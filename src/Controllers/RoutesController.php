<?php

namespace Laralum\Routes\Controllers;

use App\Http\Controllers\Controller;
use Laralum\Routes\RoutesInfo;

class RoutesController extends Controller
{
    /**
     * The RoutesInfo instance.
     *
     * @var \Laralum\Routes\RoutesInfo
     */
    protected $routesInfo;

    /**
     * RoutesController constructor.
     */
    public function __construct(RoutesInfo $routesInfo)
    {
        $this->routesInfo = $routesInfo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function routes()
    {
        $routes = $this->routesInfo->getPaginatedRoutes();

        return view('laralum_routes::routes', ['routes' => $routes]);
    }
}
