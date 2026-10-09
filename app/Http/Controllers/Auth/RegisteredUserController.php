<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationCompletedMail;
use App\Models\User;
use App\Models\Income;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],

            'mobile' => [
                'required',
                'digits:10',
                'unique:users,mobile'
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],
        ]);

        $sponsorId = null;

        if ($request->filled('ref')) {

            $sponsor = User::where(
                'referral_code',
                $request->ref
            )->first();

            if ($sponsor) {
                $sponsorId = $sponsor->id;
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'sponsor_id' => $sponsorId,
        ]);

        // Future MLM income logic can be enabled here.

        event(new Registered($user));

        $user->otp = null;
        $user->otp_expires_at = null;
        $user->otp_verified = true;
        $user->save();

        try {
            Mail::to($user->email)->send(new RegistrationCompletedMail($user));
        } catch (\Throwable $exception) {
            Log::warning('Registration completed email failed.', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $exception->getMessage(),
            ]);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('status', 'Registration completed successfully.');
    }
}
