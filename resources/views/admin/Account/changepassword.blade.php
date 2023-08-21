@extends('admin.layout.master')
@section('title', 'Category List Page')
@section('content')
    <!-- MAIN CONTENT-->

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">


                    <div class="col-lg-6 offset-3">
                        @if (session("Match"))
                        <div class="">
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-2"></i> {{session("Match")}}

                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                      </div>



                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>
                                <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password"
                                            class="form-control @if (session('notMatch')) is-invalid @endif       @error('oldPassword') is-invalid

                                                    @enderror"
                                            varia-required="true" aria-invalid="false"
                                            placeholder="Enter your old password...">
                                        @error('oldPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        @if (session('notMatch'))
                                            <div class="invalid-feedback">
                                                {{ session('notMatch') }}
                                            </div>
                                        @endif


                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password"
                                            class="form-control @error('newPassword') is-invalid

                                                    @enderror"
                                            varia-required="true" aria-invalid="false" placeholder="New password...">
                                        @error('newPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password"
                                            class="form-control @error('confirmPassword') is-invalid

                                                    @enderror"
                                            varia-required="true" aria-invalid="false"
                                            placeholder="Confirm new password...">
                                        @error('confirmPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount" class="text-dark my-2 mx-2"><i
                                                    class="fa-solid fa-key"></i> Change password</span>
                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

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
