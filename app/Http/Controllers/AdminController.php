<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function getDashboard(){
        return view('admin.dashboard');
    }
    public function getUserAdd(){
        $ro=Role::all();
        $user=User::all();
        return view('admin.userAdd')->with(['user'=>$user])->with(['ro'=>$ro]);
    }
    public function postUpdateRole(Request $request){
        $id=$request['id'];
        $roleName=$request['roleName'];
        $user=User::where('id',$id)->first();
        $user->syncRoles($roleName);
        return redirect()->back();

    }

}
