@extends('layouts.header')

@section('title', 'About BAFAI - Master AI Skills')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush

@section('content')
<!-- Breadcrumb with Parallax -->
@include('layouts.breadcrumb', ['title' => 'About BAFAI', 'breadcrumb' => 'About Us'])

<!-- Who We Are Section -->
<section class="who-we-are" id="WhoWeAre">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="100">
                <div class="section-header text-start">
                    <h2>Who We Are</h2>
                    <p>Bloom Academy for Artificial Intelligence (BAFAI) is empowering individuals and organisations to succeed in the age of AI. We offer accessible, world-class education tailored for learners across Africa, the Global South, and beyond.</p>
                    <p>Our mission is rooted in social impact – bridging the global digital divide through AI literacy, career upskilling, and practical innovation. As AI reshapes industries and job markets, BAFAI equips learners to adapt, compete, and lead. From addressing food insecurity with smart agriculture to improving healthcare, education, finance, and urban systems, AI has transformative potential in emerging economies. At BAFAI, we're not just teaching AI, we're empowering change-makers.</p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="about-image-wrapper">
                    <img class="img-fluid" src="{{ asset('assets/img/10-1024x726.png') }}" alt="BAFAI Team">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About the Program Section -->
<section class="about-program">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>About the Program</h2>
            <p>Most Affordable Online Courses for Everyone</p>
        </div>
        <div class="program-highlight" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
            <p>BAFAI offers flexible, expert-led training designed to build real-world AI skills. Our programs include masterclasses, on-demand video lessons, real-life case studies, and mentorship from industry leaders.</p>
            <p><strong>🌟 Starting with AI Literacy Track</strong> – a free, self-paced introduction to Artificial Intelligence, ideal for beginners and professionals exploring AI for the first time. On this track, learners gain:</p>
            <ul>
                <li>A strong foundation in AI, Machine Learning, and global ethical practices</li>
                <li>Practical examples across finance, health, education, agriculture, and diverse industries</li>
                <li>Insight into global and local AI career pathways</li>
            </ul>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary-custom">Get Started <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Why Learn with BAFAI? Section -->
<section class="why-bafai" id="WhyLearnWithBAFAI">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>Why Learn with BAFAI?</h2>
            <p>BAFAI offers a unique learning experience that combines international excellence with local relevance.</p>
        </div>
        <div class="benefit-grid">
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="100">
                <div class="benefit-icon"><i class="fas fa-globe"></i></div>
                <h4>Global & Local Expertise</h4>
                <p>BAFAI combines global expertise with local relevance, offering practical, industry-aligned AI education led by international experts and African innovators.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="200">
                <div class="benefit-icon"><i class="fas fa-laptop"></i></div>
                <h4>Flexible Learning Access</h4>
                <p>Our flexible, hybrid learning model includes on-demand lessons, live sessions, and hands-on projects accessible on mobile, tablet, or laptop.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="300">
                <div class="benefit-icon"><i class="fas fa-certificate"></i></div>
                <h4>Recognised Certification</h4>
                <p>Backed by global support from notable individuals, accreditation and global partnerships, BAFAI provides recognised certifications and career-ready skills.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="400">
                <div class="benefit-icon"><i class="fas fa-users"></i></div>
                <h4>Vibrant AI Community</h4>
                <p>Join a vibrant and global network of learners, mentors, and professionals building the future of Artificial Intelligence.</p>
            </div>
        </div>
    </div>
</section>

<!-- NEW STATS SECTION (BAFAI by the Numbers) -->
<section class="stats-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2 style="background: linear-gradient(135deg, #ffd89b, #ffb347); -webkit-background-clip: text; background-clip: text; color: transparent;">BAFAI by the Numbers</h2>
            <p style="color: rgba(255,255,255,0.85);">Making an impact through quality AI education</p>
        </div>
        <div class="stats-grid">
            <div class="stat-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="100">
                <div class="stat-icon">
                    <img src="{{ asset('assets/img/icons/course-icon.svg') }}" alt="Online Courses">
                </div>
                <div class="stat-number">10K</div>
                <div class="stat-label">Online Courses</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="200">
                <div class="stat-icon">
                    <img src="{{ asset('assets/img/icons/tutor-icon.svg') }}" alt="Expert Tutors">
                </div>
                <div class="stat-number">200+</div>
                <div class="stat-label">Expert Tutors</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="300">
                <div class="stat-icon">
                    <img src="{{ asset('assets/img/icons/certified-icon.svg') }}" alt="Certified Courses">
                </div>
                <div class="stat-number">6K+</div>
                <div class="stat-label">Certified Courses</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="400">
                <div class="stat-icon">
                    <img src="{{ asset('assets/img/icons/students-icon.svg') }}" alt="Online Students">
                </div>
                <div class="stat-number">60K+</div>
                <div class="stat-label">Online Students</div>
            </div>
        </div>
    </div>
</section>

<!-- Who Is This Program For? Section -->
<section class="target-audience">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>Who Is This Program For?</h2>
            <p>We welcome a dynamic and diverse community of learners driven by curiosity, ambition, and a desire to lead in the era of artificial intelligence. Our programs are designed to meet people where they are – regardless of background or experience – and help them grow into AI-literate professionals and innovators.</p>
        </div>
        <div class="audience-grid">
            <div class="audience-item" data-aos="zoom-in-up" data-aos-duration="500" data-aos-delay="50">
                <div class="audience-icon"><i class="fas fa-graduation-cap"></i></div>
                <h5>Students</h5>
                <p>Building foundational knowledge and future-ready skills from an early stage.</p>
            </div>
            <div class="audience-item" data-aos="zoom-in-up" data-aos-duration="500" data-aos-delay="100">
                <div class="audience-icon"><i class="fas fa-user-graduate"></i></div>
                <h5>Graduates</h5>
                <p>Bridging the gap between academic study and real-world AI applications.</p>
            </div>
            <div class="audience-item" data-aos="zoom-in-up" data-aos-duration="500" data-aos-delay="150">
                <div class="audience-icon"><i class="fas fa-briefcase"></i></div>
                <h5>Working Professionals</h5>
                <p>Offering opportunities to upskill, reskill, and lead in evolving industries.</p>
            </div>
            <div class="audience-item" data-aos="zoom-in-up" data-aos-duration="500" data-aos-delay="200">
                <div class="audience-icon"><i class="fas fa-chalkboard-user"></i></div>
                <h5>Educators</h5>
                <p>Empowering teachers and academic leaders to bring AI into the classroom and learning environments.</p>
            </div>
            <div class="audience-item" data-aos="zoom-in-up" data-aos-duration="500" data-aos-delay="250">
                <div class="audience-icon"><i class="fas fa-lightbulb"></i></div>
                <h5>Entrepreneurs</h5>
                <p>Enabling bold thinkers to harness AI in launching and scaling innovative ventures.</p>
            </div>
            <div class="audience-item" data-aos="zoom-in-up" data-aos-duration="500" data-aos-delay="300">
                <div class="audience-icon"><i class="fas fa-chart-line"></i></div>
                <h5>Career Changers</h5>
                <p>Opening pathways for individuals from all fields – technical or non-technical – to pivot confidently into the world of AI.</p>
            </div>
        </div>
    </div>
</section>

<!-- Optional: Remove the old counter-sec if you want only this new stats section -->
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
        easing: 'ease-out-quad',
        mirror: false
    });
</script>
@endpush