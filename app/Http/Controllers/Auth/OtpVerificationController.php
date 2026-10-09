<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class OtpVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')
                ->withErrors([
                    'otp' => 'OTP session expired. Please login/register again.'
                ]);
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')
                ->withErrors([
                    'otp' => 'User not found.'
                ]);
        }

        if (!$user->otp || !$user->otp_expires_at) {
            return back()->withErrors([
                'otp' => 'OTP not found. Please request a new OTP.'
            ]);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors([
                'otp' => 'OTP has expired. Please request a new OTP.'
            ]);
        }

        if ($user->otp !== $request->otp) {
            return back()->withErrors([
                'otp' => 'Invalid OTP.'
            ]);
        }

        $user->otp = null;
        $user->otp_expires_at = null;
        $user->otp_verified = true;
        $user->save();

        session()->forget('otp_user_id');

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}