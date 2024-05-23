@extends('admin.layouts.master')

@section('title','Contact List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                @if(session('deleteSuccess'))
                <div class=" col-4 offset-8">
               <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-arrow-up"></i>{{session('deleteSuccess')}}
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
               </div>
                 @endif

                 <h3>Total-{{$contact->total()}}</h3>

                <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2 text-center">
                        <thead>
                            <tr >
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $c)
                            <tr class="tr-shadow">
                             <input type="hidden" id="contactId" value="{{$c->id}}">
                             <td>{{$c->name}}</td>
                             <td>{{$c->email}}</td>
                             <td>{{$c->message}}</td>
                             <td>{{$c->created_at->format('j-F-Y')}}</td>
                             <td class="col-2">
                                <div class="table-data-feature">
                               <a href="{{route('contact#delete',$c->id)}}">
                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fa-solid fa-trash-can me-1"></i>
                                    </button>
                                    </a>
                                </div>
                             </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
