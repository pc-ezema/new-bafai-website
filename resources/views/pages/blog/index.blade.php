@extends('layouts.header')

@section('title', 'Blog & News - BAFAI')

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

/* Blog Section */
.blog-section {
    padding: 60px 0;
}
.blog-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    height: 100%;
}
.blog-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-md);
}
.blog-image {
    /* height: 200px; */
    overflow: hidden;
    background: var(--gray-light);
    display: flex;
    align-items: center;
    justify-content: center;
}
.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.5s ease;
}
.blog-card:hover .blog-image img {
    transform: scale(1.05);
}
.blog-body {
    padding: 1.5rem;
}
.blog-meta {
    font-size: 0.8rem;
    color: var(--gray);
    margin-bottom: 0.5rem;
}
.blog-meta i {
    margin-right: 0.3rem;
}
.blog-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}
.blog-title a {
    color: var(--dark);
    text-decoration: none;
    transition: color 0.2s;
}
.blog-title a:hover {
    color: var(--primary);
}
.blog-excerpt {
    color: var(--gray);
    font-size: 0.9rem;
    line-height: 1.6;
}
.blog-read-more {
    display: inline-block;
    margin-top: 1rem;
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s;
}
.blog-read-more:hover {
    color: var(--primary-dark);
    transform: translateX(4px);
}
.blog-read-more i {
    margin-left: 0.3rem;
}
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Blog & News</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Blog Content -->
<section class="blog-section">
    <div class="container">
        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                    <div class="blog-card">
                        <div class="blog-image">
                            @if($post->featured_image)
                                <img src="{{ asset('assets/img/blog/' . $post->featured_image) }}" alt="{{ $post->title }}">
                            @else
                                <img src="{{ asset('assets/img/blog-placeholder.jpg') }}" alt="{{ $post->title }}">
                            @endif
                        </div>
                        <div class="blog-body">
                            <div class="blog-meta">
                                <i class="fas fa-user"></i> {{ $post->author }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar-alt"></i> {{ $post->published_at->format('F j, Y') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-eye"></i> {{ $post->views }} views
                            </div>
                            <h5 class="blog-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h5>
                            <p class="blog-excerpt">{{ $post->excerpt }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-read-more">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3>No blog posts found</h3>
                    <p>Check back soon for updates!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection

@push('scripts')
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