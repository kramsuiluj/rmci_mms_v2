<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Strand;
use Illuminate\Validation\Rule;

class AdminSectionController extends Controller
{
    public function index(Strand $strand)
    {
        return view('administrator.sections.index', [
            'strand' => $strand,
        ]);
    }

    public function show(Strand $strand, Section $section)
    {
        return view('administrator.sections.show', [
            'strand' => $strand,
            'section' => $section
        ]);
    }

    public function create(Strand $strand)
    {
        return view('administrator.sections.create', [
            'grades' => $strand->grades,
            'strand' => $strand
        ]);
    }

    public function store()
    {
        Section::create($this->validateSection());

        return redirect(route('admin.strands.index'))
            ->with('success', 'You have successfully created a section!');
    }

    public function edit(Strand $strand, Section $section)
    {
        return view('administrator.sections.edit', compact('strand', 'section'));
    }

    public function update(Strand $strand, Section $section)
    {
        $attributes = $this->validateSection($section->id);
        $update = [];

        if ($section->grade_id !== (int)$attributes['grade_id']) {
            $update['grade_id'] = $attributes['grade_id'];
        }

        if ($section->name !== $attributes['name']) {
            $update['name'] = $attributes['name'];
        }

        if (! empty($update)) {
            $section->update($update);

            return redirect(route('admin.strands.index'))
                ->with('success', 'You have successfully updated the section you selected!');
        } else {
            return redirect(route('admin.strands.index'))
                ->with('info', 'You did not update any field.');
        }
    }

    public function destroy(Strand $strand, Section $section)
    {
        $section->delete();

        return redirect(route('admin.strands.index'))
            ->with('success', 'You have successfully deleted the section you selected!');
    }

    protected function validateSection($section = ''): array
    {
        return request()->validate([
            'grade_id' => [
                'required',
                Rule::exists('grades', 'id'),
                Rule::unique('sections')
                    ->where('grade_id', request('grade_id'))
                    ->where('name', request('name'))
                    ->ignore($section)
            ],
            'name' => [
                'required', 'min:3', 'max:40', 'alpha',
                Rule::unique('sections')
                    ->where('grade_id', request('grade_id'))
                    ->where('name', request('name'))
                    ->ignore($section)
            ]
        ]);
    }
}
