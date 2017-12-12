<?php

namespace App\Repositories\Eloquent;

use App\Answer;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\AnswerRepository;

class EloquentAnswerRepository extends RepositoryAbstract implements AnswerRepository
{
    public function entity()
    {
        return Answer::class;
    }
}