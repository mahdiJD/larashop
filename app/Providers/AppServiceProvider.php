<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Gate::policy(Product::class, ProductPolicy::class);

        Gate::define('create-gate',function(User $user){
            return $user->role == Role::admin || $user->role == Role::root;
        });
        Gate::define('delete-or-update-gate',function(User $user , Model $model){
            return $user->id == $model->user_id || $user->role == Role::root;
        });
    }
}
