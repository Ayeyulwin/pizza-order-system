@extends('admin.layouts.master')

@section('title', 'Category List Page')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>

                            <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id}}">
                                            <img src="{{ asset('storage/'.$pizza->image) }} " class="img-thumbnail" />


                                        <div class="mt-3">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="">
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">
                                                <i class="fa-solid fa-circle-chevron-right me-1"></i>Update
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" value="{{ old('name', $pizza->name) }}"
                                                aria-invalid="false" placeholder="Enter pizza name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Description</label>
                                                <textarea name="description" class="form-control @error('description') is-invalid

                    @enderror"
                                                    id="" cols="30" rows="10" placeholder="Enter pizza description">{{ old('description', $pizza->description) }} </textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>



                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <select name="category"
                                                            class="form-control @error('category') is-invalid

                                @enderror"
                                                            id="">
                                                            <option value="">Choose pizza category....</option>
                                                            @foreach ($category as $c)
                                                                <option value="{{ $c->id}}" @if ($pizza->category_id == $c->id) selected @endif>{{ $c->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Price</label>
                                                        <input id="cc-pament" name="price" type="text"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            aria-required="true" value="{{ old('price', $pizza->price) }}"
                                                            aria-invalid="false" placeholder="Enter pizza price...">
                                                        @error('price')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-1">Waiting Time</label>
                                                            <input id="cc-pament" name="waitingTime" type="text"
                                                                class="form-control @error('waitingTime') is-invalid @enderror"
                                                                aria-required="true" value="{{ old('waitingTime', $pizza->waiting_time) }}"
                                                                aria-invalid="false" placeholder="Enter waiting time...">
                                                            @error('waitingTime')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label mb-1">View Count</label>
                                                                <input id="cc-pament" name="viewCount" type="text"
                                                                    class="form-control @error('viewCount') is-invalid @enderror"
                                                                    aria-required="true" value="{{ old('viewCount', $pizza->view_count) }}"
                                                                    aria-invalid="false" disabled>

                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label mb-1">Create_at</label>
                                                                    <input id="cc-pament" name="createdAt" type="text" disabled
                                                                        class="form-control" aria-required="true"
                                                                        value='{{ $pizza->created_at->format('j-F-Y') }}' aria-invalid="false">
                                                                </div>
                                                            </div>
                                                        </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endsection
