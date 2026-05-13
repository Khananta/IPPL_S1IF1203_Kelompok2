<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse; // Ubah ini untuk merespon AJAX
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request (AJAX Friendly).
     *
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // 1. Validasi input password dan token
            $request->validate([
                'token' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // 2. Jalankan proses reset password via Laravel Broker
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );

            // 3. Jika kata sandi sukses diperbarui
            if ($status == Password::PASSWORD_RESET) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kata sandi kamu berhasil diperbarui! Mengalihkan...',
                    'redirect' => route('login')
                ], 200);
            }

            // 4. Jika gagal dari Laravel Broker (misal token kadaluwarsa)
            return response()->json([
                'success' => false,
                'message' => __($status)
            ], 422);

        } catch (ValidationException $e) {
            // Menangkap error validasi (misal password kurang panjang atau konfirmasi tidak cocok)
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        }
    }
}