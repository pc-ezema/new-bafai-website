@extends('layouts.header')

@section('title', $post->title . ' - BAFAI')

@push('styles')
<style>
body {
    background: #f8fafc;
}
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
    font-size: 2.5rem;
    font-weight: 800;
}
.breadcrumb-bar .breadcrumb-item a,
.breadcrumb-bar .breadcrumb-item.active {
    color: white !important;
}
.breadcrumb-bar .breadcrumb-item a:hover { color: var(--secondary) !important; }
.breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before {
    color: white !important;
    content: "/";
}

.blog-post-section {
    padding: 60px 0;
}

.blog-post-card {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

/* --- IMPROVED IMAGE STYLES --- */
.blog-image-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #f1f5f9; /* fallback background */
}

.blog-post-image {
    display: block;
    width: 100%;
    height: auto;
    /* max-height: 450px; */
    object-fit: cover;
    object-position: center;
    transition: transform 0.6s ease;
}

/* Optional zoom effect on hover (subtle) */
.blog-image-wrapper:hover .blog-post-image {
    transform: scale(1.02);
}

/* Add a subtle gradient overlay at the bottom (optional) */
.blog-image-wrapper::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: linear-gradient(to top, rgba(0,0,0,0.08), transparent);
    pointer-events: none;
}

/* If the image is missing, show a placeholder with icon */
.blog-image-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 300px;
    background: #e2e8f0;
    color: #94a3b8;
    font-size: 3rem;
}
/* --- END IMAGE STYLES --- */

.blog-post-body {
    padding: 2.5rem;
}

.blog-post-meta {
    font-size: 0.9rem;
    color: #64748b;
    margin-bottom: 1rem;
}
.blog-post-meta i {
    margin-right: 0.3rem;
}

.blog-post-title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 1rem;
}

.blog-post-content {
    color: #1e293b;
    line-height: 1.8;
    font-size: 1.05rem;
}
.blog-post-content p {
    margin-bottom: 1.5rem;
}
.blog-post-content h2,
.blog-post-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.blog-post-content img {
    max-width: 100%;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
}
.blog-post-content ul,
.blog-post-content ol {
    margin: 1rem 0 1.5rem 1.5rem;
}
.blog-post-content blockquote {
    border-left: 4px solid #503a98;
    padding: 1rem 1.5rem;
    background: #f1f5f9;
    border-radius: 0 0.5rem 0.5rem 0;
    margin: 1.5rem 0;
    font-style: italic;
}

.back-to-blog {
    display: inline-block;
    margin-top: 2rem;
    color: #503a98;
    font-weight: 600;
    text-decoration: none;
}
.back-to-blog:hover {
    color: #3b2a73;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .blog-post-image {
        max-height: 280px;
    }
    .blog-post-body {
        padding: 1.5rem;
    }
    .blog-post-title {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="breadcrumb-bar text-center">
    <div class="container">
        <h2 class="breadcrumb-title mb-2">Blog Details</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($post->title, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="blog-post-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="blog-post-card">
                    @if($post->featured_image)
                        <img src="{{ asset('assets/img/blog/' . $post->featured_image) }}" class="blog-post-image" alt="{{ $post->title }}">
                    @endif
                    <div class="blog-post-body">
                        <div class="blog-post-meta">
                            <i class="fas fa-user"></i> {{ $post->author }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-calendar-alt"></i> {{ $post->published_at->format('F j, Y') }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-eye"></i> {{ $post->views }} views
                        </div>
                        <h1 class="blog-post-title">{{ $post->title }}</h1>
                        <div class="blog-post-content">
                            {!! $post->content !!}
                        </div>
                        <a href="{{ route('blog.index') }}" class="back-to-blog">
                            <i class="fas fa-arrow-left"></i> Back to Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection