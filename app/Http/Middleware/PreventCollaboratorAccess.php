<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventCollaboratorAccess
{
    public function handle(Request $request, Closure $next)
    {
        if ((int) $request->user()?->id_rol === 4) {
            abort(403, 'No tienes permisos para acceder a este módulo.');
        }

        return $next($request);
    }
}
