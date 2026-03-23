@extends('layouts.frontend.app')

@section('title')
    Register
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
        max-width: 1000px;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.06);
        border: none;
    }
    
    .auth-branding {
        flex: 0.8;
        background: linear-gradient(135deg, var(--primary-color) 0%, #1e40af 100%);
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #fff;
    }
    
    .auth-form-container {
        flex: 1.5;
        padding: 40px 50px;
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
        height: 44px;
        padding-left: 45px !important;
        border-radius: 10px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .form-control-modern:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        background: #fff;
    }

    .form-label-small {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 6px;
    }
    
    .btn-register-modern {
        height: 48px;
        border-radius: 10px;
        font-weight: 700;
        background: var(--primary-color);
        border: none;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    @media (max-width: 900px) {
        .auth-branding { display: none; }
        .auth-card { max-width: 600px; }
        .auth-form-container { padding: 30px 25px; }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <!-- Left Branding Section -->
        <div class="auth-branding d-none d-md-flex">
            <h1 class="display-4 font-weight-bold mb-4 text-white">Newsly</h1>
            <p class="h5 font-weight-light text-white" style="opacity: 1; line-height: 1.6;">Join our global community and start sharing your stories today.</p>
        </div>

        <!-- Right Form Section -->
        <div class="auth-form-container">
            <div class="mb-4 text-center text-md-left">
                <h2 class="font-weight-bold mb-1" style="color: #1e293b; letter-spacing: -0.5px;">Start Your Journey</h2>
                <p class="text-muted small">Fill in the details to create your account</p>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-small">{{ __('Name') }}</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-user"></i>
                            <input id="name" type="text" class="form-control form-control-modern @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Full Name">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-small">{{ __('Username') }}</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-at"></i>
                            <input id="username" type="text" class="form-control form-control-modern @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="username">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-small">{{ __('Email') }}</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" class="form-control form-control-modern @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="email@example.com">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-small">{{ __('Phone') }}</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-phone"></i>
                            <input id="phone" type="text" class="form-control form-control-modern @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="+123456">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label-small">{{ __('Country') }}</label>
                        <input id="country" type="text" class="form-control form-control-modern" name="country" value="{{ old('country') }}" required placeholder="Country" style="padding-left: 15px !important;">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-small">{{ __('City') }}</label>
                        <input id="city" type="text" class="form-control form-control-modern" name="city" value="{{ old('city') }}" required placeholder="City" style="padding-left: 15px !important;">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label-small">{{ __('Street') }}</label>
                        <input id="street" type="text" class="form-control form-control-modern" name="street" value="{{ old('street') }}" required placeholder="Street" style="padding-left: 15px !important;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label-small">{{ __('Password') }}</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" class="form-control form-control-modern @error('password') is-invalid @enderror" name="password" required placeholder="••••••••">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label-small">{{ __('Confirm') }}</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-check-double"></i>
                            <input id="password-confirm" type="password" class="form-control form-control-modern" name="password_confirmation" required placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label-small">Profile Picture</label>
                    <input id="image" type="file" class="form-control-file small" name="image" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-register-modern mb-3">
                    {{ __('Register Account') }}
                </button>

                <div class="text-center">
                    <p class="small text-muted mb-0">Already a member? <a href="{{ route('login') }}" class="font-weight-bold" style="color: var(--primary-color);">Sign in here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
