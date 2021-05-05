<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'type'                 => 'required|in:buy,sell',
            'cryp_id'              => 'required',
            'gateway_id'           => 'required',
            'fiat_id'              => 'required',
            'price_type'           => 'required|in:1,2',
            'fixed_rate'           => 'required_if:price_type,2|gt:0|numeric',
            'margin'               => 'required_if:price_type,1|numeric',
            'minimum'              => 'required|gt:0|numeric',
            'maximum'              => 'required|gt:minimum|numeric',
            'trade_duration'       => 'required',
            'offer_terms'          => 'required',
            'trade_instructions'   => 'required',
            'status'               => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cryp_id.required'    => 'Please select a crypto currency.',
            'gateway_id.required' => 'Please select a gateway.',
            'fiat_id.required'    => 'Please select a fiat currency.',
            'margin.required_if'  => 'Margin field is required when price type is market price.',
            'fixed_rate.required_if'  => 'Fixed rate field is required when price type is fixed price.'
        ];
    }
}
