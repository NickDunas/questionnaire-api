<?php

namespace App\Observers;

use App\Section;

class SectionObserver
{
    /**
     * Listen to the Section creating event.
     *
     * @param  \App\Section  $section
     * @return void
     */
    public function creating(Section $section)
    {
        $maxOrder = (int) $this->getMaxSectionOrder($section);
        $section->order = ($maxOrder >= 1) ? $maxOrder + 1 : 1;
    }

    /**
     * Get the max order of the specific questionnaire
     *
     * @param Section $section
     * @return mixed
     */
    private function getMaxSectionOrder(Section $section)
    {
        return Section::query()->where('questionnaire_id', $section->questionnaire_id)->max('order');
    }
}