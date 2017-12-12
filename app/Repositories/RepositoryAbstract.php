<?php

namespace App\Repositories;

use Exception;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Queue\EntityNotFoundException;

abstract class RepositoryAbstract implements RepositoryInterface
{
    /**
     * Entity instance.
     *
     * @var mixed
     */
    protected $entity;

    /**
     * RepositoryAbstract constructor.
     */
    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    /**
     * Return paginated resource collection.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->entity->get();
    }

    /**
     * Return resource item.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create resource item.
     *
     * @param $properties
     * @return mixed
     */
    public function create($properties)
    {
        return $this->entity->create($properties);
    }

    /**
     * Update resource item.
     *
     * @param $id
     * @param $properties
     * @return mixed
     */
    public function update($id, $properties)
    {
        $entity = $this->entity->find($id);

        $entity->update($properties);

        return $entity;
    }

    /**
     * Delete resource item.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->entity->find($id)->delete();
    }

    /**
     * Resolve resource entity.
     *
     * @return mixed
     * @throws Exception
     */
    protected function resolveEntity()
    {
        if (! method_exists($this, 'entity')) {
            throw new Exception('No entity defined');
        }

        return app()->make($this->entity());
    }
}