@extends('admin.layout.master')
@section('title', 'Category List Page')
@section('content')
    <!-- MAIN CONTENT-->

    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7 mb-2">
                @if (session("updateSuccess"))
                  <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session("updateSuccess")}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>



                  @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">



                <div class="col-lg-10 offset-1">
                    <div class="card">

                        <div class="card-body">
                            <div class="ms-5 fs-3">

                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>

                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Detail</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                               <img src="{{asset("storage/".$pizzas->image)}}" alt="">
                               <div class="row">

                            </div>

                                </div>
                                <div class="col-5 offset-1">


                                        <div class="form-group">


                                            <h3 class="mb-2 text-primary">{{$pizzas->name}}</h3><hr>
                                            <div class="d-flex">
                                                <div class="mb-2 btn btn-sm bg-dark text-white me-2"> <i class="fa-solid fa-dollar-sign me-2"></i>{{$pizzas->price}}</div>
                                                <div class="mb-2 btn btn-sm bg-dark text-white me-2"> <i class="fa-regular fa-clock me-2"></i>{{$pizzas->waiting_time}}</div>
                                                <div class="mb-2 btn btn-sm bg-dark text-white me-2"> <i class="fa-solid fa-eye me-2"></i>{{$pizzas->view_count}}</div>
                                                <div class="mb-2 btn btn-sm bg-dark text-white me-2"><i class="fa-solid fa-list me-2"></i>{{$pizzas->category_name}}</div>

                                            </div>
                                            <div class="mb-2 btn btn-sm bg-dark text-white me-2"><i class="fa-regular fa-calendar me-2" ></i>{{$pizzas->created_at->format("j-F-Y")}}</div>

                                            <div class="mb-2"><button class="btn btn-sm bg-dark text-white me-2 d-block"><i class="fa-solid fa-circle-info"></i> Description</button>{{$pizzas->description}}</div>




                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
