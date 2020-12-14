<?php

namespace Buddhika\AppCache\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menu driven cache management';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $option = $this->choice(
            'Cache',
            [
                'All',
                'Config',
                'Views and Routes',
                'Clear All',
                'Clear Cache and Config',
                'Clear Routes and Views',
            ],
            3
        );

        if ($option == 'All') {
            $commands = ['config:cache', 'route:cache', 'view:cache'];
            $message = 'Caching config, routes and views!';
        } else if ($option == 'Config') {
            $commands = ['config:cache'];
            $message = 'Caching config!';
        } else if ($option == 'Views and Routes') {
            $commands = ['route:cache', 'view:cache'];
            $message = 'Caching routes and views!';
        } else if ($option == 'Clear All') {
            $commands = ['cache:clear', 'config:clear', 'optimize:clear', 'route:clear', 'view:clear'];
            $message = 'Clearing cache, config, bootstrap, routes and views!';
        } else if ($option == 'Clear Cache and Config') {
            $commands = ['cache:clear', 'config:clear', 'optimize:clear'];
            $message = 'Clearing cache, config and bootstrap!';
        } else if ($option == 'Clear Routes and Views') {
            $commands = ['route:clear', 'view:clear', 'optimize:clear'];
            $message = 'Clearing routes, views and bootstrap!';
        } else {
            $commands = [];
            $message = 'Something went wrong!';
        }

        $this->info($message);
        $this->withProgressBar($commands, function($command) use ($message) {
            Artisan::call($command);
            usleep(100000);;
        });
        $this->info('');
    }
}
