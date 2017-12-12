<?php

namespace App\Repositories\Eloquent;

use App\Question;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\QuestionRepository;

class EloquentQuestionRepository extends RepositoryAbstract implements QuestionRepository
{
    public function entity()
    {
        return Question::class;
    }
}