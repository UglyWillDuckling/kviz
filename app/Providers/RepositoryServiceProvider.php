<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Question as QuestionHelper;
use App\Repository\Question as QuestionRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        return  $this->app->singleton(QuestionRepository::class, function ($app) {
            return new QuestionRepository();
        });
    }

}