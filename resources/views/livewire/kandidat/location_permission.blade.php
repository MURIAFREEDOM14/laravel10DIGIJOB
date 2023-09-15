<div>
    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Provinsi</label>
        </div>
        <div class="col-md-8">
            <!-- pilihan provinsi -->
            <select wire:model.live="kota" required class="form-select" name="provinsi_perizin" id="provinsi">
                <option value="">-- Pilih Provinsi --</option>
                @foreach($provinsis as $item)
                    <option value="{{ $item->id }}" >{{ $item->provinsi }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Kabupaten / Kota</label>
        </div>
        <div class="col-md-8">
            <!-- pilihan kota / kab -->
            <select class="form-select" required wire:model.live="kecamatan" name="kota_perizin" id="kota">
                @if (!is_null($kota))
                    <option value="">-- Pilih Kabupaten / Kota --</option>
                    @foreach($kotas as $item)
                        <option value="{{ $item->id }}" @if ($kandidat->kabupaten == $item->id)
                            selected
                        @endif>{{ $item->kota }}</option>
                    @endforeach
                @else
                    <option value="">-- Harap Pilih Provinsi Dahulu --</option>
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Kecamatan</label>
        </div>
        <div class="col-md-8">
            <!-- pilihan kecamatan -->
            <select class="form-select" required wire:model.live="kelurahan" name="kecamatan_perizin" id="kecamatan">
                @if (!is_null($kecamatan))
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($kecamatans as $item)
                        <option value="{{ $item->id }}" @if ($kandidat->kecamatan == $item->id)
                            selected
                        @endif>{{ $item->kecamatan }}</option>
                    @endforeach
                @else
                    <option value="">-- Harap Pilih Kabupaten / Kota Dahulu --</option>
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Kelurahan</label>
        </div>
        <div class="col-md-8">
            <!-- pilihan kelurahan -->
            <select class="form-select" required name="kelurahan_perizin" id="kelurahan">
                @if (!is_null($kelurahan))
                    <option value="">-- Pilih Kelurahan --</option>
                    @foreach($kelurahans as $item)
                        <option value="{{ $item->id }}" @if ($kandidat->kelurahan == $item->id)
                            selected
                        @endif>{{ $item->kelurahan }}</option>
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
            <label for="inputPassword6" class="col-form-label">Dusun</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" value="{{$kandidat->dusun_perizin}}" name="dusun_perizin" required placeholder="Masukkan Alamat Dusun" id="dusun">
        </div>
    </div>
</div>