@extends('admin.layouts.master')

@section('title', 'Category List Page')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create your pizza</h3>
                            </div>

                            <form action="{{ route('product#create') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" value="{{ old('name') }}"name="name" type="text"
                                        class="form-control  @error('name') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter pizza name...">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Category</label>
                                        <select name="category" class="form-control  @error('category') is-invalid @enderror"
                                            id="">
                                            <option value="">Choose your category</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="description" class="form-control  @error('description') is-invalid @enderror"
                                                value="{{ old('description') }}" cols="30" rows="10" placeholder="Enter description"></textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label class="control-label mb-1">Image</label>
                                                <input type="file" name="image" class="form-control
                                                    @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Waiting_Time</label>
                                                    <input id="cc-pament" value="{{ old('waitingTime') }}"name="waitingTime" type="number"
                                                        class="form-control  @error('price') is-invalid @enderror" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter pizza waiting time...">
                                                    @error('waitingTime')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" value="{{ old('price') }}"name="price" type="number"
                                                        class="form-control  @error('price') is-invalid @enderror" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter pizza price...">
                                                    @error('price')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                            <span id="payment-button-amount">Create</span>
                                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                            <i class="fa-solid fa-circle-right"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endsection
