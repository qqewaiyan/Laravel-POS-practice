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
                            <div class="ms-5 fs-3">

                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>

                        </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-4 offset-1">

                                        <input type="hidden" name="pizzaId" value="{{$pizzas->id}}">
                                        <img src="{{ asset('storage/' . $pizzas->image) }}" alt="">

                                        <div class="">
                                            <input type="file" name="pizzaImage" id=""
                                                class="form-control @error('pizzaImage') is-invalid @enderror  ">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-dark  text-white col-12" type="submit"><i
                                                    class="fa-solid fa-arrow-up-from-bracket me-1"></i>Update</button>
                                        </div>
                                    </div>
                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text"
                                                class="form-control  @error('pizzaName') is-invalid

                                                    @enderror"
                                                varia-required="true" aria-invalid="false"
                                                value="{{ old('name', $pizzas->name) }}" placeholder="Enter Pizza Name">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>

                                            <textarea name="pizzaDescription" id=""
                                                class=" form-control @error('pizzaDescription') is-invalid

                                                @enderror"
                                                cols="30" rows="10"> {{ old('pizzaDescription', $pizzas->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1 ">Category</label>

                                            <select name="pizzaCategory"
                                                class="form-control @error('pizzaCategory') is-invalid

                                            @enderror"
                                                id="">
                                                <option value="">Choose Your Category</option>
                                            @foreach ($category as $c)
                                                <option value="{{$c->id}}" @if ($pizzas->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number"
                                                class="form-control  @error('pizzaPrice') is-invalid

                                                    @enderror"
                                                varia-required="true" aria-invalid="false"
                                                value="{{ old('pizzaPrice', $pizzas->price) }}"
                                                placeholder="Enter Pizza price">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                                class="form-control  @error('pizzaWaitingTime') is-invalid

                                                    @enderror"
                                                varia-required="true" aria-invalid="false"
                                                value="{{ old('pizzaWaitingTime', $pizzas->waiting_time) }}"
                                                placeholder="Enter Pizza Waiting Time">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="viewCount" type="number" class="form-control"
                                                disabled varia-required="true" aria-invalid="false"
                                                value="{{ old('viewCount', $pizzas->view_count) }}"
                                                placeholder="View Count">

                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="" type="text" class="form-control"
                                                value="{{ $pizzas->created_at->format('j-F-Y') }}" disabled>


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
