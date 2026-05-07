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
            background: rgba(15, 23, 42, 0.5) !important;
            backdrop-filter: blur(8px) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
        }

        nav a {
            color: #cbd5e1 !important;
        }

        nav a:hover {
            color: #38BDF8 !important;
        }

        nav .text-gray-700 {
            color: #cbd5e1 !important;
        }

        nav .h-16 {
            height: 72px !important;
        }

        /* Hero Gradient */
        .hero-gradient {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(37, 99, 235, 0.03) 50%, rgba(15, 23, 42, 0.5) 100%),
                linear-gradient(135deg, #0f172a 0%, #1a2f50 100%);
            color: white;
            position: relative;
            overflow: visible;
        }

        .hero-gradient::before {
            content: '';
            position: absolute;
            top: -40%;
            right: 10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        .hero-gradient::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        /* Hero Grid Alignment - Centered Layout */
        .hero-grid {
            display: flex;
            flex-direction: column;
            gap: 48px;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            z-index: 1;
            min-height: 100vh;
            padding-top: 120px;
            padding-bottom: 80px;
        }

        @media (max-width: 1024px) {
            .hero-grid {
                gap: 40px;
                min-height: auto;
                padding-top: 100px;
                padding-bottom: 60px;
            }
        }

        @media (max-width: 768px) {
            .hero-grid {
                padding-top: 80px;
                padding-bottom: 40px;
            }
        }

        /* Feature Cards Animation */
        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.07) !important;
            border: 1px solid rgba(56, 189, 248, 0.2) !important;
            backdrop-filter: blur(20px);
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.27),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
            border-radius: 20px;
            padding: 32px !important;
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
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .feature-card h4 {
            color: #f1f5f9 !important;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #cbd5e1 !important;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .feature-card-icon {
            font-size: 3.5rem;
            margin-bottom: 24px;
            transition: transform 0.3s ease;
            display: block;
            text-align: center;
            filter: drop-shadow(0 0 8px rgba(56, 189, 248, 0.2));
        }

        .feature-card:hover .feature-card-icon {
            transform: scale(1.15) rotate(5deg);
            filter: drop-shadow(0 0 16px rgba(56, 189, 248, 0.4));
        }

        /* Stats Counter Animation */
        .stat-box {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.07) !important;
            border: 1px solid rgba(56, 189, 248, 0.2) !important;
            backdrop-filter: blur(20px);
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.27),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
            border-radius: 20px;
            padding: 32px !important;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .stat-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.1), transparent);
            transition: left 0.5s;
        }

        .stat-box:hover::before {
            left: 100%;
        }

        .stat-box:hover {
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .stat-number {
            color: #f1f5f9 !important;
            font-size: 2.75rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .stat-box p {
            color: #cbd5e1 !important;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* Role Cards */
        .role-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            padding: 40px;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.07) !important;
            border: 1px solid rgba(56, 189, 248, 0.2) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.27),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
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
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
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
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 24px;
        }

        .role-card li {
            color: #cbd5e1 !important;
            font-size: 0.95rem;
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
            margin-bottom: 80px;
            animation: fadeInUp 0.8s ease-out;
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
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 32px;
            margin-bottom: 40px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 32px;
        }

        @media (max-width: 768px) {
            .feature-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 28px;
        }

        /* Stats Section Background */
        #stats {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(37, 99, 235, 0.03) 50%, rgba(15, 23, 42, 0.5) 100%),
                linear-gradient(135deg, #0f172a 0%, #1a2f50 100%);
            position: relative;
            overflow: hidden;
        }

        #stats::before {
            content: '';
            position: absolute;
            top: -40%;
            right: 10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        #stats::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        /* Roles Section Background */
        #roles {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(37, 99, 235, 0.03) 50%, rgba(15, 23, 42, 0.5) 100%),
                linear-gradient(135deg, #0f172a 0%, #1a2f50 100%);
            position: relative;
            overflow: hidden;
        }

        #roles::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.02) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        #roles::after {
            content: '';
            position: absolute;
            top: -40%;
            right: 5%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        /* Button Group Alignment */
        .button-group {
            display: flex;
            flex-direction: row;
            gap: 12px;
            align-items: center;
            justify-content: center;
        }

        /* CTA Section Enhancement */
        #contact {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(37, 99, 235, 0.03) 50%, rgba(15, 23, 42, 0.5) 100%),
                linear-gradient(135deg, #0f172a 0%, #1a2f50 100%);
            position: relative;
            overflow: hidden;
            border-top: 1px solid rgba(56, 189, 248, 0.1);
            border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        }

        #contact h3 {
            color: #f1f5f9;
        }

        /* Footer */
        footer {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(37, 99, 235, 0.03) 50%, rgba(15, 23, 42, 0.5) 100%),
                linear-gradient(135deg, #0f172a 0%, #1a2f50 100%);
            border-top: 1px solid rgba(56, 189, 248, 0.1);
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.02) 0%, transparent 100%);
            pointer-events: none;
            z-index: 0;
        }

        footer::after {
            content: '';
            position: absolute;
            top: -100px;
            right: -200px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        footer>* {
            position: relative;
            z-index: 1;
        }

        footer h4 {
            color: #f1f5f9 !important;
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        footer p {
            color: #cbd5e1 !important;
        }

        footer a {
            color: #cbd5e1;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #38BDF8, #10B981);
            transition: width 0.3s ease;
        }

        footer a:hover {
            color: #38BDF8;
        }

        footer a:hover::after {
            width: 100%;
        }

        footer .border-t {
            border-top-color: rgba(56, 189, 248, 0.1) !important;
        }

        /* Hero Content Container */
        .hero-content {
            max-width: 820px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease-out;
        }

        .hero-content h2 {
            font-size: 3.75rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 24px;
        }

        .hero-content>p {
            font-size: 1.25rem;
            color: #cbd5e1;
            line-height: 1.8;
            margin-bottom: 40px;
            max-width: 100%;
        }

        /* Dashboard Preview Card */
        .dashboard-preview {
            max-width: 900px;
            margin: 80px auto 0;
            position: relative;
            z-index: 2;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 80px rgba(37, 99, 235, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            animation: floatCard 3s ease-in-out infinite;
        }

        @keyframes floatCard {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(56, 189, 248, 0.4), transparent);
        }

        .dashboard-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 50%, rgba(56, 189, 248, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.08) 0%, transparent 50%);
            border-radius: 20px;
            pointer-events: none;
        }

        .dashboard-inner {
            position: relative;
            z-index: 2;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .dashboard-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #f1f5f9;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #94a3b8;
        }

        @media (max-width: 768px) {
            .dashboard-card {
                padding: 24px;
            }

            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .hero-content h2 {
                font-size: 2.5rem;
            }

            .hero-content>p {
                font-size: 1.125rem;
            }

            .dashboard-preview {
                margin-top: 60px;
            }
        }

        /* Background adjustments */
        body {
            background: linear-gradient(to br, #0f172a 0%, #1a2f50 50%, #0f172a 100%) !important;
            background-attachment: fixed !important;
        }

        body.bg-white {
            background: linear-gradient(to br, #0f172a 0%, #1a2f50 50%, #0f172a 100%) !important;
        }

        /* Features Section Background */
        #features {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(37, 99, 235, 0.03) 50%, rgba(15, 23, 42, 0.5) 100%),
                linear-gradient(135deg, #0f172a 0%, #1a2f50 100%);
            position: relative;
            overflow: hidden;
        }

        #features::before {
            content: '';
            position: absolute;
            top: -40%;
            right: 10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        #features::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
        }

        .py-28.bg-white {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(37, 99, 235, 0.03) 50%, rgba(15, 23, 42, 0.5) 100%),
                linear-gradient(135deg, #0f172a 0%, #1a2f50 100%) !important;
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
        /* Navigation Links */
        .nav-links {
            display: flex;
            gap: 48px;
            align-items: center;
            flex: 1;
            justify-content: center;
        }

        .nav-links a {
            position: relative;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #38BDF8, #10B981);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #38BDF8 !important;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a.active {
            color: #38BDF8 !important;
            text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);
        }

        .nav-links a.active::after {
            width: 100%;
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.4);
        }

        /* Mobile Menu */
        .mobile-menu-button {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: #e2e8f0;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .mobile-menu-button:hover {
            color: #38BDF8;
            transform: scale(1.1);
        }

        .mobile-menu {
            position: fixed;
            top: 72px;
            right: 0;
            width: 100%;
            max-width: 280px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-left: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: -8px 0 32px rgba(0, 0, 0, 0.3);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 40;
            max-height: calc(100vh - 72px);
            overflow-y: auto;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .mobile-menu-links {
            display: flex;
            flex-direction: column;
            gap: 0;
            padding: 24px 0;
        }

        .mobile-menu-links a {
            display: block;
            padding: 12px 24px;
            text-decoration: none;
            color: #e2e8f0;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .mobile-menu-links a:hover,
        .mobile-menu-links a.active {
            background: rgba(56, 189, 248, 0.1);
            color: #38BDF8;
            border-left-color: #38BDF8;
        }

        /* Navbar scroll enhancement */
        nav.scrolled {
            background: rgba(15, 23, 42, 0.95) !important;
            backdrop-filter: blur(16px) !important;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4) !important;
            border-bottom-color: rgba(56, 189, 248, 0.2) !important;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-button {
                display: block;
            }

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

        @media (min-width: 769px) {
            .mobile-menu {
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="#home" class="flex items-center space-x-2 hover:opacity-80 transition group">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition">
                        <span class="text-white text-lg font-bold">⚡</span>
                    </div>
                    <h1
                        class="text-2xl font-800 bg-gradient-to-r from-cyan-400 to-emerald-400 bg-clip-text text-transparent">
                        FarmGrid</h1>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="nav-links" id="navLinks">
                    <a href="#home" class="nav-link active" data-section="home">Home</a>
                    <a href="#features" class="nav-link" data-section="features">Features</a>
                    <a href="#stats" class="nav-link" data-section="stats">Statistics</a>
                    <a href="#roles" class="nav-link" data-section="roles">Roles</a>
                    <a href="#contact" class="nav-link" data-section="contact">Contact</a>
                </div>

                <!-- Auth Buttons & Mobile Menu Toggle -->
                <div class="flex gap-4 items-center">
                    <div class="hidden sm:flex gap-4">
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
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-button"
                        aria-label="Toggle menu">
                        <span x-show="!mobileMenuOpen">☰</span>
                        <span x-show="mobileMenuOpen">✕</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" :class="{ 'open': mobileMenuOpen }">
            <div class="mobile-menu-links">
                <a href="#home" class="mobile-nav-link active" data-section="home"
                    @click="mobileMenuOpen = false">Home</a>
                <a href="#features" class="mobile-nav-link" data-section="features"
                    @click="mobileMenuOpen = false">Features</a>
                <a href="#stats" class="mobile-nav-link" data-section="stats"
                    @click="mobileMenuOpen = false">Statistics</a>
                <a href="#roles" class="mobile-nav-link" data-section="roles" @click="mobileMenuOpen = false">Roles</a>
                <a href="#contact" class="mobile-nav-link" data-section="contact"
                    @click="mobileMenuOpen = false">Contact</a>
                <div class="border-t border-white/10 mt-4 pt-4 px-6 flex flex-col gap-3 sm:hidden">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-slate-300 hover:text-cyan-400 transition font-semibold">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-slate-300 hover:text-red-400 transition font-semibold w-full text-left">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-slate-300 hover:text-cyan-400 transition font-semibold">Log In</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:shadow-lg hover:shadow-blue-500/30 transition font-semibold text-center">Sign
                            Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient text-white relative">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="hero-grid">
                <div class="hero-content">
                    <span
                        class="inline-block px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-emerald-500/20 backdrop-blur border border-cyan-400/30 rounded-full text-cyan-100 font-semibold text-sm mb-8">
                        ⚡ AI Powered Agricultural Energy Platform
                    </span>
                    <h2 class="text-white">Smart Agricultural Electricity Distribution</h2>
                    <p>FarmGrid revolutionizes agricultural power management with intelligent zone-wise electricity
                        scheduling, real-time monitoring, and complaint resolution for sustainable farming.</p>
                    <div class="button-group">
                        @guest
                            <a href="{{ route('login') }}" class="btn-primary">Get Started Free</a>
                            <a href="{{ route('register') }}" class="btn-secondary">Login to Dashboard</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="btn-primary">Go to Dashboard</a>
                        @endguest
                    </div>
                </div>

                <!-- Dashboard Preview Card -->
                <div class="dashboard-preview">
                    <div class="dashboard-card">
                        <div class="dashboard-inner">
                            <div class="dashboard-header">
                                <div class="dashboard-title">System Overview</div>
                                <div style="font-size: 1.5rem;">📊</div>
                            </div>
                            <div class="dashboard-stats">
                                <div class="stat-item">
                                    <div class="stat-value">500+</div>
                                    <div class="stat-label">Farmers Active</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">24/7</div>
                                    <div class="stat-label">Monitoring</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">99%</div>
                                    <div class="stat-label">Uptime</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="py-28 relative overflow-hidden">
        <div
            class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-600/5 to-transparent pointer-events-none z-0">
        </div>
        <div class="absolute -left-96 top-1/4 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute -right-96 bottom-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl z-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-number">500+</div>
                    <p>Farmers Connected</p>
                </div>

                <div class="stat-box">
                    <div class="stat-number">24/7</div>
                    <p>System Monitoring</p>
                </div>

                <div class="stat-box">
                    <div class="stat-number">15+</div>
                    <p>Districts Covered</p>
                </div>

                <div class="stat-box">
                    <div class="stat-number">99%</div>
                    <p>Uptime Guarantee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-28 relative overflow-hidden">
        <div
            class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-600/5 to-transparent pointer-events-none z-0">
        </div>
        <div class="absolute -left-96 top-1/4 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute -right-96 bottom-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl z-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="section-title">
                <h2>Powerful Features</h2>
                <p>Everything you need to manage agricultural electricity efficiently</p>
            </div>

            <div class="feature-grid">
                <div class="feature-card p-8">
                    <div class="feature-card-icon">📊</div>
                    <h4 class="text-xl font-bold mb-3">Smart Scheduling</h4>
                    <p class="leading-relaxed">Zone-wise electricity allocation with automated scheduling
                        to prevent overloading and ensure fair distribution.</p>
                </div>

                <div class="feature-card p-8">
                    <div class="feature-card-icon">👨‍🌾</div>
                    <h4 class="text-xl font-bold mb-3">Farmer Portal</h4>
                    <p class="leading-relaxed">Easy application management, schedule viewing, and
                        real-time connection status updates at your fingertips.</p>
                </div>

                <div class="feature-card p-8">
                    <div class="feature-card-icon">⚙️</div>
                    <h4 class="text-xl font-bold mb-3">Fast Resolution</h4>
                    <p class="leading-relaxed">Quick complaint filing and tracking with admin response
                        system for electricity issues.</p>
                </div>

                <div class="feature-card p-8">
                    <div class="feature-card-icon">📈</div>
                    <h4 class="text-xl font-bold mb-3">Usage Analytics</h4>
                    <p class="leading-relaxed">Real-time power consumption monitoring, billing details,
                        and usage history at a glance.</p>
                </div>

                <div class="feature-card p-8">
                    <div class="feature-card-icon">🔐</div>
                    <h4 class="text-xl font-bold mb-3">Secure Access</h4>
                    <p class="leading-relaxed">Role-based dashboards for Farmers, Admins, and Government
                        with enterprise-grade security.</p>
                </div>

                <div class="feature-card p-8">
                    <div class="feature-card-icon">📱</div>
                    <h4 class="text-xl font-bold mb-3">Responsive Design</h4>
                    <p class="leading-relaxed">Fully responsive interface works seamlessly on desktop,
                        tablet, and mobile devices.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section id="roles" class="py-28 relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none z-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
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
    </section>

    <!-- CTA Section -->
    <div id="contact" class="py-32 relative overflow-hidden">
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
        // Animation Observer
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

        // Smooth Scroll Navigation
        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
            const navBar = document.querySelector('nav');
            const sections = document.querySelectorAll('section, [id]');

            // Smooth scroll on link click
            navLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sectionId = this.getAttribute('href').substring(1);
                    const section = document.getElementById(sectionId);
                    if (section) {
                        section.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            // Update active nav link on scroll
            function updateActiveNav() {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= sectionTop - 100) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-section') === current) {
                        link.classList.add('active');
                    }
                });
            }

            // Navbar scroll effect
            function updateNavbarOnScroll() {
                if (window.pageYOffset > 10) {
                    navBar.classList.add('scrolled');
                } else {
                    navBar.classList.remove('scrolled');
                }
            }

            // Debounced scroll handler
            let scrollTimeout;
            window.addEventListener('scroll', function () {
                clearTimeout(scrollTimeout);
                updateActiveNav();
                updateNavbarOnScroll();
            }, { passive: true });

            // Initial call
            updateActiveNav();
            updateNavbarOnScroll();
        });
    </script>
</body>

</html>