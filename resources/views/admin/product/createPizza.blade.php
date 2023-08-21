@extends("admin.layout.master")
@section("title", "Category List Page")
@section("content")
      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                    <div class="col-md-12">

                            <h2>Create Page</h2>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-3 offset-8">
                                        <a href="{{route("product#list")}}"><button class="btn bg-dark text-white my-3">List</button></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 offset-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h3 class="text-center title-2">Create your Pizza</h3>
                                            </div>
                                            <hr>
                                            <form action="{{route("product#create")}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid

                                                    @enderror"  value="{{old("pizzaName")}}" varia-required="true" aria-invalid="false" placeholder="Enter Your Pizza Name..">
                                                    @error('pizzaName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Category</label>
                                                    <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid

                                                    @enderror">
                                                        <option value="">Choose Your Category</option>
                                                        @foreach ($categories as $c)
                                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                                        @endforeach
                                                    </select>
                                                   @error('pizzaCategory')
                                                   <div class="invalid-feedback">
                                                       {{ $message }}
                                                   </div>
                                               @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                                    <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid

                                                    @enderror" id="" cols="30" rows="10" placeholder="Enter Your Description">{{old("pizzaDescription")}}</textarea>
                                                    @error('pizzaDescription')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                                    <input id="cc-pament" name="pizzaImage" type="file" class="form-control @error('pizzaImage') is-invalid

                                                    @enderror"   varia-required="true" aria-invalid="false" >
                                                    @error('pizzaImage')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                                    <input id="cc-pament" name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime') is-invalid

                                                    @enderror"  value="{{old("pizzaWaitingTime")}}" varia-required="true" aria-invalid="false" placeholder="Enter pizza Waiting Time..">
                                                    @error('pizzaWaitingTime')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid

                                                    @enderror"  value="{{old("pizzaPrice")}}" varia-required="true" aria-invalid="false" placeholder="Enter pizza price..">
                                                    @error('pizzaPrice')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>


                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                        <span id="payment-button-amount">Create</span>

                                                        <i class="fa-solid fa-circle-right"></i>
                                                    </button>
                                                </div>
                                            </form>
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
