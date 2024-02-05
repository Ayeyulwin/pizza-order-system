@extends('user.layouts.master')
@section('content')

    <!-- Contact Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 ">

            <div class="col-6 offset-3" style="background-color: rgb(162, 170, 150)">
                @if (session('sendSuccess'))
                <div class="col-6 offset-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-cloud-arrow-down me-2"></i> {{ session('sendSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <form action=" {{ route('user#contact')}}" method="get">
                    @csrf
                    <div class="form-group  m-3">
                        <label for="" class="text-white col-2 control-label" >Name:</label>
                        <input type="text" name="name" placeholder="Enter your name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group  m-3">
                        <label for="" class="text-white col-2 control-label">Email:</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group  m-3">
                          <label for="" class="text-white col-2 control-label">Message:</label>
                          <textarea name="message" id="" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10" placeholder="Enter your message"></textarea>
                          @error('message')
                          <div class="invalid-feedback">
                              {{ $message}}
                          </div>
                          @enderror
                    </div>

                   <div class="form-group m-3 ">
                        <button type="submit" class="btn btn-dark btn-md float-right text-white m-3"> Send </button>
                   </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection


