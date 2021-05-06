<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BlogRequest extends FormRequest
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
        $required = $this->blog ? '' : 'required';
        $id = $this->blog ? ','. $this->blog->id : '';
        return  [
                'photo'       => $required.'|image|mimes:jpeg,jpg,png,svg',
                'title'       => 'required|max:255|unique:blogs,title'.$id,
                'category_id' => 'required',
                'description' => 'required|min:15',
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
            'title.unique'   => __('Title allready have been taken'),
            'category_id.required'   => __('Category field is required'),
            'description.min'   => __('Description minimum 15 character is required'),
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
