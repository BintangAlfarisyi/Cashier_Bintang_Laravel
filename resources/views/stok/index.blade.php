@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Stok</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/stok">Stok</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormStok">
                        <i class="bi bi-plus"></i> Tambah Stok
                    </button>
                    <div class="right">
                        <a href="{{ route('exportExcelStok') }}" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export XSLX
                        </a>
                        <button href="{{ route('importStok') }}" type="button" class="btn btn-success btn-import" data-bs-toggle="modal" data-bs-target="#ImportStok">
                            <i class="bi bi-file-earmark-excel"></i> Import XSLX
                        </button>
                        <a href="{{ route('exportPdfStok') }}" class="btn btn-danger" target="_blank">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
                @include('stok.data')
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@include('stok.form')

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
        $('#modalFormStok').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const menu_id = btn.data('menu_id')
            const jumlah = btn.data('jumlah')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#menu_id').val(menu_id).prop('readonly', true).css('pointer-events', 'none').css('background-color', '#eee')
                modal.find('#jumlah').val(jumlah)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('stok') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#menu_id').val('').prop('readonly', false)
                modal.find('#jumlah').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("stok") }}')
            }
        })

        $('#modalFormStok').on('shown.bs.modal', function() {
            $('#menu_id').delay(1000).focus().select();
        })
    })
</script>
@endpush