<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Auth\MyCustomRegisteredUserController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\OwnerAuthenticatedSessionController;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fortify::createUsersUsing(CreateNewUser::class);

        $this->app->bind(
            FortifyLoginRequest::class,
            CustomLoginRequest::class
        );
        
        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Route::middleware('web')->post('/register', [MyCustomRegisteredUserController::class, 'store']);
        Route::middleware('web')->post('/login', [CustomLoginController::class, 'store']);
        Route::middleware('web')->post('/admin/login', [AdminAuthenticatedSessionController::class, 'store']);
        Route::middleware('web')->post('/logout', [CustomLoginController::class, 'destroy']);
        Route::middleware('web')->post('/admin/logout', [AdminAuthenticatedSessionController::class, 'destroy']);
        Route::middleware('web')->post('/owner/login', [OwnerAuthenticatedSessionController::class, 'store']);
        Route::middleware('web')->post('/owner/logout', [OwnerAuthenticatedSessionController::class, 'destroy']);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}
