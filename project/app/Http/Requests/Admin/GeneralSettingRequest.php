<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class GeneralSettingRequest extends FormRequest
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
        $smtp_required = $this->check_smtp ? 'required' : '';
        $setting = $this->setting ? 'required' : '';
        $php_required = $this->check_smtp ? ($this->mail_type == 'php_mail' ? '' : 'required') : '';
        
        return  [
                // smtp validation start
                'title' => $setting,
                'smtp_host' => $php_required .'|string|max:150',
                'smtp_port' => $php_required .'|string|max:150',
                'smtp_user' => $php_required .'|string|max:150',
                'smtp_pass' => $php_required .'|string|max:150',
                'from_email'=> $smtp_required.'|string|max:150',
                'from_name' => $smtp_required.'|string|max:150',
                'header_logo'=> 'nullable|image|mimes:jpg,png',
                'tawk_id'    => 'nullable|string|max:250',
                'cookie_text'=> 'nullable|string|max:500',
                'cookie_btn_text'=> 'nullable|string|max:200',
                'kyc_offer_limit'=> 'numeric|gte:0',
                'kyc_trade_limit'=> 'numeric|gte:0',
                // smtp validation end
             ];
    }


 
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'smtp_host.required' => __('Title field is required'),
            'smtp_port.unique'   => __('Title allready have been taken'),
            'smtp_user.required'   => __('Category field is required'),
            'smtp_pass.required'   => __('Category field is required'),
            'from_email.required'   => __('Category field is required'),
            'from_name.required'   => __('Category field is required'),
            
           
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        throw new ValidationException($validator, $response);
    }
}
