<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Middleware\AccountApproval;
use App\Notifications\AdminNewUserNotification;

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->input('user_type'),
            'password' => Hash::make($request->password),
        ]);

        $admin = User::where('user_type', 'admin')->first();

        event(new Registered($user));

        Auth::login($user);

        if ($user->user_type === 'employee') {
            $admin->notify(new AdminNewUserNotification($user));
            app(AccountApproval::class)->handle($request, function () {});
            return redirect(route('login', absolute: false));
        }

        return redirect(route('guest.dashboard', absolute: false));
    }
}
