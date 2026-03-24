@extends('layouts.frontend.app')

@section('title')
    Verify email
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
    
    .btn-modern {
        height: 50px;
        border-radius: 12px;
        padding: 0 30px;
        font-weight: 700;
        background: var(--primary-color);
        color: #fff;
        border: none;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .btn-modern:hover {
        background: #1e40af;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 15px 20px -3px rgba(37, 99, 235, 0.4);
    }

    .icon-circle {
        width: 80px;
        height: 80px;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px auto;
        color: var(--primary-color);
        font-size: 32px;
    }

    @media (max-width: 768px) {
        .auth-branding { display: none; }
        .auth-card { max-width: 450px; }
        .auth-form-container { padding: 40px 25px; }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <!-- Left Branding Section -->
        <div class="auth-branding d-none d-md-flex">
            <h1 class="display-4 font-weight-bold mb-4 text-white">Newsly</h1>
            <p class="h5 font-weight-light text-white" style="opacity: 0.9; line-height: 1.6;">Secure your account and join our community. Verify your email to get started.</p>
        </div>

        <!-- Right Form Section -->
        <div class="auth-form-container">
            <div class="text-center">
                <div class="icon-circle">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                
                <h2 class="font-weight-bold mb-3" style="color: #1e293b; letter-spacing: -0.5px;">Verify Your Email</h2>
                <p class="text-muted mb-4">A link to verify your email address has been sent. Please check your inbox.</p>

                @if (session('resent'))
                    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px; background-color: #f0fdf4; color: #166534;" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <div class="mb-4 text-left" style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 4px solid var(--primary-color);">
                    <p class="small text-muted mb-0">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email, we can send you another one.') }}
                    </p>
                </div>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-modern w-100">
                        <i class="fas fa-paper-plane mr-2"></i> {{ __('Resend Verification Email') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
