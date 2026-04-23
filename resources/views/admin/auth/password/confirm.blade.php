@extends('layouts.admin.auth.app')
@section('title')
    Check OTP
@endsection
@section('body')
    <!-- Right Form Section -->
    <div class="auth-form-container">
        <div class="mb-5 text-center text-md-left">
            <h2 class="auth-title">Check OTP</h2>
            <p class="auth-subtitle">Please enter the OTP sent to your email</p>
        </div>

        {{-- login form --}}
        <form class="user" action="{{ route('admin.password.verify.check') }}" method="POST">
            @csrf

            {{-- email --}}
            <input hidden name="email" type="email" value="{{ $email }}">

            {{-- password --}}
            <div class="form-group mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label-modern mb-0">OTP</label>
                </div>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock"></i>
                    <input name="otp" type="password" class="form-control form-control-modern"
                        id="exampleInputPassword" placeholder="••••••••" required>
                </div>
                @error('otp')
                    <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- button login --}}
            <button type="submit" class="btn btn-login-modern w-100">
                Check OTP
            </button>

        </form>
    </div>
@endsection
