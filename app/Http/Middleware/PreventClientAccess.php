<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventClientAccess
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()?->id_rol == 3) {
            abort(403, 'No tienes permisos para acceder a este módulo.');
        }

        return $next($request);
    }
}
