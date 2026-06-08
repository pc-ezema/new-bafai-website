@extends('layouts.header')

@section('title', $course->fullname . ' - BAFAI')

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

body {
    font-size: 15px;
    line-height: 1.5;
    background: var(--gray-light);
}

/* Breadcrumb (same as courses page) */
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

/* Course Details Main */
.course-details-section {
    padding: 60px 0;
}
.course-info-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    margin-bottom: 2rem;
}
.course-header {
    padding: 2rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.course-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 0.5rem;
}
.course-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.85rem;
    color: var(--gray);
}
.course-meta i {
    margin-right: 0.3rem;
    color: var(--primary);
}
.course-rating {
    color: #fbbf24;
    font-size: 0.9rem;
}
.course-price {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary);
}
.course-image {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
}
.course-description {
    padding: 2rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.course-description h3 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--dark);
}
.course-description p {
    color: var(--gray);
    line-height: 1.6;
}
.sidebar-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    position: sticky;
    top: 20px;
}
.sidebar-card .btn-enroll {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    padding: 0.8rem;
    border-radius: 2rem;
    font-weight: 700;
    width: 100%;
    margin-top: 1rem;
    transition: all 0.3s;
    text-align: center;
    display: inline-block;
    text-decoration: none;
}
.sidebar-card .btn-enroll:hover {
    transform: translateY(-2px);
    background: var(--primary-dark);
}
.course-features {
    list-style: none;
    padding: 0;
    margin-top: 1.5rem;
}
.course-features li {
    margin-bottom: 0.8rem;
    font-size: 0.9rem;
    color: var(--gray);
}
.course-features li i {
    width: 1.5rem;
    color: var(--secondary);
}
.curriculum-section, .instructor-section {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow-md);
    margin-bottom: 2rem;
}
.curriculum-section h3, .instructor-section h3 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--dark);
}
.curriculum-item {
    padding: 1rem 0;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.curriculum-item:last-child {
    border-bottom: none;
}
.curriculum-title {
    font-weight: 600;
}
.curriculum-duration {
    font-size: 0.8rem;
    color: var(--gray);
}
.instructor-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 1rem;
}
.instructor-name {
    font-size: 1.2rem;
    font-weight: 700;
}
.instructor-bio {
    color: var(--gray);
    margin-top: 0.5rem;
}

/* Responsive */
@media (max-width: 991px) {
    .breadcrumb-bar { padding: 60px 0; }
    .breadcrumb-bar .breadcrumb-title { font-size: 2.5rem; }
    .course-title { font-size: 1.8rem; }
}
@media (max-width: 768px) {
    .breadcrumb-bar { padding: 50px 0; clip-path: polygon(0 0, 100% 0, 100% 95%, 0 100%); }
    .breadcrumb-bar .breadcrumb-title { font-size: 2rem; }
    .course-header { padding: 1.5rem; }
    .course-description { padding: 1.5rem; }
}
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Course Details</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses') }}">Courses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($course->fullname, 40) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@php
    // Define image URL once for reuse
    if($course->image_hash && $course->image_filename) {
        $imageUrl = route('moodle.file', ['hash' => $course->image_hash, 'filename' => $course->image_filename]);
    } else {
        $imageUrl = asset('assets/img/course-placeholder.jpg');
    }
@endphp

<section class="course-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Mobile image -->
                <div class="d-lg-none mb-4">
                    <img src="{{ $imageUrl }}" class="course-image rounded" alt="{{ $course->fullname }}">
                </div>

                <div class="course-info-card">
                    <div class="course-header">
                        <h1 class="course-title">{{ $course->fullname }}</h1>
                        <div class="course-meta">
                            <span><i class="fas fa-folder"></i> {{ $course->category_name ?? 'Uncategorized' }}</span>
                            <span><i class="fas fa-user-graduate"></i> All Levels</span> <!-- removed $course->level -->
                            <span><i class="fas fa-clock"></i> Self-paced</span>
                            <span class="course-rating">
                                @php
                                    $fullStars = floor($avgRating);
                                    $halfStar = ($avgRating - $fullStars) >= 0.5;
                                    for($i = 0; $i < $fullStars; $i++) echo '<i class="fas fa-star"></i>';
                                    if($halfStar) echo '<i class="fas fa-star-half-alt"></i>';
                                    $emptyStars = 5 - ceil($avgRating);
                                    for($i = 0; $i < $emptyStars; $i++) echo '<i class="far fa-star"></i>';
                                @endphp
                                {{ $avgRating }} ({{ $ratingCount }} ratings)
                            </span>
                        </div>
                        <div class="course-price d-lg-none">${{ $price }}</div>
                    </div>
                    <div class="course-description">
                        <h3>About This Course</h3>
                        <div>{!! $course->summary !!}</div>
                    </div>
                </div>

                <!-- Curriculum -->
                <div class="curriculum-section" data-aos="fade-up">
                    <h3><i class="fas fa-book-open me-2"></i> Course Curriculum</h3>
                    @if($sections->count() > 0)
                        @foreach($sections as $section)
                            <div class="curriculum-item">
                                <div class="curriculum-title">
                                    {{ $section->section }}. {{ $section->name ?: 'Section ' . $section->section }}
                                </div>
                                <div class="curriculum-duration">
                                    @if($section->summary)
                                        <span class="text-muted small">{!! Str::words(strip_tags($section->summary), 10) !!}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Curriculum details will be available after enrollment.</p>
                    @endif
                </div>

                <!-- Instructor -->
                <div class="instructor-section" data-aos="fade-up">
                    <h3><i class="fas fa-chalkboard-teacher me-2"></i> Your Instructor</h3>
                    <div class="d-flex flex-wrap align-items-center">
                        @if($instructor && $instructor->picture)
                            @php
                                $instructorImage = route('moodle.userfile', [
                                    'userid' => $instructor->id,
                                    'hash' => $instructor->picture,
                                    'filename' => 'userpicture.jpg'  // Moodle stores as 'f1.jpg' or similar, adjust if needed
                                ]);
                            @endphp
                            <img src="{{ $instructorImage }}" class="instructor-avatar" alt="{{ $instructor->firstname }}">
                        @else
                            <img src="{{ asset('assets/img/avatar-placeholder.jpg') }}" class="instructor-avatar" alt="Instructor">
                        @endif
                        <div>
                            <div class="instructor-name">
                                {{ $instructor ? $instructor->firstname . ' ' . $instructor->lastname : 'BAFAI Team' }}
                            </div>
                            <div class="instructor-bio">
                                {{ $instructor ? ($instructor->imagealt ?? 'Expert instructor') : 'Industry expert with years of experience.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-card">
                    <img src="{{ $imageUrl }}" class="img-fluid rounded mb-3" alt="{{ $course->fullname }}">
                    <div class="course-price">${{ $price }}</div>
                    @if($inCart)
                        <a href="{{ route('cart.index') }}" class="btn-enroll w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Go to Cart
                        </a>
                    @else
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <button type="submit" class="btn-enroll w-100">
                                <i class="fas fa-cart-plus me-2"></i> Add to Cart
                            </button>
                        </form>
                    @endif
                    <ul class="course-features">
                        <li><i class="fas fa-video"></i> {{ $sections->count() }} sections</li>
                        <li><i class="fas fa-download"></i> Downloadable resources</li>
                        <li><i class="fas fa-certificate"></i> Certificate of completion</li>
                        <li><i class="fas fa-infinity"></i> Lifetime access</li>
                        <li><i class="fas fa-mobile-alt"></i> Mobile & Desktop access</li>
                    </ul>
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
</script>
@endpush