<?php

namespace App\Http\Controllers;

use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AdminTeacherController extends Controller
{
    public function index()
    {
        return view('administrator.teachers.index', [
            'teachers' => User::where('profile_type', 'App\Models\TeacherProfile')->get()
        ]);
    }

    public function create()
    {
        return view('administrator.teachers.create');
    }

    public function store()
    {
        $attributes = $this->validateTeacher();

        $teacher = User::create([
            'username' => $attributes['username'],
            'firstname' => $attributes['firstname'],
            'middlename' => $attributes['middlename'],
            'lastname' => $attributes['lastname'],
            'gender' => $attributes['gender'],
            'password' => bcrypt($attributes['password'])
        ]);

        $profile = TeacherProfile::create(['contact' => $attributes['contact']]);
        $profile->user()->save($teacher);

        return redirect(route('admin.teachers.index'))
            ->with('success', 'You have successfully created a teacher account!');
    }

    public function edit(User $teacher)
    {
        return view('administrator.teachers.edit', compact('teacher'));
    }

    public function update(User $teacher)
    {
        $attributes = $this->validateTeacher($teacher->id, $teacher->profile->id);

        $updated = [];

        if ($teacher->username !== $attributes['username']) {
            $updated['username'] = $attributes['username'];
        }

        if ($teacher->firstname !== $attributes['firstname']) {
            $updated['firstname'] = $attributes['firstname'];
        }

        if ($teacher->middlename !== $attributes['middlename']) {
            $updated['middlename'] = $attributes['middlename'];
        }

        if ($teacher->lastname !== $attributes['lastname']) {
            $updated['lastname'] = $attributes['lastname'];
        }

        if ($teacher->gender !== $attributes['gender']) {
            $updated['gender'] = $attributes['gender'];
        }

        if (!empty($updated) || $teacher->profile->contact !== $attributes['contact']) {
            if (!empty($updated)) {
                $teacher->update($updated);
            }

            if ($teacher->profile->contact !== $attributes['contact']) {
                $teacher->profile->update(['contact' => $attributes['contact']]);
            }

            return redirect(route('admin.teachers.index'))
                ->with('success', 'You have successfully updated the teacher account you selected!');
        } else {
            return redirect(route('admin.teachers.index'))
                ->with('info', 'You did not update any field.');
        }

    }

    public function destroy(User $teacher)
    {
        $teacher->profile->delete();
        $teacher->delete();

        return redirect(route('admin.teachers.index'))
            ->with('success', 'You have successfully delete the teacher account you selected!');
    }

    public function editPassword(User $teacher)
    {
        return view('administrator.teachers.edit-password', compact('teacher'));
    }

    public function updatePassword(User $teacher)
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

    protected function validateTeacher($user = '', $profile = ''): array
    {
        return request()->validate([
            'username' => [
                'required', 'min:5', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($user)
            ],
            'firstname' => [
                'required', 'min:2', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', [request('firstname')])
                    ->where('middlename', [request('middlename')])
                    ->where('lastname', [request('lastname')])
                    ->ignore($user)
            ],
            'middlename' => [
                'required', 'min:2', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', [request('firstname')])
                    ->where('middlename', [request('middlename')])
                    ->where('lastname', [request('lastname')])
                    ->ignore($user)
            ],
            'lastname' => [
                'required', 'min:2', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', [request('firstname')])
                    ->where('middlename', [request('middlename')])
                    ->where('lastname', [request('lastname')])
                    ->ignore($user)
            ],
            'contact' => [
                'required', 'size:11', 'starts_with:09',
                Rule::unique('teacher_profiles', 'contact')->ignore($profile)
            ],
            'gender' => [
                'required', 'alpha'
            ],
            'password' => [
                Password::min(5),
                Rule::requiredIf(function () {
                    return request()->getRequestUri() === '/admin/teachers/create';
                })
            ],
            'password_confirmation' => [
                'same:password',
                Rule::requiredIf(function () {
                    return request()->getRequestUri() === '/admin/teachers/create';
                })
            ]
        ]);
    }
}
