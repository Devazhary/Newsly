@extends('layouts.admin.app')
@section('title')
    Show|{{ $user->name }}
@endsection
@section('body')
    <center>
            <div class="card-body shadow mb-4 col-10">
                <h1>Show User {{ $user->name }}</h1>
                <img src="{{ asset($user->image) }}" alt="User Image" class="img-thumbnail mb-4" style="width: 150px; height: 150px; border-radius: 50%;">
                {{-- 1 --}}
                <div class="row">
                    {{-- name --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="{{ "Name : ".$user->name }}" readonly>
                        </div>
                    </div>
                    {{-- username --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="{{ "Username : ".$user->username }}" readonly>
                        </div>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="row">
                    {{-- email --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="{{ "Email : ".$user->email }}" readonly>
                        </div>
                    </div>
                    {{-- phone --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="{{ "Phone : ".$user->phone }}" readonly>
                        </div>
                    </div>
                </div>
                {{-- 3 --}}
                <div class="row">
                    {{-- user status --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input value="{{ "Status : " . ($user->status == 1 ? 'Active' : 'Not Active') }}" class="form-control form-control-user" readonly>
                        </div>
                    </div>
                    {{-- user verified --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input value="{{ "Verified : " . ($user->email_verified_at !== null ? 'Yes' : 'No') }}" class="form-control form-control-user" readonly>
                        </div>
                    </div>
                </div>
                {{-- 4 --}}
                <div class="row">
                    {{-- country --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="{{ "Country : ".$user->country }}" readonly>
                        </div>
                    </div>
                    {{-- city --}}
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="{{ "City : ".$user->city }}" readonly>
                        </div>
                    </div>
                </div>
                {{-- 6 --}}
                <div class="row">
                    {{-- street --}}
                    <div class="col-8">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" value="{{ "Street : ".$user->street }}" readonly>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.user.index') }}" class="btn btn-info">Back</a>
                <a href="{{ route('admin.user.changeStatus', $user->id) }}" class="btn btn-dark">{{ $user->status == 1 ? 'Block' : 'Unblock' }}</a>
                <a class="btn btn-danger" href="javascript:void(0);" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) document.getElementById('DeleteUserForm').submit();">
                    Delete
                </a>

                <form id="DeleteUserForm" action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
    </center>
@endsection
