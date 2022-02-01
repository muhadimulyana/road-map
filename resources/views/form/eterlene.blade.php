<div class="LOCO-form">
    <h5 class="text-primary mb-3">Informasi Customer</h5>
    <div class="form-group">
        <label for="exampleInputEmail1">Label</label>
        <input type="text" class="form-control" autocomplete="off" placeholder="Masukkan label"
            required id="urut" name="urut">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Customer</label>
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
    <h5 class="text-primary mt-3 mb-3">Jarak</h5>
    <div class="form-group">
        <label for="">Jarak Dari Plant | <a href="#"
                class="badge badge-primary text-md" data-toggle="modal"
                data-target="#addJarakModal">Pilih</a></label>
        <div id="cJarak">
            <div class="row">
                <div class="col-md-6 mb-2 mb-md-3">
                    <input type="text" class="form-control readonly" placeholder="Plant" required
                        id="plant" name="plant[]">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control readonly" placeholder="Jarak" required
                        id="jarak" name="jarak[]">
                </div>
            </div>
        </div>
    </div>
</div>