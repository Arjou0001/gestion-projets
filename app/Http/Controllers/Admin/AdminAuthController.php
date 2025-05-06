<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminAuthController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Déconnecte l'utilisateur du guard 'admin'

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('admin.login'); // Redirige vers la page de connexion de l'admin
    }
}