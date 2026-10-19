@extends('layouts.app')

@section('title', 'Contact Us | Aroma')

@section('meta_description', 'Contact Aroma for perfume enquiries, customer support and fragrance assistance.')

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="text-center">
            <span class="section-subtitle">WE ARE HERE FOR YOU</span>

            <h1>Contact Aroma</h1>

            <p>
                Have a question about our fragrances? We would love to hear
                from you.
            </p>
        </div>
    </div>
</section>


<!-- Contact Section -->
<section class="section-padding bg-cream">

    <div class="container">

        <div class="row g-5">

            <!-- Contact Information -->
            <div class="col-lg-5">

                <span class="section-subtitle">
                    GET IN TOUCH
                </span>

                <h2 class="display-heading">
                    We'd Love To Hear From You
                </h2>

                <p>
                    Whether you need help choosing a fragrance, have a
                    question about an order, or simply want to know more
                    about Aroma, our team is here to help.
                </p>


                <!-- Address -->
                <div class="contact-info-item">

                    <div class="contact-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <div>
                        <h3>Visit Us</h3>

                        <p>
                            Rajkot, Gujarat, India
                        </p>
                    </div>

                </div>


                <!-- Email -->
                <div class="contact-info-item">

                    <div class="contact-icon">
                        <i class="bi bi-envelope"></i>
                    </div>

                    <div>
                        <h3>Email Us</h3>

                        <p>
                            <a href="mailto:support@aroma.com">
                                support@aroma.com
                            </a>
                        </p>
                    </div>

                </div>


                <!-- Phone -->
                <div class="contact-info-item">

                    <div class="contact-icon">
                        <i class="bi bi-telephone"></i>
                    </div>

                    <div>
                        <h3>Call Us</h3>

                        <p>
                            <a href="tel:+919999999999">
                                +91 99999 99999
                            </a>
                        </p>
                    </div>

                </div>


                <!-- Working Hours -->
                <div class="contact-info-item">

                    <div class="contact-icon">
                        <i class="bi bi-clock"></i>
                    </div>

                    <div>
                        <h3>Working Hours</h3>

                        <p>
                            Monday - Saturday<br>
                            10:00 AM - 7:00 PM
                        </p>
                    </div>

                </div>


                <!-- Social -->
                <div class="contact-social mt-4">

                    <h3>Follow Aroma</h3>

                    <div class="social-links">

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

            </div>


            <!-- Contact Form -->
            <div class="col-lg-7">

                <div class="contact-form-card">

                    <div class="mb-4">

                        <span class="section-subtitle">
                            SEND US A MESSAGE
                        </span>

                        <h3>How Can We Help?</h3>

                    </div>


                    <!-- Success Message -->


                    <!-- Error Message -->
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Please correct the following errors:
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form
                        action="{{ route('contact.store') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="row g-3">

                            <!-- Name -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Name *
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="Your name"
                                    required
                                >

                            </div>


                            <!-- Email -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Email *
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="your@email.com"
                                    required
                                >

                            </div>


                            <!-- Phone -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                    placeholder="+91"
                                >

                            </div>


                            <!-- Subject -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Subject *
                                </label>

                                <input
                                    type="text"
                                    name="subject"
                                    class="form-control"
                                    value="{{ old('subject') }}"
                                    placeholder="How can we help?"
                                    required
                                >

                            </div>


                            <!-- Message -->
                            <div class="col-12">

                                <label class="form-label">
                                    Message *
                                </label>

                                <textarea
                                    name="message"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Write your message here..."
                                    required
                                >{{ old('message') }}</textarea>

                            </div>


                            <!-- Submit -->
                            <div class="col-12">

                                <button
                                    type="submit"
                                    class="btn btn-aroma btn-lg"
                                >
                                    Send Message
                                    <i class="bi bi-send ms-2"></i>
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- FAQ CTA -->
<section class="section-padding">

    <div class="container">

        <div class="cta-box text-center">

            <span class="section-subtitle">
                NEED MORE HELP?
            </span>

            <h2>We're Always Happy To Help</h2>

            <p>
                From choosing your signature fragrance to getting assistance
                with your order, the Aroma team is here for you.
            </p>

            <a
                href="{{ route('perfumes.index') }}"
                class="btn btn-aroma"
            >
                Explore Perfumes
                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>

    </div>

</section>

@endsection