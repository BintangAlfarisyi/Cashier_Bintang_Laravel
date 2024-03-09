@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Produk Titipan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/produk">Produk Titipan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card-body">

                <!-- Alert Success -->
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Alert Ketika ada kesalahan -->
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle"></i> Terdapat beberapa masalah:
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormProduk">
                    <i class="bi bi-plus"></i> Tambah Produk Titipan
                </button>
                <a href="{{ route('exportExcelProduk') }}" class="btn btn-success">
                    <i class="bi bi-filetype-xlsx"></i> Export XSLX
                </a>
                <a href="{{ route('exportPdfProduk') }}" class="btn btn-danger">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>
                <button href="{{ route('importProduk') }}" type="button" class="btn btn-warning btn-import" data-bs-toggle="modal" data-bs-target="#modalFormImportProduk">
                    <i class="bi bi-filetype-xlsx"></i> Import
                </button>
                @include('produk.data')
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@include('produk.form')
@include('produk.import')

@push('script')
<script>
    // Alert Berinteraksi   
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    })

    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-danger').slideUp(500)
    })

    // dataTable
    // $(document).ready(function() {
    //     $('#myTable').DataTable();
    // });

    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable('.datatable');
    });

    // Hapus Data
    $(function() {
        // dialog hapus data
        $('.btn-delete').on('click', function(e) {
            const nama = $(this).closest('tr').find('td:eq(1)').text();
            // console.log('nama')
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: `Apakah data <b>${nama}</b> akan di hapus?`,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
                'showDenyButton': true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed)
                    $(e.target).closest('form').submit()
                else swal.close()
            })
        })


        // Update or input
        $('#modalFormProduk').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama_produk = btn.data('nama_produk')
            const nama_supplier = btn.data('nama_supplier')
            const harga_beli = btn.data('harga_beli')
            const harga_jual = btn.data('harga_jual')
            const stok = btn.data('stok')
            const keterangan = btn.data('keterangan')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#nama_produk').val(nama_produk)
                modal.find('#nama_supplier').val(nama_supplier)
                modal.find('#harga_beli').val(harga_beli)
                modal.find('#harga_jual').val(harga_jual)
                modal.find('#stok').val(stok)
                modal.find('#keterangan').val(keterangan)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('produk') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#nama_produk').val('')
                modal.find('#nama_supplier').val('')
                modal.find('#harga_beli').val('')
                modal.find('#harga_jual').val('')
                modal.find('#stok').val('')
                modal.find('#keterangan').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("produk") }}')
            }
        })

        $('#modalFormProduk').on('shown.bs.modal', function() {
            $('#nama_produk').delay(1000).focus().select();
        })
    })

    // Fungsi Penambahan Harga Jual
    document.getElementById("harga_beli").addEventListener("input", function() {
        var hargaBeli = parseFloat(this.value);
        var hargaJual = hargaBeli * 1.7; // Menambahkan 70%
        document.getElementById("harga_jual").value = hargaJual;
    });
</script>
@endpush

<style>
    /* Gaya untuk tabel DataTable */
    #myTable_wrapper {
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #myTable_filter input[type="search"] {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 5px;
        border: 1px solid #ccc;
    }
    
    .dataTables_wrapper .sorting,
    .dataTables_wrapper .sorting_asc,
    .dataTables_wrapper .sorting_desc {
        vertical-align: middle;
        /* Mengatur vertikal alignment agar ikon sejajar dengan teks di dalam header */
        margin-top: -3px;
        /* Menggeser ikon sedikit ke atas */
    }
</style>