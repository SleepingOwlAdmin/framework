<?php
namespace SleepingOwl\Framework\Providers;

use Illuminate\Support\ServiceProvider;
use SleepingOwl\Framework\Contracts\SleepingOwl;
use SleepingOwl\Framework\Routing\Router;
use SleepingOwl\Framework\Routing\UrlGenerator;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('sleepingowl.router', function($app) {
            return new \SleepingOwl\Framework\Routing\Router(
                $app['router'],
                $app[SleepingOwl::class]->config()->get('url_prefix', 'backend')
            );
        });

        $this->app->singleton('sleepingowl.url', function($app) {
            $routes = $app['router']->getRoutes();

            return new UrlGenerator(
                $routes,
                $app['sleepingowl.router'],
                $app->rebinding(
                    'request', function ($app, $request) {
                        $app['url']->setRequest($request);
                    }
                )
            );
        });

        $this->defineRoutes($this->app['sleepingowl.router']);
    }

    /**
     * Define the SleepingOwl routes.
     *
     * @param Router $router
     * @return void
     */
    protected function defineRoutes(Router $router)
    {
        $this->defineRouteBindings($router);

        // If the routes have not been cached, we will include them in a route group
        // so that all of the routes will be conveniently registered to the given
        // controller namespace. After that we will load the Spark routes file.
        if (! $this->app->routesAreCached()) {
            $router->group([
                'namespace' => 'SleepingOwl\Framework\Http\Controllers'],
                function () use($router) {
                    require SLEEPINGOWL_PATH.'/routes/web.php';
                }
            );

            $router->group([
                'namespace' => 'SleepingOwl\Api\Http\Controllers'],
                function () use($router) {
                    require SLEEPINGOWL_PATH.'/routes/api.php';
                }
            );
        }
    }

    /**
     * Define the SleepingOwl route model bindings.
     *
     * @param Router $router
     * @return void
     */
    protected function defineRouteBindings(Router $router)
    {

    }
}