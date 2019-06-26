<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
        ];
    }
    public function messages()
    {
        return [
            'file.mimes' => 'Uploaded file is not in image format',
            'file.required' => 'Image is required'
        ];
    }
}
