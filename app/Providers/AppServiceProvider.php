<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Location;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Support\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::unguard();

        $this->registerCacheableApplicationModels();
        $this->registerCustomBladeDirectives();
        $this->registerMigrationMacros();
        $this->registerApiResponseMacro();
        $this->registerCarbonMacro();
        //$this->registerSiteSetting();

        Paginator::useBootstrapFive();
    }

    /**
     * Creates a Response macro for API json responses having a standard format;
     */
    public function registerApiResponseMacro(): void
    {
        Response::macro('api', function (string $message, $data = [], $status = 200, array $headers = []) {
            return response()->json(['message' => $message, 'data' => $data], $status, $headers);
        });
    }

    public function registerCarbonMacro(): void
    {
        Carbon::macro('greet', fn () => match (true) {
            ($hour = now()->format('H')) < 12 => 'Morning',
            $hour < 17 => 'Afternoon',
            default    => 'Evening'
        });
    }

    public function registerMigrationMacros(): void
    {
        Blueprint::macro('authors', function () {
            /** @var Blueprint $this */
            $this->foreignId('created_by')->nullable()->constrained('users');
            $this->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    public function registerSiteSetting(): void
    {
        $this->app->singleton(Setting::class, function () {
           return Cache::rememberForever('setting', fn () => Setting::firstOrFail());
        });
    }

    public function registerCacheableApplicationModels(): void
    {
        $this->app->bind('categories',
            fn () => Category::latest('relevance')->withWhereHas('subCategories')->get() // Todo: Cache forever
        );

        $this->app->bind('locations',
            fn () => Location::whereNotNull('featured_at')->get() // Todo: Cache forever
        );

        $this->app->bind('featured_products',
            fn () => Product::featured()->whereHas('image')->get() // Todo: Cache forever
        );

        $this->app->bind('brands',
            fn () => Brand::all() // Todo: Cache forever
        );
    }

    public function registerCustomBladeDirectives(): void
    {
        Blade::if('admin', function (?User $user = null) {
            return ($user ?? user())->isAdmin();
        });

        Blade::if('customer', function (?User $user = null) {
            return ($user ?? user())->isCustomer();
        });

        Blade::directive('money', function ($expression) {
            return "<?php echo number_format($expression) ?>";
        });
    }
}
