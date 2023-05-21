<?php

namespace App\Providers;

use App\Models\Post;
use App\View\Components\Alert;
//use App\View\Components\inputs\Button;
//use App\View\Components\form\Button as FormButton;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

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
        //
        Blade::directive('datetime', function ($expression) {
            $expression = trim($expression, '\'');
            $expression = trim($expression, '"');
            $dateObject = date_create($expression);
            if (!empty($dateObject)) {
                $dateFormat = $dateObject->format('d/m/y h:i');
                return  $dateFormat;
            }
        });

        Blade::if('nhan', function ($value) {
            if (config('app.env') === $value) {
                return true;
            }
            return false;
        });

        Blade::component('package_alert', Alert::class);
//        Blade::component('button', Button::class);
//        Blade::component('form.button', FormButton::class);
        Paginator::useBootstrap();

//        Post::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }
}
