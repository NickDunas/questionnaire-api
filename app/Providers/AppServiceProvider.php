<?php

namespace App\Providers;

use App\Answer;
use App\Section;
use App\Question;
use App\Observers\AnswerObserver;
use App\Observers\SectionObserver;
use App\Observers\QuestionObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Section::observe(SectionObserver::class);
        Question::observe(QuestionObserver::class);
        Answer::observe(AnswerObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
