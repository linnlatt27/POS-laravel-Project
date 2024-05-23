@extends('admin.layouts.master')

@section('title','Category List Page')
@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->

                 @if(session('deleteSuccess'))
                 <div class="col-4 offset-8 ">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-xmark"></i>{{session('deleteSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
                  @endif

                 <div class="row">
                  <div class="col-3 mb-2">
                  <h4 class="text-secondary">Search Key:<span class="text-danger">{{request('key')}}</span></h4>
                  </div>
                  <div class="col-3 offset-6">
                    <form action="{{route('admin#list')}}" method="get">
                        @csrf
                        <div class="d-flex">
                         <input type="text" name="key" class="form-control" placeholder="Search..." value="{{request('key')}}">
                         <button class="btn bg-dark text-white" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                         </button>
                        </div>
                    </form>
                  </div>
                  </div>

                  <div class="row my-2">
                    <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center">
                        <h3><i class="fa-solid fa-database"></i>{{$admin->total()}}</h3>
                        </div>
                    </div>

                    @if(count($admin) !=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr >
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="tr-shadow">
                                <td class="col-2">
                                 @if ($a->image ==null)
                                    @if ($a->gender=='female')
                                     <img src="{{asset('image/default_user.jpg')}}" class="img-thumbnail shadow-sm"/>
                                    @else
                                        <img src="{{asset('image/male.png')}}" class="img-thumbnail shadow-sm"/>
                                    @endif
                                 @else
                                     <img src="{{asset('storage/'.$a->image)}}" />
                                 @endif
                                </td>
                                <input type="hidden" id="userId" value="{{$a->id}}">
                                <td>{{$a->name}}</td>
                                <td>{{$a->email}}</td>
                                <td>{{$a->gender}}</td>
                                <td>{{$a->phone}}</td>
                                <td>{{$a->address}}</td>
                                <td class="">
                                    @if (Auth::user()->id==$a->id)

                                    @else
                                 <select name="role" id="roleOption" class="form-control statusChange" >
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                 </select>
                               @endif
                                </td>

                              <td>
                                 <div class="table-data-feature">
                                  @if (Auth::user()->id==$a->id)

                                      @else
                                      {{--<a href="{{route('admin#changeRole',$a->id)}}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                            <i class="fa-solid fa-person-circle-minus me-1"></i>
                                        </button>
                                        </a>--}}

                                      <a href="{{route('admin#delete',$a->id)}}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fa-solid fa-trash-can "></i>
                                        </button>
                                        </a>
                                     @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-5">
                        {{$admin->links()}}
                    </div>
                </div>
                @else
                <h3 class="text-center">There is no  here</h3>
                @endif

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

<!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){

     $('.statusChange').change(function() {
       $currentStatus =$(this).val();
       $parentNode =$(this).parents("tr");
       $userId    =$parentNode.find('#userId').val();

       $data = {'userId' :$userId,'role':$currentStatus};

       $.ajax({
        type :'get',
        url  :'http://localhost:8000/admin/change/role',
        data :$data,
        dataType:'json',
    })

    location.reload();
     })

    })
 </script>
@endsection



