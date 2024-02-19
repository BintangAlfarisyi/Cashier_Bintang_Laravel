@extends('templates.layout')

@push('style')
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Checkout</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Pemesanan</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/checkout">Checkout</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container d-flex justify-content-between p-3">
        <div class="item" style="flex-basis: 70%;">
            <div class="accordion" id="menuAccordion">
                @foreach ($jenis as $j)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$j->id}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$j->id}}" aria-expanded="true" aria-controls="collapse{{$j->id}}">
                            {{ $j->nama_jenis }}
                        </button>
                    </h2>
                    <div id="collapse{{$j->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$j->id}}" data-bs-parent="#menuAccordion">
                        <div class="accordion-body">
                            <ul class="menu-item list-group list-group-flush">
                                @foreach ($j->menu as $menu)
                                <li class="list-group-item" data-harga="{{ $menu->harga }}" data-id="{{ $menu->id }}">
                                    {{ $menu->nama_menu }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="item content p-4" style="flex-basis: 30%;">
            <h3>Order</h3>
            <ul class="ordered-list list-group">

            </ul>
            <div>
                <button id="btn-bayar" class="btn btn-primary">Bayar</button>
            </div>
            <div class="mt-3">
                Total Bayar : <h2 id="total">0</h2>
            </div>
        </div>
    </div>

</main><!-- End #main -->
@endsection

@push('script')
<script>
    // Penutup Jenis List
    document.addEventListener('DOMContentLoaded', function() {
        var accordionItems = document.querySelectorAll('.accordion-item');

        accordionItems.forEach(function(item) {
            item.addEventListener('click', function() {
                var accordionCollapse = this.querySelector('.accordion-collapse');
                var isCollapsed = accordionCollapse.classList.contains('show');

                // Close all other accordions
                var accordions = document.querySelectorAll('.accordion-collapse.show');
                accordions.forEach(function(accordion) {
                    if (accordion !== accordionCollapse) {
                        accordion.classList.remove('show');
                    }
                });

                // Toggle collapsed state
                if (isCollapsed) {
                    accordionCollapse.classList.remove('show');
                } else {
                    accordionCollapse.classList.add('show');
                }
            });
        });
    });

    $(function() {
        // Inisialisasi
        const orderedList = [];
        let total = 0;

        const sum = () => {
            return orderedList.reduce((accumulator, object) => {
                return accumulator + (object.harga * object.qty);
            }, 0);
        };

        const changeQty = (el, inc) => {
            // Ubah di array
            const id = $(el).closest('li')[0].dataset.id;
            const index = orderedList.findIndex(list => list.id == id);
            orderedList[index].qty += orderedList[index].qty == 1 && inc == -1 ? 0 : inc;

            // Ubah qty dan ubah subtotal
            const txt_subtotal = $(el).closest('li').find('.subtotal')[0];
            const txt_qty = $(el).closest('li').find('.qty-item')[0];
            txt_qty.value = parseInt(txt_qty.value) == 1 && inc == -1 ? 1 : parseInt(txt_qty.value) + inc;
            txt_subtotal.innerHTML = orderedList[index].harga * orderedList[index].qty;

            // Ubah jumlah total
            $('#total').html(sum());
        };

        // Events
        $('.ordered-list').on('click', '.btn-dec', function() {
            changeQty(this, -1);
        });

        $('.ordered-list').on('click', '.btn-inc', function() {
            changeQty(this, 1); // Perbaiki parameter di sini
        });

        $('.ordered-list').on('click', '.remove-item', function() {
            const item = $(this).closest('li')[0];
            let index = orderedList.findIndex(list => list.id == parseInt(item.dataset.id));
            orderedList.splice(index, 1);
            $(this).closest('li').remove(); // Perbaiki pemanggilan remove
            $('#total').html(sum());
        });

        $('#btn-bayar').on('click', function() {
            $.ajax({
                url: "{{ route('checkout.store') }}",
                method: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    orderedList: orderedList,
                    total: total
                },
                success: function(data) { // Perbaiki pengejaan di sini
                    console.log(data);
                }
            });
        });

        $(".menu-item li").click(function() {
            const menu_clicked = $(this).text();
            const data = $(this)[0].dataset;
            const harga = parseFloat(data.harga);
            const id = parseInt(data.id);

            if (orderedList.every(list => list.id !== id)) {
                let dataN = {
                    'id': id,
                    'menu': menu_clicked,
                    'harga': harga,
                    'qty': 1
                };
                orderedList.push(dataN);
                let listOrder = `
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${id}">
                    <h5>${menu_clicked}</h5>
                    <div class="input-group">
                        <span class="input-group-text">Sub Total : Rp. ${harga}</span>
                        <button class='btn btn-danger remove-item'>Hapus</button>
                        <button class="btn btn-secondary btn-dec">-</button>
                        <input class="form-control qty-item" type="number" value="1" style="width:60px" readonly>
                        <button class="btn btn-secondary btn-inc">+</button>
                        <h2><span class="subtotal">${harga * 1}</span></h2>
                    </div>
                </li>`;
                $('.ordered-list').append(listOrder);
            }
            $('#total').html(sum());
        });
    });
</script>
@endpush