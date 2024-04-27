<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Rules\HashMatching;
use App\Rules\PasswordPattern;
use Illuminate\Validation\Rules\Password;


class ChangePasswordRequest extends FormRequest
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
                'current_password'      => ['required'] , new HashMatching(auth()->user()->password),
                'password'  => ["required" ,'confirmed', Password::min(8)->numbers()->symbols()]
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
