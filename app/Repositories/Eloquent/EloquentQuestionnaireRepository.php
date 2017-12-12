<?php

namespace App\Repositories\Eloquent;

use App\Questionnaire;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\QuestionnaireRepository;

class EloquentQuestionnaireRepository extends RepositoryAbstract implements QuestionnaireRepository
{
    public function entity()
    {
        return Questionnaire::class;
    }
}