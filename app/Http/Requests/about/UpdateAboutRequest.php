<?php

namespace App\Http\Requests\about;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'image_url' => 'image|mimes:jpeg,png,jpg',
            'details' => 'required|string',
            'button' => 'string|max:50',
        ];
    }
}
