<?php

namespace App\Support;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Mpdf\Output\Destination;

/**
 * A simple wrapper around Mpdf
 */
class Pdf
{
    /**
     * The underlying Mpdf instance.
     *
     * @var Mpdf $mpdf
     */
    public $mpdf;

    public function __construct()
    {
        // Todo: Bind from a service provider.
        App::bind(Mpdf::class, function () {
            $mpdf = new Mpdf(config('pdf'));

            if (config('pdf.watermark')) {
                $mpdf->SetWatermarkImage(config('pdf.watermark'), '0.05', [450, 200]);
                $mpdf->showWatermarkImage = true;
            }

            if (config('pdf.footer')) {
                $mpdf->SetHTMLFooter(view(config('pdf.footer')));
            }

            return $mpdf;
        });
    }

    /**
     * Set the page format for the Pdf.
     *
     * @param $format
     * @return $this
     */
    public function format($format): static
    {
        config(['pdf.format' => $format]);

        return $this;
    }

    /**
     * Set the margin for the Pdf.
     *
     * @param $value
     * @return $this
     */
    public function margin($value): static
    {
        config([
            'pdf.margin_left'   => $value,
            'pdf.margin_right'  => $value,
            'pdf.margin_top'    => $value,
            'pdf.margin_bottom' => $value,
        ]);

        return $this;
    }

    public function view($name, $data = []): static
    {
        return $this->write(view($name, $data));
    }

    public function write($html): static
    {
        $this->boostMemoryLimits();

        $this->mpdf = app(Mpdf::class);

        @$this->mpdf->WriteHTML($html);

        return $this;
    }

    /**
     * Boost the memory limits to accommodate large PDFs.
     */
    public function boostMemoryLimits(): void
    {
        ini_set("pcre.backtrack_limit", "50000000");
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 120);
    }

    public function stream($filename = 'file')
    {
        $filename = $this->name($filename);

        return $this->mpdf->Output($filename, Destination::INLINE);
    }

    /**
     * Get a sanitized version of the pdf filename.
     */
    public function name($filename): string
    {
        return preg_replace('/[^a-zA-Z0-9]+/', '-', $filename) . '.pdf';
    }

    public function download($filename = 'file')
    {
        $filename = $this->name($filename);

        return $this->mpdf->Output($filename, Destination::DOWNLOAD);
    }

    /**
     * Get the PDF string from the cache, or execute the given Closure and store the result.
     */
    public function remember($key, $ttl, Closure $callback, $filename): Response
    {
        $base64 = Cache::remember($key, $ttl, function () use ($callback) {
            return $this->write($callback())->base64();
        });

        return $this->fromBase64($base64, $filename);
    }

    /**
     * A base64 encoded string of the generated PDF.
     *
     * @return string
     * @throws MpdfException
     */
    public function base64(): string
    {
        return base64_encode($this->string());
    }

    /**
     * Returns the of the generated PDF as a raw string.
     *
     * @param $html
     * @return string
     * @throws MpdfException
     */
    public function string(): string
    {
        return $this->mpdf->Output(null, Destination::STRING_RETURN);
    }

    /**
     * Decode the given base64 PDF string and return it as a proper HTTP response.
     */
    public function fromBase64($string, $filename): Response
    {
        $filename = $this->name($filename);

        return response(base64_decode($string))->withHeaders([
            'Content-Type'        => 'application/pdf',
            'Content-disposition' => "inline; filename=\"$filename\""
        ]);
    }
}
