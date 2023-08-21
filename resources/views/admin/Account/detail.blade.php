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
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/download.jpg') }}" class=" shadow-sm"  alt="">
                                    @else
                                        <img src="{{asset("storage/".Auth::user()->image)}}" alt="">
                                    @endif
                                </div>
                                <div class="col-5 offset-1">

                                        <div class="form-group">

                                            <h4 class="mb-2"><button class="btn btn-sm bg-dark text-white me-2"><i class="fa-solid fa-user-tag"></i></button> {{Auth::user()->name}}</h4>
                                            <h4 class="mb-2"><button class="btn btn-sm bg-dark text-white me-2"><i class="fa-solid fa-envelope"></i></button>{{Auth::user()->email}}</h4>
                                            <h4 class="mb-2"><button class="btn btn-sm bg-dark text-white me-2"><i class="fa-solid fa-phone"></i></button>{{Auth::user()->phone}}</h4>
                                            <h4 class="mb-2"><button class="btn btn-sm bg-dark text-white me-2">@if(Auth::user()->gender == "female")
                                                <i class="fa-solid fa-venus"></i>


                                            @else
                                            <i class="fa-solid fa-mars"></i>
                                            @endif</button>{{Auth::user()->gender}}</h4>
                                            <h4 class="mb-2"><button class="btn btn-sm bg-dark text-white me-2"><i class="fa-solid fa-location-dot"></i></button>{{Auth::user()->address}}</h4>
                                            <h4 class="mb-2"><button class="btn btn-sm bg-dark text-white me-2"><i class="fa-regular fa-calendar"></i></button>{{Auth::user()->created_at->format("j-F-Y")}}</h4>



                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-2 mt-3 ">
                                    <a href="{{route("admin#edit")}}"><button class="btn bg-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</button></a>
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
