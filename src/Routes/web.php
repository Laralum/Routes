<?php

Route::group([
        'middleware' => [
            'web', 'laralum.base', 'laralum.auth',
            // 'can:access,Laralum\Routes\Models\Route',
        ],
        'prefix'    => config('laralum.settings.base_url'),
        'namespace' => 'Laralum\Routes\Controllers',
        'as'        => 'laralum::routes.',
    ], function () {
        Route::get('routes', 'RoutesController@routes')->name('index');
    });
