<?php

namespace CHHW\RouteList;

use CHHW\RouteList\Commands\RouteListCommand;
use Illuminate\Support\ServiceProvider;

class RouteListServiceProvider extends ServiceProvider
{
    protected $commands = [
        'RouteList' => RouteListCommand::class,
    ];

    protected $devCommands = [
        //
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands(array_merge(
            $this->commands, $this->devCommands
        ));
    }

    /**
     * Register the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRouteListCommand()
    {
        $this->app->singleton(RouteListCommand::class, function ($app) {
            return new RouteListCommand($app['router']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
