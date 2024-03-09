@extends('templates.layout')

@push('style')
@endpush

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
        <div class="row">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title mt-1 p-0" style="font-size: 30px;">Tentang Aplikasi</h1>
                        <p class="card-subtitle">Aplikasi Kasir yang bagus dan mudah dipakai</p>
                    </div>
                    <div class="card-content p-4">
                        <div class="card-price">

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="#" class="btn btn-primary">Hubungi kami sekarang!</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->
@endsection

@push('script')
@endpush