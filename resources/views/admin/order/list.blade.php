@extends("admin.layout.master")
@section("title", "Category List Page")
@section("content")
      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">

                        </div>


                    </div>


                  @if (session("deleteSuccess"))
                  <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session("deleteSuccess")}}
                        <i class="fa-solid fa-trash"></i>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>



                  @endif
                  <a href="{{route("order#list")}}">
                    <div class="mb-3">
                        <i class="fa-solid fa-rotate-right fs-3 text-danger"></i>
                      </div>
                  </a>
                <div class="row">
                    <div class="col-3 text-secondary "> <h4>Search Key :  <span class="text-danger"> {{request("key")}}</span></h4></div>
                    <div class="col-3 mb-4 offset-6">
                        <form action="{{route("order#list")}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" class="form-control" name="key" placeholder="Search here" value="{{request("key")}}">
                            <button class="btn bg-dark text-white"><i class="fa-solid fa-magnifying-glass" type="submit"></i></button>

                            </div>
                        </form>
                      </div>
                </div>
                <div class="row mt-1 mb-4">
                    <div class="col-1 offset-10 p-2 text-center bg-white shadow-sm">
                       <h3><i class="fa-solid fa-database mr-2"></i> {{count($order)}}</h3>

                    </div>
                    <div class="col-6 mb-3">

                        <form action="{{route("admin#orderStatus")}}" method="get" class="d-flex">
                            @csrf
                            <select name="orderStatus" id="orderStatus" class="form-control col-4 me-3" id="" >
                                <option value="">All</option>
                                <option value="0" @if (request("orderStatus") == "0") selected  @endif>Pending</option>
                                <option value="1" @if (request("orderStatus") == "1") selected @endif>Success</option>
                                <option value="2" @if (request("orderStatus") == "2")  selected @endif>Reject</option>

                            </select>


                            <button type="submit" class="col-3 bg-dark text-white">Search</button>
                        </form>

                    </div>
                </div>

                   @if (count($order)!=0)
                   <div class="table-responsive table-responsive-data2" >
                    <table class="table table-data2 text-center" >
                        <thead>
                            <tr>

                                <th>User Id</th>
                                <th>Username</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>


                            </tr>
                        </thead>
                        <tbody id="" class="fee">

                            @foreach ($order as $o)

                            <tr class="tr-shadow">
                                <td class="col-2">{{$o->user_id}}</td>
                                <td class="col-2">{{$o->user_name}}</td>
                                <td class="col-2">{{$o->created_at->format("F-j-Y")}}</td>
                                <td class="col-2"><a href="{{route("admin#orderInfo",$o->order_code)}}" class="text-danger">{{$o->order_code}}</a></td>
                                <td class="col-2"  >{{$o->total_price}}</td>
                                <input type="hidden" name="" class="orderId" value="{{$o->id}}">
                                <td class="col-2">

                                    <select name="status" class="form-control orderStatus">

                                        <option value="0"@if ($o->status == 0) selected   @endif>Pending</option>
                                        <option value="1" @if ($o->status == 1) selected   @endif>Accept</option>
                                        <option value="2" @if ($o->status == 2) selected   @endif>Reject</option>
                                    </select>
                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>

                   @else
                   <h3 class="text-secondary text-center mt-5">There is no order here</h3>

                   @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
@section("scriptSection")
    <script>
        $(document).ready(function(){
            // $("#orderStatus").change(function(){
            //   $status = $("#orderStatus").val();


            //   $.ajax({
            //     type : "get",
            //     url : "/order/ajaxStatus",
            //     data : {
            //         "status" : $status,
            //     },
            //     dataType : "json",
            //     success :function(response){
            //         $list = '';
            //                for($i=0;$i<response.length;$i++){
            //                 $months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
            //                 $dbDate = new Date(response[$i].created_at)

            //                 $finalDate = $months[$dbDate.getMonth()]+"-"+ $dbDate.getDate()+"-"+$dbDate.getFullYear();
            //                 if(response[$i].status == 0){
            //                     $statusMessage = `<select name="status" class="form-control orderStatus" >

            //                                 <option value="0" selected >Pending</option>
            //                                 <option value="1"  >Accept</option>
            //                                 <option value="2"  >Reject</option>
            //                                         </select>
            //                                     `
            //                 }else if(response[$i].status == 1) {
            //                     $statusMessage = `<select name="status" class="form-control orderStatus" >

            //                                 <option value="0"  >Pending</option>
            //                                 <option value="1" selected  >Accept</option>
            //                                 <option value="2"  >Reject</option>
            //                                         </select>
            //                                     `
            //                 }else{
            //                          $statusMessage = `<select name="status" class="form-control orderStatus" >

            //                                 <option value="0"  >Pending</option>
            //                                 <option value="1"   >Accept</option>
            //                                 <option value="2" selected  >Reject</option>
            //                                         </select>
            //                                     `
            //                 }
            //                 $list +=`<tr class="tr-shadow">
            //                     <input type="text" name="" class="orderId" value="${response[$i].id}">
            //                     <td class="col-2">${response[$i].user_id}</td>
            //                     <td class="col-2">${response[$i].user_name}</td>
            //                     <td class="col-2">${$months[$dbDate.getMonth()]+"-"+ $dbDate.getDate()+"-"+$dbDate.getFullYear()}</td>
            //                     <td class="col-2">${response[$i].order_code}</td>
            //                     <td class="col-2">${response[$i].total_price}</td>

            //                     <td class="col-2">
            //                         ${$statusMessage}
            //                     </td>

            //                 </tr>
            //                 `

            //                }
            //                $(".fee").html($list);


            //         }
            //   })

            // })
            //change status
            $(".orderStatus").change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find(".orderId").val();
                $data = {
                    "status" : $currentStatus,
                    "orderId" : $orderId
                }
                console.log($data);
                $.ajax({
                type : "get",
                url : "/order/ajaxChangeStatus",
                data : $data,
                dataType : "json",

                    })
                    // location.reload();
                    // window.location.href ="/order/list"
            })
        })
    </script>
@endsection

