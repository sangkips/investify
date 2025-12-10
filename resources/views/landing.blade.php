<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your trusted hardware store for all construction and home improvement needs. Quality tools, materials, and expert advice.">

    <title>Hardware Pro - Your Trusted Hardware Business Store</title>

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
            --bg-light: #f8fafc;
            --bg-gradient-start: #fef3e2;
            --bg-gradient-end: #e0e7ff;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 32px;
            background: var(--white);
            border-radius: 50px;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent) 0%, #fdba74 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 24px;
            height: 24px;
            fill: var(--white);
        }

        .nav-links {
            display: flex;
            gap: 40px;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline {
            background: transparent;
            color: var(--text-dark);
            border: 2px solid transparent;
        }

        .btn-outline:hover {
            background: var(--bg-light);
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

        .btn-accent {
            background: var(--accent);
            color: var(--white);
        }

        .btn-accent:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 20px 80px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            width: 100%;
        }

        .hero-text {
            max-width: 600px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(249, 115, 22, 0.1);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--accent);
            margin-bottom: 24px;
        }

        .hero-badge::before {
            content: '🔧';
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: var(--primary);
            line-height: 1.1;
            margin-bottom: 24px;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--accent) 0%, #fb923c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.125rem;
            color: var(--text-light);
            margin-bottom: 40px;
            max-width: 480px;
        }

        /* CTA Input Group */
        .cta-group {
            display: flex;
            align-items: center;
            background: var(--white);
            border-radius: 50px;
            padding: 8px;
            box-shadow: var(--shadow-xl);
            max-width: 480px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .cta-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            margin-left: 8px;
        }

        .cta-icon svg {
            width: 24px;
            height: 24px;
            fill: var(--text-light);
        }

        .cta-divider {
            width: 1px;
            height: 30px;
            background: #e2e8f0;
            margin: 0 12px;
        }

        .cta-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 12px;
            font-size: 1rem;
            color: var(--text-dark);
            background: transparent;
            font-family: inherit;
        }

        .cta-input::placeholder {
            color: var(--text-light);
        }

        .cta-button {
            padding: 14px 24px;
            background: var(--accent);
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
        }

        .cta-button:hover {
            background: var(--accent-hover);
            transform: scale(1.05);
        }

        .cta-button svg {
            width: 20px;
            height: 20px;
            fill: var(--white);
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            max-width: 550px;
        }

        .hero-image {
            width: 100%;
            height: auto;
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
        }

        /* Floating Elements */
        .floating-card {
            position: absolute;
            background: var(--white);
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: float 3s ease-in-out infinite;
        }

        .floating-card-1 {
            top: 10%;
            left: -30px;
            animation-delay: 0s;
        }

        .floating-card-2 {
            bottom: 20%;
            right: -40px;
            animation-delay: 1.5s;
        }

        .floating-card-3 {
            bottom: 5%;
            left: 10%;
            animation-delay: 0.8s;
        }

        .floating-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .floating-icon.tools {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }

        .floating-icon.quality {
            background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%);
        }

        .floating-icon.delivery {
            background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);
        }

        .floating-text h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .floating-text p {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Features Grid */
        .features {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .feature-card {
            background: var(--white);
            border-radius: 24px;
            padding: 40px 32px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 2.5rem;
        }

        .feature-icon.orange {
            background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
        }

        .feature-icon.blue {
            background: linear-gradient(135deg, #eff6ff 0%, #bfdbfe 100%);
        }

        .feature-icon.green {
            background: linear-gradient(135deg, #f0fdf4 0%, #bbf7d0 100%);
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .feature-card p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        /* Stats Section */
        .stats {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            background: var(--primary);
            border-radius: 24px;
            padding: 50px 40px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Footer */
        footer {
            padding: 60px 20px 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary);
            text-decoration: none;
        }

        .footer-links {
            display: flex;
            gap: 40px;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accent);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
        }

        .mobile-menu-btn span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--primary);
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        /* 3D Store Graphic - CSS Only */
        .store-graphic {
            position: relative;
            width: 100%;
            max-width: 450px;
            aspect-ratio: 1;
            margin: 0 auto;
        }

        .store-building {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            width: 280px;
            height: 320px;
            background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%);
            border-radius: 40px 40px 20px 20px;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.15),
                inset 0 2px 0 rgba(255, 255, 255, 0.8);
        }

        .store-awning {
            position: absolute;
            top: 180px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 50px;
            background: repeating-linear-gradient(
                90deg,
                var(--accent) 0px,
                var(--accent) 20px,
                #ffffff 20px,
                #ffffff 40px
            );
            border-radius: 0 0 100px 100px;
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
        }

        .store-window {
            position: absolute;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 140px;
            background: linear-gradient(145deg, #c084fc 0%, #a855f7 100%);
            border-radius: 60px 60px 20px 20px;
            box-shadow: inset 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .store-sign {
            position: absolute;
            top: 150px;
            right: -30px;
            background: linear-gradient(135deg, #ec4899 0%, #d946ef 100%);
            padding: 10px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.4);
            transform: rotate(-5deg);
        }

        .package-box {
            position: absolute;
            background: linear-gradient(145deg, #d4a574 0%, #bc8f5a 100%);
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .package-box::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-50%);
        }

        .package-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            bottom: 0;
            width: 2px;
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-50%);
        }

        .package-1 {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 5%;
            animation: float 4s ease-in-out infinite;
        }

        .package-2 {
            width: 60px;
            height: 60px;
            top: 25%;
            left: 20%;
            animation: float 3.5s ease-in-out infinite 0.5s;
        }

        .package-3 {
            width: 70px;
            height: 70px;
            top: 5%;
            right: 15%;
            animation: float 4.5s ease-in-out infinite 1s;
        }

        .coin {
            position: absolute;
            width: 60px;
            height: 60px;
            background: linear-gradient(145deg, #fbbf24 0%, #f59e0b 100%);
            border-radius: 50%;
            bottom: 10%;
            right: 10%;
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            font-weight: 700;
            animation: float 3s ease-in-out infinite 0.3s;
        }

        .bench {
            position: absolute;
            bottom: 15%;
            left: 15%;
            width: 60px;
            height: 40px;
            background: linear-gradient(to bottom, transparent 0%, transparent 40%, #94a3b8 40%, #94a3b8 50%, transparent 50%);
        }

        .bench::before,
        .bench::after {
            content: '';
            position: absolute;
            bottom: 0;
            width: 4px;
            height: 25px;
            background: #64748b;
        }

        .bench::before {
            left: 10px;
        }

        .bench::after {
            right: 10px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text {
                max-width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .hero-description {
                max-width: 100%;
            }

            .cta-group {
                max-width: 100%;
            }

            .hero-visual {
                order: -1;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 40px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 12px 20px;
            }

            .nav-links {
                display: none;
            }

            .nav-buttons {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero {
                padding: 100px 20px 60px;
            }

            .hero-title {
                font-size: 2.25rem;
            }

            .cta-group {
                flex-direction: column;
                padding: 16px;
                border-radius: 24px;
            }

            .cta-icon,
            .cta-divider {
                display: none;
            }

            .cta-input {
                width: 100%;
                text-align: center;
                padding: 16px;
            }

            .cta-button {
                width: 100%;
                padding: 16px;
                border-radius: 50px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .floating-card {
                display: none;
            }

            .footer-content {
                flex-direction: column;
                gap: 30px;
            }

            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="/" class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                </svg>
            </div>
            Hardware Pro
        </a>

        <ul class="nav-links">
            <li><a href="#about">About</a></li>
            <li><a href="#products">Products</a></li>
            <li><a href="#pricing">Pricing</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <div class="nav-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Start Selling</a>
                    @endif
                @endauth
            @endif
        </div>

        <button class="mobile-menu-btn" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-badge">Premium Hardware Solutions</span>
                <h1 class="hero-title">
                    Build your <span class="highlight">dream project</span> with us!
                </h1>
                <p class="hero-description">
                    With Hardware Pro, professionals and DIY enthusiasts can access top-quality tools and materials. 
                    Just search for what you need. It's that easy.
                </p>

                <div class="cta-group">
                    <div class="cta-icon">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                    </div>
                    <div class="cta-divider"></div>
                    <input type="text" class="cta-input" placeholder="Search for tools, materials...">
                    <button class="cta-button" aria-label="Search">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="hero-visual">
                <div class="store-graphic">
                    <!-- 3D Store Elements -->
                    <div class="package-box package-1"></div>
                    <div class="package-box package-2"></div>
                    <div class="package-box package-3"></div>
                    
                    <div class="store-building">
                        <div class="store-window"></div>
                        <div class="store-awning"></div>
                        <div class="store-sign">OPEN</div>
                    </div>
                    
                    <div class="bench"></div>
                    <div class="coin">$</div>

                    <!-- Floating Info Cards -->
                    <div class="floating-card floating-card-1">
                        <div class="floating-icon tools">🔨</div>
                        <div class="floating-text">
                            <h4>1000+ Tools</h4>
                            <p>In stock</p>
                        </div>
                    </div>

                    <div class="floating-card floating-card-2">
                        <div class="floating-icon quality">✓</div>
                        <div class="floating-text">
                            <h4>Premium Quality</h4>
                            <p>Guaranteed</p>
                        </div>
                    </div>

                    <div class="floating-card floating-card-3">
                        <div class="floating-icon delivery">🚚</div>
                        <div class="floating-text">
                            <h4>Fast Delivery</h4>
                            <p>Same day</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="about">
        <div class="section-header">
            <h2 class="section-title">Why Choose Hardware Pro?</h2>
            <p class="section-subtitle">We're committed to providing the best tools and materials for your construction and home improvement projects.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon orange">🛠️</div>
                <h3>Quality Products</h3>
                <p>We source only the finest tools and materials from trusted manufacturers worldwide.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon blue">💰</div>
                <h3>Competitive Pricing</h3>
                <p>Get the best value with our competitive prices and exclusive bulk discounts.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon green">🎯</div>
                <h3>Expert Support</h3>
                <p>Our knowledgeable team is ready to help you find exactly what you need.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Happy Customers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">5K+</div>
                <div class="stat-label">Products Available</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">15+</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Customer Support</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <a href="/" class="footer-logo">
                <div class="logo-icon" style="width: 32px; height: 32px;">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px; fill: white;">
                        <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                    </svg>
                </div>
                Hardware Pro
            </a>

            <div class="footer-links">
                <a href="#about">About Us</a>
                <a href="#products">Products</a>
                <a href="#pricing">Pricing</a>
                <a href="#contact">Contact</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Hardware Pro. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Simple mobile menu toggle
        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            const navButtons = document.querySelector('.nav-buttons');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
            navButtons.style.display = navButtons.style.display === 'flex' ? 'none' : 'flex';
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
