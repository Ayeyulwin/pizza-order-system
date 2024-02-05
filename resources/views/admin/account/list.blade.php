@extends('admin.layouts.master')

@section('title', 'Category List Page')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">

                        </div>

                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-3 offset-9">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">

                        <div class="col-3">
                            <h3 class="text-secondary">Search Key: <span class="text-danger">{{ request('key')}}</span> </h3>
                        </div>

                        <div class="col-3 offset-6 mb-3">
                            <form action="{{ route('admin#list') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..."
                                        value="{{ request('key') }}">
                                    <button class="btn bg-dark text-white" type="submt">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row m-2">
                        <div class="col-1 offset-10 bg-white shadow-sm p-1  text-center">
                             <h3> <i class="fa-solid fa-database"></i> {{ $admin->total()}}</h3>
                        </div>
                    </div>

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
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
                                <tbody>
                                     @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($a->image == null)
                                               @if($a->gender == 'male')
                                                    <img src="{{ asset('image/default_user.jpg')}}" class="img-thumbnail shadow-sm">
                                               @else
                                                    <img src="{{ asset('image/female.jpeg')}}" class="img-thumbnail shadow-sm">
                                               @endif
                                            @else
                                                <img src="{{ asset('storage/'.$a->image)}}" class="img-thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" id="userId" value="{{ $a->id }}">
                                        <td> {{ $a->name }} </td>
                                        <td> {{ $a->email }}</td>
                                        <td> {{ $a->gender }}</td>
                                        <td> {{ $a->phone }}</td>
                                        <td> {{ $a->address }}</td>

                                        <td>
                                            <div class="table-data-feature">

                                                @if(Auth::user()->id == $a->id)
                                                @else

                                                    <select class="form-control statusChange me-3">
                                                        <option value="user" @if ($a->role == 'user') selected @endif >User</option>
                                                        <option value="admin" @if ($a->role == 'admin') selected @endif >Admin</option>
                                                    </select>


                                                    <a href="{{ route('admin#delete',$a->id)}}">
                                                        <button class="item m-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                        </div>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $admin->links() }}

                                {{-- {{ $categories->appends(request()->query())->links()}} --}}
                            </div>
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
                url : '/account/changeRole' ,
                data : $data ,
                dataType : 'json' ,
            })
            location.reload();

        })

    })
</script>
@endsection
