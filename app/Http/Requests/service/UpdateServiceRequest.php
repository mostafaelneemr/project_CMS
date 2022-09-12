<?php

namespace App\Http\Requests\service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'thumbnail' => 'string',
            'title' => 'required|max:100|string|exists:services,id',
            'details' => 'required',
            'is_published' => 'required',
            'serv_type' => 'nullable',
        ];
    }
}
