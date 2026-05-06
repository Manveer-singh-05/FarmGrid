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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        /* Hero Gradient */
        .hero-gradient {
            background: linear-gradient(135deg, #0f7938 0%, #065f46 50%, #0d3e2c 100%);
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
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            blur: 50px;
        }

        /* Feature Cards Animation */
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: white;
            border: 1px solid #e5e7eb;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            border-color: #10b981;
        }

        .feature-card-icon {
            font-size: 3.5rem;
            margin-bottom: 16px;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-card-icon {
            transform: scale(1.15) rotate(5deg);
        }

        /* Stats Counter Animation */
        .stat-box {
            text-align: center;
            padding: 40px 24px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #059669);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .stat-box:hover::before {
            transform: scaleX(1);
        }

        .stat-box:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.2);
        }

        .stat-number {
            font-size: 2.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Role Cards */
        .role-card {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            padding: 32px;
        }

        .role-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
            transition: transform 0.4s ease;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .role-card:hover::after {
            transform: translate(30%, -30%);
        }

        .role-card-content {
            position: relative;
            z-index: 2;
        }

        /* CTA Button Animations */
        .btn-primary {
            display: inline-block;
            padding: 14px 32px;
            background: white;
            color: #0f7938;
            text-decoration: none;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 2px solid white;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background: #f0f9ff;
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            display: inline-block;
            padding: 14px 32px;
            background: transparent;
            color: white;
            text-decoration: none;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 2px solid white;
            cursor: pointer;
            font-size: 1rem;
            margin-left: 12px;
        }

        .btn-secondary:hover {
            background: white;
            color: #0f7938;
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
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
            color: #1f2937;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .section-title p {
            font-size: 1.25rem;
            color: #6b7280;
            max-width: 500px;
            margin: 0 auto;
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

        /* Accessibility */
        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .btn-secondary {
                margin-left: 0;
                margin-top: 10px;
                display: block;
            }

            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body class="bg-white">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="flex items-center space-x-2 hover:opacity-80 transition">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-700 rounded-lg flex items-center justify-center shadow-lg">
                        <span class="text-white text-lg font-bold">⚡</span>
                    </div>
                    <h1 class="text-2xl font-800 text-gray-900">FarmGrid</h1>
                </a>
                <div class="flex gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-gray-700 hover:text-green-600 transition font-semibold">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-gray-700 hover:text-red-600 transition font-semibold">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-gray-900 transition font-semibold px-4 py-2">Log In</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold shadow-md">Sign
                            Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient text-white pt-36 pb-28 mt-16 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div>
                        <span
                            class="inline-block px-4 py-2 bg-green-500 bg-opacity-20 rounded-full text-green-100 font-semibold text-sm mb-6">
                            🚀 Smart Agriculture Solution
                        </span>
                        <h2 class="text-5xl md:text-6xl font-800 mb-6 leading-tight">Smart Agricultural Electricity
                            Distribution</h2>
                        <p class="text-lg text-green-50 leading-relaxed max-w-lg">FarmGrid revolutionizes agricultural
                            power management with intelligent zone-wise electricity scheduling, real-time monitoring,
                            and complaint resolution for sustainable farming.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        @guest
                            <a href="{{ route('login') }}" class="btn-primary text-center">🔓 Login Now</a>
                            <a href="{{ route('register') }}" class="btn-secondary text-center">✨ Get Started Free</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="btn-primary text-center">📊 Go to Dashboard</a>
                        @endguest
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center space-y-8">
                    <div class="relative">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-green-400 to-green-600 opacity-20 blur-xl rounded-full">
                        </div>
                        <div class="text-9xl animate-bounce relative">⚡</div>
                    </div>
                    <div class="text-8xl">🌾</div>
                    <p class="text-2xl font-bold text-green-50 text-center">Efficient Power for Better Farming</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="stat-box">
                    <div class="stat-number">500+</div>
                    <p class="text-gray-600 mt-3 font-medium">Farmers Connected</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">24/7</div>
                    <p class="text-gray-600 mt-3 font-medium">System Monitoring</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">15+</div>
                    <p class="text-gray-600 mt-3 font-medium">Districts Covered</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">99%</div>
                    <p class="text-gray-600 mt-3 font-medium">Uptime Guarantee</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>Powerful Features</h2>
                <p>Everything you need to manage agricultural electricity efficiently</p>
            </div>

            <div class="feature-grid">
                <div class="feature-card p-8 rounded-16 shadow-sm hover:shadow-xl">
                    <div class="feature-card-icon">📊</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Smart Scheduling</h4>
                    <p class="text-gray-700 leading-relaxed">Zone-wise electricity allocation with automated scheduling
                        to prevent overloading and ensure fair distribution.</p>
                </div>

                <div class="feature-card p-8 rounded-16 shadow-sm hover:shadow-xl">
                    <div class="feature-card-icon">👨‍🌾</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Farmer Portal</h4>
                    <p class="text-gray-700 leading-relaxed">Easy application management, schedule viewing, and
                        real-time connection status updates at your fingertips.</p>
                </div>

                <div class="feature-card p-8 rounded-16 shadow-sm hover:shadow-xl">
                    <div class="feature-card-icon">⚙️</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Fast Resolution</h4>
                    <p class="text-gray-700 leading-relaxed">Quick complaint filing and tracking with admin response
                        system for electricity issues.</p>
                </div>

                <div class="feature-card p-8 rounded-16 shadow-sm hover:shadow-xl">
                    <div class="feature-card-icon">📈</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Usage Analytics</h4>
                    <p class="text-gray-700 leading-relaxed">Real-time power consumption monitoring, billing details,
                        and usage history at a glance.</p>
                </div>

                <div class="feature-card p-8 rounded-16 shadow-sm hover:shadow-xl">
                    <div class="feature-card-icon">🔐</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Secure Access</h4>
                    <p class="text-gray-700 leading-relaxed">Role-based dashboards for Farmers, Admins, and Government
                        with enterprise-grade security.</p>
                </div>

                <div class="feature-card p-8 rounded-16 shadow-sm hover:shadow-xl">
                    <div class="feature-card-icon">📱</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Responsive Design</h4>
                    <p class="text-gray-700 leading-relaxed">Fully responsive interface works seamlessly on desktop,
                        tablet, and mobile devices.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Roles Section -->
    <div class="py-28 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-title">
                <h2>Built for Everyone</h2>
                <p>Tailored features for each user role</p>
            </div>

            <div class="role-grid">
                <!-- Farmer Card -->
                <div class="role-card bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-200">
                    <div class="role-card-content">
                        <h4 class="text-2xl font-bold text-green-800 mb-8">👨‍🌾 Farmers</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Apply for connections
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                View electricity schedules
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                File & track complaints
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Monitor power usage
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                View billing info
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Admin Card -->
                <div class="role-card bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200">
                    <div class="role-card-content">
                        <h4 class="text-2xl font-bold text-blue-800 mb-8">⚙️ Admins</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Manage applications
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Create schedules
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Resolve complaints
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Generate reports
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Monitor all systems
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Government Card -->
                <div class="role-card bg-gradient-to-br from-purple-50 to-purple-100 border-2 border-purple-200">
                    <div class="role-card-content">
                        <h4 class="text-2xl font-bold text-purple-800 mb-8">🏛️ Government</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                View reports
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Monitor distribution
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Audit complaints
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                Policy oversight
                            </li>
                            <li class="flex items-center text-gray-800 font-medium">
                                <span
                                    class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">✓</span>
                                System analytics
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-32 bg-gradient-to-r from-green-600 via-green-700 to-green-800 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-80 h-80 bg-white rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
            <h3 class="text-5xl md:text-6xl font-800 mb-8 leading-tight">Transform Your Farm Today</h3>
            <p class="text-xl mb-12 text-green-50 max-w-2xl mx-auto">Join thousands of farmers benefiting from
                intelligent electricity management. Experience real-time monitoring, fair distribution, and seamless
                complaint resolution.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
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
    <footer class="bg-gray-950 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-700 rounded-lg flex items-center justify-center">
                            <span class="text-white text-lg font-bold">⚡</span>
                        </div>
                        <span class="font-bold text-white text-lg">FarmGrid</span>
                    </div>
                    <p class="text-sm text-gray-500 leading-relaxed">Smart Agricultural Electricity Distribution System
                        for sustainable farming solutions.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Product</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition">Scheduling</a></li>
                        <li><a href="#" class="hover:text-white transition">Complaints</a></li>
                        <li><a href="#" class="hover:text-white transition">Analytics</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Company</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-6">Legal</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-white transition">Security</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-500">© 2026 FarmGrid. All rights reserved. Built with ❤️ for farmers.</p>
                <div class="flex space-x-8 text-sm mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Facebook</a>
                    <a href="#" class="hover:text-white transition">Twitter</a>
                    <a href="#" class="hover:text-white transition">LinkedIn</a>
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
</div>
</div>
</div>
</div>

<!-- CTA Section -->
<div class="py-20 bg-gradient-to-r from-green-600 to-green-700 text-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h3 class="text-5xl font-bold mb-6">Transform Your Farm Today</h3>
        <p class="text-xl mb-10 text-green-50">Join thousands of farmers benefiting from intelligent electricity
            management</p>
        <div>
            @guest
                <a href="{{ route('register') }}" class="btn-primary" style="color: #1e40af; margin-right: 15px;">🚀
                    Start Free Now</a>
                <a href="{{ route('login') }}" class="btn-secondary"
                    style="background: white; color: #10b981; margin-left: 0;">Already a Member? Login</a>
            @else
                <a href="{{ url('/dashboard') }}" class="btn-primary" style="color: #1e40af;">📊 Open Dashboard</a>
            @endguest
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-green-600 rounded flex items-center justify-center">
                        <span class="text-white">⚡</span>
                    </div>
                    <span class="font-bold text-white">FarmGrid</span>
                </div>
                <p class="text-sm">Smart Agricultural Electricity Distribution System</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Features</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Scheduling</a></li>
                    <li><a href="#" class="hover:text-white transition">Complaints</a></li>
                    <li><a href="#" class="hover:text-white transition">Analytics</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">About</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    <li><a href="#" class="hover:text-white transition">Support</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Privacy</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms</a></li>
                    <li><a href="#" class="hover:text-white transition">Security</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-8 flex justify-between items-center">
            <p class="text-sm">© 2026 FarmGrid. All rights reserved.</p>
            <div class="flex space-x-6 text-sm">
                <a href="#" class="hover:text-white transition">Facebook</a>
                <a href="#" class="hover:text-white transition">Twitter</a>
                <a href="#" class="hover:text-white transition">LinkedIn</a>
            </div>
        </div>
    </div>
</footer>

<script>
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -100px 0px' };
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
            }
        });
    }, observerOptions);
    document.querySelectorAll('.feature-card, .stat-box').forEach(el => observer.observe(el));
</script>
</body>

</html>