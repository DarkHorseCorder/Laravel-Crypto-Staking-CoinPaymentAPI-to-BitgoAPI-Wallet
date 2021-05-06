<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminProfileRequest extends FormRequest
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
       
        $profile = $this->profile ? 'required' : '';
        $reset = $this->reset ? 'required' : '';
        return [
            // profile reset validation
            'photo' => 'image|mimes:jpeg,jpg,png,svg',
            'name'  => $profile.'|string|max:255',
            'email' => $profile.'|email|max:255|unique:admins,email,'.Auth::guard('admin')->user()->id,
            'phone' => $profile.'|string|max:14',
            // password reset validation
            'cpass' => $reset.'|string|max:16',
            'newpass' => $reset.'|string|max:16',
            'renewpass' => $reset.'|string|max:16',
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
            'name.required'  => __('Name field is required'),
            'email.required' => __('Email field is required'),
            'email.unique'   => __('Email allready have been taken'),
            'phone.required' => __('Phone number field is required'),
            'photo.image'    => __('Image format not supported'),
            'photo.mimes'    => __('Image format not supported'),
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        throw new ValidationException($validator, $response);
    }
}
