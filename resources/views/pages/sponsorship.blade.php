@extends('layouts.header')

@section('title', 'BAFAI - Sponsor a Student | Make a Social Impact')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/sponsorship.css') }}">
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Sponsorship</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sponsorship</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Mission Section -->
<section class="sponsorship-mission">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>Partner with BAFAI to shape the future of technology and make a lasting social impact.</h2>
        </div>
        <div class="mission-text" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <p><strong>Empower the Next Generation of AI Innovators</strong></p>
            <p>BAFAI is dedicated to identifying, training, and nurturing talented young minds in the field of Artificial Intelligence. Our mission is to democratise access to high-quality AI education, ensuring that the next generation of global tech leaders is diverse and inclusive.</p>
        </div>
    </div>
</section>

<!-- Trusted Sponsors Logos -->
<section class="sponsor-logos">
    <div class="container">
        <h6 class="text-center fw-semibold mb-4" data-aos="fade-up">Collaborated with trusted sponsors</h6>
        <div class="logo-strip" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('assets/img/partners/digital-encode.png') }}" alt="Digital Encode">
            <img src="{{ asset('assets/img/partners/progital.png') }}" alt="Progital">
            <img src="{{ asset('assets/img/partners/tech-1m.png') }}" alt="Tech 1M">
            <img src="{{ asset('assets/img/partners/topas-hub.png') }}" alt="Topas Hub">
        </div>
    </div>
</section>

<!-- Why Sponsor a Student? -->
<section class="why-sponsor">
    <div class="container">
        <div class="section-header" data-aos="fade-up" data-aos-duration="800">
            <h2>Why Sponsor a Student?</h2>
            <p>Your Sponsorship, Their Future. Your support can change a life.</p>
        </div>
        <div class="benefit-grid">
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="100">
                <div class="benefit-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h4>Direct Impact</h4>
                <p>Your contribution directly funds a student's participation in our intensive training program, covering tuition, resources, and mentorship.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="200">
                <div class="benefit-icon"><i class="fas fa-globe"></i></div>
                <h4>Social Cause</h4>
                <p>By supporting a student, you're not just funding an education; you're breaking down barriers and creating opportunities for a bright young mind from a resource-constrained background.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="300">
                <div class="benefit-icon"><i class="fas fa-chart-line"></i></div>
                <h4>CSR & Brand Visibility</h4>
                <p>Align your organisation with a meaningful social cause. We offer opportunities for brand recognition on our website, in our publications helping you meet your CSR goals.</p>
            </div>
            <div class="benefit-card" data-aos="flip-left" data-aos-duration="600" data-aos-delay="400">
                <div class="benefit-icon"><i class="fas fa-users"></i></div>
                <h4>Connect with Talent</h4>
                <p>Sponsors get exclusive opportunities to engage with our students and graduates, providing a unique avenue for talent scouting and future collaborations.</p>
            </div>
        </div>
    </div>
</section>

<!-- Forms Section (Two Forms with Tabs) -->
<section class="forms-section">
    <div class="container">
        <div class="form-tabs" data-aos="fade-up" data-aos-duration="800">
            <button class="form-tab-btn active" id="sponsor-tab">Apply to Sponsor</button>
            <button class="form-tab-btn" id="student-tab">Apply for Sponsorship</button>
        </div>
        @if($errors->any())
            <div class="custom-alert custom-alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1" style="padding-left: 1.2rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button class="alert-close" data-close="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if(session('success'))
            <div class="custom-alert custom-alert-success" role="alert">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                <button class="alert-close" data-close="alert" aria-label="Close">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="custom-alert custom-alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <span>{{ session('error') }}</span>
                <button class="alert-close" data-close="alert" aria-label="Close">&times;</button>
            </div>
        @endif

        @if(session('info'))
            <div class="custom-alert custom-alert-info" role="alert">
                <i class="fas fa-info-circle"></i>
                <span>{{ session('info') }}</span>
                <button class="alert-close" data-close="alert" aria-label="Close">&times;</button>
            </div>
        @endif

        <!-- Sponsor Form (for organizations/individuals sponsoring candidates) -->
        <div id="sponsor-form-container" class="form-container active-form" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <h3><i class="fas fa-building me-2"></i> Apply to Sponsor</h3>
            <p class="text-muted mb-4">For individuals or organisations sponsoring candidates</p>
            <form action="{{ route('sponsorship.apply') }}" method="POST" id="sponsorForm">
                @csrf
                <input type="hidden" name="type" value="sponsor">
                <div class="mb-3">
                    <label class="form-label">Individual Name / Organisational Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone *</label>
                    <input type="tel" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">How many students do you want to sponsor? *</label>
                    <input type="number" name="student_count" class="form-control" min="1" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="consent" class="form-check-input" id="sponsorConsent" required>
                    <label class="form-check-label" for="sponsorConsent">Yes, I agree with the privacy policy and terms and conditions.</label>
                </div>
                <button type="submit" class="btn btn-submit w-100" id="sponsorSubmitBtn">
                    <span class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                    <span class="btn-text">Apply for Sponsorship</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>
        </div>

        <!-- Student Form (for individuals applying to be sponsored) -->
        <div id="student-form-container" class="form-container" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <h3><i class="fas fa-user-graduate me-2"></i> Apply for Sponsorship</h3>
            <p class="text-muted mb-4">For individuals applying for sponsorship</p>
            <form action="{{ route('sponsorship.apply') }}" method="POST" id="studentForm">
                @csrf
                <input type="hidden" name="type" value="student">
                <div class="mb-3">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone *</label>
                    <input type="tel" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Write your essay, applying for sponsorship and stating your reason. *</label>
                    <textarea name="essay" class="form-control" rows="5" placeholder="Tell us about yourself, your passion for AI, your financial situation, and why you deserve sponsorship..." required></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="consent" class="form-check-input" id="studentConsent" required>
                    <label class="form-check-label" for="studentConsent">Yes, I agree with the privacy policy and terms and conditions.</label>
                </div>
                <button type="submit" class="btn btn-submit w-100" id="studentSubmitBtn">
                    <span class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                    <span class="btn-text">Submit Application</span>
                    <i class="fas fa-paper-plane ms-2"></i>
                </button>
            </form>
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

    // Tab switching logic
    const sponsorTab = document.getElementById('sponsor-tab');
    const studentTab = document.getElementById('student-tab');
    const sponsorForm = document.getElementById('sponsor-form-container');
    const studentForm = document.getElementById('student-form-container');

    function setActiveTab(active) {
        if (active === 'sponsor') {
            sponsorTab.classList.add('active');
            studentTab.classList.remove('active');
            sponsorForm.classList.add('active-form');
            studentForm.classList.remove('active-form');
        } else {
            studentTab.classList.add('active');
            sponsorTab.classList.remove('active');
            studentForm.classList.add('active-form');
            sponsorForm.classList.remove('active-form');
        }
    }

    sponsorTab.addEventListener('click', (e) => {
        e.preventDefault();
        setActiveTab('sponsor');
    });
    studentTab.addEventListener('click', (e) => {
        e.preventDefault();
        setActiveTab('student');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('#sponsorForm, #studentForm');

        forms.forEach(form => {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (!submitBtn) return;

            // Handle form submission
            form.addEventListener('submit', function(e) {
                // 1️⃣ Check HTML5 validation – if invalid, do NOT disable button
                if (!form.checkValidity()) {
                    // Let the browser show validation messages
                    return;
                }

                // 2️⃣ Prevent double submission
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return;
                }

                // 3️⃣ Disable button and show spinner
                disableButton(submitBtn);
            });

            // 4️⃣ Re‑enable button if validation fails on any input
            form.querySelectorAll('input, textarea, select').forEach(field => {
                field.addEventListener('invalid', function() {
                    // Re‑enable the button so user can correct and try again
                    enableButton(submitBtn);
                });
            });
        });

        // Helper functions
        function disableButton(btn) {
            btn.disabled = true;
            const spinner = btn.querySelector('.spinner-border');
            const btnText = btn.querySelector('.btn-text');
            const icon = btn.querySelector('.fas');

            if (spinner) spinner.classList.remove('d-none');
            if (btnText) btnText.textContent = 'Submitting...';
            if (icon) icon.style.display = 'none';
        }

        function enableButton(btn) {
            btn.disabled = false;
            const spinner = btn.querySelector('.spinner-border');
            const btnText = btn.querySelector('.btn-text');
            const icon = btn.querySelector('.fas');

            if (spinner) spinner.classList.add('d-none');
            if (btnText) btnText.textContent = btnText.dataset.originalText || 'Submit';
            if (icon) icon.style.display = 'inline-block';
        }

        // Store original button text for restoration
        document.querySelectorAll('.btn-submit').forEach(btn => {
            const textSpan = btn.querySelector('.btn-text');
            if (textSpan) {
                textSpan.dataset.originalText = textSpan.textContent.trim();
            }
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.matches('[data-close="alert"]')) {
            e.target.closest('.custom-alert').remove();
        }
    });
</script>
@endpush