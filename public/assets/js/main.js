/**
 * BAFAI LMS - Main JavaScript
 * Handles mobile menu, dropdowns, cart counter, and sticky header.
 * No dark mode, no inline scripts.
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS if available
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true,
                offset: 60,
            });
        }

        // 1. Mobile sidebar open/close
        function initMobileMenu() {
            const openBtn = document.getElementById('mobileMenuBtn');
            const closeBtn = document.getElementById('closeSidebar');
            const sidebar = document.querySelector('.mobile-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');

            if (!openBtn || !sidebar) return;

            const openMenu = () => {
                sidebar.classList.add('open');
                if (overlay) overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            };

            const closeMenu = () => {
                sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            };

            openBtn.addEventListener('click', openMenu);
            if (closeBtn) closeBtn.addEventListener('click', closeMenu);
            if (overlay) overlay.addEventListener('click', closeMenu);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                    closeMenu();
                }
            });
        }

        // 2. Mobile dropdown toggles (existing)
        function initMobileDropdowns() {
            const mobileToggles = document.querySelectorAll('.mobile-nav .has-dropdown > a');
            mobileToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parentLi = this.parentElement;
                    const dropdown = parentLi.querySelector('.mobile-dropdown-menu');
                    const icon = this.querySelector('i');
                    if (!dropdown) return;

                    // Close siblings
                    document.querySelectorAll('.mobile-nav .has-dropdown').forEach(sib => {
                        if (sib !== parentLi) {
                            const otherDropdown = sib.querySelector('.mobile-dropdown-menu');
                            const otherIcon = sib.querySelector('a i');
                            if (otherDropdown) otherDropdown.classList.remove('show');
                            if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                        }
                    });

                    const isOpen = dropdown.classList.contains('show');
                    if (isOpen) {
                        dropdown.classList.remove('show');
                        if (icon) icon.style.transform = 'rotate(0deg)';
                    } else {
                        dropdown.classList.add('show');
                        if (icon) icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        }

        // 3. DESKTOP DROPDOWN CLICK HANDLER (FIX)
        function initDesktopDropdowns() {
            const desktopToggles = document.querySelectorAll('.main-nav .has-dropdown > a');
            
            desktopToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();   // Prevent event from bubbling to document
                    const parentLi = this.parentElement;
                    const wasOpen = parentLi.classList.contains('open');
                    
                    // Close all others
                    document.querySelectorAll('.main-nav .has-dropdown').forEach(li => {
                        if (li !== parentLi) li.classList.remove('open');
                    });
                    
                    // Toggle current
                    parentLi.classList.toggle('open', !wasOpen);
                });
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.main-nav .has-dropdown')) {
                    document.querySelectorAll('.main-nav .has-dropdown').forEach(li => {
                        li.classList.remove('open');
                    });
                }
            });
        }

        // 4. Sticky header shadow
        function initStickyHeader() {
            const header = document.querySelector('.header-one');
            if (!header) return;
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) header.classList.add('scrolled');
                else header.classList.remove('scrolled');
            });
        }

        // 5. Active nav link highlight
        function setActiveNavLink() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.main-nav > li > a');
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && href !== '#' && href !== 'javascript:void(0)') {
                    if (currentPath === href || currentPath.startsWith(href + '/')) {
                        link.classList.add('nav-link-active');
                    } else {
                        link.classList.remove('nav-link-active');
                    }
                }
            });
        }

        // 6. User dropdown
        function initUserDropdown() {
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.querySelector('.user-dropdown');
            
            if (!userMenuBtn || !userDropdown) return;
            
            // Toggle dropdown when clicking the button
            userMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();  // Prevent closing from document click immediately
                userDropdown.classList.toggle('open');
            });
            
            // Close user dropdown when clicking anywhere outside of it
            document.addEventListener('click', function(e) {
                if (!userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('open');
                }
            });
        }

        // Run all
        initMobileMenu();
        initMobileDropdowns();
        initDesktopDropdowns();
        initStickyHeader();
        setActiveNavLink();
        initUserDropdown();
    });

    
    function updateCartCount() {
        cfetch('/cart-count')
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                const cartCountSpan = document.getElementById('cartCount');
                if (cartCountSpan) {
                    cartCountSpan.innerText = data.count;   // ✅ set the number
                }
            })
            .catch(error => {
                console.error('Failed to update cart count:', error);
                // Optionally show 0 or keep previous value
                const cartCountSpan = document.getElementById('cartCount');
                if (cartCountSpan) cartCountSpan.innerText = '0';
            });
    }

    // Update when page loads
    document.addEventListener('DOMContentLoaded', updateCartCount);

    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('.add-to-cart-btn');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            fetch('/cart/add', {
                method: 'POST',
                body: new FormData(this),
                headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    btn.innerHTML = '<i class="fas fa-shopping-cart me-2"></i> Go to Cart';
                    btn.classList.add('btn-success');
                    btn.onclick = () => window.location.href = '{{ route("cart.index") }}';
                    updateCartCount();  // refresh header count
                } else {
                    btn.innerHTML = originalHtml;
                    alert(data.message);
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const scrollBtn = document.getElementById('scrollToTopBtn');
        if (!scrollBtn) return;

        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollBtn.classList.add('show');
            } else {
                scrollBtn.classList.remove('show');
            }
        });

        scrollBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

})();