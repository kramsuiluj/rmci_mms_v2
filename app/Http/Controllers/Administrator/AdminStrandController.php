<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Strand;
use Illuminate\Validation\Rule;

class AdminStrandController extends Controller
{
    public function index()
    {
        return view('administrator.strands.index', [
            'strands' => Strand::all()
        ]);
    }

    public function create()
    {
        return view('administrator.strands.create');
    }

    public function store()
    {
        Strand::create($this->validateStrand());

        return redirect(route('admin.strands.index'))
            ->with('success', 'You have successfully created a strand!');
    }

    public function edit(Strand $strand)
    {
        return view('administrator.strands.edit', compact('strand'));
    }

    public function update(Strand $strand)
    {
        $attributes = $this->validateStrand($strand);

        $update = [];

        if ($strand->name !== $attributes['name']) {
            $update['name'] = $attributes['name'];
        }

        if ($strand->description !== $attributes['description']) {
            $update['description'] = $attributes['description'];
        }

        if (!empty($update)) {
            $strand->update($update);

            return redirect(route('admin.strands.index'))
                ->with('success', 'You have successfully updated the strand you selected!');
        } else {
            return redirect(route('admin.strands.index'))
                ->with('info', 'You did not update any field.');
        }
    }

    public function destroy(Strand $strand)
    {
        $strand->delete();

        return redirect(route('admin.strands.index'))
            ->with('success', 'You have successfully deleted the strand you selected!');
    }

    protected function validateStrand($strand = ''): array
    {
        return request()->validate(
            [
            'name' => [
                'required', 'min:3', 'alphanumeric_spaces',
                Rule::unique('strands', 'name')->ignore($strand)
                ],
            'description' => [
                'required', 'between:12,255',
                Rule::unique('strands', 'description')->ignore($strand)
                ]
            ],
            [
                'name.required' => 'The strand name has already been taken.'
            ]
        );
    }
}
