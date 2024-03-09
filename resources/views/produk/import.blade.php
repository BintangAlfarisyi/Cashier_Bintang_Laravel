<div class="modal fade" id="modalFormImportProduk" tabindex="-1" aria-labelledby="modalFomrImportProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFomrImportProdukModalLabel">Import Data Produk</h5>
                <button type="button" class="btn-close" style="font-size: 1.5rem;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('produk/import') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="import" class="form-label">Pilih File Excel</label>
                            <input type="file" class="form-control" name="import" id="import" accept=".xls, .xlsx">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Unggah</button>
                </div>
            </form>
        </div>
    </div>
</div>