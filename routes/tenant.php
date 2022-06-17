<?php

declare(strict_types=1);

use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\{Auth, Route};
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Auth::routes();
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::view('/home', 'home');
    Route::resource('user', UserController::class)->middleware('auth');
    Route::get('profile', [UserController::class, 'profileShow'])->name('profile.show')->middleware('auth');
    Route::post('profile/password', [UserController::class, 'passwordStore'])->name('profile.store')->middleware('auth');
});
