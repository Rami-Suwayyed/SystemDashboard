<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

function gateCRUDPermissions($mainName){
    return Gate::check("view-" . $mainName) || Gate::check("create-" . $mainName)
        || Gate::check("update-" . $mainName) || Gate::check("delete-" . $mainName);
}

function hasPermissions($permissions){
    $user = Auth::guard('admin')->user();
//
//    if($permissions == "admin-control"){
//        if($user->is_super_admin == 1)
//            return true;
//        return false;
//    }

//    if($user->is_super_admin == 1)
//        return true;

    if(is_array($permissions)){
        foreach ($permissions as $permission){
            if(Gate::allows($permission)){
                return true;
            }
        }
    }else{
        if(Gate::allows($permissions)){
            return true;
        }
    }
    return false;
}

function isPermissionsAllowed(...$permissions){
    $user = Auth::guard('admin')->user();
    if($permissions[0] == "admin-control"){
//        return $user->isAdministrator();
        return true;
    }
//    if($user->isAdministrator())
//        return true;

    foreach ($permissions as $permission){
        if(Gate::allows($permission)){
            return true;
        }
    }

    return false;
}
