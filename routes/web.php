<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//login //register
// Route::get('/', function () {
//     return view("login");
// });





    Route::middleware(["admin_auth"])->group(function(){
        Route::redirect('/','loginPage',);
        Route::get("loginPage",[AuthController::class,"loginPage"])->name("auth#loginPage");
        Route::get("registerPage",[AuthController::class,"registerPage"])->name("auth#registerPage");

    });


Route::middleware(['auth'])->group(function () {

 //dashboard
 Route::get("dashboard",[AuthController::class,"dashboard"])->name("dashboard");



    //admin

    Route::middleware(["admin_auth"])->group(function(){
        //category
        Route::prefix("category")->group(function(){
            Route::get("list",[CategoryController::class,"list"])->name("category#list");
            Route::get("create/page",[CategoryController::class,"createPage"])->name("category#createPage");
            Route::post("create",[CategoryController::class,"create"])->name("category#create");
            Route::get("delete/{id}",[CategoryController::class,"delete"])->name("category#delete");
            Route::get("edit/{id}",[CategoryController::class,"edit"])->name("category#edit");
            Route::post("update",[CategoryController::class,"update"])->name("category#update");
         });
         //admin account

         Route::prefix("admin")->group(function(){
            //password
            Route::get("password/changePasswordPage",[AdminController::class,"changePasswordPage"])->name("admin#changePasswordPage");
            Route::post("changePassword",[AdminController::class,"changePassword"])->name("admin#changePassword");
            //account
            Route::get("account/detail",[AdminController::class,"detail"])->name("admin#detail");
            Route::get("edit",[AdminController::class,"edit"])->name("admin#edit");
            Route::post("update/{id}",[AdminController::class,"update"])->name("admin#update");
            //admin list
            Route::get("list",[AdminController::class,"list"])->name("admin#list");
            Route::get("delete,{id}",[AdminController::class,"delete"])->name("admin#delete");
            //admin change role
            Route::get("changeRole,{id}",[AdminController::class,"changeRole"])->name("admin#changeRole");
            Route::post("change/role,{id}",[AdminController::class,"change"])->name("admin#change");
            //admin/user

           Route::prefix("user")->group(function(){
            Route::get("userList",[UserListController::class,"userList"])->name("admin#userList");
            Route::get("change/userRole",[UserListController::class,"changeRole"])->name("admin#userChangeRole");

        });
           //products
           Route::prefix("products")->group(function(){
            Route::get("list",[ProductController::class,"list"])->name("product#list");
            Route::get("createPage",[ProductController::class,"createPage"])->name("product#createPage");
            Route::post("crate",[ProductController::class,"create"])->name("product#create");
            Route::get("delete,{id}",[ProductController::class,"delete"])->name("product#delete");
            Route::get("edit,{id}",[ProductController::class,"edit"])->name("product#edit");
            Route::get("updatePage,{id}",[ProductController::class,"updatePage"])->name("product#updatePage");
            Route::post("update",[ProductController::class,"update"])->name("product#update");
           });
           //order

           Route::prefix("order")->group(function(){
            Route::get("list",[OrderController::class,"orderList"])->name("order#list");
            Route::get("orderStatus",[OrderController::class,"orderStatus"])->name("admin#orderStatus");
            Route::get("ajaxChangeStatus",[OrderController::class,"ChangeStatus"])->name("admin#ajaxChangeStatus");
            Route::get("orderInfo,{orderCode}",[OrderController::class,"orderInfo"])->name("admin#orderInfo");

           });



           });
});


// user
//home
Route::group(["prefix"=> "user","middleware" => "user_auth"],function(){


    Route::get("/home",[UserController::class,"home"])->name("user#home");
    Route::get("/filter,{id}",[UserController::class,"filter"])->name("user#filter");
    Route::get("history",[UserController::class,"history"])->name("user#history");

    Route::prefix("pizza")->group(function(){
        Route::get("details,{id}",[UserController::class,"pizzaDetails"])->name("user#pizzaDetail");
    });

    Route::prefix("password")->group(function(){
        Route::get("changePassword",[UserController::class,"changePasswordPage"])->name("user#changePasswordPage");
        Route::post("changePassword",[UserController::class,"changePassword"])->name("user#changePassword");
    });
    Route::prefix("account")->group(function(){
        Route::get("change",[UserController::class,"changePage"])->name("user#accountPage");
        Route::post("change,{id}",[UserController::class,"accountChange"])->name("user#accountChange");

    });
    Route::prefix("ajax")->group(function(){
        Route::get("pizzaList",[AjaxController::class,"pizzaList"])->name("ajax#pizzaList");
        Route::get("pizzaCart",[AjaxController::class,"addToCart"])->name("ajax#addToCart");
        Route::get("order",[AjaxController::class,"order"])->name("ajax#order");
        Route::get("clearCart",[AjaxController::class,"clearCart"])->name("ajax#clearCart");
        Route::get("removeBtn",[AjaxController::class,"removeBtn"])->name("ajax#removeBtn");
        Route::get("increase/viewCount",[AjaxController::class,"increaseViewCount"])->name("ajax#increaseViewCount");
    });
    Route::prefix("cart")->group(function(){
        Route::get("list",[CartController::class,"cartList"])->name("cart#cartList");
    });
});

});
Route::get("webtesting",function(){
    $data = [
     "status" => "this is  web test"
    ];
    return response()->json($data,200);

 });






