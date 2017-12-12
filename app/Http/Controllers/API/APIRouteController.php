<?php

namespace App\Http\Controllers\API;

use Request;
use Route;

class APIRouteController
{
    /**
     * @var APIController $controller
     */
    protected $controller;

    /**
     * APIRouteController constructor.
     */
    public function __construct()
    {
        if (!Route::current()) {
            return;
        }
        $endpoint = Route::input('endpoint');
        $resolvedControllerClass = $this->resolveAPIController($endpoint);
        $this->controller = app($resolvedControllerClass);
    }

    /**
     * Resolves the controller for the given endpoint.
     *
     * @param string $endpoint
     * @return string
     */
    protected function resolveAPIController($endpoint)
    {
        $baseClassName = studly_case($endpoint);
        $apiControllerClassName = "\\App\\Http\\Controllers\\API\\{$baseClassName}Controller";
        if (class_exists($apiControllerClassName)) {
            return $apiControllerClassName;
        }
        return APIController::class;
    }

    /**
     * Calls a method on the controller instance.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->controller->$method(Request::instance(), ...$arguments);
    }
}