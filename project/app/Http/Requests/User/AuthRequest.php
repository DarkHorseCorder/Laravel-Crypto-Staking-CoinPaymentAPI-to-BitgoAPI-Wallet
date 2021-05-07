<?php

namespace App\Http\Requests\User;

use App\Models\Generalsetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthRequest extends FormRequest
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
        $gs = Generalsetting::first();
        return  [
            'email'  => 'required|string|max:250|email',
            'password'  => 'required|max:255',
            'g-recaptcha-response' => [$gs->recaptcha ? 'required':'']
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
            'g-recaptcha-response.required'=>'Please verify that you are not a robot.'
        ];
    }


  
}
