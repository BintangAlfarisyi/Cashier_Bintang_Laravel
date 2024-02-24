@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Detail Transaksi</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/detail_transaksi">Detail Transaksi</a></li>
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

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormDetailTransaksi">
                    <i class="bi bi-plus"></i> Tambah Detail Transaksi
                </button>
                @include('detail_transaksi.data')
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@include('detail_transaksi.form')

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
            const nama = $(this).closest('tr').find('td:eq(3)').text();
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
        $('#modalFormDetailTransaksi').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const transaksi_id = btn.data('transaksi_id')
            const menu_id = btn.data('menu_id')
            const jumlah = btn.data('jumlah')
            const sub_total = btn.data('sub_total')
            const jenis_id = btn.data('jenis_id')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#transaksi_id').val(transaksi_id)
                modal.find('#menu_id').val(menu_id)
                modal.find('#jumlah').val(jumlah)
                modal.find('#sub_total').val(sub_total)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('detail_transaksi') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#transaksi_id').val('')
                modal.find('#menu_id').val('')
                modal.find('#jumlah').val('')
                modal.find('#sub_total').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("detail_transaksi") }}')
            }
        })

        $('#modalFormDetailTransaksi').on('shown.bs.modal', function() {
            $('#transaksi_id').delay(1000).focus().select();
        })
    })
</script>
@endpush