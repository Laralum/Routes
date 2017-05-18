@extends('laralum::layouts.master')
@section('icon', 'ion-soup-can')
@section('title', __('laralum_routes::general.routes'))
@section('subtitle', __('laralum_routes::general.routes_desc'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_routes::general.home')</a></li>
        <li><span>@lang('laralum_routes::general.routes')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum_routes::general.routes')
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('laralum_routes::general.name')</th>
                                        <th>@lang('laralum_routes::general.method')</th>
                                        <th>@lang('laralum_routes::general.uri')</th>
                                        <th>@lang('laralum_routes::general.action')</th>
                                        <th>@lang('laralum_routes::general.middleware')</th>
                                        <th>@lang('laralum_routes::general.host')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($routes as $route)
                                        <tr>
                                            <td>{{ $route->name }}</td>
                                            <th>{{ $route->method }}</th>
                                            <th>{{ $route->uri }}</th>
                                            <th>{{ $route->action }}</th>
                                            <th>{{ $route->middleware }}</th>
                                            <th>{{ $route->host }}</th>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @include('laralum::layouts.pagination', ['paginator' => $routes])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
