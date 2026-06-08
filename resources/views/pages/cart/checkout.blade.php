@extends('layouts.header')

@section('title', 'Checkout - BAFAI')

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
.breadcrumb-bar .breadcrumb-item a:hover { color: var(--secondary) !important; }
.breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before {
    color: white !important;
    content: "/";
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Checkout section */
.checkout-section {
    padding: 60px 0;
}
.checkout-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.checkout-card-header {
    background: var(--primary);
    color: white;
    padding: 1rem 1.5rem;
    font-weight: 700;
    font-size: 1.1rem;
}
.checkout-card-header i {
    margin-right: 0.5rem;
}
.checkout-card-body {
    padding: 1.5rem;
}
.order-table {
    margin-bottom: 0;
}
.order-table th {
    background: var(--gray-light);
    border-bottom: 2px solid var(--primary);
    color: var(--dark);
    font-weight: 600;
}
.order-table td, .order-table th {
    vertical-align: middle;
}
.order-total {
    font-size: 1.2rem;
    font-weight: 700;
    text-align: right;
    padding-top: 1rem;
    margin-top: 1rem;
    border-top: 2px solid var(--gray-light);
}
.order-total span {
    color: var(--primary);
    font-size: 1.4rem;
}
.summary-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    position: sticky;
    top: 20px;
}
.summary-card-header {
    background: var(--secondary);
    color: white;
    padding: 1rem 1.5rem;
    font-weight: 700;
}
.summary-card-body {
    padding: 1.5rem;
}
.btn-confirm {
    background: linear-gradient(135deg, var(--secondary), #1a7a59);
    color: white;
    border: none;
    padding: 0.8rem;
    border-radius: 2rem;
    font-weight: 700;
    width: 100%;
    transition: all 0.3s;
}
.btn-confirm:hover {
    transform: translateY(-2px);
    background: #1a7a59;
    color: white;
}
.btn-back {
    background: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
    padding: 0.6rem 1.5rem;
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
}
.btn-back:hover {
    background: var(--primary);
    color: white;
}
@media (max-width: 768px) {
    .breadcrumb-bar { padding: 50px 0; clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%); }
    .breadcrumb-bar .breadcrumb-title { font-size: 2rem; }
    .checkout-card-header { font-size: 1rem; }
    .summary-card { margin-top: 1.5rem; position: static; }
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

<!-- Checkout Content -->
<section class="checkout-section">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <i class="fas fa-shopping-cart"></i> Order Summary
                    </div>
                    <div class="checkout-card-body">
                        <div class="table-responsive">
                            <table class="table order-table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th width="120">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course->fullname }}</td>
                                        <td>${{ number_format($course->price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                             </table>
                        </div>
                        <div class="order-total">
                            Total: <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="summary-card-header">
                        <i class="fas fa-check-circle"></i> Complete Enrollment
                    </div>
                    <div class="summary-card-body">
                        <p class="text-muted mb-3">
                            By clicking “Confirm Enrollment”, you will be enrolled in the selected courses.
                        </p>
                        <form action="{{ route('cart.enroll') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-confirm">
                                <i class="fas fa-graduation-cap me-2"></i> Confirm Enrollment
                            </button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="{{ route('cart.index') }}" class="btn-back">
                                <i class="fas fa-arrow-left me-1"></i> Back to Cart
                            </a>
                        </div>
                    </div>
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