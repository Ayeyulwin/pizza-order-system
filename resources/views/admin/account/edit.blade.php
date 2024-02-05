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
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>

                            <form action="{{ route('admin#update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                                @if(Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/default_user.jpg')}}" class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/female.jpeg')}}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                        <img src="{{ asset('storage/'.Auth::user()->image ) }}"  />
                                        @endif

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
                                                aria-required="true" value="{{ old('name', Auth::user()->name) }}"
                                                aria-invalid="false" placeholder="Enter admin Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input id="cc-pament" name="email" type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    aria-required="true" value="{{ old('email', Auth::user()->email) }}"
                                                    aria-invalid="false" placeholder="Enter admin email...">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" name="phone" type="number"
                                                        class="form-control @error('phone') is-invalid

                                @enderror"
                                                        aria-required="true" value="{{ old('phone', Auth::user()->phone) }}" aria-invalid="false" placeholder="Enter admin phone...">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select name="gender"
                                                            class="form-control @error('gender') is-invalid

                                @enderror"
                                                            id="">
                                                            <option value="">Choose gender....</option>
                                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                                Male</option>
                                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                                Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror

                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label mb-1">Address</label>
                                                            <textarea name="address" class="form-control @error('address') is-invalid

                                @enderror"
                                                                id="" cols="30" rows="10" placeholder="Enter admin address">{{ old('address', Auth::user()->address) }} </textarea>
                                                            @error('address')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                                <div class="form-group">
                                                                    <label class="control-label mb-1">Role</label>
                                                                    <input id="cc-pament" name="role" type="text" disabled
                                                                        class="form-control" aria-required="true"
                                                                        value={{ old('role', Auth::user()->role) }} aria-invalid="false">
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
