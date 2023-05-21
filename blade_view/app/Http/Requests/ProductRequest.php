<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        return [
            'name_product' => 'required|min:6',
            'price_product' => 'required|integer'
//                'price_product' => ['required','integer']
            //
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute is required',
            'min' => ':attribute bigger than :min characters',
            'integer' => ':attribute is number'
        ];
    }

    public function attributes(): array
    {
        return [
            'name_product' => 'Name product',
            'price_product' => 'Price product',
        ];
    }

    protected function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add('msg', 'Something is wrong with this field');
            }


        });
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'create_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedAuthorization(): void
    {
//       throw new AuthorizationException('You are not allowed to');
//        throw new HttpResponseException(redirect('/')->with('msg','You are not allowed to')->with('type', 'danger'));
        throw new HttpResponseException(abort(404));
    }
}
