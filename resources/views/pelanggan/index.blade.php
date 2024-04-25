@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pelanggan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/pelanggan">Pelanggan</a></li>
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
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormPelanggan">
                        <i class="bi bi-plus"></i> Tambah Pelanggan
                    </button>
                    <div class="right">
                        <a href="{{ route('exportExcelPelanggan') }}" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export XSLX
                        </a>
                        <button href="{{ route('importPelanggan') }}" type="button" class="btn btn-success btn-import" data-bs-toggle="modal" data-bs-target="#ImportPelanggan">
                            <i class="bi bi-file-earmark-excel"></i> Import XSLX
                        </button>
                        <a href="{{ route('exportPdfPelanggan') }}" class="btn btn-danger" target="_blank">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
                @include('pelanggan.data')
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@include('pelanggan.form')

@push('script')
<script>
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    })

    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-danger').slideUp(500)
    })

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
        $('#modalFormPelanggan').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama = btn.data('nama_pelanggan')
            const email = btn.data('email')
            const ponsel = btn.data('ponsel')
            const alamat = btn.data('alamat')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#nama_pelanggan').val(nama)
                modal.find('#email').val(email)
                modal.find('#ponsel').val(ponsel)
                modal.find('#alamat').val(alamat)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('pelanggan') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#nama_pelanggan').val('')
                modal.find('#email').val('')
                modal.find('#ponsel').val('')
                modal.find('#alamat').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("pelanggan") }}')
            }
        })

        $('#modalFormPelanggan').on('shown.bs.modal', function() {
            $('#nama_pelanggan').delay(1000).focus().select();
        })
    })
</script>
@endpush