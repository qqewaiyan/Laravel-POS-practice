<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    ////product list
   public function list(){
    $pizzas =Product::select("products.*","categories.name as category_name")->when(request("key"),function($query){
        $query->where("products.name","like","%".request("key")."%");
    })
    ->leftJoin("categories","products.category_id","categories.id")
    ->orderBy("products.created_at","desc")
    ->paginate(5);

    $pizzas->appends(request()->all());
    return view("admin.product.pizzalist",compact("pizzas"));
   }

   //direct pizza create page

   public function createPage(){
    $categories = Category::select("id","name")->get();

    return view("admin.product.createPizza",compact("categories"));
   }
   //pizza create

   public function create(Request $request){
    $this->productValidationCheck($request,"create");
    $data= $this->requestProductData($request);

        $filename = uniqid().$request->file("pizzaImage")->getClientOriginalName();
        $request->file("pizzaImage")->storeAs("public/".$filename);
        $data["image"] = $filename;

    Product::create($data);
    return redirect()->route("product#list");
   }
   //delete pizza
   public function delete($id){
    Product::where("id",$id)->delete();
    return redirect()->route("product#list")->with(["deleteSuccess"=>"Product Deleted Successfully"]);
   }
   //edit page

   public function edit($id){
    $pizzas = Product::select("products.*","categories.name as category_name" )
    ->where("products.id",$id)
    ->leftJoin("categories","products.category_id","categories.id")
    ->first();
    return view("admin.product.edit",compact("pizzas"));
   }

   //update page
   public function updatePage($id){
    $pizzas = Product::where("id",$id)->first();
    $category = Category::get();
    return view("admin.product.update",compact("pizzas","category"));

   }


   //update pizza

   public function update(Request $request){

    $this->productValidationCheck($request,"update");
    $data = $this->requestProductData($request);
    if($request->hasFile("pizzaImage")){
        $oldImage = Product::where("id",$request->pizzaId)->first();
        $oldImage = $oldImage->image;
   if($oldImage != null){
    Storage::delete("public/".$oldImage);
   }

    $filename = uniqid().$request->file("pizzaImage")->getClientOriginalName();
    $request->file("pizzaImage")->storeAs("public",$filename);
    $data["image"] = $filename;
    }
    Product::where("id",$request->pizzaId)->update($data);
    return redirect()->route("product#list")->with(["updateSuccess" => "Updated Successfully"]);

   }
   //product validation check

   private function productValidationCheck($request,$action){
    $validationRule = [
        "pizzaName" => "required |min:5|unique:products,name,".$request->pizzaId,
        "pizzaCategory" => "required",

        "pizzaDescription"=> "required |min:10",
        "pizzaPrice" => "required",
        "pizzaWaitingTime" => "required",
    ];

    $validationRule["pizzaImage"] = $action == "create" ? "mimes:png,jpg,jpeg,webp |file |required" : "mimes:png,jpg,jpeg,webp |file";
     Validator::make($request->all(),$validationRule)->validate();

   }
   //get product data
   private function requestProductData($request){
    return [
        "category_id" => $request->pizzaCategory,
        "name" => $request->pizzaName,
        "description" => $request->pizzaDescription,
        "price" => $request->pizzaPrice,
        "waiting_time" => $request->pizzaWaitingTime


    ];
   }
}
