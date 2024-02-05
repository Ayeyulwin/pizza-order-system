@extends('admin.layouts.master')

@section('title','Category List Page')
@section('content')


<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 offset-7">

                    @if (session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>

                    @endif
                </div>
            </div>

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                       {{-- <a href=" {{ route('product#list')}}" > --}}
                        <div class="ms-5">
                            <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                        </div>
                       {{-- </a> --}}
                        <div class="card-title">
                          {{-- <h3 class="text-center title-2">Pizza Details</h3> --}}
                        </div>

                        <div class="row mt-3">
                            <div class="col-3 offset-1">

                                <img src="{{ asset('storage/'.$pizza->image) }} "  class="img-thumbnail"  />

                            </div>

                            <div class="col-8">
                                <div class="my-3  btn btn-danger text-white d-block w-50 text-center fs-5"> {{ $pizza->name}}</div>
                                <span class="my-3 btn btn-dark text-white"> <i class="fa-solid fa-money-bill-1-wave me-2 fs-5"></i>  {{ $pizza->price}}kyats</span>
                                <span class="my-3 btn btn-dark text-white"> <i class="fa-solid fa-clock me-2 fs-5"></i>  {{ $pizza->waiting_time}}mins</span>
                                <span class="my-3 btn btn-dark text-white"> <i class="fa-solid fa-eye me-2 fs-5"></i>  {{ $pizza->view_count}}</span>
                                <span class="my-3 btn btn-dark text-white"> <i class="fa-solid fa-list me-2 fs-5"></i>  {{ $pizza->category_name}}</span>
                                <span class="my-3 btn btn-dark text-white"> <i class="fa-solid fa-user-clock me-2 fs-5"></i>  {{ $pizza->created_at->format('j-F-Y')}}</span>
                                <div class="my-3"><i class="fa-solid fa-file-lines me-2 fs-5"></i>Details</div>
                                <div>{{ $pizza->description}}</div>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
