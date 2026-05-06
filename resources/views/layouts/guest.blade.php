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
        /* Glassmorphic Theme */
        body {
            background: linear-gradient(135deg, #0f7938 0%, #065f46 25%, #0d5f6f 50%, #0a4a5f 75%, #081f3f 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(15, 121, 56, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(10, 90, 95, 0.3) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .min-h-screen {
            position: relative;
            z-index: 1;
        }

        /* Glassmorphic Card */
        .glassmorphic-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border-radius: 24px;
        }

        /* Input Styling */
        .glassmorphic-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #fff;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .glassmorphic-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .glassmorphic-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(16, 185, 129, 0.6);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
        }

        .glassmorphic-input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px rgba(255, 255, 255, 0.1) inset !important;
            -webkit-text-fill-color: #fff !important;
        }

        /* Label Styling */
        .glassmorphic-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 0.95rem;
        }

        /* Button Styling */
        .glassmorphic-button {
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.3);
        }

        .glassmorphic-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
        }

        .glassmorphic-button:active {
            transform: translateY(0);
        }

        /* Link Styling */
        .glassmorphic-link {
            color: rgba(106, 210, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .glassmorphic-link:hover {
            color: #6ad2ff;
            text-decoration: underline;
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
            color: #fecaca;
            font-size: 0.875rem;
            margin-top: 6px;
        }

        /* Logo */
        .auth-logo {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Title and Subtitle */
        .auth-title {
            color: white;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 8px;
            text-align: center;
        }

        .auth-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            text-align: center;
            margin-bottom: 24px;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-8">
            <a href="/" class="auth-logo">
                <span class="text-3xl font-bold text-white">⚡</span>
            </a>
        </div>

        <div class="glassmorphic-card w-full sm:max-w-md mt-6 px-8 py-8">
            <div class="text-center mb-8">
                <h1 class="auth-title">FarmGrid</h1>
                <p class="auth-subtitle">Agricultural Electricity Distribution</p>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>