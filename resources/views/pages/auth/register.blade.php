@extends('layouts.header')

@section('title', 'Register - BAFAI')

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

.login-card { max-width: 500px; margin: 0 auto; }
.form-group { margin-bottom: 1.5rem; }
.btn-login { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); width: 100%; padding: 0.8rem; border-radius: 2rem; color: white; }
</style>
@endpush

@section('content')
<div class="breadcrumb-bar text-center">
    <div class="container">
        <h2 class="breadcrumb-title">Create Account</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Register</li>
            </ol>
        </nav>
    </div>
</div>

<section class="login-section py-5">
    <div class="container">
        <div class="login-card">
            <div class="login-header bg-primary text-white text-center p-4 rounded-top">
                <i class="fas fa-user-plus fa-2x"></i>
                <h3 class="mt-2">Sign Up for BAFAI</h3>
            </div>
            <div class="login-body p-4 bg-white rounded-bottom shadow">
                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="form-control" required>
                            <option value="">Select your country</option>
                            @foreach($countries as $code => $name)
                                <option value="{{ $code }}" {{ old('country') == $code ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <small class="text-muted">Min 8 chars, 1 uppercase, 1 lowercase, 1 digit, 1 special character</small>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-login">Register</button>
                </form>
                <div class="text-center mt-3">
                    Already have an account? <a href="{{ route('login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection