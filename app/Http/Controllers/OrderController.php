<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //    //order list for admin
    public function orderList(){
        $order = Order:: select("orders.*","users.name as user_name")
        ->leftJoin("users","users.id","orders.user_id")
        ->orderBy("created_at","asc")

        ->when(request("key"),function($qeury){
            $qeury->orWhere("users.name","like","%".request("key")."%")
                  ->orWhere("order_Code","like","%".request("key")."%")
                  ->orWhere("total_price","like","%".request("key")."%")
                  ->orWhere("Status","like","%".request("key")."%");


        })
        ->get();


        return view("admin.order.list",compact("order"));
    }
    //order status ajax

    public function orderStatus(Request $request){

        $order = Order:: select("orders.*","users.name as user_name")
        ->leftJoin("users","users.id","orders.user_id")
        ->orderBy("created_at","asc");
        if($request->orderStatus == null ){
           $order = $order->get();
        }else{
          $order =  $order->where("orders.status",$request->orderStatus)->get();
        }

        return view("admin.order.list",compact("order"));
    }

    //ajax order status change

    public function ChangeStatus(Request $request){
        Order::where("id",$request->orderId)->update([
            "status" => $request->status,

        ]);
         Order:: select("orders.*","users.name as user_name")
        ->leftJoin("users","users.id","orders.user_id")
        ->orderBy("created_at","asc")

        ->when(request("key"),function($qeury){
            $qeury->orWhere("users.name","like","%".request("key")."%")
                  ->orWhere("order_Code","like","%".request("key")."%")
                  ->orWhere("total_price","like","%".request("key")."%")
                  ->orWhere("Status","like","%".request("key")."%");


        })
        ->get();
    }

    //order Info

    public function orderInfo($orderCode){
     $order = Order::where("order_code",$orderCode)->first();
      $orderList = OrderList::select("order_lists.*","users.name as user_name","users.phone as user_phone","products.image as product_image","products.name as product_name","products.price as product_price")
      ->leftJoin("users","users.id","order_lists.user_id")
      ->leftJoin("products","products.id","order_lists.product_id")
      ->where("order_code",$orderCode)
      ->get();


     return view("admin.order.orderProduct",compact("orderList","order"));
    }
}
