@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Karyawan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/karyawan">Karyawan</a></li>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormKaryawan">
                        <i class="bi bi-plus"></i> Tambah Karyawan
                    </button>
                    <div class="right">
                        <a href="{{ route('exportExcelJenis') }}" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export XSLX
                        </a>
                        <button href="{{ route('importJenis') }}" type="button" class="btn btn-success btn-import" data-bs-toggle="modal" data-bs-target="#ImportJenis">
                            <i class="bi bi-file-earmark-excel"></i> Import XSLX
                        </button>
                        <a href="{{ route('exportPdfJenis') }}" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
                @include('karyawan.data')
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@include('karyawan.form')

@push('script')
<script>
    $(document).ready(function() {
        $('.status-select').change(function() {
            var selectedValue = $(this).val();
            var dataId = $(this).data('id');

            $.ajax({
                url: '/update-status',
                method: 'POST',
                data: {
                    id: dataId,
                    status: selectedValue
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });


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
        $('#modalFormJenis').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama = btn.data('nama_karyawan')
            const tanggal_masuk = btn.data('tanggal_masuk')
            const waktu_masuk = btn.data('waktu_masuk')
            const status = btn.data('status')
            const waktu_keluar = btn.data('waktu_keluar')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#nama_karyawan').val(nama)
                modal.find('#tanggal_masuk').val(tanggal_masuk)
                modal.find('#waktu_masuk').val(waktu_masuk)
                modal.find('#status').val(status)
                modal.find('#waktu_keluar').val(waktu_keluar)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('karyawan') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#nama_karyawan').val('')
                modal.find('#tanggal_masuk').val('')
                modal.find('#waktu_masuk').val('')
                modal.find('#status').val('')
                modal.find('#waktu_keluar').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("karyawan") }}')
            }
        })

        $('#modalFormKaryawan').on('shown.bs.modal', function() {
            $('#nama_karyawan').delay(1000).focus().select();
        })
    })
</script>
@endpush