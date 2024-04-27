<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::findOrFail(auth()->user()->id);

        return view('Admin.profile.index',compact('admin'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function Setting()
    {
        $admin = User::findOrFail(auth()->user()->id);


        return view('Admin.profile.edit',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $admin = User::findOrFail(auth()->user()->id);

        return view('Admin.profile.change_password',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileRequest $request)
    {

        $validated = $request->validated();
        $admin = User::findOrFail(auth()->user()->id);
        $result = User::findOrFail(auth()->user()->id)->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
        ]);
        //check if file exist
        if($request->hasFile('image')) {
            if ($admin->image)
                $admin->removeMedia($admin->image);
            $admin->saveMedia($request->file("image"),$admin->path,'image');
        }

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("profile.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function ChangePassword(ChangePasswordRequest $request)
    {

        $validated = $request->validated();
        $admin = User::findOrFail(auth()->user()->id);
        $admin->password =$request->password;
        $admin->save();

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("profile.index");
    }

}
