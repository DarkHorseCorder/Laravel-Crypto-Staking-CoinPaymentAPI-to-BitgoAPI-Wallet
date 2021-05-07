<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
        $required = $this->user ? '' : 'required';
        $register = $this->user ? '' : 'required';
        $id = $this->user ? ','. $this->user->id : '';
        return  [
                'photo'     => $required.'|image|mimes:jpeg,jpg,png,svg',
                'name'      => 'required|string|max:255',
                'email'     => 'required|email|unique:users,email'.$id,
                'country'   => 'nullable|string|max:255',
                'phone'     => 'nullable|string|max:255',
                'address'   => 'nullable|string|max:255',
                'city'      => 'nullable|string|max:255',
                'zip'       => 'nullable|string|max:25',
                'password'  => $register.'|string|max:25',
                'cumpassword'=> $register.'|string|max:25',
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
            'title.required' => __('Title field is required'),
            'photo.image'    => __('Image format not supported'),
            'photo.mimes'    => __('Image format not supported'),
        ];
    }

  
}
