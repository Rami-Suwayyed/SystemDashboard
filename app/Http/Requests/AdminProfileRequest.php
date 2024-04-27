<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminProfileRequest extends FormRequest
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
    public function rules(Request $request): array
    {

        return  [
                'name'      => 'required|string|max:100',
                'username'  => 'required|string|unique:users,username,'.auth()->user()->id,
                'email'     => 'required|email|unique:users,email,'.auth()->user()->id,
            ];

    }

        /**
         * Custom message for validation
         *
         * @return array
         */
//        public function messages()
//    {
//        return [
//            'title.required' => 'Title is required!',
//            'text.required' => 'Text is required!',
//            'image.required' => 'image is required!'
//        ];
//    }
}