@extends("admin.layout.master")
@section("title", "Category List Page")
@section("content")
      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <a href="{{route("order#list")}}">
                        <div class="mb-3">
                            <i class="fa-solid fa-arrow-left-long fs-3 text-danger"></i>
                          </div>
                      </a>

                    <h3 class="fs-3 text-primary mb-2">User Info</h3>
                  <div class="row card col-5">

                    <div class="my-2 row">
                       <div class="col"> Order Code</div>
                       <div class="col">{{$orderList[0]->order_code}}</div>
                    </div>
                    <div class="my-2 row">
                       <div class="col"> Username</div>
                       <div class="col"><i class="fa-solid fa-user me-2"></i>{{$orderList[0]->user_name}}</div>
                    </div>
                    <div class="my-2 row">
                       <div class="col"> Order Date</div>
                       <div class="col"><i class="fa-regular fa-calendar-days me-2"></i> {{$orderList[0]->created_at->format("F-j-Y")}}</div>
                    </div>
                    <div class="my-2 row">
                       <div class="col"> Phone Number</div>
                       <div class="col"><i class="fa-solid fa-phone me-2"></i>  {{$orderList[0]->user_phone}}</div>
                    </div>
                  </div>


                <div class="row mt-1 mb-4">
                    {{-- <div class="col-1 offset-10 p-2 text-center bg-white shadow-sm">
                       <h3><i class="fa-solid fa-database mr-2"></i> {{count($order)}}</h3>

                    </div> --}}
                    <div class="col-6 mb-3">



                    </div>
                </div>

                   {{-- @if (count($order)!=0) --}}
                   <div class="table-responsive table-responsive-data2" >
                    <table class="table table-data2 text-center" >
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>

                                <th>Quantity</th>

                                <th>Price Per Unit</th>



                            </tr>
                        </thead>
                        <tbody id="" class="fee">

                            @foreach ($orderList as $o)

                            <tr class="tr-shadow">
                                <td class="col-1"></td>
                                <td class="col-2">{{$o->id}}</td>
                                <td class="col-2"><img src="{{asset("storage/".$o->product_image)}}" class="img-thumbnail" alt=""></td>
                                <td class="col-2">{{$o->product_name}}</td>

                                <td class="col-2">{{$o->quantity}}</td>
                                <td class="col-2">{{$o->product_price}}</td>






                            </tr>
                            @endforeach


                        </tbody>

                    </table>
                    <div class="card row col-3 mt-3 offset-9">
                        <div class=" fs-5 mb-2">Subtotal -><i class="fa-solid fa-dollar-sign"></i>{{$order->total_price-1500}}</div>
                        <div class="fs-5 mb-4 ">Delivery -><i class="fa-solid fa-truck me-2"></i> 1500</div>
                        
                        <div class="fs-5">Total ->  <i class="fa-solid fa-dollar-sign me-2 ms-4"></i>{{$order->total_price}}</div>
                    </div>

                </div>

                   {{-- @else
                   <h3 class="text-secondary text-center mt-5">There is no order here</h3>

                   @endif --}}


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection


