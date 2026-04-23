@extends('layouts.admin.auth.app')
@section('title')
    Reset Password
@endsection
@section('body')
    <!-- Right Form Section -->
    <div class="auth-form-container">
        <div class="mb-5 text-center text-md-left">
            <h2 class="auth-title">Reset Password</h2>
            <p class="auth-subtitle">Please enter your new password</p>
        </div>

        {{-- login form --}}
        <form class="user" action="{{ route('admin.password.reset.password') }}" method="POST">
            @csrf

            {{-- email --}}
            <input hidden name="email" type="email" value="{{ request()->email }}">
            

            {{-- password --}}
            <div class="form-group mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label-modern mb-0">Password</label>
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

            {{-- password confirmation --}}
            <div class="form-group mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label-modern mb-0">Confirm Password</label>
                </div>
                <div class="input-icon-wrapper">
                    <i class="fas fa-lock"></i>
                    <input name="password_confirmation" type="password" class="form-control form-control-modern"
                        id="exampleInputPassword" placeholder="••••••••" required>
                </div>
                @error('password_confirmation')
                    <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- button login --}}
            <button type="submit" class="btn btn-login-modern w-100">
                Reset Password
            </button>

        </form>
    </div>
@endsection
