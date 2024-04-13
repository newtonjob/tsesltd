<div class="row g-5 g-xl-10">
    <div class="col-12 mb-5 mb-xl-10">
        <div class="card card-flush rounded-4" data-bs-theme="light"
             style="background-color: #202B46; background-image:url('{{ asset('admin/media/svg/shapes/widget-bg-2.png') }}')"
        >
            @php([$quote, $author]  = explode('<fg=gray>', \Illuminate\Foundation\Inspiring::quote()))
            <div class="card-body mt-6 bgi-no-repeat bgi-size-cover bgi-position-x-center">
                <div class="text-white mb-9">
                    <h4 class="text-white">Quote of the day! ✨ 🌈 </h4>
                    <div class="mt-5">
                        <span>{!! $quote !!} &nbsp;</span>
                        <span class="position-relative d-inline-block">
                            <span class="text-success opacity-75-hover"> {!! $author !!}.</span>
                            <span class="position-absolute opacity-25 bottom-0 start-0 border-4 border-success border-bottom w-100"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
