<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $uniqueEmail = 'unique:users';
        if (session('id')) {
            $id = session('id');
//            $uniqueEmail = Rule::unique('users', 'email')->ignore($id);
            $uniqueEmail = 'unique:users,email,'.$id;
        }

        return [
            'fullname' => 'required|min:5',
//            'email' => ['required','email', $uniqueEmail ],
            'email' => 'required|email|', $uniqueEmail,
            'group_id' => ['required','integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Must choose group');
                }
            }],
            'status' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Name not be required',
            'fullname.min' => 'Name must be bigger than :min characters',
            'email.required' => 'Email not be required',
            'email.email' => 'Email must correct format email',
            'email.unique' => 'Email exists',
            'group_id.required' => 'Group not be required',
            'group_id.integer' => 'Group no correctly',
            'status.required' => 'Status not be required',
            'status.integer' => 'Status no correctly',
        ];
    }
}
