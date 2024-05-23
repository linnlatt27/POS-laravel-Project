@extends('admin.layouts.master')

@section('title','Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                            <a href="{{route('admin#list')}}">
                            <i class="fa-solid fa-arrow-left text-dark"></i>
                            </a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>

                        <hr>

                        <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                            <div class="col-4 offset-1">
                                @if ($account->image == null)
                                <img src="{{asset('image/default_user.jpg')}}"  class="img-thumbnail shadow-sm"/>
                                @else
                                <img src="{{asset('storage/'.$account->image)}}" class="img-thumbnail shadow-sm" />
                                @endif

                                <div class="mt-3">
                                 <button class="btn bg-dark text-white">
                                    <i class="fa-solid fa-circle-arrow-left"></i>Change
                                 </button>
                                </div>
                            </div>

                         <div class="row col-6">
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input id="cc-pament" disabled name="name" type="text" value="{{old('name',$account->name)}}" class="form-control  @error('name') @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label  class="control-label mb-1">Role</label>
                                <select name="role" class="form-control">
                                  <option value="admin" @if($account->role=='admin')selected @endif>Admin</option>
                                  <option value="user" @if($account->role=='user')selected @endif>User</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Email</label>
                                <input id="cc-pament" disabled name="email" type="text" value="{{old('email',$account->email)}}" class="form-control  @error('email') @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Phone</label>
                                <input id="cc-pament" disabled name="phone" type="number" value="{{old('phone',$account->phone)}}" class="form-control  @error('phone') @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Phone...">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Gender</label>
                              <select name="gender" disabled class="form-control  @error('gender')@enderror ">
                                <option value="">Choose your Gender</option>
                                <option value="male" @if($account->gender=='male')selected @endif>Male</option>
                                <option value="female" @if($account->gender=='female')selected @endif>Female</option>
                              </select>
                              @error('gender')
                              <div class="invalid-feedback">
                                  {{$message}}
                              </div>
                              @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Address</label>
                                <textarea name="address" disabled class="form-control  @error('address')@enderror" cols="30" rows="10" placeeholder="Enter Address...">{{old('address',$account->address)}}</textarea>
                               @error('address')
                               <div class="invalid-feedback">
                                   {{$message}}
                               </div>
                               @enderror
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
@endsection
