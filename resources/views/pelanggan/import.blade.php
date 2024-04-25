<div class="modal fade" id="importPelanggan" tabindex="-1" aria-labelledby="importPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importPelangganModalLabel">Import Data Jenis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('pelanggan/import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="import" class="form-label">File Excel</label>
                        <input type="file" name="import" id="import" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>