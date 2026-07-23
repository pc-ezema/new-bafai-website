<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="BAFAI - Advanced Learning Management System">
    <meta name="keywords" content="LMS, e-learning, online courses, education">
    <meta name="author" content="BAFAI">
    <title>@yield('title', 'BAFAI - Advanced Learning Management System')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <!-- Header CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

    <!-- Footer CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/footer.css') }}">

    <!-- Additional CSS -->
    @stack('styles')
</head>

<body>
    <!-- Overlay -->
    <div class="sidebar-overlay"></div>

    <!-- Mobile Sidebar -->
    <div class="mobile-sidebar">
        <div class="mobile-sidebar-header">
            <img src="{{ asset('assets/img/bafai-logo.png') }}" alt="BAFAI">
            <button class="close-sidebar" id="closeSidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="mobile-nav">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/about-us') }}">About Us</a></li>
            <li><a href="{{ url('/faculty') }}">Our Faculty</a></li>
            <li>
                <a href="{{ url('/courses') }}">Courses</a>
            </li>
            <li class="has-dropdown">
                <a href="javascript:void(0)">More Links <i class="fas fa-chevron-down"></i></a>
                <ul class="mobile-dropdown-menu">
                    <li><a href="{{ url('/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/faqs') }}">FAQs</a></li>
                    <li><a href="{{ url('/sponsorship') }}">Sponsorship</a></li>
                    <li><a href="{{ url('/testimonials') }}">Testimonials</a></li>
                </ul>
            </li>
        </ul>
        <div class="mobile-auth">
            @guest
                <a href="https://learn.bafai.ai/login/index.php" class="btn-signin">Sign In</a>
                <a href="{{ url('/register') }}" class="btn-signup">Sign Up</a>
            @endguest

            @auth
                <div class="mobile-user-info">
                    <div class="mobile-user-name">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->firstname }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mobile-logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header Start -->
        <header class="header-one">
            <!-- Top Accent Bar -->
            <div class="header-accent-bar"></div>
            <div class="container">
                <div class="header-nav">
                    <!-- Mobile Menu Button -->
                    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Open Menu">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Logo -->
                    <div class="navbar-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/bafai-logo.png') }}" class="logo" alt="BAFAI">
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <ul class="main-nav">
                        <li><a href="{{ url('/') }}" class="nav-link-active">Home</a></li>
                        <li><a href="{{ url('/about-us') }}">About Us</a></li>
                        <li><a href="{{ url('/faculty') }}">Our Faculty</a></li>
                        <li>
                            <a href="{{ url('/courses') }}">Courses</a>
                        </li>
                        <li class="has-dropdown">
                            <a href="#">More Links <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/blog') }}"><i class="fas fa-blog"></i> Blog</a></li>
                                <li><a href="{{ url('/faqs') }}"><i class="fas fa-question-circle"></i> FAQs</a></li>
                                <li><a href="{{ url('/sponsorship') }}"><i class="fas fa-hand-holding-heart"></i> Sponsorship</a></li>
                                <li><a href="{{ url('/testimonials') }}"><i class="fas fa-star"></i> Testimonials</a></li>
                            </ul>
                        </li>
                        <li class="nav-item language-dropdown">

                            <button id="languageToggle" class="language-btn">
                                <i class="fas fa-globe"></i>
                                <span id="currentLanguage">English</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>

                            <ul class="language-menu">
                                <li data-lang="af">🇿🇦 Afrikaans</li>
                                <li data-lang="sq">🇦🇱 Albanian</li>
                                <li data-lang="ar">🇸🇦 العربية</li>
                                <li data-lang="hy">🇦🇲 Armenian</li>
                                <li data-lang="az">🇦🇿 Azerbaijani</li>
                                <li data-lang="bn">🇧🇩 Bengali</li>
                                <li data-lang="zh-CN">🇨🇳 中文 (简体)</li>
                                <li data-lang="zh-TW">🇹🇼 中文 (繁體)</li>
                                <li data-lang="nl">🇳🇱 Dutch</li>
                                <li data-lang="en">🇺🇸 English</li>
                                <li data-lang="fr">🇫🇷 Français</li>
                                <li data-lang="de">🇩🇪 Deutsch</li>
                                <li data-lang="hi">🇮🇳 हिन्दी</li>
                                <li data-lang="it">🇮🇹 Italiano</li>
                                <li data-lang="ja">🇯🇵 日本語</li>
                                <li data-lang="ko">🇰🇷 한국어</li>
                                <li data-lang="pt">🇵🇹 Português</li>
                                <li data-lang="ru">🇷🇺 Русский</li>
                                <li data-lang="es">🇪🇸 Español</li>
                                <li data-lang="sw">🇰🇪 Kiswahili</li>
                                <li data-lang="tr">🇹🇷 Türkçe</li>
                                <li data-lang="uk">🇺🇦 Українська</li>
                                <li data-lang="ur">🇵🇰 اردو</li>
                                <li data-lang="vi">🇻🇳 Tiếng Việt</li>
                            </ul>

                        </li>

                        <div id="google_translate_element"></div>
                    </ul>

                    <!-- Header Actions -->
                    <div class="header-actions">
                        <!-- Cart Icon -->
                        <div class="cart-icon-wrapper">
                            <a href="{{ url('/cart') }}" class="cart-icon" aria-label="Shopping Cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-count" id="cartCount">0</span>
                                <span class="cart-count" id="cartCount">{{ count(session()->get('cart', [])) }}</span>
                            </a>
                        </div>

                        <!-- Auth Buttons -->
                        <div class="auth-buttons">
                            @guest
                                <a href="https://learn.bafai.ai/login/index.php" class="btn-signin">Sign In</a>
                                <a href="{{ url('/register') }}" class="btn-signup">Sign Up</a>
                            @endguest

                            @auth
                                <!-- User dropdown or just a greeting + logout -->
                                <div class="user-dropdown">
                                    <button class="btn-user" id="userMenuBtn">
                                        <i class="fas fa-user-circle"></i> {{ Auth::user()->firstname }}
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" id="userDropdown">
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                            @csrf
                                            <button type="submit" class="dropdown-item logout-btn">
                                                <i class="fas fa-sign-out-alt"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->

        <!-- Dynamic Content -->
        @yield('content')

        <!-- Footer Start -->
        @include('layouts.footer')
        <!-- Footer End -->