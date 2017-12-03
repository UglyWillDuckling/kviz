<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Question as QuestionHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        return  $this->app->singleton(QuestionHelper::class, function ($app) {
            return new QuestionHelper();
        });
    }
}
