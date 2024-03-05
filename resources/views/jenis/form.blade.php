<div class="modal fade" id="modalFormJenis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormJenisLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormJenisLabel">Tambah Data</h5>
                <button type="button" class="btn-close" style="font-size: 2rem;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="jenis" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <div class="mb-3">
                        <label for="nama_jenis" class="form-label">Nama Jenis</label>
                        <input type="text" class="form-control" id="nama_jenis" name="nama_jenis">
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori Id</label>
                        <input type="text" class="form-control" id="kategori_id" name="kategori_id">
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



<div class="modal fade" id="formImport" tabindex="-1" aria-labelledby="importJenisModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importJenisModalLabel">Import Data Jenis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('jenis/import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="jenis">File Excel</label>
                            <input type="file" name="import" id="import">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>