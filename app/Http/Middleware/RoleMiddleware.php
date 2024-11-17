<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role = null)
    {
        if ($role == 'admin' && Auth::user()->role !== 'admin') {
            return redirect('/'); // Redirecionar se não for admin
        }

        if ($role == 'user' && Auth::user()->role !== 'user') {
            return redirect('/'); // Redirecionar se não for usuário
        }

        return $next($request);
    }
}

