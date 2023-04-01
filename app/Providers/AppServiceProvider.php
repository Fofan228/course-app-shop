<?php

    namespace App\Providers;

    use Illuminate\Database\Connection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void
        {
            //
        }

        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
//            Model::preventLazyLoading(!app()->isProduction());
            Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

            DB::whenQueryingForLongerThan(500, function (Connection $connection) {
                // TODO Чуть позже
            });
            // TODO В рамках цикла запроса (когда запрос слишком долго выполняется)
        }
    }
