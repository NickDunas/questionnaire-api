<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\SectionRepository;

class SectionController extends APIController
{
    /**
     * The repository responsible for handling CRUD and search operations on the model.
     *
     * @var SectionRepository
     */
    protected $repository;

    /**
     * SectionController constructor.
     *
     * @param SectionRepository $repository
     */
    public function __construct(SectionRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }
}
