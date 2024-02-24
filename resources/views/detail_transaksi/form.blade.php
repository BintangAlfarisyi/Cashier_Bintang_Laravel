<div class="modal fade" id="modalFormDetailTransaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormDetailTransaksiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormDetailTransaksiLabel">Tambah Data</h5>
                <button type="button" class="btn-close" style="font-size: 2rem;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="detail_transaksi" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <div class="mb-3">
                        <label for="transaksi_id" class="form-label">Transaksi Id</label>
                        <input type="number" class="form-control" id="transaksi_id" name="transaksi_id">
                    </div>
                    <div class="mb-3">
                        <label for="menu_id" class="form-label">Menu Id</label>
                        <input type="number" class="form-control" id="menu_id" name="menu_id">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="sub_total" class="form-label">Sub Total</label>
                        <input type="text" class="form-control" id="sub_total" name="sub_total">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>