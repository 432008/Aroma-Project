@extends('layouts.app')

@section('title', 'About Us | Aroma')

@section('meta_description', 'Learn about Aroma, a luxury fragrance house creating elegant perfumes that become lasting memories.')

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="text-center">

            <!-- Perfume Logo -->
            <div class="about-hero-logo">
                <img
                    src="{{ asset('images/about/logo.png') }}"
                    alt="Perfume Logo"
                >
            </div>

            <h1>About Aroma</h1>

            <p>
                Crafting fragrances that become memories.
            </p>

        </div>
    </div>
</section>


<!-- Our Story -->
<section class="section-padding bg-cream">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="about-image">

                    @if(file_exists(public_path('images/about/aroma-story.jpg')))

                        <img
                            src="{{ asset('images/about/aroma-story.jpg') }}"
                            alt="The Aroma Story"
                            class="img-fluid"
                        >

                    @else

                        <div class="editorial-placeholder editorial-placeholder--tall">
                            <i class="bi bi-stars" aria-hidden="true"></i>
                            <span>The Aroma Story</span>
                        </div>

                    @endif

                </div>

            </div>

            <div class="col-lg-6">

                <span class="section-subtitle">
                    OUR STORY
                </span>

                <h2 class="display-heading">
                    The Story Behind Aroma
                </h2>

                <p>
                    Aroma was created from a simple belief: a fragrance is
                    more than a scent. It is a memory, a feeling and a part
                    of who you are.
                </p>

                <p>
                    Our journey began with a passion for beautiful
                    fragrances and a desire to create premium perfumes that
                    feel elegant, timeless and personal.
                </p>

                <p>
                    Every Aroma fragrance is carefully designed to bring
                    together distinctive notes, refined craftsmanship and
                    exceptional quality.
                </p>

                <a
                    href="{{ route('perfumes.index') }}"
                    class="btn btn-aroma mt-3"
                >
                    Explore Our Perfumes
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>

            </div>

        </div>

    </div>

</section>


<!-- Philosophy -->
<section class="section-padding">

    <div class="container">

        <div class="section-heading text-center">

            <span class="section-subtitle">
                WHAT WE BELIEVE
            </span>

            <h2>Our Philosophy</h2>

            <p>
                Everything we create is guided by quality, elegance and
                individuality.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-lg-4">

                <div class="about-feature text-center">

                    <div class="feature-icon">
                        <i class="bi bi-gem"></i>
                    </div>

                    <h3>Quality</h3>

                    <p>
                        We believe exceptional fragrances begin with
                        carefully selected ingredients and thoughtful
                        compositions.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="about-feature text-center">

                    <div class="feature-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <h3>Elegance</h3>

                    <p>
                        From fragrance to packaging, every Aroma detail is
                        designed to feel refined, sophisticated and timeless.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="about-feature text-center">

                    <div class="feature-icon">
                        <i class="bi bi-person-heart"></i>
                    </div>

                    <h3>Individuality</h3>

                    <p>
                        Your fragrance should feel uniquely yours. We create
                        scents for different personalities and moments.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Mission & Vision -->
<section class="section-padding bg-dark-aroma">

    <div class="container">

        <div class="row g-5">

            <div class="col-lg-6">

                <div class="dark-info-card">

                    <span class="section-subtitle">
                        OUR MISSION
                    </span>

                    <h2>Creating Fragrances With Purpose</h2>

                    <p>
                        Our mission is to make premium fragrance accessible
                        while maintaining the quality, beauty and character
                        expected from a luxury perfume house.
                    </p>

                    <p>
                        We want every Aroma fragrance to help people express
                        themselves with confidence.
                    </p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="dark-info-card">

                    <span class="section-subtitle">
                        OUR VISION
                    </span>

                    <h2>To Become Part of Your Memories</h2>

                    <p>
                        We envision Aroma as a fragrance brand that people
                        return to for the moments that matter most.
                    </p>

                    <p>
                        From everyday confidence to unforgettable occasions,
                        we want our fragrances to become part of your story.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Values -->
<section class="section-padding bg-cream">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <span class="section-subtitle">
                    THE AROMA PROMISE
                </span>

                <h2 class="display-heading">
                    More Than A Perfume
                </h2>

                <p>
                    A great fragrance has the power to transform an ordinary
                    moment into something unforgettable.
                </p>

                <div class="promise-list">

                    <div class="promise-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Premium fragrance compositions</span>
                    </div>

                    <div class="promise-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Elegant and thoughtful packaging</span>
                    </div>

                    <div class="promise-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Carefully selected fragrance notes</span>
                    </div>

                    <div class="promise-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Secure and reliable delivery</span>
                    </div>

                    <div class="promise-item">
                        <i class="bi bi-check-circle"></i>
                        <span>Customer-focused experience</span>
                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="about-quote">

                    <i class="bi bi-quote"></i>

                    <blockquote>
                        “A fragrance is invisible, yet it can leave the most
                        unforgettable impression.”
                    </blockquote>

                    <span>— The Aroma Philosophy</span>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- CTA -->
<section class="cta-section">

    <div class="container">

        <div class="cta-box text-center">

            <span class="section-subtitle">
                DISCOVER YOUR SCENT
            </span>

            <h2>Your Signature Scent Is Waiting</h2>

            <p>
                Explore the world of Aroma and find a fragrance that feels
                uniquely yours.
            </p>

            <a
                href="{{ route('perfumes.index') }}"
                class="btn btn-aroma"
            >
                Shop Perfumes
                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>

    </div>

</section>

@endsection