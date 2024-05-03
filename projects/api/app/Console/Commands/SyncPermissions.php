<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Route;
use Spatie\Permission\Models\Permission;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize permissions from router to a database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $router = resolve('router');
        $routes = collect($router->getRoutes());
        $ignore = '/(filament|passport|livewire|ignition)\.(.+)/';

        $routes = $routes->filter(function (Route $route) use ($ignore) {
            $name = $route->getName();
            return $name && !preg_match($ignore, $name);
        });

        $guards = collect(config('auth.guards'))->keys();
        $routes = $routes->pluck('action.as');

        $guards->each(fn($guard) => $routes->each(fn($route) => Permission::updateOrCreate(['name' => $route, 'guard_name' => $guard])));
        $this->output->success('Permissions has been synced.');
    }
}
