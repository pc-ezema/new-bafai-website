        <!-- Footer Start -->
        <footer class="footer footer-one">
            <div class="footer-top">
                <div class="container">
                    <div class="row row-gap-4">
                        <div class="col-lg-4">
                            <div class="footer-about">
                                <div class="footer-logo">
                                    <img src="{{ asset('assets/img/bafai-logo.png') }}" alt="BAFAI Logo">
                                </div>
                                <p>BAFAI is a powerful Learning Management System designed for educators, training institutions, and businesses. Manage courses, track student progress, and enhance e-learning experiences.</p>
                                <!-- App Store & Google Play buttons removed -->
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="row row-gap-4">
                                <div class="col-lg-4 col-md-4">
                                    <div class="footer-widget footer-menu">
                                        <h3 class="footer-title">Courses</h3>
                                        <ul>
                                            <li><a href="{{ url('/courses') }}">CAIF</a></li>
                                            <li><a href="{{ url('/courses') }}">CAITM</a></li>
                                            <li><a href="{{ url('/courses') }}">Agentic AI</a></li>
                                            <li><a href="{{ url('/courses') }}">Workflow Automation</a></li>
                                            <li><a href="{{ url('/courses') }}">Data Annotation</a></li>
                                            <li><a href="{{ url('/courses') }}">AI Ethics & Governance</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="footer-widget footer-menu">
                                        <h3 class="footer-title">About</h3>
                                        <ul>
                                            <li><a href="{{ url('/about-us') }}">About Us</a></li>
                                            <li><a href="{{ url('/courses') }}">Courses</a></li>
                                            <li><a href="{{ url('/about-us') }}#WhoWeAre">Who We Are</a></li>
                                            <li><a href="{{ url('/about-us') }}#WhyLearnWithBAFAI">Why Learn with BAFAI?</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="footer-widget footer-menu">
                                        <h3 class="footer-title">Useful Links</h3>
                                        <ul>
                                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                                            <li><a href="{{ url('/faqs') }}">FAQs</a></li>
                                            <li><a href="{{ url('/sponsorship') }}">Sponsorship</a></li>
                                            <li><a href="{{ url('/testimonials') }}">Testimonials</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="footer-widget footer-contact">
                                <h3 class="footer-title">Subscribe Newsletter</h3>
                                <div class="footer-newsletter">
                                    <p>Sign up to get updates & news about our courses.</p>
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="subscribe-form">
                                            <span><i class="fas fa-envelope"></i></span>
                                            <input type="email" name="email" class="form-control" placeholder="Your Email Address" required>
                                        </div>
                                        <button type="submit" class="btn btn-secondary w-100">Subscribe Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center row-gap-2">
                        <div class="col-lg-5">
                            <div class="text-center text-lg-start">
                                <p>Copyright &copy; {{ date('Y') }} <span class="text-secondary">BAFAI</span>. All rights reserved.</p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="social-icon">
                                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->
        <!-- Floating Action Buttons -->
        <div class="floating-buttons">
            <!-- Scroll to Top Button -->
            <button id="scrollToTopBtn" class="fab-btn scroll-top" title="Go to top">
                <i class="fas fa-arrow-up"></i>
            </button>

            <!-- Clear Cart Button (only shown if cart is not empty) -->
            @if(count(session()->get('cart', [])) > 0)
            <form action="{{ route('cart.clear') }}" method="POST" id="clearCartForm" class="fab-form">
                @csrf
                <button type="submit" class="fab-btn clear-cart" title="Clear cart" onclick="return confirm('Remove all courses from your cart?')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Slick JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <!-- Main JavaScript (consolidated) -->
    <script src="{{ url('assets/js/main.js') }}"></script>

    <script type="text/javascript">
        function googleTranslateElementInit(){
            new google.translate.TranslateElement({
                pageLanguage:'en',
                autoDisplay:false
            },'google_translate_element');
        }
    </script>

    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    @stack('scripts')
    </body>

</html>