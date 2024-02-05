@extends('admin.layouts.master')

@section('title', 'Category List Page')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin#list')}}">
                                <div class="ms-5">
                                    <i class="fa-solid fa-arrow-left text-dark" ></i>
                                </div>
                            </a>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>

                            <form action="{{ route('admin#change', $account->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                                @if($account->gender == 'male')
                                                    <img src="{{ asset('image/default_user.jpg')}}" class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/female.jpeg')}}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                        <img src="{{ asset('storage/'.$account->image ) }}"  />
                                        @endif



                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">
                                                <i class="fa-solid fa-circle-chevron-right me-1"></i>Change
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" disabled value="{{ old('name', $account->name) }}"
                                                aria-invalid="false" placeholder="Enter admin Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Role</label>
                                                    <select name="role" class="form-control">
                                                        <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user"  @if($account->role == 'user') selected @endif>User</option>
                                                    </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input id="cc-pament" disabled name="email" type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    aria-required="true" value="{{ old('email', $account->email) }}"
                                                    aria-invalid="false" placeholder="Enter admin email...">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" disabled name="phone" type="number"
                                                        class="form-control @error('phone') is-invalid

                                @enderror"
                                                        aria-required="true" value="{{ old('phone', $account->phone) }}" aria-invalid="false" placeholder="Enter admin phone...">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror"
                                                            id="">
                                                            <option value="">Choose gender....</option>
                                                            <option value="male" @if ($account->gender == 'male') selected @endif>
                                                                Male</option>
                                                            <option value="female" @if ($account->gender == 'female') selected @endif>
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
                                                            <textarea name="address" disabled class="form-control @error('address') is-invalid

                                @enderror"
                                                                id="" cols="30" rows="10" placeholder="Enter admin address">{{ old('address', $account->address) }} </textarea>
                                                            @error('address')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
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
 @section('scriptSource')

 @endsection
