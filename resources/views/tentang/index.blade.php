@extends('templates.layout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tentang</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/tentang">Tentang</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">Tentang Kami</h2>
                            <p class="card-text">Selamat datang di aplikasi kasir kami! Kami adalah tim yang berdedikasi untuk memberikan solusi yang bagus dan mudah digunakan bagi bisnis Anda. Dengan pengalaman dan keahlian kami, kami berkomitmen untuk membantu Anda mengelola transaksi dengan lebih efisien dan efektif.</p>
                            <p class="card-text">Kami percaya bahwa setiap bisnis memiliki kebutuhan yang unik, itulah mengapa kami berusaha untuk memberikan solusi yang dapat disesuaikan dengan kebutuhan Anda. Dengan fokus pada kualitas, keandalan, dan kemudahan penggunaan, kami bertekad untuk menjadi mitra terpercaya dalam pengelolaan kasir Anda.</p>
                            <p class="card-text">Jika Anda memiliki pertanyaan lebih lanjut atau ingin berdiskusi tentang bagaimana kami dapat membantu bisnis Anda, jangan ragu untuk menghubungi kami sekarang. Kami siap membantu Anda mencapai kesuksesan!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection