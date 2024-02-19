@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Menu</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/menu">Menu</a></li>
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

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormTransaksi">
                    <i class="bi bi-plus"></i> Tambah Transaksi
                </button>
                @include('transaksi.data')
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

@include('transaksi.form')

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
        $('#modalFormTransaksi').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const tanggal = btn.data('tanggal')
            const total_harga = btn.data('total_harga')
            const metode_pembayaran = btn.data('metode_pembayaran')
            const keterangan = btn.data('keterangan')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#tanggal').val(tanggal)
                modal.find('#total_harga').val(total_harga)
                modal.find('#metode_pembayaran').val(metode_pembayaran)
                modal.find('#keterangan').val(keterangan)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('transaksi') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#tanggal').val('')
                modal.find('#total_harga').val('')
                modal.find('#metode_pembayaran').val('')
                modal.find('#keterangan').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("transaksi") }}')
            }
        })
        
        $('#modalFormTransaksi').on('shown.bs.modal', function() {
            $('#tanggal').delay(1000).focus().select();
        })
    })
</script>
@endpush