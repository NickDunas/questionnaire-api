<?php

namespace App\Observers;

use App\Answer;
use Carbon\Carbon;

class AnswerObserver
{
    /**
     * Listen to the Section creating event.
     *
     * @param  \App\Answer  $answer
     * @return void
     */
    public function creating(Answer $answer)
    {
        $answer->created_at = Carbon::now();
    }
}