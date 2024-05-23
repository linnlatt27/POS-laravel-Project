@extends('admin.layouts.master')

@section('title','Password List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>

                        @if(session('changeSuccess'))
                        <div class="col-12 ">
                       <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check"></i>{{session('changeSuccess')}}
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>
                       </div>
                         @endif

                         @if(session('notMatch'))
                         <div class="col-12 ">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i>{{session('notMatch')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        </div>
                          @endif
                        <hr>

                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                         @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password"  class="form-control @error('oldPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                                @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password"  class="form-control @error('newPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                                @error('newPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password"  class="form-control @error('confirmPassword')is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                                @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change Password</span>
                                    {{--<span id="payment-button-sending" style="display:none;">Sending…</span>--}}
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
<!-- END MAIN CONTENT-->
@endsection
