<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    ////return pizza list
    public function pizzaList(Request $request){

        if($request->status == "asc"){
            $data = Product::orderBy("created_at","asc")->get();
        }
        else{
            $data = Product::orderBy("created_at","desc")->get();
        }


        return response()->json($data,200);



    }
    // return add to cary pizza and user list
    public function addToCart(Request $request){
       $data = $this->getOrderData($request);
       Cart::create($data);
       $response =[
        "message" => "add to cart successfully",
        "status" => "success"
       ];


      return response()->json($response,200);
    }
    //order

    public function order(Request $request){

        $total=0;
      foreach($request->all() as $item){
      $data =  OrderList::create([
            "user_id" => $item["user_id"],
            "product_id"=> $item["product_id"],
            "quantity" => $item["quantity"],
            "total" => $item["total"],
            "order_code" => $item["order_code"],

        ]);
        $total= $data->total;
      }


      Cart::where("user_id",Auth::user()->id)->delete();
      logger($total+1500);
      Order::create([
        "user_id" => Auth::user()->id,
        "order_code" => $data->order_code,
        "total_price" => $total
      ]);

      return response()->json([
        "status" => "success",
        "message" => "order compleete",
    ],200);

    }
    // clear cart data
    public function clearCart(){
        Cart::where("user_id",Auth::user()->id)->delete();
        return response()->json([
            "status"=> "success",
        ],200);
    }

    //remove btn data
    public function removeBtn(Request $request ){
       Cart::where("user_id",Auth::user()->id)->where("product_id",$request->productId)->where("id",$request->orderId)->delete();
    }

    //increase view count

    public function increaseViewCount(Request $request){
      $pizza = Product::where("id",$request->productId)->first();
      $viewCount = [
        "view_count" => $pizza->view_count +1,
      ];

      Product::where("id",$request->productId)->update($viewCount);
    }

    //get order data

    private function getOrderData($request){

        return [
            "user_id" => $request->userId,
            "product_id" => $request->pizzaId,
            "quantity" =>$request->count,
            "created_at" => Carbon::now(),
        ];
    }

}
