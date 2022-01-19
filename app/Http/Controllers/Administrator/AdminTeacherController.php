<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherAccount;
use App\Models\TeacherProfile;
use App\Models\User;

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

    public function store(StoreTeacherAccount $request)
    {
        $attributes = $request->all();

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

    public function update(StoreTeacherAccount $request, User $teacher)
    {
        $attributes = $request->all();

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
}
