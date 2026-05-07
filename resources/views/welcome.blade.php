<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmGrid - Smart Agricultural Electricity Distribution</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            color: #f1f5f9;
            line-height: 1.6;
        }

        /* Navbar Styling */
        nav {
            background: rgba(15, 23, 42, 0.75) !important;
            backdrop-filter: blur(10px) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1) !important;
        }

        nav a {
            color: #e2e8f0 !important;
        }

        nav a:hover {
            color: #38BDF8 !important;
        }

        nav .text-gray-700 {
            color: #e2e8f0 !important;
        }

        /* Hero Gradient */
        .hero-gradient {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15) 0%, rgba(16, 185, 129, 0.1) 50%, rgba(15, 23, 42, 0.3) 100%),
                linear-gradient(to bottom, #0f172a 0%, #1a2f50 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
        }

        .hero-gradient::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
        }

        /* Hero Grid Alignment */
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
        }

        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }

        /* Feature Cards Animation */
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(10px);
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.27);
            color: #f1f5f9;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.1), transparent);
            transition: left 0.5s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
            box-shadow: 0 20px 50px rgba(37, 99, 235, 0.3);
        }

        .feature-card h4 {
            color: #f1f5f9 !important;
        }

        .feature-card p {
            color: #cbd5e1 !important;
        }

        .feature-card-icon {
            font-size: 3.5rem;
            margin-bottom: 16px;
            transition: transform 0.3s ease;
            display: block;
            text-align: center;
        }

        .feature-card:hover .feature-card-icon {
            transform: scale(1.15) rotate(5deg);
        }

        /* Stats Counter Animation */
        .stat-box {
            text-align: center;
            padding: 40px 24px;
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.27);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            color: #f1f5f9;
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #38BDF8, #10B981);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .stat-box:hover::before {
            transform: scaleX(1);
        }

        .stat-box:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.3);
        }

        .stat-number {
            font-size: 2.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-box p {
            color: #cbd5e1 !important;
        }

        /* Role Cards */
        .role-card {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            padding: 32px;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.27);
        }

        .role-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: translate(50%, -50%);
            transition: transform 0.4s ease;
        }

        .role-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
            box-shadow: 0 20px 50px rgba(37, 99, 235, 0.3);
        }

        .role-card:hover::after {
            transform: translate(30%, -30%);
        }

        .role-card-content {
            position: relative;
            z-index: 2;
        }

        .role-card h4 {
            color: #f1f5f9 !important;
        }

        .role-card li {
            color: #cbd5e1 !important;
        }

        /* CTA Button Animations */
        .btn-primary {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #38BDF8 0%, #2563EB 100%) !important;
            color: white;
            text-decoration: none;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: none !important;
            cursor: pointer;
            font-size: 1rem;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(56, 189, 248, 0.5);
            color: white !important;
        }

        .btn-secondary {
            display: inline-block;
            padding: 14px 32px;
            background: rgba(255, 255, 255, 0.1) !important;
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            cursor: pointer;
            font-size: 1rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.27);
            margin-left: 12px;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.4);
            color: #e2e8f0 !important;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .section-title p {
            font-size: 1.25rem;
            color: #cbd5e1;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 28px;
        }

        /* Button Group Alignment */
        .button-group {
            display: flex;
            flex-direction: row;
            gap: 12px;
            align-items: center;
            justify-content: center;
        }

        /* Hero Emoji Section */
        .hero-emoji-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 24px;
            text-align: center;
        }

        .emoji-container {
            position: relative;
            display: inline-block;
        }

        .emoji-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.3), transparent 70%);
            border-radius: 50%;
            filter: blur(20px);
        }

        /* Background adjustments */
        body {
            background: linear-gradient(to br, #0f172a 0%, #1a2f50 50%, #0f172a 100%) !important;
            background-attachment: fixed !important;
        }

        body.bg-white {
            background: linear-gradient(to br, #0f172a 0%, #1a2f50 50%, #0f172a 100%) !important;
        }

        /* Stats Section Background */
        .py-24 {
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.5), rgba(15, 23, 42, 0.8)) !important;
        }

        /* Features Section Background */
        .py-28.bg-white {
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.7)) !important;
        }

        /* Roles Section Background */
        .py-28.bg-gradient-to-b {
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.5), rgba(15, 23, 42, 0.8)) !important;
        }

        /* CTA Section */
        .bg-gradient-to-r.from-green-600 {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.8) 0%, rgba(16, 185, 129, 0.6) 100%) !important;
        }

        /* Footer */
        .bg-gray-950 {
            background: rgba(15, 23, 42, 0.9) !important;
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .text-gray-400 {
            color: #cbd5e1 !important;
        }

        .text-gray-500 {
            color: #94a3b8 !important;
        }

        /* Accessibility */
        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .btn-secondary {
                margin-left: 0;
            }

            .stat-number {
                font-size: 2rem;
            }

            .hero-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="flex items-center space-x-2 hover:opacity-80 transition group">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition">
                        <span class="text-white text-lg font-bold">⚡</span>
                    </div>
                    <h1
                        class="text-2xl font-800 bg-gradient-to-r from-cyan-400 to-emerald-400 bg-clip-text text-transparent">
                        FarmGrid</h1>
                </a>
                <div class="flex gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-slate-300 hover:text-cyan-400 transition font-semibold">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-slate-300 hover:text-red-400 transition font-semibold">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-slate-300 hover:text-cyan-400 transition font-semibold px-4 py-2">Log In</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:shadow-lg hover:shadow-blue-500/30 transition font-semibold">Sign
                            Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient text-white pt-36 pb-28 mt-16 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="hero-grid">
                <div class="space-y-8">
                    <div>
                        <span
                            class="inline-block px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-emerald-500/20 backdrop-blur border border-cyan-400/30 rounded-full text-cyan-100 font-semibold text-sm mb-6">
                            🚀 Smart Agriculture Solution
                        </span>
                        <h2 class="text-5xl md:text-6xl font-800 mb-6 leading-tight text-white">Smart Agricultural
                            Electricity
                            Distribution</h2>
                        <p class="text-lg text-slate-200 leading-relaxed max-w-lg">FarmGrid revolutionizes agricultural
                            power management with intelligent zone-wise electricity scheduling, real-time monitoring,
                            and complaint resolution for sustainable farming.</p>
                    </div>
                    <div class="button-group sm:justify-start">
                        @guest
                            <a href="{{ route('login') }}" class="btn-primary">🔓 Login Now</a>
                            <a href="{{ route('register') }}" class="btn-secondary">✨ Get Started Free</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="btn-primary">📊 Go to Dashboard</a>
                        @endguest
                    </div>
                </div>
                <div class="hero-emoji-section">
                    <div class="emoji-container">
                        <div class="emoji-glow"></div>
                        <div class="text-9xl animate-bounce relative z-10">⚡</div>
                    </div>
                    <div class="text-8xl">🌾</div>
                    <p class="text-2xl font-bold text-slate-200">Efficient Power for Better Farming</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="stat-box">
                    <div class="stat-number">500+</div>
                    <p class="mt-3 font-medium">Farmers Connected</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">24/7</div>
                    <p class="mt-3 font-medium">System Monitoring</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">15+</div>
                    <p class="mt-3 font-medium">Districts Covered</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">99%</div>
                    <p class="mt-3 font-medium">Uptime Guarantee</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>Powerful Features</h2>
                <p>Everything you need to manage agricultural electricity efficiently</p>
            </div>

            <div class="feature-grid">
                <div class="feature-card p-8 rounded-2xl">
                    <div class="feature-card-icon">📊</div>
                    <h4 class="text-xl font-bold mb-3">Smart Scheduling</h4>
                    <p class="leading-relaxed">Zone-wise electricity allocation with automated scheduling
                        to prevent overloading and ensure fair distribution.</p>
                </div>

                <div class="feature-card p-8 rounded-2xl">
                    <div class="feature-card-icon">👨‍🌾</div>
                    <h4 class="text-xl font-bold mb-3">Farmer Portal</h4>
                    <p class="leading-relaxed">Easy application management, schedule viewing, and
                        real-time connection status updates at your fingertips.</p>
                </div>

                <div class="feature-card p-8 rounded-2xl">
                    <div class="feature-card-icon">⚙️</div>
                    <h4 class="text-xl font-bold mb-3">Fast Resolution</h4>
                    <p class="leading-relaxed">Quick complaint filing and tracking with admin response
                        system for electricity issues.</p>
                </div>

                <div class="feature-card p-8 rounded-2xl">
                    <div class="feature-card-icon">📈</div>
                    <h4 class="text-xl font-bold mb-3">Usage Analytics</h4>
                    <p class="leading-relaxed">Real-time power consumption monitoring, billing details,
                        and usage history at a glance.</p>
                </div>

                <div class="feature-card p-8 rounded-2xl">
                    <div class="feature-card-icon">🔐</div>
                    <h4 class="text-xl font-bold mb-3">Secure Access</h4>
                    <p class="leading-relaxed">Role-based dashboards for Farmers, Admins, and Government
                        with enterprise-grade security.</p>
                </div>

                <div class="feature-card p-8 rounded-2xl">
                    <div class="feature-card-icon">📱</div>
                    <h4 class="text-xl font-bold mb-3">Responsive Design</h4>
                    <p class="leading-relaxed">Fully responsive interface works seamlessly on desktop,
                        tablet, and mobile devices.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Roles Section -->
    <div class="py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>Built for Everyone</h2>
                <p>Tailored features for each user role</p>
            </div>

            <div class="role-grid">
                <!-- Farmer Card -->
                <div class="role-card">
                    <div class="role-card-content">
                        <h4 class="text-2xl font-bold mb-8">👨‍🌾 Farmers</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-emerald-500/30 border border-emerald-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-emerald-400">✓</span>
                                Apply for connections
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-emerald-500/30 border border-emerald-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-emerald-400">✓</span>
                                View electricity schedules
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-emerald-500/30 border border-emerald-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-emerald-400">✓</span>
                                File & track complaints
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-emerald-500/30 border border-emerald-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-emerald-400">✓</span>
                                Monitor power usage
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-emerald-500/30 border border-emerald-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-emerald-400">✓</span>
                                View billing info
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Admin Card -->
                <div class="role-card">
                    <div class="role-card-content">
                        <h4 class="text-2xl font-bold mb-8">⚙️ Admins</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-500/30 border border-blue-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-blue-400">✓</span>
                                Manage applications
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-500/30 border border-blue-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-blue-400">✓</span>
                                Create schedules
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-500/30 border border-blue-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-blue-400">✓</span>
                                Resolve complaints
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-500/30 border border-blue-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-blue-400">✓</span>
                                Generate reports
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-500/30 border border-blue-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-blue-400">✓</span>
                                Monitor all systems
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Government Card -->
                <div class="role-card">
                    <div class="role-card-content">
                        <h4 class="text-2xl font-bold mb-8">🏛️ Government</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-500/30 border border-purple-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-purple-400">✓</span>
                                View reports
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-500/30 border border-purple-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-purple-400">✓</span>
                                Monitor distribution
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-500/30 border border-purple-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-purple-400">✓</span>
                                Audit complaints
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-500/30 border border-purple-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-purple-400">✓</span>
                                Policy oversight
                            </li>
                            <li class="flex items-center font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-500/30 border border-purple-500 rounded-full flex items-center justify-center mr-3 text-sm font-bold text-purple-400">✓</span>
                                System analytics
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-emerald-600/10 to-blue-600/10 backdrop-blur">
        </div>
        <div class="absolute inset-0">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
            <h3 class="text-5xl md:text-6xl font-800 mb-8 leading-tight">Transform Your Farm Today</h3>
            <p class="text-xl mb-12 text-slate-300 max-w-2xl mx-auto">Join thousands of farmers benefiting from
                intelligent electricity management. Experience real-time monitoring, fair distribution, and seamless
                complaint resolution.</p>
            <div class="button-group">
                @guest
                    <a href="{{ route('register') }}" class="btn-primary">🚀 Start Free Now</a>
                    <a href="{{ route('login') }}" class="btn-secondary">Already a Member? Login</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn-primary">📊 Open Dashboard</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-16 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                            <span class="text-white text-lg font-bold">⚡</span>
                        </div>
                        <span class="font-bold text-white text-lg">FarmGrid</span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">Smart Agricultural Electricity Distribution System
                        for sustainable farming solutions.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Product</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Scheduling</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Complaints</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Analytics</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Company</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">About Us</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Contact</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Legal</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Terms & Conditions</a>
                        </li>
                        <li><a href="#" class="text-slate-400 hover:text-cyan-400 transition">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-sm text-slate-400">© 2026 FarmGrid. All rights reserved. Built with ❤️ for farmers.</p>
                <div class="flex space-x-8 text-sm">
                    <a href="#" class="text-slate-400 hover:text-cyan-400 transition">Facebook</a>
                    <a href="#" class="text-slate-400 hover:text-cyan-400 transition">Twitter</a>
                    <a href="#" class="text-slate-400 hover:text-cyan-400 transition">LinkedIn</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = `fadeInUp 0.6s ease forwards`;
                    entry.target.style.animationDelay = `${index * 0.1}s`;
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .stat-box, .role-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>