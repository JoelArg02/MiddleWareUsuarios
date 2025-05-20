<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PerfilController extends Controller
{
    public function form()
    {
        return view('perfil.completar');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'edad' => ['required', 'integer', 'min:1', 'max:120'],
        ]);
        $user = Auth::user();
        if (!$user instanceof \App\Models\User) {
            $user = User::find($user->id);
        }
        $user->edad = $request->input('edad');
        $user->save();

        if ($user->edad < 16) {
            return redirect('/menor-de-16');
        }

        if ($user->edad >= 16 && $user->edad < 18) {
            return redirect('/entre-16-y-17');
        }

return redirect('/mayor-de-edad');
    }
}
