<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\BaseRequest;
use App\Http\Resources\BaseResource;
use App\Repositories\RepositoryAbstract;
use App\Support\Resolver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class APIController extends Controller
{
    /**
     * The repository responsible for handling CRUD and search operations on the model.
     *
     * @var RepositoryAbstract
     */
    protected $repository = null;

    /**
     * Request class instance
     *
     * @var BaseRequest|null
     */
    protected $resourceRequest;

    /**
     * Resource class instance
     *
     * @var BaseResource|null
     */
    protected $resource;

    /**
     * APIController constructor.
     */
    public function __construct()
    {
        $endpoint = $this->resolveEndpoint();

        $requestClass = Resolver::resolveRequestClass($endpoint);

        $this->resource = Resolver::resolveResourceClass($endpoint);

        $this->resourceRequest = new $requestClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $repositoryResource = new $this->resource($request);
        return $repositoryResource->collection($this->repository->all());
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $endpoint
     * @param $id
     * @return mixed
     */
    public function show(Request $request, $endpoint, $id)
    {
        $entity = $this->repository->find($id);

        if (! $entity) {
            return $this->entityNotFound();
        }

        return new $this->resource($entity);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->resourceRequest->rules());

        $entity = $this->repository->create($request->all());

        return new $this->resource($entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $endpoint
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $endpoint, $id)
    {
        $this->validate($request, $this->resourceRequest->rules());

        $entity = $this->repository->update($id, $request->all());

        return new $this->resource($entity);
    }

    /**
     * Create the specified resource collection in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkStore(Request $request)
    {
        $entities = new Collection();

        collect($request->all())->each(function ($item) use ($entities) {
            $entity = $this->repository->create($item);

            $entities->push($entity);
        });

        $repositoryResource = new $this->resource($request);
        return $repositoryResource->collection($entities);
    }

    /**
     * Update the specified resource collection in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdate(Request $request)
    {
        $entities = new Collection();

        collect($request->all())->each(function ($item) use ($entities) {
            $entity = $this->repository->update($item['id'], $item);

            $entities->push($entity);
        });

        $repositoryResource = new $this->resource($request);
        return $repositoryResource->collection($entities);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $endpoint
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Request $request, $endpoint, $id)
    {
        $entity = $this->repository->find($id);

        if (! $entity) {
            return $this->entityNotFound();
        }

        $this->repository->delete($id);

        return response()->json([
            'Deleted entity' => (int) $id
        ]);
    }

    /**
     * Return entity not found json 404 response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function entityNotFound()
    {
        return response()->json([
            'error' => 'Entity not found',
        ], 404);
    }

    /**
     * Resolves endpoint name using the route input or controller class name.
     *
     * @return mixed|string
     */
    protected function resolveEndpoint()
    {
        $endpoint = Route::input('endpoint');

        if ($endpoint) {
            return $endpoint;
        }

        return snake_case(str_replace('Controller', '', class_basename($this)));
    }
}
