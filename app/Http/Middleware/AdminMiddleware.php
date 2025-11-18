<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Verifica se o usuário está logado
        // 2. Verifica se a coluna is_admin é verdadeira (1)
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request); // Pode passar
        }

        // Se não for admin, redireciona para a home com erro
        return redirect('/')->with('error', 'Acesso negado. Você não é administrador.');
    }
}
