<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
        //cart detail list
        public function cartList(){

            $cartList = Cart::select("carts.*","products.name as pizza_name", "products.price as pizza_price","products.image as product_image",)
            ->leftJoin("products","products.id","carts.product_id")
            ->where("carts.user_id",Auth::user()->id)
            ->get();

            $totalPrice = 0;
            foreach($cartList as $c){
                $totalPrice +=  $c->pizza_price*$c->quantity;
            }

            return view("user.cart.cart",compact("cartList","totalPrice"));
        }
}
