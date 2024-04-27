<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    /**
     * admin Login
     */
    public function adminLogin(Request $request)
    {

        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'email' => 'required',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response([
                    'status' => 0,
                    'message' => 'Validation Error',
                    'data' => false,
                    'error' => $validator->errors()

                ], 200);
            }


            if (!auth()->attempt($data) || auth()->user()->role != 99) {
                return response([
                    'status' => 0,
                    'message' => trans('auth.failed'),
                    'data' => false,
                    'error' => [
                        [
                            "type" => 'email',
                            "message" => trans('auth.failed')
                        ]
                    ]
                ], 200);
            } else if (auth()->user()->status != 1) {
                return response([
                    'status' => 0,
                    'message' => trans('auth.blocked'),
                    'data' => false,
                    'error' => [
                        [
                            "type" => 'email',
                            "message" => trans('auth.blocked')
                        ]
                    ]
                ], 200);
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            $response = [
                'status' => 1,
                'message' => 'Login successfully.',
                'user' => new UserResource(auth()->user()),
                'access_token' => $accessToken,
                'error' => []

            ];

            return response($response, 200);
        } catch (\Exception $e) {

            $response = [
                'status' => 0,
                'message' => 'process failed.',
                'data' => false

            ];

            return response($response, 401);
        }
    }

    /**
     * Get admin Data
     */
    public function getAdminProfile(Request $request)
    {

        try {
            if (auth()->user()->status != 1) {
                return response([
                    'status' => 0,
                    'message' => trans('auth.blocked'),
                    'data' => false,
                    'error' => [
                        [
                            "type" => 'email',
                            "message" => trans('auth.blocked')
                        ]
                    ]
                ], 200);
            } else if (auth()->user()->role != 99) {
                return response([
                    'status' => 0,
                    'message' => trans('auth.notUser'),
                    'data' => false,
                    'error' => [
                        [
                            "type" => 'email',
                            "message" => trans('auth.notUser')
                        ]
                    ]
                ], 200);
            }

            $accessToken = $request->user()->createToken('authToken')->accessToken;

            $response = [
                'status' => 1,
                'message' => 'Login successfully.',
                'user' => new UserResource($request->user()),
                'access_token' => $accessToken,
                'error' => []

            ];

            return response($response, 200);
        } catch (\Exception $e) {
            $response = [
                'status' => 0,
                'message' => 'process failed.',
                'data' => false

            ];

            return response($response, 401);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getRoles()
    {

        $roles= Roles::where('id','!=',99)->select('name','id')->get();

        $response = $roles;
        return response($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::user()->select('id','name')->get();
        return response($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}

?>
