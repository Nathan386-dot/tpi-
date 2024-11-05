<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et a le usertype 'admin'
        if (Auth::check() && Auth::user()->usertype != 'user') {
            return $next($request);
        }

        // Rediriger vers la page d'accueil ou toute autre page si l'utilisateur n'est pas un admin
        return redirect('/');
    }
}
