<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse; // Tambahkan ini untuk merespon AJAX
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request (AJAX Friendly).
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // 1. Validasi format input email
            $request->validate([
                'email' => ['required', 'email'],
            ]);

            // 2. Kirim link token reset via Laravel Broker
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // 3. Jika sukses terkirim ke email / Mailtrap
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tautan pemulihan berhasil dikirim! Silakan cek email kamu.'
                ], 200);
            }

            // 4. Jika gagal dari Laravel Broker (misal email tidak ditemukan)
            return response()->json([
                'success' => false,
                'message' => __($status) // Mengambil translasi pesan bawaan laravel ("We can't find a user with that email address.")
            ], 422);

        } catch (ValidationException $e) {
            // Menangkap error jika format email tidak sesuai aturan validasi di atas
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        }
    }
}