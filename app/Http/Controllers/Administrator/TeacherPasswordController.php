<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class TeacherPasswordController extends Controller
{
    public function edit(User $teacher)
    {
        return view('administrator.teachers.edit-password', compact('teacher'));
    }

    public function update(User $teacher)
    {
        $attributes = request()->validate([
            'current_password' => ['required', Password::min(5)],
            'password' => ['required', Password::min(5)],
            'confirm_password' => ['required', 'same:password']
        ]);

        $currentPassword = $teacher->getAuthPassword();

        if (Hash::check($attributes['current_password'], $currentPassword)) {
            $teacher->update([
                'password' => bcrypt($attributes['password'])
            ]);

            return redirect(route('admin.teachers.index'))
                ->with('success', 'You have successfully changed the password of the teacher account you selected!');
        } else {
            throw ValidationException::withMessages([
                'current_password' => 'You entered the wrong password.'
            ]);
        }
    }

}
