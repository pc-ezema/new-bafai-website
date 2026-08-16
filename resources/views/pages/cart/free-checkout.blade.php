@extends('layouts.header')

@section('title', 'Free Checkout - BAFAI')

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
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.9), rgba(80, 58, 152, 0.85)),
        url('{{ asset(' assets/img/bafai-8.jpg') }}') no-repeat;
        background-size: cover;
        background-position: center 30%;
        background-attachment: fixed;
        padding: 100px 0;
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

    .breadcrumb-bar .breadcrumb-item a:hover {
        color: var(--secondary) !important;
    }

    .breadcrumb-bar .breadcrumb-item+.breadcrumb-item::before {
        color: white !important;
        content: "/";
    }

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

    .free-checkout-section {
        padding: 60px 0;
        background: var(--gray-light);
        min-height: 60vh;
        display: flex;
        align-items: center;
    }

    .free-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        border: none;
        max-width: 600px;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }

    .free-card:hover {
        transform: translateY(-5px);
    }

    .free-card-header {
        background: linear-gradient(135deg, var(--secondary), #1a7a59);
        color: white;
        padding: 1.5rem 2rem;
        border-bottom: none;
    }

    .free-card-header h4 {
        margin: 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .free-card-header h4 i {
        font-size: 1.8rem;
    }

    .free-card-body {
        padding: 2rem;
    }

    .free-card-body p {
        color: #475569;
        font-size: 1.05rem;
        margin-bottom: 1.5rem;
    }

    .course-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem 0;
    }

    .course-list li {
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
        border-left: 4px solid var(--secondary);
        font-weight: 500;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .course-list li::before {
        content: "\f19d";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        color: var(--secondary);
    }

    .btn-group-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .btn-confirm-free {
        background: linear-gradient(135deg, var(--secondary), #1a7a59);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 2rem;
        font-weight: 700;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-confirm-free:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(33, 163, 122, 0.3);
        color: white;
    }

    .btn-back-free {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
        padding: 0.8rem 2rem;
        border-radius: 2rem;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back-free:hover {
        background: var(--primary);
        color: white;
        text-decoration: none;
    }

    @media (max-width: 576px) {
        .free-card-header h4 {
            font-size: 1.25rem;
        }

        .free-card-body {
            padding: 1.5rem;
        }

        .btn-group-actions {
            flex-direction: column;
        }

        .btn-group-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Checkout</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses') }}">Courses</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="free-checkout-section">
    <div class="container">
        <div class="free-card">
            <div class="free-card-header">
                <h4>
                    <i class="fas fa-graduation-cap"></i> Free Enrollment
                </h4>
            </div>
            <div class="free-card-body">
                <p class="text-muted">
                    You are about to enroll in the following <strong>free courses</strong>.
                    No payment is required. Confirm below to get started.
                </p>

                <ul class="course-list">
                    @foreach($courses as $course)
                    <li>{{ $course->fullname }}</li>
                    @endforeach
                </ul>

                <form action="{{ route('cart.enroll') }}" method="POST">
                    @csrf
                    <div class="btn-group-actions">
                        <button type="submit" class="btn-confirm-free">
                            <i class="fas fa-check-circle"></i> Confirm Free Enrollment
                        </button>
                        <a href="{{ route('cart.index') }}" class="btn-back-free">
                            <i class="fas fa-arrow-left"></i> Back to Cart
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection