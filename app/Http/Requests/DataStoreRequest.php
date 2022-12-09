<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'  => 'required|string|max:50',
            'description' =>'required|string|max:250',
            'file' => 'required|file|mimes:png,jpg,jpeg|max:5120',
            'type' => 'required|numeric|between:1,3'
        ];
    }
    public function messages()
        {
            return [
                'name.required' => 'Name must be maximum 50 characters!',
                'description.required' => 'Description must be maximum 250 characters!',
                'file.required' => 'File must be PNG,JPG,Jpeg format and be maximum 5mb!',
                'type.required' => 'Type must be 1,2 or 3!'
            ];
        }

}
