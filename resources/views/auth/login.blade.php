<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Login to Hardware Pro - Your trusted hardware business store">

    <title>Login - {{ config('app.name', 'Hardware Pro') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    <style>
        :root {
            --primary: #1e1b4b;
            --primary-light: #312e81;
            --accent: #f97316;
            --accent-hover: #ea580c;
            --text-dark: #1e1b4b;
            --text-light: #64748b;
            --text-muted: #94a3b8;
            --bg-gradient-start: #fef3e2;
            --bg-gradient-end: #e0e7ff;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
        }

        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* Left Panel - Image Showcase */
        .image-panel {
            position: relative;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }

        .floating-shapes {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            width: 30px;
            height: 30px;
            opacity: 0.6;
        }

        .shape-1 {
            top: 10%;
            right: 15%;
            background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
            transform: rotate(45deg);
            animation: float 4s ease-in-out infinite;
        }

        .shape-2 {
            top: 25%;
            right: 5%;
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
            border-radius: 50%;
            animation: float 3.5s ease-in-out infinite 0.5s;
        }

        .shape-3 {
            bottom: 30%;
            right: 10%;
            background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
            transform: rotate(45deg);
            animation: float 4.5s ease-in-out infinite 1s;
        }

        .shape-4 {
            bottom: 15%;
            left: 5%;
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
            transform: rotate(45deg);
            animation: float 3.8s ease-in-out infinite 0.3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(45deg); }
            50% { transform: translateY(-15px) rotate(45deg); }
        }

        .images-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 50px;
        }

        .image-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: transform 0.3s ease;
        }

        .image-card:hover {
            transform: scale(1.02);
        }

        .image-card-1 {
            width: 220px;
            height: 300px;
            transform: rotate(-8deg);
            z-index: 2;
        }

        .image-card-2 {
            width: 200px;
            height: 280px;
            transform: rotate(8deg) translateX(-40px);
            z-index: 1;
        }

        .image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-panel-text {
            text-align: center;
        }

        .image-panel-text h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .image-panel-text p {
            font-size: 1rem;
            color: var(--text-light);
            max-width: 400px;
            margin: 0 auto;
        }

        /* Right Panel - Login Form */
        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            background: var(--white);
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .form-header p {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            font-size: 1rem;
            font-family: inherit;
            color: var(--text-dark);
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 27, 75, 0.1);
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .form-input.is-invalid {
            border-color: var(--error-color);
        }

        .invalid-feedback {
            display: block;
            margin-top: 6px;
            font-size: 0.8rem;
            color: var(--error-color);
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .remember-me span {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .forgot-link {
            font-size: 0.875rem;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--accent-hover);
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px 24px;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-google {
            background: var(--white);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            margin-top: 16px;
            gap: 12px;
        }

        .btn-google:hover {
            background: #f8fafc;
            border-color: var(--text-muted);
        }

        .btn-google svg {
            width: 20px;
            height: 20px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .divider span {
            padding: 0 16px;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .signup-link {
            text-align: center;
            margin-top: 32px;
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .signup-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: var(--accent-hover);
        }

        /* Alert Box */
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 0.9rem;
        }

        .alert-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .login-container {
                grid-template-columns: 1fr;
            }

            .image-panel {
                display: none;
            }

            .form-panel {
                padding: 40px 24px;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                max-width: 100%;
            }

            .form-row {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Panel - Image Showcase -->
        <div class="image-panel">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>

            <div class="images-container">
                <div class="image-card image-card-1">
                    <img src="{{ asset('images/login-image-1.png') }}" alt="Professional hardware tools">
                </div>
                <div class="image-card image-card-2">
                    <img src="{{ asset('images/login-image-2.png') }}" alt="Construction materials">
                </div>
            </div>

            <div class="image-panel-text">
                <h2>Build your dreams with us</h2>
                <p>Access premium tools, materials, and expert guidance for all your construction and home improvement needs.</p>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="form-panel">
            <div class="form-container">
                <div class="form-header">
                    <h1>Login to Continue</h1>
                    <p>Welcome back! Please enter your credentials to access your account.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="form-group">
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-input @error('email') is-invalid @enderror"
                               placeholder="Enter Email"
                               autocomplete="off"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-input @error('password') is-invalid @enderror"
                               placeholder="Enter Password"
                               autocomplete="off"
                               required>
                    </div>

                    <div class="form-row">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Remember Me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="forgot-link">Recover Password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <button type="button" class="btn btn-google" onclick="alert('Google Sign-in coming soon!')">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Sign in with Google
                    </button>
                </form>

                <div class="signup-link">
                    Don't have an account yet? <a href="{{ route('register') }}">Signup!</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
