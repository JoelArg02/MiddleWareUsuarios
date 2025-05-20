<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarEdadUsuario
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (is_null($user->edad)) {
            return redirect('/completar-perfil');
        }

        if ($request->is('redirigir')) {
            if ($user->edad < 16) {
                return redirect('/menor-de-16');
            }

            if ($user->edad >= 16 && $user->edad < 18) {
                return redirect('/entre-16-y-17');
            }

            return redirect('/mayor-de-edad');
        }

        return $next($request);
    }
}
