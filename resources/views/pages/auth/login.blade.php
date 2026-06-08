@extends('layouts.header')

@section('title', 'Login - BAFAI')

@push('styles')
<style>
:root {
    --primary: #503a98;
    --primary-dark: #3b2a73;
    --secondary: #21a37a;
    --dark: #0f172a;
    --gray: #64748b;
    --gray-light: #f1f5f9;
    --white: #ffffff;
    --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    --radius: 0.75rem;
    --radius-lg: 1rem;
}

body {
    background: var(--gray-light);
}

/* Breadcrumb */
.breadcrumb-bar {
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(80, 58, 152, 0.85)), url('{{ asset('assets/img/bafai-8.jpg') }}') no-repeat;
    background-size: cover;
    background-position: center 30%;
    background-attachment: fixed;
    padding: 80px 0;
    color: white;
    clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
}
.breadcrumb-bar .breadcrumb-title {
    font-size: 3rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-bottom: 1rem;
    animation: fadeInUp 0.8s ease;
}
.breadcrumb-bar .breadcrumb-item a,
.breadcrumb-bar .breadcrumb-item.active {
    color: white !important;
    font-size: 0.9rem;
}
.breadcrumb-bar .breadcrumb-item a:hover { color: var(--secondary) !important; }
.breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before {
    color: white !important;
    content: "/";
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Login Section */
.login-section {
    padding: 60px 0;
}
.login-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    max-width: 500px;
    margin: 0 auto;
}
.login-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    padding: 1.5rem;
    text-align: center;
}
.login-header i {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}
.login-header h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}
.login-body {
    padding: 2rem;
}
.form-group {
    margin-bottom: 1.5rem;
}
.form-group label {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.5rem;
    display: block;
}
.form-control {
    width: 100%;
    padding: 0.7rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius);
    transition: all 0.3s;
}
.form-control:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(80, 58, 152, 0.1);
}
.btn-login {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    padding: 0.8rem;
    border-radius: 2rem;
    font-weight: 700;
    width: 100%;
    transition: all 0.3s;
}
.btn-login:hover {
    transform: translateY(-2px);
    background: var(--primary-dark);
}
.login-footer {
    text-align: center;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
}
.login-footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
}
.login-footer a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}
.checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.checkbox-group input {
    width: auto;
}
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Welcome Back</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Login Form -->
<section class="login-section">
    <div class="container">
        <div class="login-card" data-aos="fade-up" data-aos-duration="800">
            <div class="login-header">
                <i class="fas fa-graduation-cap"></i>
                <h3>Sign In to BAFAI</h3>
            </div>
            <div class="login-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autofocus>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group checkbox-group">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="mb-0">Remember Me</label>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </form>

                <div class="login-footer">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                    <p><a href="">Forgot your password?</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-out-quad'
    });
</script>
@endpush