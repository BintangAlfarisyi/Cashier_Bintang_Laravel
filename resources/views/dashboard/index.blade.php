@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title pt-0">Stok</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-box"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalStok }} <span class="text-muted small pt-2 ps-1">Stok</span></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title pt-0">Transaksi</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $totalTransaksi }} <span class="text-muted small pt-2 ps-1">Transaksi</span></h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-12">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title pt-0">Pendapatan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center pt-2">Transaksi Bulan Januari</h5>
                                <input type="hidden" id="pendapatanPerTanggal" value="{{ json_encode($pendapatanPerTanggal) }}">
                                <!-- Line Chart -->
                                <div id="lineChart" style="min-height: 400px;" class="echart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const pendapatanPerTanggal = JSON.parse(document.getElementById('pendapatanPerTanggal').value);

                                        // Ubah data pendapatan per tanggal ke dalam format yang sesuai
                                        const tanggal = Object.keys(pendapatanPerTanggal);
                                        const totalPendapatan = Object.values(pendapatanPerTanggal);

                                        // Inisialisasi grafik menggunakan ECharts
                                        const chart = echarts.init(document.querySelector("#lineChart"));

                                        // Konfigurasi opsi grafik
                                        const options = {
                                            tooltip: {
                                                trigger: 'axis',
                                                formatter: '{b}<br/>{c} Pendapatan'
                                            },
                                            xAxis: {
                                                type: 'category',
                                                data: tanggal
                                            },
                                            yAxis: {
                                                type: 'value'
                                            },
                                            series: [{
                                                data: totalPendapatan,
                                                type: 'line',
                                                smooth: true
                                            }]
                                        };

                                        // Set opsi grafik ke grafik
                                        chart.setOption(options);
                                    });
                                </script>

                                <!-- End Line Chart -->

                            </div>
                        </div>
                    </div>
                    <!-- End Line Chart -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title pt-0">Top 5 Penjualan</h5>

                        @foreach($menuSales as $menu)
                        <div class="menu-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $menu->menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="menu-image">
                                <div class="menu-details ms-3">
                                    <h4 class="menu-name mb-0">{{ $menu->menu->nama_menu }}</h4>
                                    <p class="menu-stock mt-0">Terjual : {{ $menu->total_sales }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <!-- End Recent Activity -->

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title pt-0">Stok Tersisa</h5>

                        @foreach($menuData as $menu)
                        <div class="menu-item">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="menu-image">
                                <div class="menu-details ms-3">
                                    <h4 class="menu-name mb-0">{{ $menu->nama_menu }}</h4>
                                    <p class="menu-stock mt-0">{{ $menu->stok->sum('jumlah') }} Tersisa</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <!-- End Recent Activity -->


            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->
@endsection

<style>
    .menu-name {
        font-size: 15px;
        margin-top: 10px;
    }

    .menu-item {
        margin-bottom: 5px;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 5px;
    }

    .menu-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .menu-details {
        flex-grow: 1;
    }
</style>