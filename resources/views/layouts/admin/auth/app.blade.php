<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Newsly Admin Login">
    <meta name="author" content="">

    <title>Newsly Admin | @yield('title')</title>

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
            @yield('body')
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