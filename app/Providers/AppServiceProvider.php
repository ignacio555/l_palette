<?php

namespace App\Providers;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


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
        Gate::define('ver-productos', function (User $user, Producto $producto) {
            #return $user->id === $login->id;
            return $user->id === $producto->pivot->user_id;
                #? Response::allow()
                #: Response::deny('No es tu comentario');
        });

        Gate::define('rol', function (User $user) {
            #return $user->id === $login->id;
            $datos = $user->roles;
            if($datos->isNotEmpty())
            {
                return $datos[0]->dato === 1;
            }
            else
            {
                return false;
            }
                #? Response::allow()
                #: Response::deny('No es tu comentario');
        });

    }
}
