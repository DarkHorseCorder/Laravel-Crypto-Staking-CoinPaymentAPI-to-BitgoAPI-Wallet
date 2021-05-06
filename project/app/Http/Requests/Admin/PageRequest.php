<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PageRequest extends FormRequest
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
        $id = $this->page ? ','. $this->page->id : '';
        return [
            'lang' => 'required',
            'title' => 'required|max:255|unique:pages,title'.$id,
            'details' => 'required',
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
            'details.required' => __('Description field is required'),
        ];
    }

   
}
