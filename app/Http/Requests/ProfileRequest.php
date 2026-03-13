<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name'    => 'nullable|string|max:250' ,
            'phone_number' => 'nullable|digits:10',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048' ,
            'location'     => 'nullable|string',
        ];
    }
}
