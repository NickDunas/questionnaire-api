<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\AnswerRepository;

class AnswerController extends APIController
{
    /**
     * The repository responsible for handling CRUD and search operations on the model.
     *
     * @var AnswerRepository
     */
    protected $repository;

    /**
     * AnswerRepository constructor.
     *
     * @param AnswerRepository $repository
     */
    public function __construct(AnswerRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }
}
