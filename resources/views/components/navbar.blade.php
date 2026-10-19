<nav class="navbar navbar-expand-lg navbar-dark aroma-navbar sticky-top">
    <div class="container">

        @php
            // Navbar logo image — a clean, background-removed version of
            // Aroma_logo-1.jpg (generated as public/images/aroma-logo.png).
            // Alternatives you can drop in here:
            //   'images/aroma-logo.png'       transparent, original colours  (current)
            //   'images/aroma-logo-gold.png'  transparent, gold
            //   'images/Aroma_logo-1.jpg'     original uploaded file
            $navLogo = 'images/aroma-logo.png';
        @endphp

        <!-- Logo -->
        <a class="navbar-brand aroma-logo rounded-circle" href="{{ url('/') }}" aria-label="Aroma home">

            <span class="aroma-logo-badge">
                <img
                    src="{{ asset($navLogo) }}"
                    alt=""
                    class="aroma-logo-img"
                    width="45"
                    height="40"
                    aria-hidden="true"
                >
            </span>

            <span class="aroma-logo-text">AROMA</span>

        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#aromaNavbar"
                aria-controls="aromaNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="aromaNavbar">

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="{{ url('/') }}"
                       @if(request()->is('/')) aria-current="page" @endif>
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('perfumes*') ? 'active' : '' }}"
                       href="{{ url('/perfumes') }}"
                       @if(request()->is('perfumes*')) aria-current="page" @endif>
                        Perfumes
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('collections*') ? 'active' : '' }}"
                       href="{{ url('/collections') }}"
                       @if(request()->is('collections*')) aria-current="page" @endif>
                        Collections
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                       href="{{ url('/about') }}"
                       @if(request()->is('about')) aria-current="page" @endif>
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                       href="{{ url('/contact') }}"
                       @if(request()->is('contact')) aria-current="page" @endif>
                        Contact
                    </a>
                </li>

            </ul>

            <!-- Right Side -->
            <div class="d-flex align-items-center gap-3 aroma-nav-actions">

                <!-- Search -->
                <div class="navbar-search">
                    <form action="{{ route('perfumes.index') }}" method="GET" role="search">
                        <label for="navSearch" class="visually-hidden">Search perfumes</label>

                        <input
                            type="search"
                            id="navSearch"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search fragrances..."
                        >

                        <button type="submit" aria-label="Search">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                @auth

                    <!-- Cart -->
                    <a href="{{ url('/cart') }}"
                       class="nav-icon position-relative"
                       aria-label="Shopping cart, {{ $cartCount }} item(s)"
                       title="Shopping Cart">

                        <i class="bi bi-bag" aria-hidden="true"></i>

                        @if(($cartCount ?? 0) > 0)
                            <span class="cart-badge" aria-hidden="true">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- User Dropdown -->
                    <div class="dropdown">

                        <a href="#"
                           class="nav-user dropdown-toggle"
                           data-bs-toggle="dropdown"
                           aria-expanded="false"
                           aria-label="Account menu for {{ auth()->user()->name }}">

                            <i class="bi bi-person-circle" aria-hidden="true"></i>
                            <span>{{ auth()->user()->name }}</span>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end aroma-dropdown">

                            <li>
                                <a class="dropdown-item"
                                   href="{{ url('/profile') }}">
                                    <i class="bi bi-person me-2" aria-hidden="true"></i>
                                    Profile
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ url('/orders') }}">
                                    <i class="bi bi-box-seam me-2" aria-hidden="true"></i>
                                    My Orders
                                </a>
                            </li>

                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2" aria-hidden="true"></i>
                                        Admin Dashboard
                                    </a>
                                </li>
                            @endif

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="{{ url('/logout') }}" method="POST">
                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2" aria-hidden="true"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                @else

                    <!-- Login -->
                    <a href="{{ url('/login') }}"
                       class="nav-login">
                        Login
                    </a>

                    <!-- Register -->
                    <a href="{{ url('/register') }}"
                       class="btn aroma-nav-btn">
                        Register
                    </a>

                @endauth

            </div>

        </div>
    </div>
</nav>
