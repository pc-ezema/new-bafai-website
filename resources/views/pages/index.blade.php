@extends('layouts.header')

@section('title', 'BAFAI - Master Skills, Advance Your Career')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="{{ url('assets/css/index.css') }}">
@endpush

@section('content')
<!-- Banner Section -->
<section class="banner-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="banner-content" data-aos="fade-right" data-aos-duration="800">
                    <div class="hero-badge">Bloom Academy for Artificial Intelligence</div>
                    <h1>Learn <span class="gradient-text">Artificial Intelligence</span> from Industry Experts</h1>
                    <p>We bridge the global AI skills gap through accessible, no-code-required education. Our global experts and real-world practitioners will equip you to earn your place in an AI-powered world.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('about-us') }}" class="btn btn-primary-custom">Learn More</a>
                        <a href="{{ route('courses') }}" class="btn btn-outline-custom">See Courses</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mt-4 mt-lg-0">
                <div class="media-side-by-side" data-aos="zoom-in" data-aos-duration="800">
                    <div class="media-card">
                        <div class="media-thumbnail">
                            <img src="{{ asset('assets/img/bafai-8-1024x683.jpeg') }}" alt="Watch Intro Video">
                            <div class="play-btn">
                                <a href="https://www.youtube.com/watch?v=JmE1HhXTomI" data-fancybox><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="media-card">
                        <div class="media-thumbnail">
                            <img src="{{ asset('assets/img/bafai-7-1024x682.jpg') }}" alt="Global Community">
                        </div>
                    </div>
                </div>
                <div class="top-courses-carousel" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0"><i class="fas fa-fire"></i> Top Rated Courses</h6>
                        <a href="{{ route('courses') }}" class="small" style="text-decoration: none;">View All <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="swiper coursesSwiper">
                        <div class="swiper-wrapper">
                            @foreach($topCourses as $course)
                                @php
                                    $imageUrl = ($course->image_hash && $course->image_filename) 
                                        ? route('moodle.file', ['hash' => $course->image_hash, 'filename' => $course->image_filename])
                                        : asset('assets/img/course-placeholder.jpg');
                                @endphp
                                <div class="swiper-slide">
                                    <div class="mini-course-card">
                                        <div class="mini-course-img">
                                            <img src="{{ $imageUrl }}" alt="{{ $course->fullname }}">
                                            @if($course->has_discount)
                                                <span class="discount-badge">-{{ $course->savings_percent }}%</span>
                                            @endif
                                        </div>
                                        <div class="mini-course-content">
                                            <h6 class="mini-course-title">{{ Str::limit($course->fullname, 40) }}</h6>
                                            <div class="mini-course-price-wrap">
                                                <div class="price-display">
                                                    @if($course->has_discount)
                                                        <span class="original-price small text-muted text-decoration-line-through">
                                                            {{ $course->currency }} {{ number_format($course->original_price, 2) }}
                                                        </span>
                                                        <span class="discounted-price fw-bold text-success">
                                                            {{ $course->currency }} {{ number_format($course->price, 2) }}
                                                        </span>
                                                    @elseif($course->price > 0)
                                                        <span class="regular-price-grid fw-bold">
                                                            {{ $course->currency }} {{ number_format($course->price, 2) }}
                                                        </span>
                                                    @else
                                                        <span class="regular-price-grid fw-bold text-success">Free</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('course-details', $course->id) }}" class="btn btn-sm-custom">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Us -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <div class="about-image">
                    <img src="{{ asset('assets/img/1000265302.jpg') }}" alt="About BAFAI" class="img-fluid">
                    <div class="play-btn">
                        <a href="https://www.youtube.com/watch?v=Ja-v4QQAA-8" data-fancybox><i class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800">
                <div class="section-header text-start mb-3">
                    <h2 class="text-start">Bloom Academy For Artificial Intelligence (BAFAI)</h2>
                </div>
                <p>BAFAI is an innovative platform that empowers individuals and organisations to thrive in the age of AI. By harnessing modern technology and machine learning, we equip our learners with the knowledge and skills needed to launch or accelerate their careers or businesses.</p>
                <p>At BAFAI, our modules are filled with real-life case studies, experiences from industry experts, and project-based learning. We help you see the "why" and "how" of AI, and empower you with tools to upskill your work and career. We have partnered with international organisations to help our graduates match their skills to in-demand jobs globally.</p>
                <ul class="about-list">
                    <li><i class="fas fa-check-circle"></i> 10+ qualified instructors from all over the world</li>
                    <li><i class="fas fa-check-circle"></i> Heavily discounted access to world-class AI education</li>
                    <li><i class="fas fa-check-circle"></i> Courses designed to help you secure or keep a job</li>
                    <li><i class="fas fa-check-circle"></i> Earn that new role, or that next promotion at work</li>
                    <li><i class="fas fa-check-circle"></i> Become an AI entrepreneur</li>
                    <li><i class="fas fa-check-circle"></i> Get a BAFAI certificate!</li>
                </ul>
                <div class="d-flex gap-3 mt-4">
                    <a href="{{ route('courses') }}" class="btn btn-primary-custom">Explore Courses</a>
                    <a href="{{ route('faculty') }}" class="btn btn-outline-custom">Meet Our Mentors</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why BAFAI -->
<section class="why-bafai-section">
    <div class="container">
        <div class="section-header" data-aos="zoom-in-up" data-aos-duration="800">
            <h2>Learn More Skills, Be More Competent & Competitive</h2>
            <p>BAFAI is committed to providing its students with the best possible education and support. Our experienced instructors and resources ensure your success.</p>
        </div>
        <div class="feature-grid" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="100">
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-clock"></i></div>
                <h4>Self-Paced + Live Classes</h4>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-certificate"></i></div>
                <h4>Certificate Awarded</h4>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-comments"></i></div>
                <h4>Online Forum</h4>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-hand-sparkles"></i></div>
                <h4>Soft Skills</h4>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-project-diagram"></i></div>
                <h4>Project Work</h4>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-users"></i></div>
                <h4>Networking Event</h4>
            </div>
        </div>
    </div>
</section>

<!-- Courses Grid -->
<section class="courses-grid-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>Explore Our Top AI & Tech Courses</h2>
            <p>Start your learning journey with our most popular programs</p>
        </div>
        <div class="row g-4">
            @foreach($featuredCourses as $key => $course)
                @php
                    // Build image URL
                    if($course->image_hash && $course->image_filename) {
                        $imageUrl = route('moodle.file', [
                            'hash' => $course->image_hash,
                            'filename' => $course->image_filename
                        ]);
                    } else {
                        $imageUrl = asset('assets/img/course-placeholder.jpg');
                    }
                @endphp
                <div class="col-md-6 col-lg-4" data-aos="flip-up" data-aos-duration="800" data-aos-delay="{{ 100 + ($key * 100) }}">
                    <div class="course-card">
                        <div class="course-img">
                            <img src="{{ $imageUrl }}" alt="{{ $course->fullname }}">
                            @if($course->has_discount)
                                <span class="discount-badge-grid">-{{ $course->savings_percent }}%</span>
                            @endif
                        </div>
                        <div class="course-content">
                            <h5 class="course-title">{{ Str::limit($course->fullname, 50) }}</h5>
                            <p class="text-muted small">{{ Str::limit(strip_tags($course->summary), 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price-display-grid">
                                    @if($course->has_discount)
                                        <span class="original-price-grid text-muted text-decoration-line-through">
                                            {{ $course->currency }} {{ number_format($course->original_price, 2) }}
                                        </span>
                                        <span class="discounted-price-grid text-success fw-bold">
                                            {{ $course->currency }} {{ number_format($course->price, 2) }}
                                        </span>
                                    @elseif($course->price > 0)
                                        <span class="regular-price-grid fw-bold">
                                            {{ $course->currency }} {{ number_format($course->price, 2) }}
                                        </span>
                                    @else
                                        <span class="regular-price-grid fw-bold text-success">Free</span>
                                    @endif
                                </div>
                                <a href="{{ route('course-details', $course->id) }}" class="btn btn-outline-primary-custom">
                                    View Details <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="view-more-wrapper mt-5 text-center" data-aos="fade-up" data-aos-duration="800">
            <a href="{{ route('courses') }}" class="btn btn-primary-custom">See All Courses <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Get Started Section -->
<section class="get-started-section">
    <div class="container">
        <div class="get-started-wrapper" data-aos="fade-up" data-aos-duration="800">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="get-started-content">
                        <h2 class="display-5 fw-bold mb-4">Start Your <span class="gradient-text">Course Today!</span></h2>
                        <p class="lead mb-4">At BAFAI, we're not just teaching Artificial Intelligence, we're building a movement of innovators, problem-solvers, and leaders.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ url('/register') }}" class="btn btn-primary-custom btn-lg">Join Cohort <i class="fas fa-arrow-right ms-2"></i></a>
                            <a href="https://learn.bafai.ai/login/index.php" class="btn btn-outline-custom btn-lg">Sign In <i class="fas fa-user ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="get-started-media position-relative rounded-4 overflow-hidden shadow-lg">
                        <img src="{{ asset('assets/img/10-1024x726.png') }}" alt="Get Started" class="img-fluid w-100">
                        <div class="video-play-btn">
                            <a href="https://www.youtube.com/embed/1trvO6dqQUI" data-fancybox>
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section - Fixed Slider (with destroy/re-init logic) -->
<section class="partners-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>We Collaborate with Industry Leaders</h2>
            <p>Join thousands of learners who trust our partner organizations</p>
        </div>
        <div class="partners-swiper-container" data-aos="fade-up" data-aos-duration="800">
            <div class="swiper partnersSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/digital-encode.png') }}" alt="Digital Encode"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/progital.png') }}" alt="Progital"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/tech-1m.png') }}" alt="Tech 1M"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/topas-hub.png') }}" alt="Topas Hub"></div>
                    </div>
                    <!-- Duplicate for smoother infinite loop -->
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/digital-encode.png') }}" alt="Digital Encode"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/progital.png') }}" alt="Progital"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/tech-1m.png') }}" alt="Tech 1M"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/topas-hub.png') }}" alt="Topas Hub"></div>
                    </div>
                    <!-- Duplicate for smoother infinite loop -->
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/digital-encode.png') }}" alt="Digital Encode"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/progital.png') }}" alt="Progital"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/tech-1m.png') }}" alt="Tech 1M"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/topas-hub.png') }}" alt="Topas Hub"></div>
                    </div>
                    <!-- Duplicate for smoother infinite loop -->
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/digital-encode.png') }}" alt="Digital Encode"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/progital.png') }}" alt="Progital"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/tech-1m.png') }}" alt="Tech 1M"></div>
                    </div>
                    <div class="swiper-slide">
                        <div class="partner-item"><img src="{{ asset('assets/img/partners/topas-hub.png') }}" alt="Topas Hub"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>What Our Learners Say</h2>
            <p>Real experiences from our community of achievers</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="testimonial-card">
                    <div class="quote-icon">“</div>
                    <p class="testimonial-text">The course has had a meaningful impact on my studies as a student, especially in how I organise and complete my academic tasks. The course has made my study process smarter, faster, and more structured. This really was of great help to me during my last medical board examination.</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">OP</div>
                        <div>
                            <h5>Okurame Patricia Efeoghene</h5>
                            <p>Certificate in AI Task Management – Medical Student</p>
                            <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <div class="testimonial-card">
                    <div class="quote-icon">“</div>
                    <p class="testimonial-text">As the Head of Marketing, this course on AI Task Management has had a significant impact on my workflow and overall productivity. By integrating AI-driven planning tools into my daily operations, I’ve been able to improve campaign turnaround time, enhance team coordination, and make more data-backed decisions.</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">JW</div>
                        <div>
                            <h5>Judah Wisdom Abiola</h5>
                            <p>Certificate in AI Task Management – Head of Marketing</p>
                            <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <div class="testimonial-card">
                    <div class="quote-icon">“</div>
                    <p class="testimonial-text">My experience at BAFAI was a good blend of exciting, intriguing, and educational. I got to learn how integrated AI has gotten into various industries and aspects of life, amongst many other things. I also love the structure of the program; we were given quizzes at the end of each module, which made it easier for the lessons to stick better. Big ups to BAFAI Academy. I had a great learning experience.</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">TM</div>
                        <div>
                            <h5>Tamara Margaret Adedapo</h5>
                            <p>Certificate in AI Task Management – AI Enthusiast</p>
                            <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="view-more-wrapper mt-5 text-center" data-aos="fade-up" data-aos-duration="800"><a href="#" class="btn btn-outline-custom">View More Testimonials <i class="fas fa-arrow-right ms-2"></i></a></div>
    </div>
</section>

<!-- FAQ -->
<div class="faq-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="faq-img" data-aos="fade-right" data-aos-duration="800" data-aos-easing="ease-out-back"><img class="img-fluid rounded-4" src="{{ asset('assets/img/bafai-9.jpg') }}" alt="faq"></div>
            </div>
            <div class="col-lg-6">
                <div class="faq-content">
                    <div class="section-header text-start" data-aos="fade-left" data-aos-duration="800">
                        <h2 class="text-start">Frequently Asked Questions</h2>
                        <p>Explore detailed answers to the most common questions about our platform.</p>
                    </div>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">How do I enroll in a course?</button></h2>
                            <div id="faq1" class="accordion-collapse collapse show">
                                <div class="accordion-body">Simply browse our course catalog, select your desired course, and click "Enroll Now". You'll be guided through the registration process.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">How long do I have access to a course?</button></h2>
                            <div id="faq2" class="accordion-collapse collapse">
                                <div class="accordion-body">You get lifetime access to all purchased courses. Learn at your own pace, anytime, anywhere.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">What payment methods are accepted?</button></h2>
                            <div id="faq3" class="accordion-collapse collapse">
                                <div class="accordion-body">We accept all major credit cards, PayPal, and various local payment methods depending on your region.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Global variable to hold partners swiper instance
    let partnersSwiper = null;

    function initSwiper() {
        // Top Courses Carousel
        new Swiper('.coursesSwiper', {
            slidesPerView: 1.2,
            spaceBetween: 25,
            freeMode: { enabled: true, sticky: false, momentum: true },
            grabCursor: true,
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            breakpoints: {
                480: { slidesPerView: 1.5, spaceBetween: 20 },
                768: { slidesPerView: 1.8, spaceBetween: 25 },
                992: { slidesPerView: 2.2, spaceBetween: 25 },
                1200: { slidesPerView: 2.5, spaceBetween: 30 }
            }
        });

        // Destroy existing partners swiper if it exists
        if (partnersSwiper) {
            partnersSwiper.destroy(true, true);
        }

        // Initialize partners swiper
        partnersSwiper = new Swiper('.partnersSwiper', {
            slidesPerView: 'auto',
            spaceBetween: 24,
            loop: true,
            loopAdditionalSlides: 8,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
                stopOnLastSlide: false,
            },
            speed: 8000,
            allowTouchMove: true,
            freeMode: false,
            simulateTouch: true,
            grabCursor: true,
            breakpoints: {
                0: { spaceBetween: 12 },
                640: { spaceBetween: 20 },
                1024: { spaceBetween: 24 }
            }
        });

        // Pause on hover
        const swiperContainer = document.querySelector('.partnersSwiper');
        if (swiperContainer) {
            swiperContainer.removeEventListener('mouseenter', () => partnersSwiper?.autoplay?.stop());
            swiperContainer.removeEventListener('mouseleave', () => partnersSwiper?.autoplay?.start());
            swiperContainer.addEventListener('mouseenter', () => partnersSwiper?.autoplay?.stop());
            swiperContainer.addEventListener('mouseleave', () => partnersSwiper?.autoplay?.start());
        }
    }

    function initPage() {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-quad'
        });
        Fancybox.bind('[data-fancybox]');
        initSwiper();
    }

    // Run on initial load
    document.addEventListener('DOMContentLoaded', initPage);

    // If your app uses Turbolinks / Turbo / Livewire / hotwired, also run on page:load or turbo:load
    window.addEventListener('load', function() {
        // Re-init swiper in case of cached page
        if (partnersSwiper) partnersSwiper.destroy(true, true);
        initSwiper();
    });

    // For Turbolinks (classic)
    document.addEventListener('turbolinks:load', function() {
        if (partnersSwiper) partnersSwiper.destroy(true, true);
        initSwiper();
    });

    // For Turbo (modern)
    document.addEventListener('turbo:load', function() {
        if (partnersSwiper) partnersSwiper.destroy(true, true);
        initSwiper();
    });
</script>
@endpush