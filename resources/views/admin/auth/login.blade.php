<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Newsly Admin Login">
    <meta name="author" content="">

    <title>Newsly Admin | Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/dashboard') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/dashboard') }}/css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --bg-light: #f8fafc;
        }
        
        body { 
            background-color: var(--bg-light); 
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: auto; /* Fallback for small screens */
        }
        
        .auth-wrapper {
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            align-items: center;
        }
        
        .auth-card {
            display: flex;
            flex-direction: row;
            width: 100%;
            max-width: 900px;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border: none;
        }
        
        .auth-branding {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        
        /* Subtle pattern/overlay to the branding background */
        .auth-branding::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+CjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0ibm9uZSI+PC9yZWN0Pgo8Y2lyY2xlIGN4PSIyIiBjeT0iMiIgcj0iMiIgZmlsbD0icmdiYSgyNTUsIDI1NSwgMjU1LCAwLjA1KSI+PC9jaXJjbGU+Cjwvc3ZnPg==') repeat;
            opacity: 0.5;
        }
        
        .auth-branding > * {
            position: relative;
            z-index: 1;
        }
        
        .auth-form-container {
            flex: 1.2;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }
        
        .input-icon-wrapper {
            position: relative;
        }
        
        .input-icon-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
            z-index: 10;
        }
        
        .form-control-modern {
            height: 54px;
            padding-left: 50px !important;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            transition: all 0.3s ease;
            font-size: 1rem;
            color: #334155;
        }
        
        .form-control-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: #fff;
        }
        
        .btn-login-modern {
            height: 54px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.05rem;
            background: var(--primary-color);
            border: none;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            transition: all 0.3s ease;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-login-modern:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(37, 99, 235, 0.4);
            color: #fff;
        }

        .auth-title {
            color: #0f172a;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: #64748b;
            font-size: 0.95rem;
        }
        
        .form-label-modern {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .auth-branding { display: none; }
            .auth-card { max-width: 450px; border-radius: 16px; min-height: 400px; }
            .auth-form-container { padding: 40px 30px; }
            body { padding: 15px; height: auto; }
            .auth-wrapper { padding: 0; min-height: 80vh; }
        }
    </style>

</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">
            
            <!-- Left Branding Section -->
            <div class="auth-branding d-none d-md-flex">
                <div class="mb-auto">
                    <i class="fas fa-shield-alt fa-3x mb-3 text-white"></i>
                </div>
                <div>
                    <h1 class="display-4 font-weight-bold mb-3 text-white" style="letter-spacing: -1px;">Admin <br>Portal</h1>
                    <p class="h6 font-weight-light text-white" style="opacity: 0.9; line-height: 1.6;">Secure access to the Newsly management dashboard. Manage content, users, and settings.</p>
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
                            <input name="email" type="email" class="form-control form-control-modern"
                                id="exampleInputEmail" aria-describedby="emailHelp"
                                placeholder="admin@newsly.com" required autofocus>
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    {{-- password --}}
                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label-modern mb-0">Password</label>
                            <a class="small font-weight-bold" href="#" style="color: var(--primary-color);">Forgot?</a>
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
                            <label class="custom-control-label font-weight-bold text-muted pt-1" for="customCheck" style="font-size: 0.9rem; margin-top: 2px;">
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
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/dashboard') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/dashboard') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/dashboard') }}/js/sb-admin-2.min.js"></script>

</body>

</html>