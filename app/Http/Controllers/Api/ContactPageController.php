<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContactPageController extends Controller
{

    public function rules(Request $request)
    {
        return [
            'name'            => 'required|max:100',
            'email'           => 'required|email|max:100',
            'company_name'    => 'required',
            'phone_number'    => 'required_without:email',
            'message'         => 'required',
        ];
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();

                $validator = Validator::make($request->all(), $this->rules($request));

                if ($validator->fails()) {
                    return response([
                        'status' => 0,
                        'message' => 'Validation Error',
                        'data' => false,
                        'error' => $validator->errors()

                    ], 200);
                }

                $result = ContactUs::create($data);

                $response = [
                    'status' => 1,
                    'message' => 'request successful.',
                    'data' => $result

                ];

                return response($response, 200);
            } catch (\Exception $e) {
                $response = [
                    'status' => 0,
                    'message' => 'process failed.',
                    'data' => false

                ];
                return response($response, 400);
            }

    }


}
