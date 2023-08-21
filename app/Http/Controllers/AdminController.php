<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    // password change page
    public function changePasswordPage(){
        return view("admin.Account.changepassword");
    }
    //change password

    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select("password")->where("id",$currentUserId)->first();
        $dbPassword=$user->password;


        if(Hash::check($request->oldPassword,$dbPassword)){
           $updatePassword = [
            "password" => Hash::make($request->newPassword)
           ];
           User::where("id",$currentUserId)->update($updatePassword);
           return redirect()->route("admin#changePasswordPage")->with(["Match"=>"Password Changed Successfully"]);
        }
        else{
            return back()->with(["notMatch"=> "Old passwords do not match. Try Again!"]);
        }
        //hashing password



    }
    //admin edit page
    public function edit(){
        return view("admin.Account.editpage");
    }

    //admin list

    public function list(){
        $admins = User::when(request("key"),function($query){
            $query->orWhere("name","like","%".request("key")."%")
                  ->orWhere("email","like","%".request("key")."%")
                  ->orWhere("phone","like","%".request("key")."%")
                  ->orWhere("address","like","%".request("key")."%");
        })
        ->where("role","admin")->paginate(3);
        $admins->appends(request()->all());

        return view("admin.Account.adminlist",compact("admins"));
    }
    //delete admin account
    public function delete($id){
        User::where("id",$id)->delete();
        return back()->with(["deleteSuccess"=>"Admin Account Deleted"]);
    }
    //change admin role

    public function changeRole($id){
        $account = User::where("id",$id)->first();
        return view("admin.Account.changerole",compact("account"));
    }


    //update the admin role

    public function change($id, Request $request){
        $data = $this->requestUserData($request);
        User::where("id",$id)->update($data);
        return redirect()->route("admin#list");

    }
    //direct admin detail page

    public function detail(){
        return view("admin.Account.detail");
    }

    //update acc
    public function update($id, Request $request){

        $this->acoountValidationCheck($request);
        $data = $this->getUserData($request);
        //for image

        if($request->hasFile("image")){
            // 1 old image name | check => delete | store
            $dbImage = User::where("id",$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage != null){
                Storage::delete("public/".$dbImage);

            }
            $fileName = uniqid() .$request->file("image")->getClientOriginalName();
               $request->file("image")->storeAs("public",$fileName);
               $data["image"] = $fileName;
        }
        User::where("id",$id)->update($data);
        return redirect()->route("admin#detail")->with(["updateSuccess"=> "Admin Account Updated"]);
    }
    //getUserData

    private function getUserData($request){
         return [
            "name" => $request->name,
            "email" => $request->email,
            "gender" => $request->gender,
            "phone" => $request->phone,
            "address" => $request->address,
            "updated_at" => Carbon::now()
         ];
    }

    // user data validation

    private function acoountValidationCheck($request){
        Validator::make($request->all(),[
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "gender" => "required",
            "image" => "mimes:png,jpg,jpeg,webp | file",
            "address" => "required",

        ])->validate();
    }
    //validator for password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            "oldPassword" => "required|min:6|",
            "newPassword" => "required|min:6|same:confirmPassword|",
            "confirmPassword" => "required|min:6|same:newPassword",
        ])->validate();
    }
    //admin role user data
    private function requestUserData($request){
        return [
            "role"=> $request->role
        ];
    }



}
