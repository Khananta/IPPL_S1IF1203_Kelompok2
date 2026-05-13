<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User; // Tambahkan ini untuk mengecek keberadaan email
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Ubah return type menjadi JsonResponse
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk mengecek kecocokan password
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        try {
            // 2. Langsung lempar ke autentikasi bawaan Laravel
            $request->authenticate();
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => route('dashboard', absolute: false)
            ], 200);

        } catch (ValidationException $e) {
            $errorMessage = $e->getMessage();
            if (!str_contains($errorMessage, 'seconds')) { 
                $errorMessage = 'Email atau kata sandi yang kamu masukkan salah!';
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ], 422);
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
};