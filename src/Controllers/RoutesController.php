<?php

namespace Laralum\Routes\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Laralum\Routes\Models\Route;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route as BaseRoute;

class RoutesController extends Controller
{
    /**
     * The router instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * An array of all the registered routes.
     *
     * @var \Illuminate\Routing\RouteCollection
     */
    protected $routes;

    /**
     * Routes Facade constructor.
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->routes = $router->getRoutes();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function routes()
    {
        collect($this->routes)->map(function ($route) {
            dd($route->getName());
        })->all();

        return view('laralum_routes::routes', ['routes' => $routes]);
    }

    /**
     * Compile the routes into a displayable format.
     *
     * @return array
     */
    public function getAll()
    {
        $routes = collect($this->routes)->map(function ($route) {
            return $this->getRouteInformation($route);
        })->all();

        return array_filter($routes);
    }

    /**
     * Get the route information for a given route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return array
     */
    public function getRouteInformation(BaseRoute $route)
    {
        return [
            'host'   => $route->domain(),
            'method' => implode('|', $route->methods()),
            'uri'    => $route->uri(),
            'name'   => $route->getName(),
            'action' => $route->getActionName(),
            'middleware' => $this->getRouteMiddleware($route),
        ];
    }

    /**
     * Get before filters.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return string
     */
    public function getRouteMiddleware($route)
    {
        return collect($route->gatherMiddleware())->map(function ($middleware) {
            return $middleware instanceof Closure ? 'Closure' : $middleware;
        })->implode(',');
    }
}
