@extends("user.layout.master")
@section("content")

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0 "  id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        @foreach ($cartList as $c)
                        <tr>
                            <td><img src="{{asset("storage/".$c->product_image)}}" class="img-thumbnail shadow-sm" alt="" style="width: 75px;"></td>

                            <td class="align-middle"> {{$c->pizza_name}}</td>
                            <input type="hidden" class="orderId" value="{{$c->id}}">
                            <input type="hidden" class="productId" value="{{$c->product_id}}">
                            <input type="hidden" class="userId" value="{{$c->user_id}}">
                            <td class="align-middle" id="price">{{$c->pizza_price}}Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->quantity}}" id="quantity">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{$c->pizza_price*$c->quantity}}Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove" ><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalPrice}} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">1500 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalPrice+1500}} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCartBtn">Clear Cart</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->



@endsection
@section("scriptSource")
<script>
    $(document).ready(function(){
        //when + btn click
        $(".btn-plus").click(function(){
            $parentNode = $(this).parents("tr");
            $price = Number($parentNode.find("#price").text().replace("Kyats" , ""));

            $qty = Number($parentNode.find("#quantity").val());
            $total = $qty * $price;
            $parentNode.find("#total").html($total + " Kyats");
                   //total summery
                   summaryCalculation();
        })


        $(".btn-minus").click(function(){
            //when - btn
            $parentNode = $(this).parents("tr");
            $price = $parentNode.find("#price").text().replace("Kyats", "");

            $qty = Number($parentNode.find("#quantity").val());
            $total =  $price * $qty ;
            $parentNode.find("#total").text($total + " Kyats");
            summaryCalculation();
        })

        $("#orderBtn").click(function(){


                $orderList=[];

                $random = Math.floor(Math.random()* 10000000001);


                  $("#dataTable tbody tr").each(function(index, row){
                    $orderList.push({
                        "user_id" : $(row).find(".userId").val(),
                        "product_id" : $(row).find(".productId").val(),
                        "quantity" : $(row).find("#quantity").val(),
                        "total" :   $("#finalPrice").html().replace("Kyats",""),
                        "order_code" : "POS"+$random
                    });

                   });


                   $.ajax({
                         type : "get",
                         url : "/user/ajax/order",
                         data : Object.assign({},$orderList),
                         dataType : "json",
                         success :function(response){
                            console.log(response);
                            if(response.status == "success"){
                             window.location.href = "/user/home"
               }
                         }
                     })
        })
        $("#clearCartBtn").click(function(){
            $("#dataTable tbody tr").remove();
            $("#subTotalPrice").html("0 Kyats");
            $("#finalPrice").html("1500 Kyats");
            $.ajax({
                         type : "get",
                         url : "/user/ajax/clearCart",
                         dataType : "json",
                         success :function(response){
                            console.log(response.status);
                            if(response.status == "success"){
                             window.location.href = "/user/home"
               }
                         }
                     })
        })
        $(".btn-remove").click(function(){
            $parentNode =$(this).parents("tr");
            $orderId = $parentNode.find(".orderId").val();
            $productId = $parentNode.find(".productId").val();
             $parentNode.remove();
            summaryCalculation();
            $.ajax({
                type : "get",
                url : "/user/ajax/removeBtn",
                data : {
                    "productId" : $productId,
                    "orderId" : $orderId
                },
                dataType : "json",
            })
        })
        function summaryCalculation(){
            //calculate for final
            $totalPrice = 0
                   $("#dataTable tbody tr").each(function(index, row){


                   $totalPrice += Number($(row).find("#total").text().replace("Kyats",""));
                   });
                   $("#subTotalPrice").html(`${$totalPrice} Kyats`)
                   $("#finalPrice").html(`${$totalPrice + 1500} Kyats`)
        }
    })
</script>

@endsection
