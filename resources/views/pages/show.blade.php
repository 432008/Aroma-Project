@extends('layouts.app')

@section('title', $page['title'] . ' | Aroma')

@section('meta_description', $page['intro'])

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="text-center">
            <span class="section-subtitle">{{ strtoupper($page['eyebrow']) }}</span>

            <h1>{{ $page['title'] }}</h1>

            <p>{{ $page['intro'] }}</p>
        </div>
    </div>
</section>


<!-- Content -->
<section class="section-padding">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="info-page">

                    @foreach($page['sections'] as $section)

                        <div class="info-page-section">

                            <h2>
                                <span class="info-page-number">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                {{ $section['heading'] }}
                            </h2>

                            @foreach($section['body'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>
</section>


<!-- Help CTA -->
<section class="cta-section">
    <div class="container">

        <div class="cta-box text-center">

            <span class="section-subtitle">STILL HAVE QUESTIONS?</span>

            <h2>We're Here To Help</h2>

            <p>
                Our fragrance team is happy to assist with anything you
                need — from product advice to order support.
            </p>

            <a href="{{ route('contact.index') }}" class="btn btn-aroma">
                Contact Us
                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>

    </div>
</section>

@endsection
