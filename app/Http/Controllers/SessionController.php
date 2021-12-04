<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function store(): RedirectResponse
    {
        $credentials = request()->validate([
            'username' => ['required', 'min:5'],
            'password' => ['required', 'min:4']
        ]);

        if (is_numeric(request('username'))) {
            if (auth()->attempt(['id' => $credentials['username'], 'password' => $credentials['password']])) {
                session()->regenerate();

                return redirect()->intended('/student');
            }
        } else {
            if (auth()->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
                session()->regenerate();

                if (auth()->user()->username === 'admin') {
                    return redirect()->intended('/admin');
                }

                if (auth()->user()->profile_type === 'App\Models\TeacherProfile') {
                    return redirect()->intended('/teacher');
                }
            }
        }

        throw ValidationException::withMessages([
            'username' => 'The username or password you provided could not be verified.',
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect(route('guest.home'));
    }
}
