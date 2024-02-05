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
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
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


                   <form action="{{ route('admin#changeStatus')}}" method="get" class="col-5">
                    @csrf
                    <div class="input-group mb-3">

                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa-solid fa-database mr-2"></i>{{ count($order)}}
                            </span>
                        </div>
                        <select name= "orderStatus" class="form-select" id="inputGroupSelect02">
                            <option value="" @if(request('orderStatus')=='') selected @endif>All</option>
                            <option value="0" @if(request('orderStatus')=='0') selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus')=='1') selected @endif>Accept</option>
                            <option value="2" @if(request('orderStatus')=='2') selected @endif>Reject</option>
                        </select>

                       <div class="input-group-append">
                        <button type="submit" class="btn btn-sm ms-3 bg-dark text-white input-group-text" ><i class="fa-solid fa-magnifying-glass me-3"></i>Search</button>
                       </div>
                    </div>

                   </form>
                       <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead >
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody id="dataList">

                                @foreach ($order as $o)
                                <tr class="tr-shadow">
                                    <input type="hidden" class="orderId" value="{{ $o->id}}">
                                    <td class="">{{ $o->user_id }}</td>
                                    <td class="">{{ $o->user_name }}</td>
                                    <td class="">{{ $o->created_at->format('F-j-Y') }}</td>
                                    <td class="">
                                        <a href="{{ route('admin#listInfo',$o->order_code)}}" style="text-decoration: none">{{ $o->order_code }}</a>
                                    </td>
                                    <td class="amount">{{ $o->total_price }}</td>
                                    <td class="">
                                        <select name="status" class="form-control statusChange">
                                            <option value="0" @if ($o->status == 0) selected @endif >Pending</option>
                                            <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td>
                                 </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">

                            {{-- {{ $order->links() }} --}}

                            {{ $order->appends(request()->query())->links()}}
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

        $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $orderId = $parentNode.find('.orderId').val();
            $data = {
                'status' : $currentStatus ,
                'orderId' : $orderId
            };


            $.ajax({
                type : 'get' ,
                url : '/order/ajax/change/status' ,
                data : $data ,
                dataType : 'json' ,
            })

        })

    })
</script>
@endsection
