<?php

namespace App\Observers;

use App\Question;

class QuestionObserver
{
    /**
     * Listen to the Question creating event.
     *
     * @param  \App\Question  $question
     * @return void
     */
    public function creating(Question $question)
    {
        $maxOrder = (int) $this->getMaxQuestionOrder($question);
        $question->order = ($maxOrder >= 1) ? $maxOrder + 1 : 1;
    }

    /**
     * Get the max order of the specific section
     *
     * @param Question $question
     * @return mixed
     */
    private function getMaxQuestionOrder(Question $question)
    {
        return Question::query()->where('section_id', $question->section_id)->max('order');
    }
}