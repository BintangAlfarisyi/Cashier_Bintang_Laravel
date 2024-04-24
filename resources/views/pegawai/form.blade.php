<div class="modal fade" id="modalFormPegawai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormPegawaiLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="pegawai" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <div class="mb-3">
                        <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                            <input type="time" class="form-control" id="waktu_masuk" name="waktu_masuk">
                        </div>
                        <div class="col">
                            <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                            <input type="time" class="form-control" id="waktu_keluar" name="waktu_keluar">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status">
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

@include('pegawai.import')