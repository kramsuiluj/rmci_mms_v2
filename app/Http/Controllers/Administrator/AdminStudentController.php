<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = User::where('profile_type', 'App\Models\StudentProfile')->filter(request(['search']))->latest()->paginate(10)->withQueryString();
        return view('administrator.students.index', [
            'students' => $students
        ]);
    }
}
