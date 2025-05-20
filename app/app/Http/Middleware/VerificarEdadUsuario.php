<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class VerificarEdadUsuario
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::check() ? Auth::user() : null;
        $edad = null;

        if ($user && !is_null($user->edad)) {
            $edad = $user->edad;
        } elseif (session()->has('visitante_edad')) {
            $edad = session('visitante_edad');
        } else {
            return redirect()->route('ingresar.edad');
        }

        $ruta = $request->path();

        $grupos = [
            'bebes'        => fn($e) => $e >= 0 && $e <= 5,
            'ninos'        => fn($e) => $e >= 6 && $e <= 12,
            'adolescentes' => fn($e) => $e >= 13 && $e <= 17,
            'jovenes'      => fn($e) => $e >= 18 && $e <= 25,
            'adultos'      => fn($e) => $e >= 26 && $e <= 59,
            'mayores'      => fn($e) => $e >= 60 && $e <= 74,
            'longevos'     => fn($e) => $e >= 75 && $e <= 120,
        ];

        // Redirigir automáticamente según edad
        if ($ruta === 'redirigir') {
            foreach ($grupos as $segmento => $condicion) {
                if ($condicion($edad)) {
                    return redirect("/$segmento");
                }
            }
            return redirect('/acceso-denegado');
        }

        // Validar acceso directo a grupo
        foreach ($grupos as $segmento => $condicion) {
            if ($ruta === $segmento && !$condicion($edad)) {
                if ($user) {
                    // Redirigir a su grupo correcto si está autenticado
                    foreach ($grupos as $rutaCorrecta => $condicionCorrecta) {
                        if ($condicionCorrecta($edad)) {
                            return redirect("/$rutaCorrecta");
                        }
                    }
                } else {
                    // Si es visitante → acceso denegado
                    return redirect('/acceso-denegado');
                }
            }
        }

        return $next($request);
    }
}
