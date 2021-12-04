<?php

namespace App\Http\Controllers;


use App\Models\Subject;
use Illuminate\Validation\Rule;

class AdminSubjectController extends Controller
{
    public function index()
    {
        return view('administrator.subjects.index', [
            'subjects' => Subject::all()
        ]);
    }

    public function create()
    {
        return view('administrator.subjects.create');
    }

    public function store()
    {
        Subject::create($this->validateSubject());

        return redirect(route('admin.subjects.index'))
            ->with('success', 'You have successfully created a subject!');
    }

    public function edit(Subject $subject)
    {
        return view('administrator.subjects.edit', compact('subject'));
    }

    public function update(Subject $subject)
    {
        $attributes = $this->validateSubject($subject->id);
        $update = [];

        if ($subject->name !== $attributes['name']) {
            $update['name'] = $attributes['name'];
        }

        if ($subject->description !== $attributes['description']) {
            $update['description'] = $attributes['description'];
        }

        if (!empty($update)) {
            $subject->update($update);

            return redirect(route('admin.subjects.index'))
                ->with('success', 'You have successfully updated the subject you selected!');
        } else {
            return redirect(route('admin.subjects.index'))
                ->with('info', 'You did not update any field.');
        }
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect(route('admin.subjects.index'))
            ->with('success', 'You have successfully deleted the subject you selected!');
    }

    protected function validateSubject($subject = ''): array
    {
        return request()->validate([
            'name' => [
                'required', 'min:3', 'max:50', 'alphanumeric_spaces',
                Rule::unique('subjects', 'name')->ignore($subject)
            ],
            'description' => [
                'required', 'between:12,255',
            ]
        ]);
    }
}
