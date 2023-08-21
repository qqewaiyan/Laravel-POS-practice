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
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route("category#createPage")}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                <div class="row">
                    <div class="col-3 text-secondary "> <h4>Search Key :  <span class="text-danger"> {{request("key")}}</span></h4></div>
                    <div class="col-3 mb-4 offset-6">
                        <form action="{{route("category#list")}}" method="get">
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

                        <h3><i class="fa-solid fa-database mx-2"></i> {{$categories->total()}}</h3>
                    </div>
                </div>
                   @if (count($categories)!=0)
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>More Option</th>

                            </tr>
                        </thead>
                        <tbody >

                            @foreach ($categories as $category)
                            <tr class="tr-shadow">
                                <td>{{$category->id}}</td>
                                <td class="">
                                  {{$category->name}}
                                </td>

                                <td>{{$category->created_at->format("j-F-Y")}}</td>

                                <td >
                                    <div class="table-data-feature justify-content-center">

                                        <a href="{{route("category#edit",$category->id)}}"><button class="item mx-3" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button></a>
                                      <a href="{{route("category#delete",$category->id)}}">  <button class="item"  data-toggle="tooltip" data-placement="top"  title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button></a>

                                    </div>

                                </td>
                            </tr>
                            @endforeach





                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$categories->links()}}
                    </div>
                </div>
                    @else
                    <h3 class="text-secondary text-center mt-5">There is no category here</h3>


                   @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
