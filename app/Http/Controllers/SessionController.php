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

        if (is_numeric($credentials['username'])) {
            if (auth()->attempt(['id' => $credentials['username'], 'password' => $credentials['password']])) {
                session()->regenerate();

                if (auth()->user()->profile->is_active == true) {
                    return redirect()->intended(route('student.index'));
                } else {
                    return redirect()->intended(route('student.edit', auth()->user()->id));
                }
            }
        } else {
            if (auth()->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
                session()->regenerate();

                if (auth()->user()->username === 'admin') {
                    return redirect()->intended(route('admin.home'));
                }

                if (auth()->user()->profile_type === 'App\Models\TeacherProfile') {
                    return redirect()->intended(route('teacher.index'));
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
