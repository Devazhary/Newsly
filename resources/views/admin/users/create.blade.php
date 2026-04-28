@extends('layouts.admin.app')
@section('title')
    Create User
@endsection
@section('body')
    <center>
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- User form fields go here -->
            <div class="card-body shadow mb-4 col-10">
                <h1>Add New User</h1>
                {{-- 1 --}}
                <div class="row">
                    {{-- name --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="name" name="name"
                                placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- username --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="username" name="username"
                                placeholder="Enter Username">
                            @error('username')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="row">
                    {{-- email --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="email" name="email"
                                placeholder="Enter Email">
                            @error('email')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- phone --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                placeholder="Enter Phone">
                            @error('phone')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 3 --}}
                <div class="row">
                    {{-- user status --}}
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" id="status" class="form-control form-control-user">
                                <option value="" selected disabled>Select User Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- user verified --}}
                    <div class="col-6">
                        <div class="form-group">
                            <select name="email_verified_at" id="email_verified_at" class="form-control form-control-user">
                                <option value="" selected disabled>Select User Verified Status</option>
                                <option value="1">Verified</option>
                                <option value="0">Unverified</option>
                            </select>
                            @error('email_verified_at')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 4 --}}
                <div class="row">
                    {{-- image --}}
                    <div class="col-8">
                        <div class="form-group">
                            <input type="file" class="form-control form-control-user" id="image" name="image"
                                placeholder="Enter Image">
                            @error('image')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 5 --}}
                <div class="row">
                    {{-- country --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="country" name="country"
                                placeholder="Enter Country">
                            @error('country')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- city --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="city" name="city"
                                placeholder="Enter Your City">
                            @error('city')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 6 --}}
                <div class="row">
                    {{-- street --}}
                    <div class="col-8">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="street" name="street"
                                placeholder="Enter Your Street">
                            @error('street')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- last --}}
                <div class="row">
                    {{-- password --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password" name="password"
                                placeholder="Enter Password">
                            @error('password')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- confirm password --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm Password">
                            @error('password_confirmation')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add User</button>
            </div>
        </form>
    </center>
@endsection
