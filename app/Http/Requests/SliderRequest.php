<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SliderRequest extends FormRequest
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
                'title.*'   => 'required',
                'image'     => 'required|image'
            ];
        }
        if ($request->isMethod('put')) {
            $return = [
                'title.*'   => 'required',
                'image'     => 'nullable|image'
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
//            'image.required' => 'image is required!'
//        ];
//    }
}