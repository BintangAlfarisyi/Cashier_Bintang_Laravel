@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Contact</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section contact">

        <div class="row gy-4">

            <div class="col-xl-6 m-0">
                <div class="p-4">
                    <div class="mb3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="info-box card">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Address</h3>
                                    <p>Jl. Ariawiratanudata Kp. Pateken Rt 03 Rw 03</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="info-box card">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Call Us</h3>
                                    <p>0895326146997<br>bntngal7@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 ms-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d11866.538149495394!2d107.16221989003202!3d-6.794095634221108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sid!2sid!4v1713921826549!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>

            <div class="col-xl-6">
                <div class="card p-4">
                    <form action="forms/contact.php" method="post" class="php-email-form">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>

        </div>

    </section>

</main><!-- End #main -->
@endsection