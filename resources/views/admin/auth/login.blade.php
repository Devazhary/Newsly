@extends('layouts.admin.auth.app')
@section('title')
    Login
@endsection
@section('body')
    <!-- Left Branding Section -->
    <div class="auth-branding d-none d-md-flex">
        <div class="mb-auto">
            <i class="fas fa-shield-alt fa-3x mb-3 text-white"></i>
        </div>
        <div>
            <h1 class="display-4 font-weight-bold mb-3 text-white" style="letter-spacing: -1px;">Admin <br>Portal</h1>
            <p class="h6 font-weight-light text-white" style="opacity: 0.9; line-height: 1.6;">Secure access to the Newsly
                management dashboard. Manage content, users, and settings.</p>
        </div>
        <div class="mt-auto pt-4">
            <p class="small text-white-50 mb-0">&copy; {{ date('Y') }} Newsly. All rights reserved.</p>
        </div>
    </div>

    <!-- Right Form Section -->
    <div class="auth-form-container">
        <div class="mb-5 text-center text-md-left">
            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Please sign in to your administrator account</p>
        </div>

        {{-- login form --}}
        <form class="user" action="{{ route('admin.login.check') }}" method="POST">
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

            {{-- password --}}
            <div class="form-group mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label-modern mb-0">Password</label>
                    <a class="small font-weight-bold" href="{{ route('admin.password.forget.show') }}" style="color: var(--primary-color);">Forgot?</a>
                </div>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock"></i>
                    <input name="password" type="password" class="form-control form-control-modern"
                        id="exampleInputPassword" placeholder="••••••••" required>
                </div>
                @error('password')
                    <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- remember me --}}
            <div class="form-group mb-5">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                    <label class="custom-control-label font-weight-bold text-muted pt-1" for="customCheck"
                        style="font-size: 0.9rem; margin-top: 2px;">
                        Remember Me
                    </label>
                </div>
            </div>

            {{-- button login --}}
            <button type="submit" class="btn btn-login-modern w-100">
                Sign In to Dashboard
            </button>

        </form>
    </div>
@endsection
