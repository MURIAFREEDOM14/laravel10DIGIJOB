<form action="" method="POST">
    <div class="">
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" value="{{$pengalaman_kerja->nama->perusahaan}}" class="form-control" id="nama_perusahaan" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Alamat Perusahaan</label>
            <input type="text" name="alamat_perusahaan" value="{{$pengalaman_kerja->alamat->perusahaan}}" class="form-control" id="alamat_perusahaan" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" value="{{$pengalaman_kerja->jabatan}}" class="form-control" id="jabatan" aria-describedby="emailHelp" required>
        </div>
        <div class="row mb-2">
            <label for="">Periode</label>
            <div class="col-6">
                <input type="date" required class="form-control" name="periode_awal" value="{{$pengalaman_kerja->periode_awal}}" id="periode_awal">
            </div>
            <div class="col-6">
                <input type="date" required class="form-control" name="periode_akhir" value="{{$pengalaman_kerja->periode_akhir}}" id="periode_akhir">
            </div>
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Alasan Berhenti</label>
            <input type="text" required name="alasan_berhenti" value="{{$pengalaman_kerja->alasan_berhenti}}" class="form-control" id="alasan_berhenti" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Video Kerja</label>
            @if ($pengalaman_kerja->video_pengalaman_kerja !== null)
                <video width="400" class="" id="video">
                    <source src="/gambar/Kandidat/{{$pengalaman_kerja->nama}}/Pengalaman Kerja/{{$pengalaman_kerja->video_pengalaman_kerja}}">
                </video>
                <button class="btn btn-success mb-2" type="button" onclick="playPause()">Mulai/Jeda</button>
                <input type="file" name="video" class="form-control" id="video" aria-describedby="emailHelp" accept="video/*">
                <small>Usahakan untuk ukuran video 3mb</small>                                
            @else
                <input type="file" name="video" class="form-control" id="video" aria-describedby="emailHelp" accept="video/*">
                <small>Usahakan untuk ukuran video 3mb</small>                                
            @endif            
        </div>
        <div class="mb-2">
            <button class="btn btn-success" onclick="update()">Simpan</button>
        </div>    
    </div>
</form>