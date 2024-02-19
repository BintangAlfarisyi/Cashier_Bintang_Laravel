@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Meja</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/meja">Meja</a></li>
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

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormMeja">
                    <i class="bi bi-plus"></i> Tambah Meja
                </button>
                @include('meja.data')
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@include('meja.form')

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
        $('#modalFormMeja').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const no_meja = btn.data('no_meja')
            const kapasitas = btn.data('kapasitas')
            const status = btn.data('status')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#no_meja').val(no_meja)
                modal.find('#kapasitas').val(kapasitas)
                modal.find('#status').val(status)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('meja') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#no_meja').val('')
                modal.find('#kapasitas').val('')
                modal.find('#status').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("meja") }}')
            }
        })
        
        $('#modalFormMeja').on('shown.bs.modal', function() {
            $('#no_meja').delay(1000).focus().select();
        })
    })
</script>
@endpush