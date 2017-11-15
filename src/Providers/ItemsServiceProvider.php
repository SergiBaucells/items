<?php

namespace Baucells\Items\Providers;

use Baucells\Items\Console\Commands\CreateItemCommand;
use Baucells\Items\Console\Commands\Esborrar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/**
 * Class ItemsServiceProvider.
 */
class ItemsServiceProvider extends ServiceProvider
{

    public function register()
    {
        if (!defined('ITEMS_PATH')) {
            define('ITEMS_PATH', realpath(__DIR__.'/../../'));
        }

        $this->registerEloquentFactoriesFrom(ITEMS_PATH . '/database/factories');

    }

    public function boot()
    {

        $this->defineRoutes();
        $this->loadViews();
        $this->loadmigrations();
        $this->loadCommands();
    }

    /**
     * Load commands
     */
    protected function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateItemCommand::class,
            ]);
        }
    }

    private function defineRoutes()
    {
        $this->defineWebRoutes();
        $this->defineApiRoutes();
    }

    protected function defineWebRoutes()     {
        require ITEMS_PATH . '/routes/web.php';
    }

    protected function defineApiRoutes()     {
        require ITEMS_PATH . '/routes/api.php';
    }

    private function loadViews()
    {
        $this->loadViewsFrom(ITEMS_PATH.'/resources/views', 'items');
    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(ITEMS_PATH.'/database/migrations');
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path)
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }
}