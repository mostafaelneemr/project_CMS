<?php

namespace App\Http\Requests\service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'title' => 'required|max:100|string|unique:services,title',
            'details' => 'required|string',
            'is_published' => 'required|in:1,0',
            'serv_type' => 'nullable',
        ];
    }
}
