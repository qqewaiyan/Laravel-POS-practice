<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    // //admin user list
    public function userList(){
        $users = User::where("role","user")->paginate(3);
        return view("admin.user.userList",compact("users"));
    }

    //admin/ user change role

    public function changeRole(Request $request){
        $user = User::where("id",$request->userId)->update([
            "role" => $request->role
        ]);
        return response()->json([
            "status" => "success"
        ],200);
    }
}
