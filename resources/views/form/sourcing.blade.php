<div class="SOURCING-form">
    <h5 class="text-primary mb-3">Lokasi Usaha</h5>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="custom-control custom-radio" style="display: inline-block;">
                    <input type="radio" required name="kategori" class="custom-control-input"
                        id="supplier" value="supplier">
                    <label class="custom-control-label" for="supplier">Supplier</label>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="custom-control custom-radio" style="display: inline-block;">
                    <input type="radio" required name="kategori" class="custom-control-input"
                        id="non_supplier" value="non supplier">
                    <label class="custom-control-label" for="non_supplier">Non Supplier</label>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="custom-control custom-radio" style="display: inline-block;">
                    <input type="radio" required name="kategori" class="custom-control-input"
                        id="kompetitor" value="kompetitor">
                    <label class="custom-control-label" for="kompetitor">Kompetitor</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Usaha</label>
        <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan nama usaha"
            required id="nama_usaha" name="nama_usaha">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Kunjungan</label>
        <input type="text" class="form-control datepicker" placeholder="Pilih tanggal kunjungan"
            required id="tgl_kunjungan" name="tgl_kunjungan">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Jenis Usaha</label>
        <div class="row">
            @foreach ($jenis_usaha as $row)
            <div class="col-lg-3 col-6">
                <div class="custom-control custom-checkbox" style="display: inline-block;">
                    <input type="checkbox" required name="jenis_usaha[]" class="custom-control-input"
                        id="jenis_usaha{{ $row->ID_JENIS_USAHA }}"
                        value="{{ strtolower($row->JENIS_USAHA) }}">
                    <label class="custom-control-label"
                        for="jenis_usaha{{ $row->ID_JENIS_USAHA }}">{{ $row->JENIS_USAHA }}</label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Contact Person</label>
        <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan kontak person"
            required id="cp" name="cp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Telepon</label>
        <input type="tel" class="form-control" autocomplete="off" placeholder="Masukkan nomor telepon"
            required id="telepon" name="telepon">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Alamat Lengkap</label>
        <textarea class="form-control" autocomplete="off" placeholder="Masukkan alamat lengkap" required
            id="alamat" rows="5" name="alamat"></textarea>
    </div>
    <div class="form-group">
        <label for="status_tempat">Status Tempat Usaha</label>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="custom-control custom-radio" style="display: inline-block;">
                    <input type="radio" required name="status_tempat" class="custom-control-input"
                        id="milikSendiri" value="milik sendiri">
                    <label class="custom-control-label" for="milikSendiri">Milik Sendiri</label>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="custom-control custom-radio" style="display: inline-block;">
                    <input type="radio" required name="status_tempat" class="custom-control-input"
                        id="kontrak" value="kontrak/sewa">
                    <label class="custom-control-label" for="kontrak">Kontrak/Sewa</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Pekerja</label>
        <input type="number" min="1" class="form-control numeric" autocomplete="off"
            placeholder="Masukkan jumlah pekerja" required id="jml_pekerja" name="jml_pekerja">
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
    <h5 class="text-primary mt-3 mb-3">Bahan Baku</h5>
    <div class="form-group">
        <label for="bahan_baku">Jenis & Kapasitas Bahan Baku | <a href="#"
                class="badge badge-primary text-md" data-toggle="modal"
                data-target="#addBahanModal">Pilih</a></label>
        <div id="cBahanBaku">
            <div class="row">
                <div class="col-md-5 mb-2 mb-md-0">
                    <input type="text" class="form-control readonly" placeholder="Jenis bahan baku"
                        required id="bahan_baku" name="bahan_baku[]">
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)"
                        required id="bahan_baku_kg" name="bahan_baku_kg[]">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="penjualan_bahan">Penjualan Bahan Baku | <a href="#" data-toggle="modal"
                data-target="#addPenjualanModal" class="badge badge-primary text-md">Pilih</a></label>
        <div id="cPenjualanBahan">
            <div class="row">
                <div class="col-md-3 mb-2 mb-md-0">
                    <input type="text" class="form-control readonly" placeholder="Penjualan bahan baku"
                        required id="penjualan_bahan" name="penjualan_bahan[]">
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <input type="text" class="form-control readonly"
                        placeholder="Keterangan penjualan bahan baku" required id="penjualan_bahan_ket"
                        name="penjualan_bahan_ket[]">
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <input type="text" class="form-control readonly"
                        placeholder="Proses penjualan bahan baku" required id="proses_penjualan"
                        name="proses_penjualan[]">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control readonly"
                        placeholder="Proses pembayaran bahan baku" required id="proses_pembayaran"
                        name="proses_pembayaran[]">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h5 class="text-primary mt-3 mb-3">Mesin </h5>
    <div class="form-group">
        <label for="proses_pembayaran">Kepemilikan Mesin | <a href="#"
                class="badge badge-primary text-md" data-toggle="modal"
                data-target="#addMesinModal">Pilih</a></label>
        <div id="cMesin">
            <div class="row">
                <div class="col-md-5 mb-2 mb-md-3">
                    <input type="text" class="form-control readonly" placeholder="Mesin" required
                        id="mesin" name="mesin[]">
                </div>
                <div class="col-md-5 mb-2 mb-md-0">
                    <input type="text" class="form-control readonly" placeholder="Kepemilikan" required
                        id="kepemilikan" name="kepemilikan[]">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control readonly" placeholder="Kuantitas" required
                        id="mesin_qty" name="mesin_qty[]">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h5 class="text-primary mt-3 mb-3">Koordinat (Opsional)</h5>
    <div class="form-group">
        <label for="exampleInputEmail1">Latitude</label>
        <input type="text" class="form-control" id="lat" autocomplete="off"
            placeholder="Masukkan koordinat latitude" name="lat">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Longitude</label>
        <input type="text" class="form-control" id="lng" autocomplete="off"
            placeholder="Masukkan koordinat longitude" name="lng">
    </div>
    <a href="#" class="badge badge-primary text-md" id="addFromMap">Pilih dari map</a>
    <hr>
    <div class="form-group">
        <label for="exampleInputEmail1">Warna Pin</label><br>
        <label>
            <input type="radio" name="pin" class="color-pin" value="green">
            <img width="50px" src="assets/img/marker/green-1.png">
        </label>

        <label>
            <input type="radio" class="color-pin" name="pin" value="blue">
            <img width="50px" src="assets/img/marker/blue-2.png">
        </label>
        <label>
            <input type="radio" class="color-pin" name="pin" value="red">
            <img width="50px" src="assets/img/marker/red-1.png">
        </label>
        <label>
            <input type="radio" class="color-pin" name="pin" value="yellow">
            <img width="50px" src="assets/img/marker/yellow-1.png">
        </label>
        <label>
            <input type="radio" class="color-pin" name="pin" value="black">
            <img width="50px" src="assets/img/marker/black-2.png">
        </label>
    </div>
</div>