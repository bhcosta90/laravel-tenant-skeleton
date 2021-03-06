<?php

namespace App\Providers;

use App\Events\EventManager;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Transactions\DatabaseTransaction;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Shared\Interfaces\EventManagerInterface;
use Core\Shared\Interfaces\TransactionInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
        $this->app->singleton(TransactionInterface::class, DatabaseTransaction::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(EventManagerInterface::class, EventManager::class);
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
