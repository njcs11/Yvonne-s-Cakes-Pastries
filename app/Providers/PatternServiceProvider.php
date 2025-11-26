<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Factories\UserFactoryInterface;
use App\Factories\ConcreteUserFactory;
use App\Services\UserManagementServiceInterface;
use App\Services\UserManagementService;
use App\Repositories\RolePrivilegeRepositoryInterface;
use App\Repositories\RolePrivilegeRepository;
use App\Proxies\UserManagementAuthorizationProxy;


class PatternServiceProvider extends ServiceProvider
{
public function register()
{
// Bind repository & factory
$this->app->bind(UserRepositoryInterface::class, UserRepository::class);
$this->app->bind(UserFactoryInterface::class, ConcreteUserFactory::class);
$this->app->bind(RolePrivilegeRepositoryInterface::class, RolePrivilegeRepository::class);


// Bind service
$this->app->bind(UserManagementServiceInterface::class, function($app) {
$real = new UserManagementService(
$app->make(UserRepositoryInterface::class),
$app->make(UserFactoryInterface::class),
$app->make(RolePrivilegeRepositoryInterface::class)
);


// Wrap with proxy to enforce authorization
return new UserManagementAuthorizationProxy(
$real,
$app->make(RolePrivilegeRepositoryInterface::class)
);
});
}


public function boot()
{
// Nothing here for now
}
}