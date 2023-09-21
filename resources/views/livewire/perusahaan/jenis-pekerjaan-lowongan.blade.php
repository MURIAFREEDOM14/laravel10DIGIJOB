<div>
    <!-- pilihan jenis pekerja -->
    <select name="lvl_pekerjaan" required class="form-control" id="jenisPekerjaan">
        <option value="">-- Tentukan Jenis Pekerja --</option>
        @foreach ($jenis_pekerjaan as $item)
            <option value="{{$item->judul}}">{{$item->judul}}</option>
        @endforeach
        <option value="lainnya">Lainnya</option>
    </select>
</div>
