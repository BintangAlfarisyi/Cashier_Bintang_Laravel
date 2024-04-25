<div class="modal fade" id="modalFormStok" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormStokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormStokLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="stok" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <div class="mb-3">
                        <label for="menu_id" class="form-label">Menu</label>
                        <div class="input-group">
                            <select class="form-select" id="menu_id" name="menu_id">
                                <option selected disabled>Pilih Menu</option>
                                @foreach($menu as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_menu }}</option>
                                @endforeach
                            </select>
                            <label class="input-group-text" for="menu_id"><i class="fas fa-caret-down"></i></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
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

@include('stok.import')