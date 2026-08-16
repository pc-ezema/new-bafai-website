@extends('layouts.header')

@section('title', 'Shopping Cart - BAFAI')

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

/* Cart section */
.cart-section {
    padding: 60px 0;
}
.cart-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}
.cart-header {
    background: var(--primary);
    color: white;
    padding: 1rem 1.5rem;
    font-weight: 700;
}
.cart-table {
    margin-bottom: 0;
}
.cart-table th {
    background: var(--gray-light);
    border-bottom: 2px solid var(--primary);
    color: var(--dark);
    font-weight: 600;
}
.cart-table td {
    vertical-align: middle;
}
.cart-total {
    background: var(--white);
    padding: 1.5rem;
    border-top: 1px solid #e2e8f0;
    font-size: 1.2rem;
    font-weight: 700;
    text-align: right;
}
.cart-total span {
    color: var(--primary);
    font-size: 1.5rem;
}
.btn-enroll-now {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    padding: 0.8rem 2rem;
    border-radius: 2rem;
    font-weight: 700;
    transition: all 0.3s;
    text-decoration: none;
}
.btn-enroll-now:hover {
    transform: translateY(-2px);
    background: var(--primary-dark);
    color: white;
}
.btn-continue {
    background: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
    padding: 0.7rem 1.8rem;
    border-radius: 2rem;
    font-weight: 600;
    transition: all 0.3s;
    text-decoration: none;
}
.btn-continue:hover {
    background: var(--primary);
    color: white;
}
.empty-cart {
    text-align: center;
    padding: 3rem;
    background: var(--white);
    border-radius: var(--radius-lg);
}
.empty-cart i {
    font-size: 4rem;
    color: var(--gray);
    margin-bottom: 1rem;
}

/* Cart section */
.cart-section {
    padding: 60px 0;
}

/* Desktop table styles */
.cart-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}
.cart-header {
    background: var(--primary);
    color: white;
    padding: 1rem 1.5rem;
    font-weight: 700;
}
.cart-table {
    margin-bottom: 0;
}
.cart-table th {
    background: var(--gray-light);
    border-bottom: 2px solid var(--primary);
    color: var(--dark);
    font-weight: 600;
}
.cart-table td {
    vertical-align: middle;
}
.cart-total {
    background: var(--white);
    padding: 1.5rem;
    border-top: 1px solid #e2e8f0;
    font-size: 1.2rem;
    font-weight: 700;
    text-align: right;
}
.cart-total span {
    color: var(--primary);
    font-size: 1.5rem;
}

/* Mobile card layout (hidden on desktop) */
.mobile-cart-items {
    display: none;
}
.mobile-cart-item {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    margin-bottom: 1rem;
    padding: 1rem;
    display: flex;
    gap: 1rem;
    align-items: center;
}
.mobile-cart-item-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: var(--radius);
}
.mobile-cart-item-details {
    flex: 1;
}
.mobile-cart-item-title {
    font-weight: 700;
    margin-bottom: 0.25rem;
}
.mobile-cart-item-price {
    color: var(--primary);
    font-weight: 700;
}
.mobile-cart-item-remove {
    background: none;
    border: none;
    color: #dc3545;
    font-size: 1.2rem;
    cursor: pointer;
}
.mobile-cart-total {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1rem;
    margin-top: 1rem;
    text-align: center;
    font-weight: 700;
    font-size: 1.2rem;
}
.mobile-cart-total span {
    color: var(--primary);
    font-size: 1.4rem;
}

/* Action buttons */
.cart-actions {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
    justify-content: space-between;
    flex-wrap: wrap;
}
.cart-actions .btn-continue,
.cart-actions .btn-enroll-now {
    flex: 1;
    text-align: center;
    min-width: 160px;
}
@media (max-width: 768px) {
    .cart-actions {
        flex-direction: column;
    }
    .cart-actions .btn-continue,
    .cart-actions .btn-enroll-now {
        width: 100%;
    }
    /* Hide table on mobile, show cards */
    .desktop-table-view {
        display: none;
    }
    .mobile-cart-items {
        display: block;
    }
}
@media (min-width: 769px) {
    .desktop-table-view {
        display: block;
    }
    .mobile-cart-items {
        display: none;
    }
}
</style>
@endpush

@section('content')
<!-- Breadcrumb (same as before) -->
<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Shopping Cart</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses') }}">Courses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Cart Content -->
<section class="cart-section">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        @if(count($courses) > 0)
            <!-- Desktop table view -->
            <div class="desktop-table-view">
                <div class="cart-card">
                    <div class="cart-header">
                        <i class="fas fa-shopping-cart me-2"></i> Your Cart Items
                    </div>
                    <div class="table-responsive">
                        <table class="table cart-table mb-0">
                            <thead>
                                <tr><th>Course</th><th>Price</th><th width="120">Action</th></tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <td><strong>{{ $course->fullname }}</strong><div class="small text-muted">{{ Str::limit(strip_tags($course->summary), 100) }}</div></td>
                                    <td class="fw-bold text-primary">${{ number_format($course->price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $course->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i> Remove</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-total">Total: <span>${{ number_format($total, 2) }}</span></div>
                </div>
            </div>

            <!-- Mobile card view -->
            <div class="mobile-cart-items">
                @foreach($courses as $course)
                <div class="mobile-cart-item">
                    <img src="{{ $course->image_url ?? asset('assets/img/course-placeholder.jpg') }}" class="mobile-cart-item-img" alt="{{ $course->fullname }}">
                    <div class="mobile-cart-item-details">
                        <div class="mobile-cart-item-title">{{ $course->fullname }}</div>
                        <div class="mobile-cart-item-price">${{ number_format($course->price, 2) }}</div>
                    </div>
                    <form action="{{ route('cart.remove', $course->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="mobile-cart-item-remove"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
                @endforeach
                <div class="mobile-cart-total">
                    Total: <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="cart-actions">
                <a href="{{ route('courses') }}" class="btn-continue">
                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                </a>
                <!-- <form action="{{ route('checkout') }}" method="POST" style="flex:1">
                    @csrf
                    <button type="submit" class="btn-enroll-now w-100">
                        <i class="fas fa-credit-card me-2"></i> Proceed to Checkout
                    </button>
                </form> -->
                <a href="{{ route('cart.process') }}" class="btn-enroll-now w-100">
                    Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        @else
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Your cart is empty</h3>
                <p>Looks like you haven't added any courses to your cart yet.</p>
                <a href="{{ route('courses') }}" class="btn-enroll-now">Browse Courses</a>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script> AOS.init({ duration: 800, once: true, offset: 100, easing: 'ease-out-quad' }); </script>
@endpush