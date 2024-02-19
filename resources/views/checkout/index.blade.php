@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Jenis</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/jenis">Jenis</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        {{-- <div class="item header">Header</div> --}}
        <div class="item">
            <ul class="menu-container">
                @foreach ($jenis as $j)
                <li>
                    <h3>{{ $j->nama_jenis }}</h3>
                    <ul class="menu-item" style="cursor: pointer;">
                        @foreach ($j->menu as $menu)
                        <li data-harga="{{ $menu->harga }}" data-id="{{ $menu->id }}">
                            {{ $menu->nama_menu }}
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
    </div>
    <div class="item content">
        <h3>Order</h3>
        <ul class="ordered-list">

        </ul>
        Total Bayar : <h2 id="total"> 0</h2>
        <div>
            <button id="btn-bayar">Bayar</button>
        </div>



</main><!-- End #main -->
@endsection

@include('jenis.form')

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
        $('#modalFormJenis').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama = btn.data('nama_jenis')
            const kategori_id = btn.data('kategori_id')

            // Membedakan Input Atau Edit
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#nama_jenis').val(nama)
                modal.find('#kategori_id').val(kategori_id)
                modal.find('#method').html('@method("PUT")')
                modal.find('form').attr('action', `{{ url('jenis') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Tambah Data')
                modal.find('#nama_jenis').val('')
                modal.find('#kategori_id').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', '{{ url("jenis") }}')
            }
        })

        $('#modalFormJenis').on('shown.bs.modal', function() {
            $('#nama_jenis').delay(1000).focus().select();
        })
    })
</script>
@endpush