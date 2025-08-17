<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminAuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD');

        if (empty($password)) {
            return back()->with('error', 'Configurazione admin non valida. Contatta l\'amministratore.');
        }

        if ($request->username === $username && $request->password === $password) {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.properties.index');
        }

        return back()->with('error', 'Credenziali non valide.');
    }

    public function logout(): RedirectResponse
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }
} 