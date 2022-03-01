<div class="LOCO-form">
    <h5 class="text-primary mb-3">Informasi @if($jenis == 'loco') Distributor @else Customer @endif</h5>
    <div class="form-group">
        <label for="exampleInputEmail1">Label</label>
        <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan label"
            required id="urut" name="urut">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama @if($jenis == 'loco') Distributor @else Customer @endif</label>
        <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan nama usaha"
            required id="nama_usaha" name="nama_usaha">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Alamat Tujuan</label>
        <textarea class="form-control" autocomplete="off" placeholder="Masukkan alamat lengkap" required
            id="alamat" rows="5" name="alamat"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tonase Per Bulan (Ton)</label>
        <input type="text" class="form-control numeric" autocomplete="off" placeholder="Masukkan tonase"
            required id="tonase" name="tonase">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Pengiriman Per Bulan (Kali)</label>
        <input type="text" class="form-control numeric" autocomplete="off" placeholder="Masukkan jumlah pengiriman"
            required id="jumlah_pengiriman" name="jumlah_pengiriman">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Ekspedisi</label>
        <select class="form-control ekspedisi select_2" data-placeholder="Pilih jenis ekspedisi" required name="ekspedisi" id="ekspedisi">
            <option value=""></option>
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Jenis Kendaraan Pengiriman</label>
        <select class="form-control jenis-kendaraan select_2" multiple required name="jenis_kendaraan[]" id="jenis_kendaraan">
            <option value="box 150">Box 150</option>
            <option value="box 300">Box 300</option>
            <option value="truk 300">Truk 300</option>
            <option value="fuso">Fuso</option>
        </select>
    </div>
    <div class="form-group">
        <div id="cExistImage" style="display: none;">
            <label id="existImageLabel" for="exampleInputEmail1">Foto | <span class="text-danger">*Pilih
                    foto yang akan dihapus</span></label>
            <ul class="img-list" id="imgList">
            </ul>
        </div>
        <label for="">Tambah Foto</label><br>
        <input type="file" style="line-height: normal !important; font-size: 14px !important;"
            multiple="multiple" id="file" name="file[]">
    </div>
    <hr>
    <h5 class="text-primary mt-3 mb-3">Jarak</h5>
    <div class="form-group">
        <label for="">Jarak Dari Plant | <a href="#"
                class="badge badge-primary text-md" id="calculate">Hitung Jarak</a></label>
        <div id="cJarak">
            @foreach ($plant as $row)
            <div class="row @if($loop->index > 0) mt-3 mt-md-0 @endif">
                <div class="col-md-6 mb-mb-3 mb-2">
                    <input type="text" name="plant_nama[]" value="{{ $row->NAMA }}" class="form-control readonly" required  readonly placeholder="Plant">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control decimal jarak" placeholder="Jarak Km (Decimal)"
                        id="jarak{{$row->KODE}}" name="jarak[]">
                </div>
                <input type="hidden" class="plants" id="plant{{$row->KODE}}" data-lat="{{ $row->LAT }}" data-lng="{{ $row->LNG }}" name="plant[]" value="{{ $row->KODE }}">
            </div>
            @endforeach
        </div>
    </div>
</div>