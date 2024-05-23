@extends('user.layouts.master')

@section('title','Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-1">
                @if(session('sendSuccess'))
                <div class="col-4 offset-8 ">
               <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-arrow-up"></i>{{session('sendSuccess')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
               </div>
                 @endif
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Contact Message</h3>
                        </div>

                        <hr>

                        <form action="{{route('user#send')}}" method="post" >
                            @csrf
                            <div class="row">
                            <div class="col-4 offset-1">
                                <input type="hidden"  value ="{{Auth::user()->id}}" id="contactId">
                                <div class="mt-3">
                                 <button class="btn bg-dark text-white">
                                    <i class="fa-solid fa-circle-arrow-left"></i>Send
                                 </button>
                                </div>
                            </div>

                         <div class="row col-6">
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}" class="form-control  @error('name')is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Email</label>
                                <input id="cc-pament" name="email" type="text" value="{{old('email',Auth::user()->email)}}" class="form-control  @error('email')is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Message</label>
                                <textarea name="message" cols="30" rows="10" class="form-control @error('message')is-invalid @enderror" placeholder="Enter Message..."></textarea>
                                @error('message')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

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
