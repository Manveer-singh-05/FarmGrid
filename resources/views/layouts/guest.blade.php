<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FarmGrid - Smart Agricultural Electricity Distribution</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Glassmorphic Theme */
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1a2f50 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            color: #f1f5f9;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(56, 189, 248, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            top: -40%;
            right: 10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
        }

        .auth-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1200px;
            width: 100%;
            align-items: center;
        }

        /* Left Branding Section */
        .auth-branding {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .auth-logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeInUp 0.8s ease-out;
        }

        .auth-logo-box {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.2) 0%, rgba(34, 197, 94, 0.2) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.4);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 8px 32px rgba(56, 189, 248, 0.15);
        }

        .auth-logo-text {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-heading {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.5px;
            animation: fadeInUp 0.8s ease-out 0.1s both;
        }

        .auth-heading-gradient {
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            font-size: 1.1rem;
            color: #cbd5e1;
            line-height: 1.6;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .auth-features {
            display: flex;
            flex-direction: column;
            gap: 20px;
            animation: fadeInUp 0.8s ease-out 0.3s both;
        }

        .feature-item {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(56, 189, 248, 0.1);
            border: 1px solid rgba(56, 189, 248, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 0 15px rgba(34, 197, 94, 0.1);
        }

        .feature-text {
            display: flex;
            flex-direction: column;
        }

        .feature-text-title {
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 2px;
        }

        .feature-text-description {
            font-size: 0.9rem;
            color: #cbd5e1;
        }

        /* Right Auth Card */
        .auth-card {
            background: rgba(20, 35, 60, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.25);
            border-radius: 32px;
            padding: 48px;
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.15),
                0 25px 80px rgba(37, 99, 235, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.8s ease-out 0.2s both;
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        .auth-card-content {
            position: relative;
            z-index: 1;
        }

        .auth-card-title {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 12px;
            color: #f1f5f9;
        }

        .auth-card-subtitle {
            font-size: 0.95rem;
            color: #cbd5e1;
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group:last-of-type {
            margin-bottom: 28px;
        }

        /* Input Styling */
        .glassmorphic-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(56, 189, 248, 0.25);
            border-radius: 14px;
            color: #fff;
            padding: 14px 18px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
        }

        .glassmorphic-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .glassmorphic-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(34, 197, 94, 0.6);
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.25);
        }

        .glassmorphic-input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px rgba(255, 255, 255, 0.08) inset !important;
            -webkit-text-fill-color: #fff !important;
            caret-color: #fff;
        }

        /* Label Styling */
        .glassmorphic-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        /* Button Styling */
        .glassmorphic-button {
            width: 100%;
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            color: white;
            font-weight: 700;
            padding: 14px 24px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.25);
            font-size: 1rem;
        }

        .glassmorphic-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(34, 197, 94, 0.35);
            background: linear-gradient(135deg, #06b6d4 0%, #10b981 100%);
        }

        .glassmorphic-button:active {
            transform: translateY(0);
        }

        /* Link Styling */
        .glassmorphic-link {
            color: rgba(56, 189, 248, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .glassmorphic-link:hover {
            color: #38BDF8;
            text-shadow: 0 0 12px rgba(56, 189, 248, 0.4);
        }

        /* Checkbox Styling */
        .glassmorphic-checkbox {
            accent-color: #10b981;
            cursor: pointer;
            width: 18px;
            height: 18px;
        }

        /* Error Message */
        .glassmorphic-error {
            color: #fca5a5;
            font-size: 0.8rem;
            margin-top: 6px;
            display: block;
        }

        /* Remember & Forgot Section */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .remember-section {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-section label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }

        /* Bottom Link Section */
        .form-link-section {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid rgba(56, 189, 248, 0.15);
        }

        .form-link-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .form-link-text .glassmorphic-link {
            margin-left: 6px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .auth-wrapper {
                gap: 40px;
            }

            .auth-heading {
                font-size: 2rem;
            }

            .auth-card {
                padding: 36px;
            }
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .auth-branding {
                gap: 24px;
            }

            .auth-heading {
                font-size: 1.75rem;
            }

            .auth-card {
                padding: 32px;
            }

            .form-footer {
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 16px;
            }

            .auth-wrapper {
                gap: 24px;
            }

            .auth-heading {
                font-size: 1.5rem;
            }

            .auth-subtitle {
                font-size: 1rem;
            }

            .auth-card {
                padding: 24px;
            }

            .auth-card-title {
                font-size: 1.5rem;
            }

            .form-group {
                margin-bottom: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-wrapper">
            <!-- Left Branding Section -->
            <div class="auth-branding">
                <div class="auth-logo-section">
                    <div class="auth-logo-box">⚡</div>
                    <div class="auth-logo-text">FarmGrid</div>
                </div>

                <div>
                    <h1 class="auth-heading">
                        Power Smart
                        <span class="auth-heading-gradient">Agriculture</span>
                    </h1>
                </div>

                <p class="auth-subtitle">
                    FarmGrid revolutionizes agricultural electricity management with intelligent zone-wise scheduling,
                    real-time monitoring, and complaint resolution for sustainable farming.
                </p>

                <div class="auth-features">
                    <div class="feature-item">
                        <div class="feature-icon">📊</div>
                        <div class="feature-text">
                            <div class="feature-text-title">Real-time Monitoring</div>
                            <div class="feature-text-description">Monitor electricity usage and status instantly</div>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">⚡</div>
                        <div class="feature-text">
                            <div class="feature-text-title">Smart Distribution</div>
                            <div class="feature-text-description">Zone-wise allocation with automated scheduling</div>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">🤖</div>
                        <div class="feature-text">
                            <div class="feature-text-title">AI Analytics</div>
                            <div class="feature-text-description">AI-powered insights and predictions</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Auth Card -->
            <div class="auth-card">
                <div class="auth-card-content">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>