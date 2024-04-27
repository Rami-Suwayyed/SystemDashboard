<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Helpers\Dialog\Web\Types\WarningMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\ManagerRequest;
use App\Models\About;
use App\Models\RelatedRole;
use App\Models\Role;
use App\Models\User;
use App\Notifications\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['managers'] = User::Admin()->paginate(20);
        return view('admin.manager.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::get();
        return view('admin.manager.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagerRequest $request)
    {

        $validated = $request->validated();
        $manager = new User();
        $manager->is_super_admin = 0;
        $manager->user_role = 'admin';
        $password = str::random(8);
        $manager->password = Hash::make($password) ;
        $manager->username = "Manager_" . Str::random(3) . $manager->id;
        $manager->first_password = $password;
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->save();
        $relatedRole = new RelatedRole();
        $relatedRole->user_id = $manager->id;
        $relatedRole->role_id =  $request->role;
        $relatedRole->save();

        $arr = [ 'name' => $manager->name  ,'url'=>route('VerificationEmail'),'username' => $manager->username  ,'Password' => $password ,'email' => $manager->email ];
        $manager->notify(new Registered($arr));

        Session::flash("Manager_register_info", [
            "full_name" => $manager->full_name,
            "username" => $manager->username,
            "email" => $manager->email,
            "password" => $password]);

        $message = (new SuccessMessage())->title(__("created_successfully"))
            ->body(__("the_data_has_been_created_successfully"));
        Dialog::flashing($message);
        return redirect()->route("managers.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['manager'] =User::findOrFail($id);
        $data["roles"] = Role::get();

        return view('admin.manager.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManagerRequest $request, string $id)
    {
        $validated = $request->validated();
        $manager = User::findOrFail($id);
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->save();
        $relatedRole = $manager->relatedRole;
        $relatedRole->role_id =  $request->role;
        $relatedRole->save();


        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("managers.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         User::findOrFail($id)->delete();

        $message = (new SuccessMessage())->title(__("deleted_successfully"))
            ->body(__("the_data_has_been_deleted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("managers.index");
    }


    public function SendEmail(Request $request){
        $id =$request->id;
        $manager=User::find($id);

        $arr = [ 'name' => $manager->name  ,'url'=> route('VerificationEmail'),'username' => $manager->username  ,'Password' => $manager->first_password ,'email' => $manager->email ];
        $manager->notify(new Registered($arr));
        $message = (new SuccessMessage())->title("Successfully")
            ->body("Email has been sent in Manager Successfully ". $manager->email);
        Dialog::flashing($message);
        return redirect()->route("managers.index");
    }

    public function VerificationEmail(){
        $manager =Auth::guard('admin')->user();
        $manager->email_verified_at = now();
        $manager->first_password = '';
        $manager->save();
        return redirect()->route("home");

    }
}
