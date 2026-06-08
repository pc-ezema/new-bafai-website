@extends('layouts.header')

@section('title', 'BAFAI - Testimonials | What Our Learners Say')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/testimonials.css') }}">
@endpush

@section('content')
<!-- Breadcrumb -->
@include('layouts.breadcrumb', ['title' => 'Testimonials', 'breadcrumb' => 'Testimonials'])

<!-- Testimonials Grid Section -->
<section class="testimonials-page">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>What Our Learners Say</h2>
            <p>Real experiences from our community of AI achievers</p>
        </div>

        <div class="testimonials-grid">
            <!-- Testimonial 1: Okurame Patricia Efeoghene -->
            <div class="testimonial-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                <div class="testimonial-avatar">OP</div>
                <h3 class="testimonial-name">Okurame Patricia Efeoghene</h3>
                <div class="testimonial-track">Track 2 – Medical Student</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">The course has had a meaningful impact on my studies as a student, especially in how I organise and complete my academic tasks. The course has made my study process smarter, faster, and more structured. This really was of great help to me during my last medical board examination.</p>
            </div>

            <!-- Testimonial 2: Judah Wisdom Abiola -->
            <div class="testimonial-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="150">
                <div class="testimonial-avatar">JW</div>
                <h3 class="testimonial-name">Judah Wisdom Abiola</h3>
                <div class="testimonial-track">Track 2 – Head of Marketing</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">As the Head of Marketing, this course on AI Task Management has had a significant impact on my workflow and overall productivity. By integrating AI-driven planning tools into my daily operations, I’ve been able to improve campaign turnaround time, enhance team coordination, and make more data-backed decisions.</p>
            </div>

            <!-- Testimonial 3: Tamara Margaret Adedapo -->
            <div class="testimonial-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                <div class="testimonial-avatar">TM</div>
                <h3 class="testimonial-name">Tamara Margaret Adedapo</h3>
                <div class="testimonial-track">Track 2 – AI Enthusiast</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">My experience at BAFAI was a good blend of exciting, intriguing and educative. I got to learn how integrated AI has gotten into various industries and aspect of life amongst many other things. I also love the structure of the program, we were given quizzes at the end of each module, which made it easy for lessons to stick better. Big ups to BAFAI Academy. I had a great learning experience.</p>
            </div>

            <!-- Testimonial 4: Adeyemi Oluwarinumi Olajumoke -->
            <div class="testimonial-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="250">
                <div class="testimonial-avatar">AO</div>
                <h3 class="testimonial-name">Adeyemi Oluwarinumi Olajumoke</h3>
                <div class="testimonial-track">Track 1 – AI Beginner</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">BAFAI is one of the best online platform that has exposed me more to the knowledge and use of Artificial intelligence. I would recommend the program to everyone in my circle so that they can stand tall in their areas of influence.</p>
            </div>

            <!-- Testimonial 5: Oni Boluwatife -->
            <div class="testimonial-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                <div class="testimonial-avatar">OB</div>
                <h3 class="testimonial-name">Oni Boluwatife</h3>
                <div class="testimonial-track">Track 1 – AI Explorer</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">Initially, I thought I might have difficulty understanding the concept of AI, but after undergoing the track 1 course from BAFAI, I became more curious to learn more about what AI is about and how we can use it in different sectors.</p>
            </div>

            <!-- Testimonial 6: Oluwagbile Praise -->
            <div class="testimonial-card" data-aos="fade-up" data-aos-duration="600" data-aos-delay="350">
                <div class="testimonial-avatar">OP</div>
                <h3 class="testimonial-name">Oluwagbile Praise</h3>
                <div class="testimonial-track">Track 1 – AI Student</div>
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">My experience at BAFAI was absolutely wonderful, the instructor was such a wonderful tutor and the materials were so self explanatory, the technical staff too were very helpful and they aided my journey and made it seamless and easy, definitely coming back for the full course next month!</p>
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