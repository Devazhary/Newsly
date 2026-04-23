@extends('layouts.admin.auth.app')
@section('title')
    Email verification
@endsection
@section('body')
    <!-- Right Form Section -->
    <div class="auth-form-container">
        <div class="mb-5 text-center text-md-left">
            <h2 class="auth-title">Email verification</h2>
            <p class="auth-subtitle">Please put your email</p>
        </div>

        {{-- login form --}}
            <form class="user" action=" {{ route('admin.password.forget.send') }} " method="POST">
            @csrf

            {{-- email --}}
            <div class="form-group mb-4">
                <label class="form-label-modern">Email Address</label>
                <div class="input-icon-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input name="email" type="email" class="form-control form-control-modern" id="exampleInputEmail"
                        aria-describedby="emailHelp" placeholder="admin@newsly.com" required autofocus>
                </div>
                @error('email')
                    <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- button login --}}
            <button type="submit" class="btn btn-login-modern w-100">
                Send
            </button>

        </form>
    </div>
@endsection
