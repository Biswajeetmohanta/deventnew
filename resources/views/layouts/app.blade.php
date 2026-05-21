<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Devent Technology | Premium Software Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'Devent Technology provides high-quality web development, mobile apps, and digital marketing solutions.')">
    
    @if(isset($settings['site_favicon']))
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($settings['site_favicon']) }}">
    @endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Calendly link widget css -->
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            scroll-behavior: smooth;
        }

        /* Calendly Modal Styles */
        .calendly-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(8px);
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .calendly-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .calendly-modal-content {
            background: #fff;
            width: 95%;
            max-width: 1060px;
            height: 95vh;
            max-height: 900px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.95);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }
        
        @media (max-width: 768px) {
            .calendly-modal-content {
                width: 100%;
                height: 100%;
                max-height: 100%;
                border-radius: 0;
            }
            .calendly-modal-close {
                top: 10px;
                right: 10px;
                background: rgba(255, 255, 255, 0.8);
            }
        }
        .calendly-modal-overlay.active .calendly-modal-content {
            transform: scale(1);
        }
        .calendly-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.2s;
            color: #64748b;
        }
        .calendly-modal-close:hover {
            background: #fee2e2;
            color: #ef4444;
            border-color: #fecaca;
            transform: rotate(90deg);
        }
        .calendly-loader {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fff;
            z-index: 1;
            transition: opacity 0.5s;
        }
        .calendly-loader.fade-out {
            opacity: 0;
            pointer-events: none;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #e0f2fe;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Gradient Button Style */
        .btn-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            color: white !important;
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 15px 30px -5px rgba(59, 130, 246, 0.6);
            filter: brightness(1.1);
        }

        /* Global Premium Card System */
        .premium-card {
            background: #fff;
            border: 2px solid #e0f2fe;
            border-radius: 24px;
            padding: 32px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            cursor: pointer;
        }
        .premium-card:hover {
            transform: translateY(-12px);
            border-color: #3b82f6;
            box-shadow: 0 30px 60px rgba(59, 130, 246, 0.15);
            background: #f0f7ff;
        }
        .premium-card-icon {
            width: 56px;
            height: 56px;
            background: #eff6ff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            border: 1px solid #dbeafe;
            transition: all 0.3s ease;
        }
        .premium-card:hover .premium-card-icon {
            background: #3b82f6;
            border-color: #3b82f6;
            transform: scale(1.1);
            color: #fff;
        }
        .premium-card:hover .premium-card-icon i {
            color: #fff !important;
        }
        .premium-card:hover .premium-card-icon img {
            filter: brightness(0) invert(1);
        }
        .premium-card-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 12px;
            line-height: 1.3;
        }
        .premium-card-text {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-scrolled {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
        }
        .dark-section {
            background-color: #0f172a;
            color: white;
        }
        .back-to-top {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: #0052FF;
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 82, 255, 0.3);
        }
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        .back-to-top:hover {
            transform: translateY(-5px);
            background: #0041cc;
        }

        /* Premium Footer Styles */
        .premium-footer {
            background-color: #030712;
            position: relative;
            overflow: hidden;
        }
        .footer-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.02) 1px, transparent 0);
            background-size: 40px 40px;
            pointer-events: none;
        }
        .footer-top-bar {
            background: linear-gradient(90deg, rgba(30, 41, 59, 0.5) 0%, rgba(15, 23, 42, 0.5) 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }
        .footer-link {
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        .footer-link i {
            font-size: 10px;
            margin-right: 12px;
            color: #3b82f6;
            transition: transform 0.3s ease;
        }
        .footer-link:hover {
            color: #3b82f6;
            transform: translateX(5px);
        }
        .footer-link:hover i {
            transform: translateX(2px);
        }
        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .social-btn:hover {
            background: #3b82f6;
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
            border-color: #3b82f6;
        }
        .newsletter-input {
            background: rgba(30, 41, 59, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .newsletter-input:focus {
            background: rgba(30, 41, 59, 0.5);
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .phone-pill {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }
        .phone-pill:hover {
            border-color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
        }
        .footer-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
            font-weight: 800;
            letter-spacing: 0.05em;
        }
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #3b82f6;
            border-radius: 2px;
        }

        /* Mobile Menu Styles */
        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }
        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .mobile-menu-content {
            position: fixed;
            top: 0;
            right: -100%;
            width: 85%;
            max-width: 400px;
            height: 100%;
            background: white;
            z-index: 101;
            padding: 40px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            box-shadow: -20px 0 50px rgba(0, 0, 0, 0.1);
        }
        .mobile-menu-content.active {
            right: 0;
        }

        /* Process Section Styles */
        .process-card {
            text-align: center;
            position: relative;
        }
        .process-circle-container {
            position: relative;
            width: 260px;
            height: 260px;
            margin: 0 auto 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .process-circle-dashed {
            position: absolute;
            inset: 0;
            border: 2px dashed #e2e8f0;
            border-radius: 50%;
            animation: spin-slow 20s linear infinite;
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .process-circle-main {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 2;
            transition: all 0.5s ease;
        }
        .process-card:hover .process-circle-main {
            transform: scale(1.05);
            box-shadow: 0 30px 60px rgba(59, 130, 246, 0.15);
        }
        .process-step-num {
            position: absolute;
            top: 20px;
            left: 10px;
            width: 44px;
            height: 44px;
            background: #0f172a;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
            z-index: 10;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .process-arrow {
            position: absolute;
            top: 30%;
            right: -20%;
            width: 40%;
            z-index: 1;
            opacity: 0.4;
        }

        /* Premium CTA Button Styles */
        .premium-cta-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            background-color: #0052FF;
            color: white;
            font-weight: 700;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 40px -10px rgba(0, 82, 255, 0.4);
            z-index: 1;
        }

        .premium-cta-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 2;
        }

        .premium-cta-btn:hover::before {
            left: 100%;
        }

        .premium-cta-btn:hover {
            background-color: #0041cc;
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 30px 60px -15px rgba(0, 82, 255, 0.5);
            color: white;
        }

        .premium-cta-btn i {
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .premium-cta-btn:hover i {
            transform: translateX(8px) scale(1.1);
        }

        .premium-cta-btn .btn-text {
            position: relative;
            z-index: 3;
        }

        .premium-cta-btn-white {
            background-color: white;
            color: #0052FF;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        }

        .premium-cta-btn-white:hover {
            background-color: #f8fafc;
            color: #0041cc;
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.15);
        }

        .premium-cta-btn-white::before {
            background: linear-gradient(
                120deg,
                transparent,
                rgba(0, 82, 255, 0.1),
                transparent
            );
        }
        /* ===== MEGA MENU STYLES ===== */

        /* Grid Layouts */
        .mega-dropdown-grid {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 0 !important;
        }
        .mega-dropdown-grid-5 {
            display: grid !important;
            grid-template-columns: repeat(5, 1fr) !important;
            gap: 0 !important;
        }

        /* Navbar */
        .mega-nav {
            background: linear-gradient(90deg, #020B4F 0%, #04135F 50%, #051A73 100%);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.15);
        }

        /* Nav Links */
        .mega-nav .nav-link {
            color: rgba(255, 255, 255, 0.75);
            font-weight: 500;
            font-size: 0.8125rem;
            letter-spacing: 0.02em;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            height: 100%;
            padding: 0 1.125rem;
            position: relative;
            text-decoration: none;
        }
        .mega-nav .nav-link:hover,
        .mega-nav .nav-link.active {
            color: #ffffff;
        }

        /* Active underline indicator */
        .mega-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: #ffffff;
            border-radius: 3px 3px 0 0;
            transition: width 0.25s ease, left 0.25s ease;
        }
        .mega-nav .nav-link:hover::after,
        .mega-nav .nav-link.active::after {
            width: 60%;
            left: 20%;
        }

        /* Dropdown Arrow (triangle pointer) */
        .dropdown-arrow {
            position: absolute;
            bottom: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid #ffffff;
            opacity: 0;
            transition: opacity 0.2s ease 0.05s;
            z-index: 52;
        }
        .mega-menu-trigger:hover .dropdown-arrow {
            opacity: 1;
        }

        /* Mega Dropdown Panel */
        .mega-dropdown {
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            background: #ffffff;
            box-shadow: 0 25px 60px -12px rgba(0, 0, 0, 0.15),
                        0 8px 20px -8px rgba(0, 0, 0, 0.08);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: opacity 0.25s ease, transform 0.25s ease, visibility 0s linear 0.25s;
            z-index: 50;
            border-top: 3px solid #2563eb;
        }

        /* Hover behavior with delay to prevent flickering */
        .mega-menu-trigger:hover .mega-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            transition: opacity 0.25s ease, transform 0.25s ease, visibility 0s linear 0s;
        }

        /* Dropdown inner container */
        .mega-dropdown-inner {
            max-width: 80rem;
            margin: 0 auto;
            padding: 2rem 2.5rem;
        }

        /* Column styling */
        .mega-col {
            padding: 0.75rem 1.5rem;
            border-right: 1px solid #f1f5f9;
        }
        .mega-col:last-child {
            border-right: none;
        }

        /* Column headers */
        .mega-col-header {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #1e293b;
            margin-bottom: 1rem;
            padding-bottom: 0.625rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .mega-col-header::before {
            content: '';
            width: 4px;
            height: 4px;
            border-radius: 1px;
            background: #2563eb;
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* Menu items */
        .mega-menu-item {
            display: block;
            padding: 0.5rem 0;
            font-size: 0.8125rem;
            color: #475569;
            text-decoration: none;
            transition: color 0.15s ease, padding-left 0.15s ease;
            line-height: 1.5;
            font-weight: 450;
        }
        .mega-menu-item:hover {
            color: #2563eb;
            padding-left: 4px;
        }

        /* CTA Contact button */
        .nav-cta-btn {
            background: #f97316;
            color: #ffffff !important;
            padding: 0.5rem 1.5rem;
            border-radius: 0.625rem;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .nav-cta-btn:hover {
            background: #ea580c;
            box-shadow: 0 6px 16px rgba(249, 115, 22, 0.4);
            transform: translateY(-1px);
        }

        /* Mobile hamburger color */
        .mega-nav #mobileMenuBtn {
            color: rgba(255,255,255,0.9);
        }
        .mega-nav #mobileMenuBtn:hover {
            color: #ffffff;
        }

        /* ===== HERO SECTION STYLES ===== */
        .hero-section {
            background: #f8fafc;
        }
        .hero-bg-gradient {
            background: 
                radial-gradient(ellipse 80% 60% at 20% 50%, rgba(219, 234, 254, 0.6) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 30%, rgba(224, 231, 255, 0.4) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 50% 80%, rgba(219, 234, 254, 0.3) 0%, transparent 60%),
                linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #f8fafc 100%);
            animation: heroGradientShift 12s ease-in-out infinite alternate;
        }
        @keyframes heroGradientShift {
            0% { opacity: 1; }
            50% { opacity: 0.8; }
            100% { opacity: 1; }
        }

        /* Floating Particles */
        .hero-particle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(139, 92, 246, 0.1));
            animation: heroParticleFloat 15s ease-in-out infinite;
        }
        .hero-particle-1 { width: 300px; height: 300px; top: -50px; right: -80px; animation-delay: 0s; animation-duration: 18s; }
        .hero-particle-2 { width: 200px; height: 200px; bottom: -40px; left: -60px; animation-delay: -4s; animation-duration: 20s; background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(59, 130, 246, 0.06)); }
        .hero-particle-3 { width: 120px; height: 120px; top: 30%; left: 45%; animation-delay: -8s; animation-duration: 14s; }
        .hero-particle-4 { width: 80px; height: 80px; bottom: 20%; right: 20%; animation-delay: -2s; animation-duration: 16s; background: linear-gradient(135deg, rgba(245, 158, 11, 0.08), rgba(239, 68, 68, 0.05)); }
        .hero-particle-5 { width: 150px; height: 150px; top: 10%; left: 10%; animation-delay: -6s; animation-duration: 22s; background: linear-gradient(135deg, rgba(139, 92, 246, 0.08), rgba(59, 130, 246, 0.06)); }

        @keyframes heroParticleFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -40px) scale(1.05); }
            50% { transform: translate(-20px, 20px) scale(0.95); }
            75% { transform: translate(15px, 30px) scale(1.02); }
        }

        /* Tagline Badge */
        .hero-tagline-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 20px 8px 14px;
            background: linear-gradient(135deg, rgba(219, 234, 254, 0.8), rgba(224, 231, 255, 0.6));
            border: 1px solid rgba(59, 130, 246, 0.15);
            border-radius: 100px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #2563eb;
            backdrop-filter: blur(10px);
        }
        .hero-badge-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: heroBadgePulse 2s ease-in-out infinite;
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
        }
        @keyframes heroBadgePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
            50% { box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
        }

        /* Gradient Text */
        .hero-gradient-text {
            background: linear-gradient(135deg, #0052FF 0%, #6366f1 40%, #8b5cf6 70%, #0052FF 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: heroGradientText 4s ease-in-out infinite alternate;
        }
        @keyframes heroGradientText {
            0% { background-position: 0% center; }
            100% { background-position: 100% center; }
        }

        /* Hero CTA Buttons */
        .hero-cta-primary {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #0052FF 0%, #2563eb 100%);
            color: white;
            padding: 16px 32px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 12px 30px -8px rgba(0, 82, 255, 0.4);
            position: relative;
            overflow: hidden;
        }
        .hero-cta-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        .hero-cta-primary:hover::before { left: 100%; }
        .hero-cta-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(0, 82, 255, 0.5);
            color: white;
        }

        .hero-cta-whatsapp {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            padding: 16px 28px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 12px 30px -8px rgba(37, 211, 102, 0.35);
            text-decoration: none;
        }
        .hero-cta-whatsapp:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(37, 211, 102, 0.5);
            color: white;
        }

        .hero-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: #334155;
            padding: 16px 28px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 15px;
            border: 2px solid #e2e8f0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .hero-cta-secondary:hover {
            transform: translateY(-3px);
            border-color: #3b82f6;
            color: #2563eb;
            box-shadow: 0 15px 30px -10px rgba(59, 130, 246, 0.2);
        }

        /* Hero Image */
        .hero-image-wrapper {
            position: relative;
        }
        .hero-image-glow {
            position: absolute;
            inset: -8px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.15), rgba(59, 130, 246, 0.1));
            border-radius: 2.5rem;
            z-index: 0;
            filter: blur(20px);
            animation: heroImageGlow 4s ease-in-out infinite alternate;
        }
        @keyframes heroImageGlow {
            0% { opacity: 0.5; transform: scale(1); }
            100% { opacity: 0.8; transform: scale(1.02); }
        }

        /* Floating Cards */
        .hero-stats-card {
            position: absolute;
            top: 16px;
            left: -40px;
            background: white;
            padding: 20px 24px;
            border-radius: 20px;
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.12);
            z-index: 20;
            border: 1px solid rgba(226, 232, 240, 0.8);
            animation: heroCardFloat 5s ease-in-out infinite;
        }
        .hero-rating-badge {
            position: absolute;
            bottom: 20px;
            right: -20px;
            background: white;
            padding: 14px 20px;
            border-radius: 16px;
            box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.1);
            z-index: 20;
            border: 1px solid rgba(226, 232, 240, 0.8);
            flex-direction: column;
            gap: 4px;
            animation: heroCardFloat 5s ease-in-out infinite;
            animation-delay: -2.5s;
        }
        @keyframes heroCardFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .hero-float-reverse {
            animation: heroFloatReverse 6s ease-in-out infinite;
        }
        @keyframes heroFloatReverse {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(15px) rotate(5deg); }
        }

        /* Hero Trust Badges */
        .hero-trust-badges {
            padding-top: 4px;
            animation: heroFadeInUp 1s ease-out 0.8s both;
        }

        /* Hero Entrance Animations */
        .hero-content-left {
            animation: heroFadeInUp 0.8s ease-out both;
        }
        .hero-content-right {
            animation: heroFadeInUp 0.8s ease-out 0.3s both;
        }
        @keyframes heroFadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* CTA WhatsApp Button (dark section) */
        .cta-whatsapp-btn {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(37, 211, 102, 0.4);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }
        .cta-whatsapp-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 18px 35px -8px rgba(37, 211, 102, 0.5);
            color: white;
            filter: brightness(1.1);
        }

        /* Floating WhatsApp Widget */
        .whatsapp-float {
            position: fixed;
            bottom: 28px;
            right: 100px;
            z-index: 9996;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: whatsappBounceIn 0.6s ease-out 2s both;
        }
        .whatsapp-float-btn {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4), 0 0 0 0 rgba(37, 211, 102, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            animation: whatsappPulse 2.5s infinite;
        }
        .whatsapp-float-btn:hover {
            transform: scale(1.12);
            box-shadow: 0 12px 35px rgba(37, 211, 102, 0.5);
            color: white;
        }
        .whatsapp-float-label {
            background: white;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            color: #128C7E;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            white-space: nowrap;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .whatsapp-float:hover .whatsapp-float-label {
            opacity: 1;
            transform: translateX(0);
        }
        @keyframes whatsappPulse {
            0% { box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4), 0 0 0 0 rgba(37, 211, 102, 0.3); }
            70% { box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4), 0 0 0 12px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4), 0 0 0 0 rgba(37, 211, 102, 0); }
        }
        @keyframes whatsappBounceIn {
            from { opacity: 0; transform: scale(0.5); }
            50% { transform: scale(1.1); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Hero responsive tweaks */
        @media (max-width: 768px) {
            .hero-stats-card { left: 10px; top: -20px; padding: 14px 18px; }
            .hero-rating-badge { right: 10px; bottom: -15px; }
            .hero-cta-primary, .hero-cta-whatsapp, .hero-cta-secondary {
                padding: 14px 22px;
                font-size: 14px;
                width: 100%;
                justify-content: center;
            }
            .whatsapp-float { right: 28px; bottom: 90px !important; }
            .back-to-top { right: 28px; bottom: 160px !important; }
            .whatsapp-float-label { display: none; }
        }

        /* Prevent overlap of footer links with floating buttons */
        @media (min-width: 768px) {
            .footer-bottom-links {
                padding-right: 180px !important;
            }
        }
    </style>
</head>
<body class="antialiased text-slate-900 bg-white">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 mega-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-stretch h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tighter text-white">
                        @if(isset($settings['site_logo']))
                            <img src="{{ Storage::url($settings['site_logo']) }}" alt="Logo" class="h-20 brightness-0 invert">
                        @else
                            DEVENT<span class="text-blue-200">TECHNOLOGY</span>
                        @endif
                    </a>
                </div>
                
                <div class="hidden md:flex items-stretch space-x-1">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About Us</a>
                    </div>
                    
                    <!-- Services Mega Menu -->
                    <div class="mega-menu-trigger flex items-stretch">
                        <a href="{{ url('/services') }}" class="nav-link {{ request()->is('services*') ? 'active' : '' }}">
                            Services
                            <div class="dropdown-arrow"></div>
                        </a>
                        <div class="mega-dropdown">
                            <div class="mega-dropdown-inner">
                                <div class="mega-dropdown-grid">
                                    @foreach(($navServices ?? collect())->chunk(ceil(($navServices ?? collect())->count() / 3)) as $index => $chunk)
                                        <div class="mega-col">
                                            <div class="mega-col-header">Services</div>
                                            @foreach($chunk as $service)
                                                <a href="{{ url('/services/' . $service->slug) }}" class="mega-menu-item">{{ $service->title }}</a>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Industry Mega Menu -->
                    <div class="mega-menu-trigger flex items-stretch">
                        <a href="{{ url('/industry') }}" class="nav-link {{ request()->is('industry*') ? 'active' : '' }}">
                            Industry
                            <div class="dropdown-arrow"></div>
                        </a>
                        <div class="mega-dropdown">
                            <div class="mega-dropdown-inner">
                                <div class="mega-dropdown-grid-5">
                                    @foreach(($navIndustries ?? collect())->chunk(ceil(($navIndustries ?? collect())->count() / 5)) as $chunk)
                                        <div class="mega-col">
                                            @foreach($chunk as $industry)
                                                <a href="{{ url('/industry/' . $industry->slug) }}" class="mega-menu-item">{{ $industry->title }}</a>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Technology Mega Menu -->
                    <div class="mega-menu-trigger flex items-stretch">
                        <a href="{{ url('/technology') }}" class="nav-link {{ request()->is('technology*') ? 'active' : '' }}">
                            Technology
                            <div class="dropdown-arrow"></div>
                        </a>
                        <div class="mega-dropdown">
                            <div class="mega-dropdown-inner">
                                <div class="mega-dropdown-grid">
                                    @foreach(($navTechnologies ?? collect())->groupBy('category') as $category => $techs)
                                        <div class="mega-col">
                                            <div class="mega-col-header">{{ $category }}</div>
                                            @foreach($techs as $tech)
                                                <a href="{{ url('/technology/' . $tech->slug) }}" class="mega-menu-item">{{ $tech->name }}</a>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Build Your Team Mega Menu -->
                    <div class="mega-menu-trigger flex items-stretch">
                        <a href="{{ url('/build-your-team') }}" class="nav-link {{ request()->is('build-your-team*') ? 'active' : '' }}">
                            Build Your Team
                            <div class="dropdown-arrow"></div>
                        </a>
                        <div class="mega-dropdown">
                            <div class="mega-dropdown-inner">
                                <div class="mega-dropdown-grid">
                                    @foreach(($navTeamRoles ?? collect())->chunk(ceil(($navTeamRoles ?? collect())->count() / 3)) as $index => $chunk)
                                        <div class="mega-col">
                                            <div class="mega-col-header">Hiring Roles</div>
                                            @foreach($chunk as $role)
                                                <a href="{{ url('/build-your-team/' . $role->slug) }}" class="mega-menu-item">{{ $role->title }}</a>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="flex items-center">
                        <a href="{{ url('/case-studies') }}" class="nav-link {{ request()->is('case-studies*') ? 'active' : '' }}">Case Studies</a>
                    </div> -->
                    
                    <div class="flex items-center">
                        <a href="{{ url('/testimonials') }}" class="nav-link {{ request()->is('testimonials*') ? 'active' : '' }}">Testimonials</a>
                    </div>
                    
                    <div class="flex items-center ml-6 gap-3">
                        <button onclick="openCalendlyModal()" class="border border-white/30 hover:border-white/80 hover:bg-white hover:text-slate-900 hover:scale-[1.02] text-white px-4 py-2 rounded-2xl text-[0.8125rem] font-medium tracking-wide transition-all self-center flex items-center bg-transparent">
                            <i class="fa-solid fa-calendar mr-2"></i>
                            Schedule Meeting
                        </button>
                        <a href="{{ url('/contact') }}" class="btn-gradient text-white px-4 py-2 rounded-2xl text-[0.8125rem] font-medium tracking-wide transition-all self-center flex items-center">
                            Contact Us
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobileMenuBtn" class="text-slate-600 hover:text-blue-600 focus:outline-none transition-colors">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Container -->
    <div id="mobileMenuOverlay" class="mobile-menu-overlay"></div>
    <div id="mobileMenuContent" class="mobile-menu-content">
        <div class="flex justify-between items-center mb-12">
            <a href="{{ url('/') }}" class="text-2xl font-black tracking-tighter text-blue-600">
                DEVENT<span class="text-slate-950">TECH</span>
            </a>
            <button id="closeMenuBtn" class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-red-500 transition-all">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <nav class="flex flex-col space-y-6">
            <a href="{{ url('/') }}" class="text-xl font-black text-slate-900 hover:text-blue-600 transition-colors">Home</a>
            <a href="{{ url('/about') }}" class="text-xl font-black text-slate-900 hover:text-blue-600 transition-colors">About Us</a>
            
            <!-- Services Dropdown -->
            <details class="group">
                <summary class="flex justify-between items-center text-xl font-black text-slate-900 hover:text-blue-600 transition-colors cursor-pointer list-none">
                    Services
                    <span class="transition-transform group-open:rotate-180">
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </span>
                </summary>
                <div class="mt-4 ml-4 flex flex-col space-y-3">
                    <a href="{{ url('/services') }}" class="text-base font-bold text-blue-600 hover:text-blue-700 transition-colors">All Services</a>
                    @foreach($navServices ?? collect() as $service)
                        <a href="{{ url('/services/' . $service->slug) }}" class="text-base font-semibold text-slate-600 hover:text-blue-600 transition-colors">{{ $service->title }}</a>
                    @endforeach
                </div>
            </details>

            <!-- Industries Dropdown -->
            <details class="group">
                <summary class="flex justify-between items-center text-xl font-black text-slate-900 hover:text-blue-600 transition-colors cursor-pointer list-none">
                    Industries
                    <span class="transition-transform group-open:rotate-180">
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </span>
                </summary>
                <div class="mt-4 ml-4 flex flex-col space-y-3">
                    <a href="{{ url('/industry') }}" class="text-base font-bold text-blue-600 hover:text-blue-700 transition-colors">All Industries</a>
                    @foreach($navIndustries ?? collect() as $industry)
                        <a href="{{ url('/industry/' . $industry->slug) }}" class="text-base font-semibold text-slate-600 hover:text-blue-600 transition-colors">{{ $industry->title }}</a>
                    @endforeach
                </div>
            </details>

            <!-- Technology Dropdown -->
            <details class="group">
                <summary class="flex justify-between items-center text-xl font-black text-slate-900 hover:text-blue-600 transition-colors cursor-pointer list-none">
                    Technology
                    <span class="transition-transform group-open:rotate-180">
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </span>
                </summary>
                <div class="mt-4 ml-4 flex flex-col space-y-4">
                    <a href="{{ url('/technology') }}" class="text-base font-bold text-blue-600 hover:text-blue-700 transition-colors">All Technologies</a>
                    @foreach(($navTechnologies ?? collect())->groupBy('category') as $category => $techs)
                        <div>
                            <h5 class="text-xs font-bold text-slate-400 uppercase mb-2">{{ $category }}</h5>
                            <div class="flex flex-col space-y-2 ml-2">
                                @foreach($techs as $tech)
                                    <a href="{{ url('/technology/' . $tech->slug) }}" class="text-base font-semibold text-slate-600 hover:text-blue-600 transition-colors">{{ $tech->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </details>

            <!-- Build Your Team Dropdown -->
            <details class="group">
                <summary class="flex justify-between items-center text-xl font-black text-slate-900 hover:text-blue-600 transition-colors cursor-pointer list-none">
                    Build Your Team
                    <span class="transition-transform group-open:rotate-180">
                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </span>
                </summary>
                <div class="mt-4 ml-4 flex flex-col space-y-3">
                    <a href="{{ url('/build-your-team') }}" class="text-base font-bold text-blue-600 hover:text-blue-700 transition-colors">All Roles</a>
                    @foreach($navTeamRoles ?? collect() as $role)
                        <a href="{{ url('/build-your-team/' . $role->slug) }}" class="text-base font-semibold text-slate-600 hover:text-blue-600 transition-colors">{{ $role->title }}</a>
                    @endforeach
                </div>
            </details>

            <a href="{{ url('/case-studies') }}" class="text-xl font-black text-slate-900 hover:text-blue-600 transition-colors">Case Studies</a>
            <a href="{{ url('/testimonials') }}" class="text-xl font-black text-slate-900 hover:text-blue-600 transition-colors">Testimonials</a>
            <hr class="border-slate-100 my-4">
            <button onclick="openCalendlyModal()" class="border-2 border-blue-600 text-blue-600 py-4 rounded-2xl text-center text-sm font-black uppercase tracking-widest hover:bg-blue-50 transition-all flex items-center justify-center gap-2 mb-3">
                <i class="fa-solid fa-calendar"></i>
                Schedule Meeting
            </button>
            <a href="{{ url('/contact') }}" class="bg-blue-600 text-white py-4 rounded-2xl text-center text-sm font-black uppercase tracking-widest shadow-xl shadow-blue-200">
                Contact Us
            </a>
        </nav>

        <div class="mt-auto pt-12 text-center">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Follow Us</p>
            <div class="flex justify-center gap-4">
                <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="premium-footer text-slate-300 mt-12">
        <div class="footer-pattern"></div>
        
        <!-- Footer Top Bar -->
        <div class="footer-top-bar py-6 mb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-12 h-12 rounded-full border border-slate-800 flex items-center justify-center text-blue-500 bg-slate-900/50">
                            <i class="fa-solid fa-headset text-xl"></i>
                        </div>
                        <h3 class="text-white font-bold text-lg tracking-tight">Elevating Customer Experience.</h3>
                    </div>
                    
                    <div class="flex items-center gap-4 md:gap-8">
                        <div class="hidden lg:block h-12 w-px bg-slate-800"></div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full border border-slate-800 flex items-center justify-center text-white bg-slate-900/50">
                                <i class="fa-solid fa-phone-volume text-sm"></i>
                            </div>
                            <a href="tel:{{ $settings['contact_phone'] ?? '+919274688925' }}" class="phone-pill group py-2 px-6">
                                <span class="text-blue-500 font-black tracking-wider group-hover:text-white transition-colors text-sm md:text-base">{{ $settings['contact_phone'] ?? '+91 92746 88925' }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12 mb-20">
                <!-- Company Info -->
                <div class="space-y-8">
                    <a href="{{ url('/') }}" class="inline-block">
                        @if(isset($settings['site_logo']))
                            <img src="{{ Storage::url($settings['site_logo']) }}" alt="Logo" class="h-20 w-auto brightness-0 invert opacity-90">
                        @else
                            <div class="flex flex-col">
                                <span class="text-2xl font-black tracking-tighter text-white">DEVENT<span class="text-blue-600">TECHNOLOGIES</span></span>
                                <span class="text-[10px] text-blue-500 font-bold tracking-[0.3em] uppercase -mt-1 ml-1">{{ $settings['hero_tagline'] ?? 'Innovative Tech Solutions' }}</span>
                            </div>
                        @endif
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed font-medium">
                        {{ $settings['about_description'] ?? 'Delivering innovative solutions with a focus on enhancing user experience and operational efficiency. Partner with us to transform your ideas into impactful results.' }}
                    </p>
                    <div class="flex gap-3">
                        @php
                            $socials = [
                                'facebook' => 'fa-facebook-f',
                                'twitter' => 'fa-x-twitter',
                                'linkedin' => 'fa-linkedin-in',
                                'instagram' => 'fa-instagram'
                            ];
                        @endphp
                        @foreach($socials as $key => $icon)
                            @if(isset($settings[$key . '_url']) && $settings[$key . '_url'] != '')
                                <a href="{{ $settings[$key . '_url'] }}" target="_blank" class="social-btn">
                                    <i class="fa-brands {{ $icon }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Useful Links -->
                <div>
                    <h4 class="text-white text-sm uppercase footer-title">Useful Links</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ url('/about') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>About Us</a></li>
                        <li><a href="{{ url('/contact') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>Contact</a></li>
                        <li><a href="{{ url('/case-studies') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>Case Studies</a></li>
                        <li><a href="{{ url('/services') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>Services</a></li>
                        <li><a href="{{ url('/testimonials') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>Testimonials</a></li>
                        <li><a href="{{ url('/blog') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>Blog</a></li>
                        <li><a href="{{ url('/build-your-team') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>Build Your Team</a></li>
                        <li><a href="{{ url('/careers') }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>Careers</a></li>
                    </ul>
                </div>

                <!-- Our Services -->
                <div>
                    <h4 class="text-white text-sm uppercase footer-title">Our Services</h4>
                    <ul class="space-y-4">
                        @foreach($footerServices ?? [] as $fService)
                            <li><a href="{{ url('/services/' . $fService->slug) }}" class="footer-link text-sm font-semibold text-slate-400"><i class="fa-solid fa-chevron-right"></i>{{ $fService->title }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-white text-sm uppercase footer-title">Newsletter</h4>
                    <p class="text-slate-400 text-sm mb-6 font-medium leading-relaxed">
                        Stay updated with our latest news and insights. Subscribe to our newsletter for industry updates, tips, and exclusive offers.
                    </p>
                    <form class="relative">
                        <input type="email" placeholder="Enter Your E-mail" class="newsletter-input w-full py-4 pl-6 pr-16 text-sm text-white focus:outline-none placeholder:text-slate-600">
                        <button type="submit" class="absolute right-2 top-2 bottom-2 w-12 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all flex items-center justify-center shadow-lg shadow-blue-900/20">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-slate-900 py-8 flex flex-col md:flex-row justify-between items-center gap-4 text-[13px] font-semibold text-slate-500">
                <p>&copy; {{ date('Y') }} <span class="text-blue-500">Devent Technology</span>. All Rights Reserved.</p>
                <div class="flex items-center gap-8 footer-bottom-links">
                    <a href="{{ route('privacy-policy') }}" class="text-slate-400 hover:text-blue-500 transition-colors duration-300">Privacy Policy</a>
                    <div class="w-px h-4 bg-slate-800"></div>
                    <a href="#" class="text-slate-400 hover:text-blue-500 transition-colors duration-300">Support</a>
                </div>
            </div>
        </div>
    </footer>

    <div id="backToTop" class="back-to-top">
        <i class="fa-solid fa-arrow-up"></i>
    </div>


    <!-- Floating WhatsApp Button -->
    <div class="whatsapp-float">
        <span class="whatsapp-float-label">Chat with us!</span>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['contact_phone'] ?? '919274688925') }}?text={{ urlencode('Hi Devent Technology! I\'d like to discuss a project.') }}" target="_blank" class="whatsapp-float-btn" aria-label="Chat on WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

    <script>
        const nav = document.querySelector('nav');
        const backToTop = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }

            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Mobile Menu Logic
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMenuBtn = document.getElementById('closeMenuBtn');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuContent = document.getElementById('mobileMenuContent');

        function toggleMenu() {
            mobileMenuOverlay.classList.toggle('active');
            mobileMenuContent.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden');
        }

        mobileMenuBtn.addEventListener('click', toggleMenu);
        closeMenuBtn.addEventListener('click', toggleMenu);
        mobileMenuOverlay.addEventListener('click', toggleMenu);
    </script>

    <!-- ===== LIVE CHAT WIDGET ===== -->
    <style>
        /* Chat Widget Styles */
        .chat-widget-btn {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            border: none;
            cursor: pointer;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4), 0 0 0 0 rgba(37, 99, 235, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            animation: chatPulse 2s infinite;
        }
        .chat-widget-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.5);
        }
        .chat-widget-btn.active {
            animation: none;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            box-shadow: 0 8px 30px rgba(220, 38, 38, 0.4);
        }
        .chat-widget-btn .chat-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: 800;
            display: none;
            align-items: center;
            justify-content: center;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }
        .chat-widget-btn .chat-badge.show {
            display: flex;
        }
        @keyframes chatPulse {
            0% { box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4), 0 0 0 0 rgba(37, 99, 235, 0.4); }
            70% { box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4), 0 0 0 15px rgba(37, 99, 235, 0); }
            100% { box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4), 0 0 0 0 rgba(37, 99, 235, 0); }
        }

        /* Chat Window */
        .chat-window {
            position: fixed;
            bottom: 100px;
            right: 28px;
            width: 400px;
            max-height: 600px;
            height: calc(100vh - 140px);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.6);
            z-index: 9998;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transform: translateY(20px) scale(0.95);
            opacity: 0;
            visibility: hidden;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .chat-window.open {
            transform: translateY(0) scale(1);
            opacity: 1;
            visibility: visible;
        }

        /* Chat Header */
        .chat-header {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
            padding: 20px;
            color: white;
            position: relative;
            flex-shrink: 0;
        }
        .chat-header-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .chat-header-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        .chat-header-info h4 {
            font-weight: 700;
            font-size: 15px;
            margin: 0;
            letter-spacing: -0.01em;
            color: white;
        }
        .chat-header-info p {
            font-size: 12px;
            opacity: 0.9;
            margin: 2px 0 0;
            display: flex;
            align-items: center;
            gap: 5px;
            color: rgba(255, 255, 255, 0.8);
        }
        .chat-online-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            display: inline-block;
            border: 1.5px solid #1e40af;
        }
        .chat-minimize-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.2s;
        }
        .chat-minimize-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        /* Chat Messages */
        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .chat-body::-webkit-scrollbar {
            width: 5px;
        }
        .chat-body::-webkit-scrollbar-track {
            background: transparent;
        }
        .chat-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .chat-msg {
            display: flex;
            gap: 8px;
            animation: chatMsgIn 0.3s ease;
        }
        .chat-msg.visitor {
            flex-direction: row-reverse;
        }
        .chat-msg-bubble {
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 16px;
            font-size: 13.5px;
            line-height: 1.4;
            position: relative;
            word-wrap: break-word;
            white-space: pre-line;
        }
        .chat-msg.admin .chat-msg-bubble {
            background: white;
            color: #1e293b;
            border: 1px solid #e2e8f0;
            border-top-left-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .chat-msg.visitor .chat-msg-bubble {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border-top-right-radius: 4px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }
        .chat-msg-time {
            font-size: 10px;
            margin-top: 4px;
            opacity: 0.7;
            color: #64748b;
        }
        .chat-msg.visitor .chat-msg-time {
            text-align: right;
            color: rgba(255, 255, 255, 0.8);
        }
        @keyframes chatMsgIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Chat Options Buttons */
        .chat-options {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        .chat-opt-btn {
            background: white;
            color: #2563eb;
            border: 1px solid #2563eb;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        .chat-opt-btn:hover {
            background: #2563eb;
            color: white;
        }

        /* Chat Input */
        .chat-footer {
            padding: 16px;
            background: white;
            border-top: 1px solid #e2e8f0;
            flex-shrink: 0;
        }
        .chat-input-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f1f5f9;
            border-radius: 24px;
            padding: 4px 4px 4px 16px;
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .chat-input-wrap:focus-within {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .chat-input-wrap textarea {
            flex: 1;
            border: none;
            background: none;
            outline: none;
            font-size: 13.5px;
            color: #1e293b;
            padding: 10px 0;
            font-family: inherit;
            resize: none;
            max-height: 100px;
            min-height: 20px;
            line-height: 1.4;
            overflow-y: auto;
        }
        .chat-send-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .chat-send-btn:hover {
            background: #1d4ed8;
            transform: scale(1.05);
        }

        /* Welcome screen */
        .chat-welcome {
            text-align: center;
            padding: 40px 20px;
        }
        .chat-welcome-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 16px;
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Powered by */
        .chat-powered {
            text-align: center;
            padding: 8px;
            font-size: 11px;
            color: #64748b;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        /* RESPONSIVE BREAKPOINTS */
        
        /* Tablet */
        @media (max-width: 768px) {
            .chat-window {
                width: 340px;
                max-height: 500px;
                bottom: 100px;
                right: 20px;
            }
            .chat-widget-btn {
                bottom: 20px;
                right: 20px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .chat-window {
                width: 100%;
                height: 100%;
                max-height: 100vh;
                bottom: 0;
                right: 0;
                border-radius: 0;
                border: none;
            }
            .chat-widget-btn {
                bottom: 20px;
                right: 20px;
            }
            .chat-window.open + .chat-widget-btn {
                display: none;
            }
            .chat-body {
                padding: 16px;
            }
            .chat-footer {
                padding: 12px 16px;
                padding-bottom: max(12px, env(safe-area-inset-bottom));
            }
        }

        #skipLeadBtn:hover {
            background-color: #f5f7ff !important;
            border-color: #2563eb !important;
        }
    </style>

    <!-- Chat Widget HTML -->
    <div id="chatWindow" class="chat-window">
        <!-- Header -->
        <div class="chat-header">
            <button class="chat-minimize-btn" onclick="toggleChat()">
                <i class="fa-solid fa-minus"></i>
            </button>
            <div class="chat-header-top">
                <div class="chat-header-avatar">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="chat-header-info">
                    <h4>Devent Support</h4>
                    <p><span class="chat-online-dot"></span> Get a quick project estimate within 2 minutes</p>
                </div>
            </div>
        </div>

        <!-- Messages Body -->
        <div class="chat-body" id="chatBody">
            <div class="chat-welcome" id="chatWelcome">
                <div class="chat-welcome-icon">
                    <i class="fa-regular fa-comments" style="color: #2563eb;"></i>
                </div>
                <h5>Hi there! 👋</h5>
                <p style="font-size: 13px; color: #64748b; margin-bottom: 0; line-height: 1.5;">How can we help you today?</p>
            </div>
        </div>



        <!-- Typing Indicator -->
        <div class="chat-typing" id="chatTyping" style="padding: 0 16px 8px;">
            <div class="chat-typing-dots">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Input -->
        <div class="chat-footer">
            <form id="chatForm" class="chat-input-wrap" autocomplete="off">
                <textarea id="chatInput" placeholder="Type a message..." maxlength="2000" rows="1"></textarea>
                <button type="submit" class="chat-send-btn" id="chatSendBtn">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>

        <div class="chat-powered">
            Powered by <strong style="color: #2563eb;">Devent Technology</strong>
        </div>
    </div>

    <!-- Chat Toggle Button -->
    <button class="chat-widget-btn" id="chatToggleBtn" onclick="toggleChat()">
        <i class="fa-solid fa-comment-dots" style="font-size: 24px;" id="chatBtnIcon"></i>
        <span class="chat-badge" id="chatBadge">0</span>
    </button>

    <!-- Chat Widget Script -->
    <script>
    (function() {
        const chatWindow = document.getElementById('chatWindow');
        const chatBody = document.getElementById('chatBody');
        const chatForm = document.getElementById('chatForm');
        const chatInput = document.getElementById('chatInput');
        const chatSendBtn = document.getElementById('chatSendBtn');
        const chatToggleBtn = document.getElementById('chatToggleBtn');
        const chatBtnIcon = document.getElementById('chatBtnIcon');
        const chatBadge = document.getElementById('chatBadge');
        const chatWelcome = document.getElementById('chatWelcome');
        const chatTyping = document.getElementById('chatTyping');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let sessionId = null;
        let lastMessageId = 0;
        let leadFormShown = false;
        let isOpen = false;
        let isSending = false;
        let pollInterval = null;
        let unreadCount = 0;
        let isInitialized = false;

        // Toggle chat window
        window.toggleChat = function() {
            isOpen = !isOpen;
            chatWindow.classList.toggle('open', isOpen);
            chatToggleBtn.classList.toggle('active', isOpen);
            
            if (isOpen) {
                chatBtnIcon.className = 'fa-solid fa-xmark';
                chatBtnIcon.style.fontSize = '22px';
                
                if (!isInitialized) {
                    isInitialized = true;
                    initChat();
                }
                
                // Clear unread
                unreadCount = 0;
                chatBadge.classList.remove('show');
                
                // Start polling
                startPolling();
                
                setTimeout(() => chatInput.focus(), 300);
            } else {
                chatBtnIcon.className = 'fa-solid fa-comment-dots';
                chatBtnIcon.style.fontSize = '24px';
                stopPolling();
            }
        };

        // Initialize chat session
        function initChat() {
            isInitialized = true;

            fetch('{{ url("/chat/start") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({})
            })
            .then(r => r.json())
            .then(data => {
                sessionId = data.session_id;

                if (data.messages && data.messages.length > 0) {
                    chatWelcome.style.display = 'none';
                    data.messages.forEach(msg => {
                        appendMessage(msg);
                    });
                    lastMessageId = data.messages[data.messages.length - 1].id;
                }
            })
            .catch(err => {
                console.error('Chat init error:', err);
                isInitialized = false;
            });
        }

        // Append message to chat
        function appendMessage(msg) {
            const div = document.createElement('div');
            div.className = `chat-msg ${msg.sender}`;
            
            let messageContent = msg.message;
            let optionsHtml = '';
            
            if (msg.message.includes('[OPTIONS]:')) {
                const parts = msg.message.split('[OPTIONS]:');
                messageContent = parts[0];
                const options = parts[1].split('|');
                
                optionsHtml = '<div class="chat-options">';
                options.forEach(opt => {
                    optionsHtml += `<button class="chat-opt-btn" onclick="sendOption('${opt.replace(/'/g, "\\'")}')">${opt}</button>`;
                });
                optionsHtml += '</div>';
            }

            div.innerHTML = `<div class="chat-msg-bubble">${escapeHtml(messageContent)}${optionsHtml}<div class="chat-msg-time">${msg.time || ''}</div></div>`;
            chatBody.appendChild(div);
            scrollChatDown();
        }

        // Global function for option buttons
        window.sendOption = function(option) {
            // Find and disable all buttons in the last message to prevent multiple clicks
            const lastMsg = chatBody.lastElementChild;
            if (lastMsg) {
                const btns = lastMsg.querySelectorAll('.chat-opt-btn');
                btns.forEach(btn => btn.disabled = true);
            }
            
            // Set input value and send
            chatInput.value = option;
            sendChatMessage();
        };

        function escapeHtml(text) {
            const d = document.createElement('div');
            d.textContent = text;
            return d.innerHTML;
        }

        function scrollChatDown() {
            requestAnimationFrame(() => {
                chatBody.scrollTop = chatBody.scrollHeight;
            });
        }

        // Send message
        function sendChatMessage() {
            const message = chatInput.value.trim();
            if (!message || isSending || !sessionId) return;

            isSending = true;
            chatSendBtn.disabled = true;
            chatWelcome.style.display = 'none';
            chatInput.style.height = 'auto';

            // Instant UI update (Optimistic)
            appendMessage({
                message: message,
                sender: 'visitor',
                time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            });
            chatInput.value = '';

            fetch('{{ url("/chat/send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message: message, session_id: sessionId })
            })
            .then(r => r.json())
            .then(data => {
                if (data.error) {
                    console.warn(data.error);
                    return;
                }
                // Update lastMessageId for polling
                lastMessageId = Math.max(lastMessageId, data.id);

                // Show typing indicator for AI/Admin response
                chatTyping.classList.add('show');
                setTimeout(() => chatTyping.classList.remove('show'), 2000 + Math.random() * 2000);
            })
            .catch(err => console.error('Send error:', err))
            .finally(() => {
                isSending = false;
                chatSendBtn.disabled = false;
                chatInput.focus();
            });
        }

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            sendChatMessage();
        });

        // Enter = new line, Shift+Enter = send
        chatInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.shiftKey) {
                e.preventDefault();
                sendChatMessage();
            }
        });

        // Auto-resize textarea
        chatInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });

        // Poll for admin replies
        function startPolling() {
            if (pollInterval) return;
            pollInterval = setInterval(pollMessages, 3000);
        }

        function stopPolling() {
            if (pollInterval) {
                clearInterval(pollInterval);
                pollInterval = null;
            }
        }

        function pollMessages() {
            if (!sessionId) return;

            fetch(`{{ url("/chat/messages") }}?session_id=${sessionId}&last_id=${lastMessageId}`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    chatTyping.classList.remove('show');
                    chatWelcome.style.display = 'none';

                    data.messages.forEach(msg => {
                        appendMessage(msg);
                        lastMessageId = Math.max(lastMessageId, msg.id);
                    });

                    // Play notification sound
                    playNotificationSound();

                    // If chat is closed, show unread badge
                    if (!isOpen) {
                        unreadCount += data.messages.length;
                        chatBadge.textContent = unreadCount;
                        chatBadge.classList.add('show');
                    }
                }
            })
            .catch(() => {});
        }

        function playNotificationSound() {
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.type = 'sine';
                osc.frequency.setValueAtTime(880, ctx.currentTime);
                osc.frequency.setValueAtTime(1100, ctx.currentTime + 0.1);
                gain.gain.setValueAtTime(0.08, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.3);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.3);
            } catch (e) {}
        }

        // Also poll when chat is closed (for badge updates)
        setInterval(function() {
            if (!isOpen && sessionId) {
                pollMessages();
            }
        }, 8000);

    })();


    </script>
    <!-- Calendly Modal -->
    <div id="calendlyModal" class="calendly-modal-overlay">
        <div class="calendly-modal-content">
            <button class="calendly-modal-close" onclick="closeCalendlyModal()">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            
            <!-- Loader -->
            <div id="calendlyLoader" class="calendly-loader">
                <div class="spinner"></div>
                <p class="text-slate-600 font-medium">Loading scheduler...</p>
            </div>
            
            <!-- Calendly inline widget -->
            <div class="calendly-inline-widget" data-url="https://calendly.com/jyoti-deventtechnology/30min" style="min-width:320px;height:100%;"></div>
        </div>
    </div>

    <!-- Calendly Modal Script -->
    <script>
        function openCalendlyModal() {
            const modal = document.getElementById('calendlyModal');
            const loader = document.getElementById('calendlyLoader');
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Disable scroll
            
            // Hide loader after a delay (or listen to Calendly event if possible, but delay is safer for static embed)
            setTimeout(() => {
                loader.classList.add('fade-out');
            }, 2000);
        }

        function closeCalendlyModal() {
            const modal = document.getElementById('calendlyModal');
            const loader = document.getElementById('calendlyLoader');
            
            modal.classList.remove('active');
            document.body.style.overflow = ''; // Enable scroll
            
            // Reset loader for next open
            setTimeout(() => {
                loader.classList.remove('fade-out');
            }, 400);
        }

        // Close on outside click
        document.getElementById('calendlyModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCalendlyModal();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCalendlyModal();
            }
        });
    </script>
</body>
</html>
