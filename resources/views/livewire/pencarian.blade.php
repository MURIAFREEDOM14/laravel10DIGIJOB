<div>
    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Provinsi</label>
        </div>
        <div class="col-md-8">
            <select wire:model="kota" class="form-control" name="provinsi_id">
                <option value="">-- Pilih Provinsi --</option>
                @foreach($provinsis as $item)
                    <option value="{{ $item->id }}">{{ $item->provinsi }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3 g-3 align-items-center">
        <div class="col-md-4">
            <label for="inputPassword6" class="col-form-label">Kabupaten / Kota</label>
        </div>
        <div class="col-md-8">
            <select class="form-control" wire:model="" name="kota_id">
                <option value="">-- Pilih Kabupaten / Kota --</option>
                @if (!is_null($kota))
                    @foreach($kotas as $item)
                        <option value="{{ $item->id }}" >{{ $item->kota }}</option>
                    @endforeach
                @else
                    <option value="">-- Harap Pilih Provinsi Dahulu --</option>
                @endif
            </select>
        </div>
    </div>
</div>
