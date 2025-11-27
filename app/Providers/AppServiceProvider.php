<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PaluwaganRepositoryInterface;
use App\Repositories\PaluwaganRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Keep only unrelated bindings
        $this->app->bind(PaluwaganRepositoryInterface::class, PaluwaganRepository::class);

       $this->app->bind(
    \App\Services\UserManagementServiceInterface::class,
    \App\Services\UserManagementService::class
);

    $this->app->bind(
        \App\Services\UserManagementServiceInterface::class,
        \App\Services\UserManagementService::class
    );

    // Required dependencies
    $this->app->bind(
        \App\Repositories\UserRepositoryInterface::class,
        \App\Repositories\UserRepository::class
    );

    $this->app->bind(
        \App\Factories\UserFactoryInterface::class,
        \App\Factories\ConcreteUserFactory::class
    );

    $this->app->bind(
        \App\Repositories\RolePrivilegeRepositoryInterface::class,
        \App\Repositories\RolePrivilegeRepository::class
    );
    }

    public function boot()
    {
        //
    }
}
