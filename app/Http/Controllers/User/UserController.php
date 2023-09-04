<?php

namespace App\Http\Controllers\User;

use view;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // //user HOme page
    public function home(){
        $category = Category::paginate();
        $pizzas = Product::orderBy("created_at","desc")->get();
        $cart = Cart::where("user_id",Auth::user()->id)->get();
        $history = Order::where("user_id",Auth::user()->id)->get();
        return view("user.main.home",compact("pizzas","category","cart","history"));
    }
    //user home filter
    public function filter($categoryId){
        $category = Category::paginate();
        $pizzas = Product::where("category_id",$categoryId)->orderBy("created_at","desc")->get();
        $cart = Cart::where("user_id",Auth::user()->id)->get();
        $history = Order::where("user_id",Auth::user()->id)->get();
        return view("user.main.home",compact("pizzas","category","cart","history"));
    }
    //history page
    public function history(){
       $order= Order::where("user_id",Auth::user()->id)->orderBy("created_at","desc")->paginate(6);
        return view("user.main.history",compact("order"));
    }
    //change password page

    public function changePasswordPage(){
        return view("user.password.change");
    }
    //user password changed
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
           return redirect()->route("user#changePasswordPage")->with(["Match"=>"Password Changed Successfully"]);
        }
        else{
            return back()->with(["notMatch"=> "Old passwords do not match. Try Again!"]);
        }
    }

    // user account change page

    public function changePage(){
        return view("user.account.account");
    }


    // // account chaqnge

    public function accountChange($id, Request $request){


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
        return back()->with(["updateSuccess"=> "User Account Updated"]);
    }


    //pizza detail

    public function pizzaDetails($pizzaId){
        $pizza = Product::where("id",$pizzaId)->first();
        $pizzaList =Product::get();
        return view("user.main.detail",compact("pizza","pizzaList"));
    }
    //validator for password
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            "oldPassword" => "required|min:6|",
            "newPassword" => "required|min:6|same:confirmPassword|",
            "confirmPassword" => "required|min:6|same:newPassword",
        ])->validate();
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
}
