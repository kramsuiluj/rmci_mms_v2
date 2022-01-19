<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreTeacherAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param $profile
     * @param string $user
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required', 'min:5', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($this->teacher->id ?? null)
            ],
            'firstname' => [
                'required', 'min:2', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', [request('firstname')])
                    ->where('middlename', [request('middlename')])
                    ->where('lastname', [request('lastname')])
                    ->ignore($this->teacher->id ?? null)
            ],
            'middlename' => [
                'required', 'min:2', 'alpha_spaces',
            ],
            'lastname' => [
                'required', 'min:2', 'alpha_spaces',
            ],
            'contact' => [
                'required', 'min:11', 'starts_with:09',
                Rule::unique('teacher_profiles', 'contact')
                    ->ignore($this->teacher->profile->id ?? null)
            ],
            'gender' => ['required', 'alpha'],
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
        ];
    }
}
