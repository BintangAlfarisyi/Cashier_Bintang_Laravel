@extends('templates.layout')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pemesanan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active" aria-current="page"><a href="/checkout">Pemesanan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container d-flex justify-content-between p-3">
        <div class="item" style="flex-basis: 60%;">
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
                                <li class="list-group-item d-flex" data-harga="{{ $menu->harga }}" data-id="{{ $menu->id }}">
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
        <div class="item content p-4" style="flex-basis: 35%; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
            <div class="title d-flex justify-content-between">
                <h3>Order</h3>
                <button class="btn btn-danger justify-content-center align-items-center p-0 mt-1 btn-remove-all" style="border-radius: 50%; width: 25px; height: 25px;"><i class="bi bi-x-circle h5"></i></button>
            </div>
            <ul class="ordered-list list-group" style="padding-left: 20px;">

            </ul>
            <div style="margin-top: 20px;">
                <button id="btn-bayar" class="btn btn-primary">Bayar</button>
            </div>
            <div class="mt-3">
                Total Bayar : <h2 id="total" style="display: inline-block; margin-left: 10px;">Rp.0</h2>
            </div>
        </div>
    </div>
</main><!-- End #main -->
@endsection

@push('script')
<script>
    $(function() {
        // Inisialisasi
        const orderedList = [];

        const sum = () => {
            return orderedList.reduce((accumulator, object) => {
                return accumulator + (object.harga * object.qty);
            }, 0);
        };

        const changeQty = (el, inc) => {
            const id = $(el).closest('li')[0].dataset.id;
            const index = orderedList.findIndex(list => list.menu_id == id);
            let currentQty = orderedList[index].qty;
            let newQty = currentQty + inc;
            if (newQty < 1) {
                Swal.fire({
                    icon: "info",
                    title: "Info",
                    text: "Kuantitas Minimal 1!",
                });
                return;
            }
            if (newQty > 10) {
                Swal.fire({
                    icon: "info",
                    title: "Info",
                    text: "Kuantitas Maksimal 10!",
                });
                return;
            }
            orderedList[index].qty = newQty;
            const txt_subtotal = $(el).closest('li').find('.subtotal')[0];
            const txt_qty = $(el).closest('li').find('.qty-item')[0];
            txt_qty.innerHTML = newQty;
            txt_subtotal.innerHTML = `Rp.${orderedList[index].harga * newQty}`;
            $('#total').html(`Rp.${sum()}`);
        };

        $('.ordered-list').on('click', '.btn-dec', function() {
            changeQty(this, -1);
        });

        $('.ordered-list').on('click', '.btn-inc', function() {
            changeQty(this, 1);
        });

        $('.ordered-list').on('click', '.remove-item', function() {
            const item = $(this).closest('li')[0];
            let index = orderedList.findIndex(list => list.id == parseInt(item.dataset.id));
            orderedList.splice(index, 1);
            $(this).closest('li').remove();
            $('#total').html(`Rp.${sum()}`);
        });

        $('.btn-remove-all').on('click', function() {
            $('.ordered-list').empty(); // Menghapus semua item dari ordered list
            orderedList = []; // Mengosongkan orderedList (jika variabel tersebut didefinisikan sebelumnya)
            $('#total').html(`Rp.${sum()}`); // Mengupdate total setelah semua item dihapus
        });

        $('#btn-bayar').on('click', function(event) {
            event.preventDefault();
            if (orderedList.length === 0) {
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan",
                    text: "Anda Belum Memesan Apapun!",
                });
                return;
            }

            // Swal.fire({
            //     icon: "success",
            //     title: "Pembayaran Berhasil",
            //     text: "Pemesanan Sedang Diproses!",
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         window.location.reload();
            //     }
            // })

            $.ajax({
                url: "{{ route('transaksi.store') }}",
                method: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    orderedList: orderedList,
                    total: sum() // Perbarui total menggunakan fungsi sum()
                },
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        title: data.message,
                        showDenyButton: true,
                        confirmButtonText: 'Cetak Nota',
                        denyButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("{{ url('nota') }}/" + data.noTrans)
                            location.reload();
                        } else if (result.isDenied) {
                            location.reload();
                        }
                    })
                },
                error: function(request, status, error) {
                    console.log(status, error);
                    Swal.fire('Pemesanan Gagal');
                }
            });
        });

        $(".menu-item li").click(function() {
            const menu_clicked = $(this).text();
            const data = $(this)[0].dataset;
            const harga = parseFloat(data.harga);
            const id = parseInt(data.id);

            if (orderedList.every(list => list.menu_id !== id)) {
                let dataN = {
                    'menu_id': id,
                    'menu': menu_clicked,
                    'harga': harga,
                    'qty': 1
                };
                orderedList.push(dataN);
                let listOrder = `
            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${id}">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="p-1">${menu_clicked}</h5>
                        <button type="button" class="btn-close btn-lg remove-item" aria-label="Close"></button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-5">
                            <p class="mb-2">Harga</p>
                            <h5 class="small">Rp.${harga}</h5>
                        </div>
                        <div class="d-flex align-items-center border rounded me-5 mt-4">
                            <button class="btn-dec border-0 ">-</button>
                            <div class="qty-item border-0 small text-center px-2" contenteditable="false">1</div>
                            <button class="btn-inc border-0 ">+</button>
                        </div>
                        <div class="ms-auto">
                            <p class="mb-2">Total</p>
                            <h5 class="small subtotal">Rp.${harga * 1}</h5>
                        </div>
                    </div>
                </div>
            </li>
            `;
                $('.ordered-list').append(listOrder);
            }
            $('#total').html(`Rp.${sum()}`);
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
</style>