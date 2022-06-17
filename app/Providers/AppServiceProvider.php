<?php

namespace App\Providers;

use App\Events\UserEvent;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Transactions\DatabaseTransaction;
use Core\Modules\User\Events\UserEventInterface;
use Core\Modules\User\Repository\UserRepositoryInterface;
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
        $this->app->singleton(UserEventInterface::class, UserEvent::class);
        $this->app->singleton(TransactionInterface::class, DatabaseTransaction::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
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
