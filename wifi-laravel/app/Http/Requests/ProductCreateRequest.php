<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name' => 'required|min:10|max:255',
            'quantity_exists' => ['required', 'integer', 'max:4', function ($value, $fail) {
                if ($value < 0) {
                    $fail('Quantity must be greater than 0');
                }
            }],
            'description' => 'required|min:20|max:2000',
            'price' => ['required', 'integer', function ($value, $fail) {
                if ($value < 0) {
                    $fail('Price must be greater than 0');
                }
            }],
            'size' => 'required|min:10|max:255',
            'flag_promoted' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose promotion';
                $this->chooseField($value, $fail, $message);
            }],
            'coverage_density_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose coverage density';
                $this->chooseField($value, $fail, $message);
            }],
            'frequency_band_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose frequency band';
                $this->chooseField($value, $fail, $message);
            }],
            'guarantee_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose guarantee';
                $this->chooseField($value, $fail, $message);
            }],
            'made_in_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose made in';
                $this->chooseField($value, $fail, $message);
            }],
            'manufacture_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose manufacturer';
                $this->chooseField($value, $fail, $message);
            }],
            'promotion_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose percent promotion when have promoted';
                $this->chooseField($value, $fail, $message);
            }],
            'speed_wifi_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose speed wifi';
                $this->chooseField($value, $fail, $message);
            }],
            'standard_network_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose standard network';
                $this->chooseField($value, $fail, $message);
            }],
            'type_anteing_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose type anteing';
                $this->chooseField($value, $fail, $message);
            }],
            'type_device_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose type device';
                $this->chooseField($value, $fail, $message);
            }],
            'user_connect_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose user connect';
                $this->chooseField($value, $fail, $message);
            }],
            'button_support_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose button support';
                $this->chooseField($value, $fail, $message);
            }],
            'port_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose port support';
                $this->chooseField($value, $fail, $message);
            }],
            'anteing_id' => ['required', 'integer', function ($value, $fail) {
                $message = 'Must choose quantity of anteing';
                $this->chooseField($value, $fail, $message);
            }],
        ];
    }

    /**
     * @param $value
     * @param $fail
     * @param $message
     * @return void
     */
    protected function chooseField($value, $fail, $message): void
    {
        if ($value == 0) {
            $fail($message);
        }
    }

    public function messages(): array
    {
        return[
            'required' => ':attribute cannot be empty',
            'min' => ':attribute cannot be smaller than :min characters',
            'max' => ':attribute cannot be greater than :max characters',
            'integer' => ':attribute must be a number',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name product',
            'quantity_exists' => 'Quantity',
            'description' => 'Description',
            'price' => 'Price',
            'size' => 'Size',
            'flag_promoted' => 'Promotion',
            'coverage_density_id' => 'Coverage density',
            'frequency_band_id' => 'Frequency band',
            'guarantee_id' => 'Guarantee',
            'made_in_id' => 'Made in',
            'manufacture_id' => 'Manufacture',
            'promotion_id'=> 'Percent promotion',
            'speed_wifi_id' => 'Speed wifi',
            'standard_network_id' => 'Standard network',
            'type_anteing_id' => 'Type anteing',
            'type_device_id' => 'Type device',
            'user_connect_id' => 'User connect',
            'button_support_id' => 'Button support',
            'port_id' => 'Port',
            'anteing_id' => 'Quantity anteing',
        ];
    }
}
