@extends('layouts.frontend.app')

@section('title')
    Login
@endsection

@section('body')
<style>
    /* Hide Breadcrumb on this page */
    .breadcrumb-wrap { display: none !important; }
    
    /* Restore natural flow */
    html, body { height: auto !important; overflow: auto !important; background-color: var(--bg-light); }
    
    .auth-wrapper {
        min-height: 80vh; 
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
    }
    
    .auth-card {
        display: flex;
        flex-direction: row;
        width: 100%;
        max-width: 900px;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.06);
        border: none;
    }
    
    .auth-branding {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #fff;
    }
    
    .auth-form-container {
        flex: 1.2;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .input-icon-wrapper {
        position: relative;
    }
    
    .input-icon-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    
    .form-control-modern {
        height: 50px;
        padding-left: 45px !important;
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        transition: all 0.3s ease;
    }
    
    .form-control-modern:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        background: #fff;
    }
    
    .btn-login-modern {
        height: 50px;
        border-radius: 12px;
        font-weight: 700;
        background: var(--primary-color);
        border: none;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    @media (max-width: 768px) {
        .auth-branding { display: none; }
        .auth-card { max-width: 450px; }
        .auth-form-container { padding: 35px 25px; }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <!-- Left Branding Section -->
        <div class="auth-branding d-none d-md-flex">
            <h1 class="display-4 font-weight-bold mb-4 text-white">Newsly</h1>
            <p class="h5 font-weight-light text-white" style="opacity: 1; line-height: 1.6;">Stay informed with the latest stories from around the world. Your professional news source.</p>
        </div>

        <!-- Right Form Section -->
        <div class="auth-form-container">
            <div class="mb-4 text-center text-md-left">
                <h2 class="font-weight-bold" style="color: #1e293b; letter-spacing: -0.5px;">Welcome Back</h2>
                <p class="text-muted small">Please enter your details to sign in</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-4">
                    <label class="small font-weight-bold text-muted mb-2">{{ __('Email Address') }}</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" class="form-control form-control-modern @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="name@example.com">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="small font-weight-bold text-muted mb-0">{{ __('Password') }}</label>
                        @if (Route::has('password.request'))
                            <a class="small font-weight-bold" href="{{ route('password.request') }}" style="color: var(--primary-color);">Forgot?</a>
                        @endif
                    </div>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" class="form-control form-control-modern @error('password') is-invalid @enderror" name="password" required placeholder="••••••••">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="form-check small">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label font-weight-bold text-muted" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-login-modern mb-4">
                    {{ __('Sign In') }}
                </button>

                <div class="text-center">
                    <p class="small text-muted mb-0">New here? <a href="{{ route('register') }}" class="font-weight-bold" style="color: var(--primary-color);">Create account</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
