<?php

namespace Laralum\Routes;

use Laralum\CRUD\Models\Route;
use Illuminate\Support\Facades\Gate;
use Laralum\CRUD\Policies\RoutePolicy;
use Illuminate\Support\ServiceProvider;
use Laralum\Permissions\PermissionsChecker;

class RoutesServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Route::class => RoutePolicy::class,
    ];

    /**
     * The mandatory permissions for the module.
     *
     * @var array
     */
    protected $permissions = [
        [
            'name' => 'Routes Access',
            'slug' => 'laralum::routes.access',
            'desc' => 'Grants access to laralum/Routes module',
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadViewsFrom(__DIR__.'/Views', 'laralum_routes');
        $this->loadTranslationsFrom(__DIR__.'/Translations', 'laralum_routes');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        // Make sure the permissions are OK
        PermissionsChecker::check($this->permissions);
    }

    /**
     * I cheated this comes from the AuthServiceProvider extended by the App\Providers\AuthServiceProvider.
     *
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
