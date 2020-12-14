<?php

namespace Buddhika\AppCache;

use Illuminate\Support\ServiceProvider;

class AppCacheServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Buddhika\AppCache\Console\Commands\AppCache',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            $this->commands($this->commands);
        }
    }
}
