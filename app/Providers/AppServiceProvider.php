<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PaluwaganRepositoryInterface;
use App\Repositories\PaluwaganRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaluwaganRepositoryInterface::class, PaluwaganRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
