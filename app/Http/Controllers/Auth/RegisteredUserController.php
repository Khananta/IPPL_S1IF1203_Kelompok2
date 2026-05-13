<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\SendOtpMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Tambahkan ini untuk return type JSON
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * STEP 1: Kirim OTP via AJAX (Grounded with Security Check)
     */
    public function sendOtp(Request $request): JsonResponse
    {
        try {
            // Validasi format email dasar
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            ]);

            // Cek manual keunikan email agar bisa kita kustomisasi pesannya untuk SweetAlert
            $userExists = User::where('email', $request->email)->exists();
            if ($userExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email ini sudah terdaftar! Silakan login atau gunakan email lain.'
                ], 422);
            }

            $otpCode = rand(100000, 999999);

            // Simpan atau update OTP di database
            DB::table('otps')->updateOrInsert(
                ['email' => $request->email],
                [
                    'otp' => $otpCode,
                    'expires_at' => Carbon::now()->addMinutes(5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Kirim Email via Mailtrap/SMTP
            Mail::to($request->email)->send(new SendOtpMail($otpCode));

            return response()->json([
                'success' => true,
                'message' => 'Kode OTP berhasil dikirim ke email kamu!'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        }
    }

    /**
     * STEP 2 (Optional Step Check): Digunakan saat user klik verifikasi di Step 2 sebelum isi password
     */
    public function verifyOnly(Request $request): JsonResponse
    {
        $otpData = DB::table('otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpData) {
            return response()->json([
                'success' => false, 
                'message' => 'Kode OTP salah atau sudah kedaluwarsa.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP valid!'
        ], 200);
    }

    /**
     * STEP 3: Validasi Akhir & Simpan User Baru
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'otp' => ['required', 'string', 'size:6'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Cek ulang validitas OTP sebelum mendaftarkan akun (Double Security)
            $otpData = DB::table('otps')
                ->where('email', $request->email)
                ->where('otp', $request->otp)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if (!$otpData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proses gagal. Kode OTP salah atau sudah kedaluwarsa.'
                ], 422);
            }

            // Daftarkan User Baru ke DB
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'member', // Tetap konsisten default role adalah member
            ]);

            // Bersihkan OTP dari database agar tidak bisa dipakai ulang
            DB::table('otps')->where('email', $request->email)->delete();

            event(new Registered($user));
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Akun kamu berhasil dibuat!',
                'redirect' => route('dashboard')
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        }
    }
}