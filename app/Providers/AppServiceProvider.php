<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Gate::define('beta', function (User $user) {
            return $user->is_beta ? Response::allow() : Response::denyAsNotFound();
        });
        Gate::define('admin', function (User $user) {
            return $user->is_admin ? Response::allow() : Response::denyAsNotFound();
        });
        Gate::before(function (User $user) {
            return $user->is_admin ? true : null;
        });
        Blade::directive('nonce', function () {
            return 'nonce="<?php echo request()->attributes->get("nonce") ?>"';
        });
    }
}
