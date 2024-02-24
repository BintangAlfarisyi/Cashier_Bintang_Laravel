@extends('templates.layout')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Checkout</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Pemesanan</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/pemesanan">Checkout</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container d-flex justify-content-between p-3">
        <div class="item" style="flex-basis: 60%;">
            <!-- Tombol All untuk menampilkan semua menu -->
            <button class="btn btn-primary mb-3" onclick="showAll()">All</button>

            <!-- Tombol untuk setiap jenis -->
            @foreach ($jenis as $j)
            <button class="btn btn-secondary mb-3" onclick="showMenu('{{ $j->id }}')">{{ $j->nama_jenis }}</button>
            @endforeach

            <!-- Daftar menu -->
            <div id="menuItems" class="row">
                @foreach ($jenis as $j)
                @foreach ($j->menu as $menu)
                <div class="col-md-4 mb-3" id="menu_{{ $j->id }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <button class="btn btn-primary" onclick="addToOrder('{{ $menu->id }}', '{{ $menu->nama_menu }}', '{{ $menu->harga }}')">Add to Order</button>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
        <div class="item content p-4" style="flex-basis: 35%; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
            <h3 style="margin-bottom: 20px;">Order</h3>
            <ul class="ordered-list list-group" style="padding-left: 20px;">

            </ul>
            <div style="margin-top: 20px;">
                <button id="btn-bayar" class="btn btn-primary">Bayar</button>
            </div>
            <div class="mt-3 d-flex">
                <h3>Total Bayar : </h3>
                <h3 id="total" style="display: inline-block; margin-left: 10px;">Rp. 0</h3>
            </div>
        </div>
    </div>
</main><!-- End #main -->
@endsection

@push('script')
<script>
    function showAll() {
        $('.row > div').removeClass('d-none');
    }

    function showMenu(jenisId) {
        // Sembunyikan semua menu terlebih dahulu
        $('.row > div').addClass('d-none');

        // Tampilkan hanya menu dengan jenis yang sesuai dengan jenis yang dipilih
        $(`.row > div[id^='menu_${jenisId}']`).removeClass('d-none');
    }

    function addToOrder(id, nama_menu, harga) {
        const orderedList = $('.ordered-list');
        const existingItem = orderedList.find(`li[data-id="${id}"]`);

        if (existingItem.length > 0) {
            const qtyItem = existingItem.find('.qty-item');
            const currentQty = parseInt(qtyItem.text());
            qtyItem.text(currentQty + 1);
            updateSubtotal(existingItem, qty, harga);
        } else {
            const listItem = `
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${id}">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="pt-1">${nama_menu}</h5>
                            <button type="button" class="btn-close btn-lg remove-item" aria-label="Close"></button>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-4">
                                <p class="mb-2">Harga</p>
                                <h5 class="small">Rp.${harga}</h5>
                            </div>
                            <div class="d-flex align-items-center border rounded me-4 mt-4">
                                <button class="btn-dec border-0 ">-</button>
                                <div class="qty-item border-0 small text-center px-2" contenteditable="false">1</div>
                                <button class="btn-inc border-0 ">+</button>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-2">Total</p>
                                <h5 class="small subtotal">Rp.${harga}</h5>
                            </div>
                        </div>
                    </div>
                </li>
            `;
            orderedList.append(listItem);
        }

        updateTotal();
    }

    function updateSubtotal(item, qty, harga) {
        const subtotal = qty * harga;
        item.find('.subtotal').text(`Rp.${subtotal}`);
    }

    function updateTotal() {
        let total = 0;
        $('.ordered-list li').each(function() {
            const subtotalText = $(this).find('.subtotal').text();
            const subtotal = parseFloat(subtotalText.replace('Rp.', ''));
            total += subtotal;
        });
        $('#total').text(`Rp.${total}`);
    }

    $(document).on('click', '.btn-dec', function() {
        const qtyItem = $(this).siblings('.qty-item');
        let qty = parseInt(qtyItem.text());
        if (qty > 1) {
            qty--;
            qtyItem.text(qty);
            const harga = parseFloat($(this).closest('li').find('.small').text().replace('Rp.', ''));
            updateSubtotal($(this).closest('li'), qty, harga);
            updateTotal();
        }
    });

    $(document).on('click', '.btn-inc', function() {
        const qtyItem = $(this).siblings('.qty-item');
        let qty = parseInt(qtyItem.text());
        if (qty < 10) {
            qty++;
            qtyItem.text(qty);
            const harga = parseFloat($(this).closest('li').find('.small').text().replace('Rp.', ''));
            updateSubtotal($(this).closest('li'), qty, harga);
            updateTotal();
        }
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('li').remove();
        updateTotal();
    });

    $(document).ready(function() {
        // Initialize total
        updateTotal();

        $('#btn-bayar').on('click', function() {
            const totalBayar = $('#total').text();
            if (parseFloat(totalBayar.replace('Rp.', '')) === 0) {
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan",
                    text: "Anda belum memilih pesanan apapun!"
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Pembayaran Berhasil",
                    text: "Pemesanan Diproses!"
                });

                // Collect ordered items
                const orderedList = [];
                $('.ordered-list li').each(function() {
                    const id = $(this).data('id');
                    const nama_menu = $(this).find('h5').text();
                    const qty = parseInt($(this).find('.qty-item').text());
                    const harga = parseFloat($(this).find('.small').text().replace('Rp.', ''));
                    orderedList.push({
                        id: id,
                        nama_menu: nama_menu,
                        qty: qty,
                        harga: harga
                    });
                });

                // Send AJAX request
                $.ajax({
                    url: "{{ route('transaksi.store') }}",
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        orderedList: orderedList,
                        total: totalBayar
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        });
    });
</script>
@endpush

<style>
    .list-group {
        display: flex;
        flex-direction: column;
        /* Susun child items secara vertical */
    }

    .list-group-item {
        flex-grow: 1;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        cursor: pointer;
    }

    .list-group-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-dec,
    .btn-inc {
        background-color: #fff;
    }

    .qty-item {
        width: 45px;
        outline: none;
        border: none;
    }

    .card-title{
        font-size: 15px !important;
    }
</style>