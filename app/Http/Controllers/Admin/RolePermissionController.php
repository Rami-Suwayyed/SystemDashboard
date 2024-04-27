<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionRequest;
use App\Models\Permission;
use App\Models\Role;


class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data["roles"] =Role::get();
        return view("admin.roles.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        $data["permissions"] = Permission::get();
        \DB::statement("SET SQL_MODE=''");;
        $role_permission = Permission::select('slug','id')->groupBy('slug')->get();

        $permissions = array();

        foreach($role_permission as $per){

            $key = substr($per->slug, 0, strpos($per->slug, "-"));

            if(str_starts_with($per->slug, $key)){

                $permissions[$key][] = $per;
            }

        }

        return view("admin.roles.create",compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request)
    {

        $validated = $request->validated();
        $role = Role::create([
            'name'=>$request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        $message = (new SuccessMessage())->title(__("created_successfully"))
            ->body(__("the_data_has_been_created_successfully"));
        Dialog::flashing($message);
        return redirect()->route("roles.index");
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
        $role = Role::with('permissions')->find($id);

        \DB::statement("SET SQL_MODE=''");
        $role_permission = Permission::select('slug','id')->groupBy('slug')->get();


        $custom_permission = array();

        foreach($role_permission as $per){

            $key = substr($per->slug, 0, strpos($per->slug, "-"));

            if(str_starts_with($per->slug, $key)){
                $custom_permission[$key][] = $per;
            }

        }
        return view('admin.roles.edit',compact('role'))->with('permissions',$custom_permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolePermissionRequest $request, string $id)
    {
        $validated = $request->validated();

       Role::findOrFail($id)->update([
            'name'=>$request->name,

        ]);
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions);

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Role::findOrFail($id)->delete();

        $message = (new SuccessMessage())->title(__("deleted_successfully"))
            ->body(__("the_data_has_been_deleted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("roles.index");
    }
}
