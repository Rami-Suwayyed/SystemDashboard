<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ManagerRequest extends FormRequest
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


        if ($request->isMethod('post')) {
            $return = [
                'name'   => 'required|string|max:100',
                'email'    => 'required|string|email|max:255|unique:users',
                'role'    => 'required|exists:roles,id',
            ];
        }
        if ($request->isMethod('put')) {
            $return = [
                'name'   => 'required|string|max:100',
                'email'    => 'required|string|email|max:255|unique:users,email,'.$request->manager,
                'role'    => 'required|exists:roles,id',
            ];
        }
        return $return;

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
