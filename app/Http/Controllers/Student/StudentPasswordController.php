<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class StudentPasswordController extends Controller
{
    public function edit()
    {
        return view('students.change-password');
    }

    public function update()
    {
        $attributes = request()->validate([
            'current_password' => ['required', Password::min(4)],
            'password' => ['required', Password::min(5)],
            'confirm_password' => ['required', 'same:password']
        ]);

        $currentPassword = auth()->user()->getAuthPassword();

        if (Hash::check($attributes['current_password'], $currentPassword)) {
            auth()->user()->update([
                'password' => bcrypt($attributes['password'])
            ]);

            auth()->user()->profile->update(['is_active' => true]);

            return redirect(route('student.index'))
                ->with('success', 'Congratulations your account has been activated!');
        } else {
            throw ValidationException::withMessages([
                'currentPassword' => 'You entered the wrong password.'
            ]);
        }
    }
}
