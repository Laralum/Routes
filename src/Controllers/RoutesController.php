<?php

namespace Laralum\Routes\Controllers;

use Illuminate\Http\Request;
use Laralum\Routes\RoutesInfo;
use Laralum\Routes\Models\Route;
use App\Http\Controllers\Controller;

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