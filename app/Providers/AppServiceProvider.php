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
        Gate::define("beta", function (User $user) {
            return $user->has_beta ? Response::allow() : Response::deny("This is a beta feature.");
        });
        Blade::directive('nonce', function () {
            return '<?php echo "nonce=\"" . request()->get("nonce") . "\"" ?>';
        });
    }
}
