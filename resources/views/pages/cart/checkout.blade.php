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

/* Summary Card – Payment Options */
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

.payment-option {
    background: var(--gray-light);
    border-radius: var(--radius);
    padding: 1rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}
.payment-option:hover {
    border-color: var(--secondary);
    background: #ffffff;
    box-shadow: var(--shadow-sm);
}
.payment-option:last-child {
    margin-bottom: 0;
}

.payment-option .btn-pay {
    width: 100%;
    padding: 0.75rem;
    border: none;
    border-radius: 2rem;
    font-weight: 700;
    color: white;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.payment-option .btn-pay:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.payment-option .btn-pay i {
    font-size: 1.1rem;
}

.payment-option .amount-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 0.5rem;
    padding: 0.25rem 0.5rem;
    font-size: 0.9rem;
    color: var(--gray);
}
.payment-option .amount-info .currency-symbol {
    font-weight: 700;
    color: var(--dark);
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
    .payment-option .amount-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
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
                                        <th width="120">Price (USD)</th>
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
                            Total (USD): <span>${{ number_format($totalUSD, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="summary-card-header">
                        <i class="fas fa-credit-card"></i> Select Payment Method
                    </div>
                    <div class="summary-card-body">

                        <!-- 🔽 DISCOUNT CODE SECTION -->
                        <div class="discount-section mb-3 p-2 border rounded-3">
                            <div class="input-group">
                                <input type="text" id="discountInput" class="form-control" placeholder="Enter discount code" value="{{ session('discount_code') }}">
                                <button class="btn btn-outline-primary" id="applyDiscountBtn" type="button">Apply</button>
                            </div>
                            <div id="discountMessage" class="small mt-1"></div>
                            @if(session('discount_code'))
                                <div class="alert alert-success mt-2 mb-0">
                                    <strong>{{ session('discount_code') }}</strong> applied!
                                    <button class="btn btn-sm btn-link text-danger" id="removeDiscountBtn">Remove</button>
                                </div>
                            @endif
                        </div>

                        <!-- Paystack Option -->
                        <div class="payment-option">
                            <button type="button" class="btn-pay" id="paystackBtn" style="background: linear-gradient(135deg, #0a6b5c, #0a8b7c);">
                                <i class="fas fa-credit-card"></i> Pay with Paystack
                            </button>
                            <div class="amount-info">
                                <span>Amount in Naira</span>
                                <span class="currency-symbol">₦ {{ number_format($totalNaira, 2) }}</span>
                            </div>
                            @if(session('discount_code'))
                                <div class="amount-info small text-success">
                                    <span>Discount applied</span>
                                    <span>- ₦{{ number_format($discountAmountNaira, 2) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Stripe Option -->
                        <div class="payment-option">
                            <form action="#" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $stripeAmount }}">
                                <input type="hidden" name="courses" value="{{ json_encode($courses->pluck('id')->toArray()) }}">
                                <button type="submit" class="btn-pay" style="background: linear-gradient(135deg, #635bff, #4a3fcf);">
                                    <i class="fas fa-credit-card"></i> Pay with Stripe
                                </button>
                            </form>
                            <div class="amount-info">
                                <span>Amount in USD</span>
                                <span class="currency-symbol">$ {{ number_format($finalUSD, 2) }}</span>
                            </div>
                            @if(session('discount_code'))
                                <div class="amount-info small text-success">
                                    <span>Discount applied</span>
                                    <span>-${{ number_format($discountAmountUSD, 2) }}</span>
                                </div>
                            @endif
                        </div>

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
<!-- Paystack Inline Script -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const discountInput = document.getElementById('discountInput');
        const applyBtn = document.getElementById('applyDiscountBtn');
        const msgDiv = document.getElementById('discountMessage');
        const removeBtn = document.getElementById('removeDiscountBtn');

        if (applyBtn) {
            applyBtn.addEventListener('click', function() {
                const code = discountInput.value.trim();
                if (!code) {
                    msgDiv.innerHTML = '<span class="text-warning">Please enter a code.</span>';
                    return;
                }
                fetch('{{ route("cart.apply-discount") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ code: code })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        msgDiv.innerHTML = '<span class="text-danger">' + data.error + '</span>';
                    } else {
                        msgDiv.innerHTML = '<span class="text-success">' + data.success + '</span>';
                        window.location.reload();
                    }
                })
                .catch(() => {
                    msgDiv.innerHTML = '<span class="text-danger">An error occurred.</span>';
                });
            });
        }

        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                fetch('{{ route("cart.remove-discount") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                })
                .then(() => window.location.reload());
            });
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Paystack
        const paystackBtn = document.getElementById('paystackBtn');
        if (paystackBtn) {
            paystackBtn.addEventListener('click', function() {
                const amount = {{ $amountInKobo }};
                const email = "{{ Auth::user()->email ?? 'guest@example.com' }}";
                const ref = "{{ $paystackRef }}";
                const key = "{{ config('services.paystack.public_key') }}";

                const handler = PaystackPop.setup({
                    key: key,
                    email: email,
                    amount: amount,
                    ref: ref,
                    metadata: {
                        custom_fields: [{ display_name: "Cart", variable_name: "cart", value: JSON.stringify(@json($courses->pluck('id')->toArray())) }]
                    },
                    callback: function(response) {
                        const baseUrl = "{{ route('paystack.verify', ['reference' => 'REF']) }}";
                        window.location.href = baseUrl.replace('REF', response.reference);
                    },
                    onClose: function() {
                        alert('Payment window closed.');
                    }
                });
                handler.openIframe();
            });
        }
    });
</script>
@endpush