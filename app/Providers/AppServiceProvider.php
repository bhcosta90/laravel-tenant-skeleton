<?php

namespace App\Providers;

use App\Mail\User\SendEmailUserCreated;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Transactions\DatabaseTransaction;
use App\Shared\EventManager;
use Core\Modules\User\Repository\UserRepositoryInterface;
use Core\Shared\Interfaces\EventManagerInterface;
use Core\Shared\Interfaces\TransactionInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
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
        $this->app->singleton(EventManagerInterface::class, EventManager::class);
        $this->app->singleton(TransactionInterface::class, DatabaseTransaction::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        Event::listen('user.created.*', function ($eventName, array $data) {
            Mail::send(new SendEmailUserCreated($data['name'], $data['email'], $data['password']));
        });
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
