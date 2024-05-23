@extends('admin.layouts.master')

@section('title','Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="row">
    <div class="col-3 offset-7">
    </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <i class="fa-solid fa-arrow-left-long text-dark" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Details</h3>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-3 offset-2">
                                <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm"  />

                            </div>

                            <div class="col-7">
                                <div class= "my-3 btn bg-danger text-white w-50 d-block fs-5 text-center "><i class="fa-solid fa-file-signature"></i>{{$pizza->name}}</div>
                                <span class= "my-3 btn bg-danger text-white"><i class="fa-solid fa-money-bill-wave"></i>{{$pizza->price}}</span>
                                <span class= "my-3 btn bg-danger text-white"><i class="fa-solid fa-clock"></i>{{$pizza->waiting_time}}</span>
                                <span class= "my-3 btn bg-danger text-white"><i class="fa-solid fa-eye"></i>{{$pizza->view_count}}</span>
                                <span class= "my-3 btn bg-danger text-white"><i class="fa-solid fa-list"></i>{{$pizza->category_name}}</span>
                                <span class= "my-3 btn bg-danger text-white"><i class="fa-solid fa-calendar me-2"></i>{{$pizza->created_at->format('j-F-Y')}}</span>
                                <div class= "my-3 "><i class="fa-solid fa-circle-info"></i>Details</div>
                                <div class="">{{$pizza->description}}</div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
