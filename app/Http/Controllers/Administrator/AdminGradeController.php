<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Strand;
use Illuminate\Validation\Rule;

class AdminGradeController extends Controller
{
    public function index(Strand $strand)
    {
        return view('administrator.grades.index', compact('strand'));
    }

    public function show(Strand $strand, Grade $grade)
    {
        return view('administrator.grades.show', compact('strand', 'grade'));
    }

    public function create(Strand $strand)
    {
        return view('administrator.grades.create', compact('strand'));
    }

    public function store(Strand $strand)
    {
        $grade = request()->validate([
            'name' => [
                'required',
                Rule::unique('grades')
                    ->where('strand_id', $strand->id)
                    ->where('name', request('name'))
            ]
        ]);

        Grade::create([
            'strand_id' => $strand->id,
            'name' => $grade['name']
        ]);

        return redirect(route('admin.strands.index'))
            ->with('success', 'You have successfully set a grade to the strand you selected!');
    }

    public function destroy($strand, Grade $grade)
    {
        $grade->delete();

        return redirect(route('admin.strands.index'))
            ->with('success', 'You have successfully deleted the grade you selected!');
    }
}
