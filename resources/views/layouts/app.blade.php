<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>@yield('title', 'Aroma')</title>

      <meta name="description" content="@yield('meta_description', 'Aroma - Luxury Perfumes Crafted for You')">

      <!-- Favicon -->
      <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
      <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
      <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
      <meta name="theme-color" content="#151515">

      <!-- Google Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

      <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

      <!-- Bootstrap 5 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

      <!-- Bootstrap Icons -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

      <!-- Custom CSS -->
      @vite(['resources/css/app.css'])
</head>

<body>

      <!-- Skip Link -->
      <a class="skip-link" href="#main-content">Skip to main content</a>

      <!-- Navbar -->
      @include('components.navbar')

      <!-- Flash Messages -->
      <x-flash />

      <!-- Main Content -->
      <main id="main-content">
            @yield('content')
      </main>

      <!-- Footer -->
      @include('components.footer')

      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

      <!-- Custom JS -->
      @vite(['resources/js/app.js'])

      @stack('scripts')

</body>

</html>
