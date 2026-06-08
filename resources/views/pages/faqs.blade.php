@extends('layouts.header')

@section('title', 'BAFAI - Frequently Asked Questions')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/faqs.css') }}">
@endpush

@section('content')
<!-- Breadcrumb -->
@include('layouts.breadcrumb', ['title' => 'Frequently Asked Questions', 'breadcrumb' => 'FAQ'])

<!-- FAQ Section -->
<section class="faq-page">
    <div class="container">
        <div class="row g-4">
            <!-- Left Sidebar - Category Tabs -->
            <div class="col-lg-4" data-aos="fade-right" data-aos-duration="800">
                <div class="nav nav-pills nav-pills-custom flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab">
                        <i class="fas fa-question-circle"></i> General Questions
                    </button>
                    <button class="nav-link" id="v-pills-courses-tab" data-bs-toggle="pill" data-bs-target="#v-pills-courses" type="button" role="tab">
                        <i class="fas fa-book-open"></i> Courses & Learning
                    </button>
                    <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab">
                        <i class="fas fa-credit-card"></i> Payment & Billing
                    </button>
                    <button class="nav-link" id="v-pills-tech-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tech" type="button" role="tab">
                        <i class="fas fa-headset"></i> Technical Support
                    </button>
                </div>
            </div>

            <!-- Right Side - FAQ Accordion Content -->
            <div class="col-lg-8" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- General Questions Category -->
                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                        <div class="faq-accordion-wrapper">
                            <div class="category-header">
                                <h3>General Questions</h3>
                                <p>Everything you need to know about BAFAI platform</p>
                            </div>
                            <div class="accordion accordion-faq" id="accordionGeneral">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#general1">
                                            What is BAFAI?
                                        </button>
                                    </h2>
                                    <div id="general1" class="accordion-collapse collapse show" data-bs-parent="#accordionGeneral">
                                        <div class="accordion-body">
                                            BAFAI (Bloom Academy for Artificial Intelligence) is an online learning platform that makes AI education accessible to everyone. We offer expert-led courses, hands-on projects, and mentorship to help learners master AI skills and advance their careers.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general2">
                                            Who can enroll in BAFAI courses?
                                        </button>
                                    </h2>
                                    <div id="general2" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                                        <div class="accordion-body">
                                            Anyone with curiosity and ambition! BAFAI courses are designed for students, graduates, working professionals, entrepreneurs, educators, and career changers – from complete beginners to experienced tech professionals.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general3">
                                            Do I need coding experience to start?
                                        </button>
                                    </h2>
                                    <div id="general3" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                                        <div class="accordion-body">
                                            Not at all! We offer no-code AI courses for beginners (Track 1) and advanced coding tracks (Track 2) for technical learners. You can start from wherever you are.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general4">
                                            Is BAFAI accredited?
                                        </button>
                                    </h2>
                                    <div id="general4" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                                        <div class="accordion-body">
                                            Yes, BAFAI partners with global accreditation bodies and industry leaders. Our certificates are recognised by employers and educational institutions worldwide.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Courses & Learning Category -->
                    <div class="tab-pane fade" id="v-pills-courses" role="tabpanel" aria-labelledby="v-pills-courses-tab">
                        <div class="faq-accordion-wrapper">
                            <div class="category-header">
                                <h3>Courses & Learning</h3>
                                <p>About our programs and learning experience</p>
                            </div>
                            <div class="accordion accordion-faq" id="accordionCourses">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#courses1">
                                            How long do I have access to a course?
                                        </button>
                                    </h2>
                                    <div id="courses1" class="accordion-collapse collapse show" data-bs-parent="#accordionCourses">
                                        <div class="accordion-body">
                                            You get lifetime access to all purchased courses. Learn at your own pace, anytime, anywhere – even after completion you can revisit materials.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#courses2">
                                            Are the courses self-paced or live?
                                        </button>
                                    </h2>
                                    <div id="courses2" class="accordion-collapse collapse" data-bs-parent="#accordionCourses">
                                        <div class="accordion-body">
                                            Both! BAFAI offers a hybrid model: self-paced on-demand video lessons plus live masterclasses and Q&A sessions with expert mentors.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#courses3">
                                            Will I receive a certificate after completing a course?
                                        </button>
                                    </h2>
                                    <div id="courses3" class="accordion-collapse collapse" data-bs-parent="#accordionCourses">
                                        <div class="accordion-body">
                                            Absolutely! You earn a BAFAI certificate upon successful course completion. Certificates are verifiable and can be shared on LinkedIn or your resume.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#courses4">
                                            Can I access courses on mobile?
                                        </button>
                                    </h2>
                                    <div id="courses4" class="accordion-collapse collapse" data-bs-parent="#accordionCourses">
                                        <div class="accordion-body">
                                            Yes! BAFAI platform is fully responsive. You can learn on your phone, tablet, or laptop – we also have mobile apps coming soon.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment & Billing Category -->
                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                        <div class="faq-accordion-wrapper">
                            <div class="category-header">
                                <h3>Payment & Billing</h3>
                                <p>Affordable pricing and payment options</p>
                            </div>
                            <div class="accordion accordion-faq" id="accordionPayment">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#payment1">
                                            What payment methods are accepted?
                                        </button>
                                    </h2>
                                    <div id="payment1" class="accordion-collapse collapse show" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            We accept all major credit cards (Visa, Mastercard, American Express), PayPal, and various local payment methods depending on your region (including mobile money in select African countries).
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment2">
                                            Do you offer discounts or scholarships?
                                        </button>
                                    </h2>
                                    <div id="payment2" class="accordion-collapse collapse" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            Yes! BAFAI is committed to accessibility. We offer early-bird discounts, group enrollment rates, and need-based scholarships. Contact our support team for details.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment3">
                                            Is there a refund policy?
                                        </button>
                                    </h2>
                                    <div id="payment3" class="accordion-collapse collapse" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            We offer a 7-day money-back guarantee for all paid courses. If you're not satisfied, simply contact us within 7 days of purchase for a full refund.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment4">
                                            Are there free courses available?
                                        </button>
                                    </h2>
                                    <div id="payment4" class="accordion-collapse collapse" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            Yes! Our AI Literacy Track (Track 1) is completely free – a self-paced introduction to Artificial Intelligence for beginners.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Technical Support Category -->
                    <div class="tab-pane fade" id="v-pills-tech" role="tabpanel" aria-labelledby="v-pills-tech-tab">
                        <div class="faq-accordion-wrapper">
                            <div class="category-header">
                                <h3>Technical Support</h3>
                                <p>Getting help with platform issues</p>
                            </div>
                            <div class="accordion accordion-faq" id="accordionTech">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tech1">
                                            How do I reset my password?
                                        </button>
                                    </h2>
                                    <div id="tech1" class="accordion-collapse collapse show" data-bs-parent="#accordionTech">
                                        <div class="accordion-body">
                                            Click on "Forgot Password" on the login page. Enter your registered email, and we'll send you a password reset link. Follow the instructions to create a new password.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tech2">
                                            I'm having trouble playing videos. What should I do?
                                        </button>
                                    </h2>
                                    <div id="tech2" class="accordion-collapse collapse" data-bs-parent="#accordionTech">
                                        <div class="accordion-body">
                                            First, check your internet connection. Clear your browser cache and try again. If the issue persists, try a different browser (Chrome, Firefox, Edge) or contact our support team at support@bafai.com.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tech3">
                                            How do I contact support?
                                        </button>
                                    </h2>
                                    <div id="tech3" class="accordion-collapse collapse" data-bs-parent="#accordionTech">
                                        <div class="accordion-body">
                                            You can reach our support team via email at support@bafai.com, through the live chat widget on our website (available 9 AM – 6 PM weekdays), or by submitting a ticket from your dashboard.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tech4">
                                            Can I download course materials for offline viewing?
                                        </button>
                                    </h2>
                                    <div id="tech4" class="accordion-collapse collapse" data-bs-parent="#accordionTech">
                                        <div class="accordion-body">
                                            Yes! Our mobile app (coming soon) will support offline downloads. For now, you can download lecture slides and PDF resources from each course module.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    // Ensure all accordions start collapsed except first item in each category
    // This is handled by Bootstrap's collapse classes. The first accordion item in each tab has "show" class.
    // When switching tabs, the accordion state is preserved.
</script>
@endpush