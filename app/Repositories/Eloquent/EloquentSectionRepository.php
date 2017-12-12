<?php

namespace App\Repositories\Eloquent;

use App\Section;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\SectionRepository;

class EloquentSectionRepository extends RepositoryAbstract implements SectionRepository
{
    public function entity()
    {
        return Section::class;
    }
}