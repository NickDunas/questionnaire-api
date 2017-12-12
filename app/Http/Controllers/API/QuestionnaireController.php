<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\QuestionnaireRepository;

class QuestionnaireController extends APIController
{
    /**
     * The repository responsible for handling CRUD and search operations on the model.
     *
     * @var QuestionnaireRepository
     */
    protected $repository;

    /**
     * QuestionnaireController constructor.
     *
     * @param QuestionnaireRepository $repository
     */
    public function __construct(QuestionnaireRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }
}
