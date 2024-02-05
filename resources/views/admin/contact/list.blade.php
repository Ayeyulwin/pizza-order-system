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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody id="dataList">
                              @foreach ($contact as $c )
                                  <tr>
                                    <td> {{ $c->id }} </td>
                                    <td> {{ $c->name }} </td>
                                    <td> {{ $c->email }} </td>
                                    <td> {{ $c->message }} </td>
                                    <td>
                                        <a href="{{ route('contact#delete',$c->id)}}">
                                            <button class="item m-1" data-toggle="tooltip" data-placement="top"
                                                title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a>
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

        //increase view count

        $.ajax({
            type : 'get' ,
            url  : '/user/ajax/increase/viewCount' ,
            dataType : 'json' ,


           })
        })
</script>
@endsection

