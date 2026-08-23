@extends('layouts.header')

@section('title', 'BAFAI - Explore Our AI Courses')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
    --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    --radius: 0.75rem;
    --radius-lg: 1rem;
}

body { font-size: 15px; line-height: 1.5; background: var(--gray-light); }

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

/* Section header */
.section-header {
    text-align: center;
    margin-bottom: 2rem;
}
.section-header h2 {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    display: inline-block;
    margin-bottom: 0.5rem;
}
.section-header p {
    color: var(--gray);
    font-size: 0.95rem;
}

/* Courses page layout */
.courses-page {
    padding: 60px 0;
}
.courses-sidebar {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    position: sticky;
    top: 20px;
}
.filter-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary);
    display: inline-block;
}
.filter-group {
    margin-bottom: 1.5rem;
}
.filter-group h4 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: var(--dark);
}
.filter-group ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.filter-group ul li {
    margin-bottom: 0.5rem;
}
.filter-group ul li a {
    color: var(--gray);
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s;
    display: block;
    padding: 0.2rem 0;
}
.filter-group ul li a:hover,
.filter-group ul li a.active {
    color: var(--primary);
    font-weight: 600;
    transform: translateX(5px);
}
.price-range {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
}
.price-range input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius);
    font-size: 0.8rem;
}
.btn-filter {
    background: var(--primary);
    color: white;
    border: none;
    padding: 0.6rem;
    border-radius: 2rem;
    font-weight: 600;
    width: 100%;
    transition: all 0.3s;
}
.btn-filter:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

/* Course cards grid */
.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.8rem;
}
.course-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.course-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}
.course-img {
    height: 180px;
    overflow: hidden;
    position: relative;
}
.course-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}
.course-card:hover .course-img img {
    transform: scale(1.05);
}
.course-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: var(--secondary);
    color: white;
    font-size: 0.7rem;
    padding: 0.2rem 0.6rem;
    border-radius: 2rem;
    font-weight: 600;
}
.course-content {
    padding: 1.2rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.course-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    line-height: 1.4;
}
.course-instructor {
    font-size: 0.75rem;
    color: var(--gray);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 5px;
}
.course-rating {
    font-size: 0.75rem;
    color: #fbbf24;
    margin-bottom: 0.5rem;
}
/* 🟢 Refined Price Styling */
.course-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: auto;
    padding-top: 0.8rem;
    border-top: 1px solid #e9ecef;
}
.price-display {
    display: flex;
    flex-direction: column;
    line-height: 1.3;
}
.price-original {
    font-size: 0.8rem;
    color: #94a3b8;
    text-decoration: line-through;
    margin-bottom: 0.1rem;
}
.price-discounted {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--secondary);
}
.price-single {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--primary);
}
.save-badge {
    font-size: 0.65rem;
    padding: 0.2rem 0.5rem;
    border-radius: 20px;
    background: #dc3545;
    color: white;
    font-weight: 600;
    margin-left: 0.5rem;
    vertical-align: middle;
}
.btn-enroll {
    flex-shrink: 0;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    padding: 0.4rem 1rem;
    border-radius: 2rem;
    font-size: 0.75rem;
    font-weight: 600;
    transition: all 0.2s;
    text-decoration: none;
    white-space: nowrap;
}
.btn-enroll:hover {
    transform: scale(1.02);
    background: var(--primary-dark);
    color: white;
}

/* Pagination */
.pagination-wrapper {
    margin-top: 3rem;
    text-align: center;
}
.pagination {
    display: inline-flex;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
}
.pagination li a,
.pagination li span {
    display: block;
    padding: 0.5rem 1rem;
    background: var(--white);
    border-radius: var(--radius);
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s;
}
.pagination li.active span {
    background: var(--primary);
    color: white;
}
.pagination li a:hover {
    background: var(--primary);
    color: white;
}

/* Responsive */
@media (max-width: 991px) {
    .breadcrumb-bar { padding: 60px 0; }
    .breadcrumb-bar .breadcrumb-title { font-size: 2.5rem; }
    .courses-sidebar { margin-bottom: 2rem; position: static; }
}
@media (max-width: 768px) {
    .breadcrumb-bar { padding: 50px 0; clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%); }
    .breadcrumb-bar .breadcrumb-title { font-size: 2rem; }
    .courses-page { padding: 40px 0; }
    .courses-grid { grid-template-columns: 1fr; }
}
@media (max-width: 576px) {
    .breadcrumb-bar .breadcrumb-title { font-size: 1.6rem; }
}
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Our Courses</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Courses</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Courses Page Content -->
<section class="courses-page">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>Explore Our AI & Tech Courses</h2>
            <p>Start your learning journey with our most popular programs</p>
        </div>
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3" data-aos="fade-right" data-aos-delay="100">
                <div class="courses-sidebar">
                    <div class="filter-title">Categories</div>
                    <div class="filter-group">
                        <ul>
                            <li>
                                <a href="{{ route('courses') }}" 
                                   class="{{ !$selectedCategory ? 'active' : '' }}">
                                    All Courses
                                </a>
                            </li>
                            @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('courses', ['category' => $cat->id]) }}" 
                                   class="{{ $selectedCategory == $cat->id ? 'active' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter-group">
                        <h4>Price Range</h4>
                        <div class="price-range">
                            <input type="text" placeholder="Min" value="0">
                            <input type="text" placeholder="Max" value="500">
                        </div>
                    </div>
                    <div class="filter-group">
                        <h4>Level</h4>
                        <ul>
                            <li><a href="#">Beginner</a></li>
                            <li><a href="#">Intermediate</a></li>
                            <li><a href="#">Advanced</a></li>
                        </ul>
                    </div>
                    <button class="btn-filter">Apply Filters</button>
                </div>
            </div>

            <!-- Dynamic Course Grid -->
            <div class="col-lg-9" data-aos="fade-left" data-aos-delay="100">
                <div class="courses-grid">
                    @forelse($courses as $course)
                    <div class="course-card">
                        <div class="course-img">
                            @php
                                if($course->image_hash && $course->image_filename) {
                                    $imageUrl = route('moodle.file', [
                                        'hash' => $course->image_hash,
                                        'filename' => $course->image_filename
                                    ]);
                                } else {
                                    $imageUrl = asset('assets/img/course-placeholder.jpg');
                                }
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $course->fullname }}">
                            <span class="course-badge">Open</span>
                        </div>
                        <div class="course-content">
                            <h5 class="course-title">{{ Str::limit($course->fullname, 55) }}</h5>
                            <div class="course-instructor">
                                <i class="fas fa-tag"></i> 
                                {{ $course->category_name ?? 'Uncategorized' }}
                            </div>
                            <div class="course-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> 4.8
                            </div>

                            <!-- 🟢 PRICE BLOCK -->
                            <div class="course-price">
                                @php
                                    $enrolPrice = $course->enrol_price ?? 0;
                                    $originalPrice = $course->original_price ?? $enrolPrice;
                                    $discountedPrice = $course->discounted_price ?? null;
                                    $hasDiscount = !is_null($discountedPrice) && $discountedPrice > 0 && $discountedPrice < $originalPrice;
                                    if ($hasDiscount && $course->discount_ends_at && \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($course->discount_ends_at))) {
                                        $hasDiscount = false;
                                        $discountedPrice = null;
                                    }
                                    $finalPrice = $hasDiscount ? $discountedPrice : $originalPrice;
                                    $currency = $course->price_currency ?? $course->enrol_currency ?? 'USD';
                                    $savingsPercent = $hasDiscount ? round((($originalPrice - $discountedPrice) / $originalPrice) * 100) : 0;
                                @endphp
                                <div class="price-display">
                                    @if($hasDiscount)
                                        <span class="price-original">
                                            {{ $currency }} {{ number_format($originalPrice, 2) }}
                                        </span>
                                        <span class="price-discounted">
                                            {{ $currency }} {{ number_format($finalPrice, 2) }}
                                            <span class="badge bg-danger save-badge">Save {{ $savingsPercent }}%</span>
                                        </span>
                                    @else
                                        <span class="price-single">
                                            {{ $currency }} {{ number_format($finalPrice, 2) }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('course-details', $course->id) }}" class="btn-enroll">
                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                            <!-- END PRICE BLOCK -->

                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No courses found in this category.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $courses->appends(['category' => $selectedCategory])->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-out-quad'
    });
    // Simple filter placeholder
    $('.btn-filter').on('click', function() {
        alert('Filter functionality can be implemented with AJAX or backend logic.');
    });
</script>
@endpush