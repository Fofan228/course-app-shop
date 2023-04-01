<?php

    namespace App\Providers;

    use App\Models\Category;
    use App\Models\Brand;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class ComposerServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         */
        public function register(): void
        {
            //
        }

        /**
         * Bootstrap services.
         */
        public function boot(): void
        {
            View::composer('layout.part.roots', function ($view) {
                $view->with(['items' => Category::roots()]);
            });
            View::composer('layout.part.brands', function ($view) {
                $view->with(['items' => Brand::popular()]);
            });
        }
    }
