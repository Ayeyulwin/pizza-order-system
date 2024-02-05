@extends('admin.layouts.master')

@section('title', 'Category List Page')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                @if (session('deleteSuccess'))
                <div class="col-3 offset-9">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                       <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead >
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $user)

                                    <tr>
                                        <td class="col-2">
                                            @if ($user->image == null)
                                            @if($user->gender == 'male')
                                                 <img src="{{ asset('image/default_user.jpg')}}" class="img-thumbnail shadow-sm">
                                            @else
                                                 <img src="{{ asset('image/female.jpeg')}}" class="img-thumbnail shadow-sm">
                                            @endif
                                         @else
                                             <img src="{{ asset('storage/'.$user->image)}}" class="img-thumbnail shadow-sm">
                                         @endif
                                        </td>
                                        <input type="hidden" name="" id="userId" value="{{ $user->id}}">
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->gender }} </td>
                                        <td> {{ $user->phone }} </td>
                                        <td> {{ $user->address }} </td>
                                        <td>
                                         <div class="table-data-feature">
                                            <select class="form-control statusChange me-3">
                                                <option value="user" @if ($user->role == 'user') selected @endif >User</option>
                                                <option value="admin" @if ($user->role == 'admin') selected @endif >Admin</option>
                                            </select>

                                            <a href="{{ route('user#delete',$user->id)}}">
                                                <button class="item m-1" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                         </div>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="mt-5">
                            {{ $users->links() }}
                        </div> --}}
                     </div>

                    <!-- END DATA TABLE -->

                </div>
        </div>
    </div>
    </div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){

        //change status
         $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('#userId').val();
            $data = {
                'status' : $currentStatus ,
                'userId' : $userId
            };

            $.ajax({
                type : 'get' ,
                url : '/user/change/role' ,
                data : $data ,
                dataType : 'json' ,
            })
            location.reload();

        })

    })
</script>
@endsection
