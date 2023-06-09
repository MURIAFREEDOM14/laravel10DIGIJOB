<form action="/simpan_kandidat_pengalaman_kerja">
    <div class="">
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Alamat Perusahaan</label>
            <input type="text" name="alamat_perusahaan" class="form-control" id="alamat_perusahaan" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" id="jabatan" aria-describedby="emailHelp" required>
        </div>
        <div class="row mb-2">
            <label for="">Periode</label>
            <div class="col-6">
                <input type="date" required class="form-control" name="periode_awal" id="periode_awal">
            </div>
            <div class="col-6">
                <input type="date" required class="form-control" name="periode_akhir" id="periode_akhir">
            </div>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Alasan Berhenti</label>
            <input type="text" required name="alasan_berhenti" class="form-control" id="alasan_berhenti" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Video Kerja</label>
            <input type="file" name="video" class="form-control" id="video" aria-describedby="emailHelp" accept="video/*">
            <small>Usahakan untuk ukuran video 3mb</small>
        </div>
        <div class="mb-2">
            <button class="btn btn-success" onclick="store()">Simpan</button>
        </div>    
    </div>
</form>