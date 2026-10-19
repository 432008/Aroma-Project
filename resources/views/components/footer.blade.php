<footer class="aroma-footer">

    <div class="container">

        <div class="row gy-5">

            <!-- Brand -->
            <div class="col-lg-4 col-md-6">

                <a href="{{ url('/') }}" class="footer-logo">
                    AROMA
                </a>

                <p class="footer-tagline">
                    Crafting fragrances that become memories.
                </p>

                <p class="footer-description">
                    Discover premium fragrances carefully crafted to express
                    your personality, mood and unforgettable moments.
                </p>

                <!-- Social Icons -->
                <div class="footer-social">

                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="https://x.com" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>

                    <a href="https://www.pinterest.com" target="_blank" rel="noopener noreferrer" aria-label="Pinterest">
                        <i class="bi bi-pinterest"></i>
                    </a>

                </div>

            </div>


            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">

                <h2 class="footer-title">
                    Quick Links
                </h2>

                <ul class="footer-links">

                    <li>
                        <a href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/perfumes') }}">
                            Perfumes
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/collections') }}">
                            Collections
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/about') }}">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Customer Service -->
            <div class="col-lg-3 col-md-6">

                <h2 class="footer-title">
                    Customer Service
                </h2>

                <ul class="footer-links">

                    <li>
                        <a href="{{ route('pages.show', 'shipping') }}">
                            Shipping & Delivery
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pages.show', 'returns') }}">
                            Returns & Refunds
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pages.show', 'privacy') }}">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pages.show', 'terms') }}">
                            Terms & Conditions
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pages.show', 'faqs') }}">
                            FAQs
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Contact -->
            <div class="col-lg-3 col-md-6">

                <h2 class="footer-title">
                    Contact Us
                </h2>

                <ul class="footer-contact">

                    <li>
                        <i class="bi bi-geo-alt"></i>
                        <span>
                            Rajkot, Gujarat, India
                        </span>
                    </li>

                    <li>
                        <i class="bi bi-envelope"></i>
                        <a href="mailto:support@aroma.com">
                            support@aroma.com
                        </a>
                    </li>

                    <li>
                        <i class="bi bi-telephone"></i>
                        <a href="tel:+919999999999">
                            +91 99999 99999
                        </a>
                    </li>

                </ul>

            </div>

        </div>


        <!-- Bottom Footer -->
        <div class="footer-bottom">

            <div class="row align-items-center gy-3">

                <div class="col-md-6">
                    <p class="copyright mb-0">
                        © {{ date('Y') }} Aroma.
                        All Rights Reserved.
                    </p>
                </div>

                <div class="col-md-6 text-md-end">

                    <p class="footer-made mb-0">
                        Crafted with
                        <i class="bi bi-heart-fill"></i>
                        for fragrance lovers.
                    </p>

                </div>

            </div>

        </div>

    </div>

</footer>