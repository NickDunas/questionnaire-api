<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\QuestionRepository;

class QuestionController extends APIController
{
    /**
     * The repository responsible for handling CRUD and search operations on the model.
     *
     * @var QuestionRepository
     */
    protected $repository;

    /**
     * QuestionController constructor.
     *
     * @param QuestionRepository $repository
     */
    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }
}
