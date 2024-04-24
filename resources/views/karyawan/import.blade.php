<div class="modal fade" id="importJenis" tabindex="-1" aria-labelledby="importJenisModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importJenisModalLabel">Import Data Jenis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('jenis/import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis" class="form-label">File Excel</label>
                        <input type="file" name="jenis" id="jenis" class="form-control">
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