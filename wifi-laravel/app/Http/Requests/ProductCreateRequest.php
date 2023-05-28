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
            'quantity_exists' => ['required', 'integer'],
            'description' => 'required|min:20|max:2000',
            'price' => ['required', 'integer'],
            'size' => 'required|min:10|max:255',
            'flag_promoted' => ['required', 'integer'],
            'coverage_density_id' => ['required', 'integer'],
            'frequency_band_id' => ['required', 'integer'],
            'guarantee_id' => ['required', 'integer'],
            'made_in_id' => ['required', 'integer'],
            'manufacture_id' => ['required', 'integer'],
            'promotion_id' => ['required', 'integer'],
            'speed_wifi_id' => ['required', 'integer'],
            'standard_network_id' => ['required', 'integer'],
            'type_anteing_id' => ['required', 'integer'],
            'type_device_id' => ['required', 'integer'],
            'user_connect_id' => ['required', 'integer'],
            'button_support_id' => ['required', 'integer'],
            'port_id' => ['required', 'integer'],
            'anteing_id' => ['required', 'integer'],
//            'images' => 'image|mimes:jpeg,png,jpg|max:2048'
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
            'required' => ':attribute cannot be empty.',
            'min' => ':attribute cannot be smaller than :min characters.',
            'max' => ':attribute cannot be greater than :max characters.',
            'integer' => ':attribute must be a number.',
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

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $valueQuantity = $this->input('quantity_exists');
            if ($valueQuantity <= 0) {
                $validator->errors()->add('quantity_exists', 'Quantity must be greater than 0.');
            } else if ($valueQuantity >= 10000) {
                $validator->errors()->add('quantity_exists', 'Quantity cannot be greater than 10000.');
            }

            $valuePrice = $this->input('price');
            if ($valuePrice <= 0) {
                $validator->errors()->add('price', 'Price must be greater than 0.');
            }

            $keyCoverageDensity = 'coverage_density_id';
            $messageCoverageDensity = 'Must choose coverage density.';
            $this->customValid($keyCoverageDensity, $validator, $messageCoverageDensity);

            $keyFrequencyBand = 'frequency_band_id';
            $messageFrequencyBand = 'Must choose frequency band.';
            $this->customValid($keyFrequencyBand, $validator, $messageFrequencyBand);

            $keyGuarantee = 'guarantee_id';
            $messageGuarantee = 'Must choose guarantee.';
            $this->customValid($keyGuarantee, $validator, $messageGuarantee);

            $keyMadeIn = 'made_in_id';
            $messageMadeIn = 'Must choose made in.';
            $this->customValid($keyMadeIn, $validator, $messageMadeIn);

            $keyManufacture = 'manufacture_id';
            $messageManufacture = 'Must choose manufacture.';
            $this->customValid($keyManufacture, $validator, $messageManufacture);

            $keyPromotion = 'promotion_id';
            $messagePromotion = 'Must choose percent promotion when have promoted.';
            $this->customValid($keyPromotion, $validator, $messagePromotion);

            $keySpeedWifi = 'speed_wifi_id';
            $messageSpeedWifi = 'Must choose speed wifi.';
            $this->customValid($keySpeedWifi, $validator, $messageSpeedWifi);

            $keyStandardNetwork = 'standard_network_id';
            $messageStandardNetwork = 'Must choose standard network.';
            $this->customValid($keyStandardNetwork, $validator, $messageStandardNetwork);

            $keyTypeAnteing = 'type_anteing_id';
            $messageTypeAnteing = 'Must choose type anteing.';
            $this->customValid($keyTypeAnteing, $validator, $messageTypeAnteing);

            $keyTypeDevice = 'type_device_id';
            $messageTypeDevice = 'Must choose type device.';
            $this->customValid($keyTypeDevice, $validator, $messageTypeDevice);

            $keyUserConnect = 'user_connect_id';
            $messageUserConnect = 'Must choose user connect.';
            $this->customValid($keyUserConnect, $validator, $messageUserConnect);

            $keyButtonSupport = 'button_support_id';
            $messageButtonSupport = 'Must choose button support.';
            $this->customValid($keyButtonSupport, $validator, $messageButtonSupport);

            $keyPort = 'port_id';
            $messagePort = 'Must choose port support.';
            $this->customValid($keyPort, $validator, $messagePort);

            $keyAnteing = 'anteing_id';
            $messageAnteing = 'Must choose quantity of anteing.';
            $this->customValid($keyAnteing, $validator, $messageAnteing);
        });
    }

    /**
     * @param $key
     * @param $validator
     * @param $message
     * @return void
     */
    protected function customValid($key, $validator, $message): void
    {
        if ($this->input($key) == 0) {
            $validator->errors()->add($key, $message);
        }
    }
}
