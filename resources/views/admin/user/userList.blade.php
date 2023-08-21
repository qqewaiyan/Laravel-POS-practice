@extends("admin.layout.master")
@section("title", "Category List Page")
@section("content")
      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->





                <div class="row mt-1 mb-4">
                    <div class="col-1 offset-10 p-2 text-center bg-white shadow-sm">
                       <h3><i class="fa-solid fa-user mr-2"></i> {{count($users)}}</h3>

                    </div>
                    <div class="col-6 mb-3">



                    </div>
                </div>

                   {{-- @if (count($order)!=0) --}}
                   <div class="table-responsive table-responsive-data2" >
                    <table class="table table-data2 text-center" >
                        <thead>
                            <tr>
                                <th> Image</th>

                                <th>Name</th>
                                <th>Email</th>


                                <th>Phone</th>

                                <th>Gender</th>
                                <th>Address</th>
                                <th>Role</th>



                            </tr>
                        </thead>
                        <tbody id="" class="fee">

                            @foreach ($users as $user)
                            <tr>
                                <td class="col-1">@if ($user->image == null)
                                    <img src="{{ asset('image/download.jpg') }}" class=" shadow-sm " alt="">
                                @else
                                    <img src="{{asset("storage/".$user->image)}}" class="shadow-sm " alt="">
                                @endif </td>

                                <td class="">{{$user->name}}</td>
                                <td class="">{{$user->email}}</td>


                                <td class="">{{$user->phone}}</td>

                                <td class="">{{$user->gender}}</td>
                                <td class="">{{$user->address}}</td>
                                <input type="hidden" name="" id="userId" value="{{$user->id}}">
                                <td class="">
                                    <select id="" class="form-control roleChange" >
                                        <option value="user"@if ($user->role == "user") selected  @endif>User</option>
                                        <option value="admin" @if ($user->role == "admin") selected  @endif>Admin</option>
                                    </select>
                                </td>




                            </tr>
                            @endforeach


                        </tbody>

                    </table>


                </div>

                   {{-- @else
                   <h3 class="text-secondary text-center mt-5">There is no order here</h3>

                   @endif --}}
                   <div class="mt-3">
                    {{$users->links()}}
                </div>

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
            $(".roleChange").change(function(){
                $roleStatus = $(this).val();

                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find("#userId").val();
                $data = {
                    "userId" : $userId,
                    "role" : $roleStatus
                }
                $.ajax({
                    type : "get",
                     url : "/admin/user/change/userRole",
                    data : $data,
                     dataType : "json",



                })
                location.reload();
            })
        })
    </script>
@endsection
