<div class="LOCO-form">
    <h5 class="text-primary mb-3">Informasi Distributor</h5>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Distributor</label>
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
        <label for="exampleInputEmail1">Jenis Kendaraan Pengiriman</label>
        <select class="form-control jenis-kendaraan select2" multiple required name="jenis_kendaraan[]" id="jenis_kendaraan">
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