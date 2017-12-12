<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    AnswerRepository, QuestionnaireRepository, QuestionRepository, SectionRepository
};

use App\Repositories\Eloquent\{
    EloquentAnswerRepository, EloquentQuestionnaireRepository, EloquentQuestionRepository, EloquentSectionRepository
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(QuestionnaireRepository::class, EloquentQuestionnaireRepository::class);
        $this->app->bind(SectionRepository::class, EloquentSectionRepository::class);
        $this->app->bind(QuestionRepository::class, EloquentQuestionRepository::class);
        $this->app->bind(AnswerRepository::class, EloquentAnswerRepository::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
