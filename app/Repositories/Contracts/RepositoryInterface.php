<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all();
    public function find($id);
    public function create($properties);
    public function delete($id);
    public function update($id, $properties);
}