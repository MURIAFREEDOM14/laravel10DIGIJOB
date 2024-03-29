<div>
    <!-- pilihan provinsi -->
    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Provinsi</label>
        </div>
        <div class="col-md-8">
            <select wire:model.live="kota" required class="form-control" name="provinsi_perizin">
                <option value="">-- Pilih Provinsi --</option>
                @foreach($provinsis as $item)
                    <option value="{{ $item->id }}" >{{ $item->provinsi }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- pilhan kota / kab -->
    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Kabupaten / Kota</label>
        </div>
        <div class="col-md-8">
            <select class="form-control" required wire:model.live="kecamatan" name="kota_perizin">
                @if (!is_null($kota))
                    <option value="">-- Pilih Kabupaten / Kota --</option>
                    @foreach($kotas as $item)
                        <option value="{{ $item->id }}" >{{ $item->kota }}</option>
                    @endforeach
                @else
                    <option value="">-- Harap Pilih Provinsi Dahulu --</option>
                @endif
            </select>
        </div>
    </div>

    <!-- pilihan kecamatan -->
    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Kecamatan</label>
        </div>
        <div class="col-md-8">
            <select class="form-control" required wire:model.live="kelurahan" name="kecamatan_perizin">
                @if (!is_null($kecamatan))
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($kecamatans as $item)
                        <option value="{{ $item->id }}" >{{ $item->kecamatan }}</option>
                    @endforeach
                @else
                    <option value="">-- Harap Pilih Kabupaten / Kota Dahulu --</option>
                @endif
            </select>
        </div>
    </div>

    <!-- pilihan kelurahan -->
    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Kelurahan</label>
        </div>
        <div class="col-md-8">
            <select class="form-control" required name="kelurahan_perizin">
                @if (!is_null($kelurahan))
                    <option value="">-- Pilih Kelurahan --</option>
                    @foreach($kelurahans as $item)
                        <option value="{{ $item->id }}" >{{ $item->kelurahan }}</option>
                    @endforeach
                @else
                    <option value="">-- Harap Pilih Kecamatan Dahulu --</option>
                @endif          
            </select>
        </div>
    </div>

    <!-- input dusun -->
    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="" class="col-form-label">Dusun</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" value="{{$kandidat->dusun_perizin}}" name="dusun_perizin"  placeholder="Masukkan Alamat Dusun">
        </div>
    </div>
</div>