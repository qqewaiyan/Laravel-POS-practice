@extends('admin.layout.master')
@section('title', 'Category List Page')
@section('content')
    <!-- MAIN CONTENT-->

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">



                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <form action="{{route("admin#update",Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('image/download.jpg') }}" class=" shadow-sm " alt="">
                                        @else
                                            <img src="{{asset("storage/".Auth::user()->image)}}" class="shadow-sm w-75" alt="">
                                        @endif
                                        <div class="">
                                            <input type="file" name="image" id="" class="form-control @error("image") is-invalid @enderror  ">
                                            @error("image")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                           <button class="btn btn-dark  text-white col-12" type="submit"><i class="fa-solid fa-arrow-up-from-bracket me-1"></i>Update</button>
                                        </div>
                                    </div>
                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control  @error('name') is-invalid

                                                    @enderror"
                                                varia-required="true" aria-invalid="false"
                                                value="{{ old('name', Auth::user()->name) }}" placeholder="Enter Admin name">
                                                @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" class="form-control @error('email') is-invalid

                                                    @enderror"
                                                varia-required="true" aria-invalid="false"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                placeholder="Enter Admin Email">
                                                @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" class="form-control @error('phone') is-invalid

                                                    @enderror"
                                                varia-required="true" aria-invalid="false"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                placeholder="Enter Admin Phone">
                                                @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 @error('gender') is-invalid

                                                    @enderror">Gender</label>
                                            <select name="gender" class="form-control" id="">
                                                <Option value=""> Choose Your Gender....</Option>
                                                <option value="male" @if (Auth::user()->gender == "male") Selected

                                                @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == "female") Selected

                                                    @endif>Female</option>
                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 @error('address') is-invalid

                                                    @enderror">Address</label>
                                            <textarea name="address" class="form-control" id="" cols="30" placeholder="Enter Admin  Address"
                                                rows="10">{{ old('address', Auth::user()->address) }}
                                       </textarea>
                                       @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" class="form-control"
                                                varia-required="true" aria-invalid="false"
                                                value="{{ old('role', Auth::user()->role) }}" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
