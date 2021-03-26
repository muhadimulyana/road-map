@extends('app')

@section('overlay')
<div id="overlay">
    <!-- <div class="spinner"></div> -->
    <img width="120px" src="assets/img/loading2.gif">
    <br />
    <strong id="omessage">Sedang memproses...</strong>
</div>
<!-- Sidebar -->
@endsection

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="">
            <!-- Page Heading -->
            <div id="mapid"></div>
            <div class="leaflet-top leaflet-right">
                <a id="sidebarToggleTop" href="javascript:void" class="menu-btn btn btn-primary btn-circle widget">
                    <i style="font-size: 15px;" class="fa fa-bars"></i>
                </a>
            </div>
            <div class="leaflet-bottom leaflet-right">
                <a href="javascript:void" class="location btn btn-info btn-circle btn-lg widget">
                    <i style="font-size: 25px;" class="fas fa-street-view"></i>
                </a>
                <a href="javascript:void" data-toggle="modal" data-target="#addMarkerModal"
                    class="add btn btn-success btn-circle btn-lg widget">
                    <i style="font-size: 25px;" class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

</div>
@endsection

@section('modal')
<!-- Logout Modal-->
<div class="modal fade" id="addMarkerModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="formCoord">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addMarkerJudul">Judul Modal</h4>
                    <button class="close btnClose" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 70vh; overflow-y: auto;">
                    <h5 class="text-primary mb-3" style="text-decoration: underline;">Lokasi Usaha</h5>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        {{-- <select class="form-control select2" required data-placeholder="Pilih Kategori"
                              name="kategori" id="kategori">
                              <option value=""></option>
                              <option value="supplier">Supplier</option>
                              <option value="non supplier">Non Supplier</option>
                              <option value="kompetitor">Kompetitor</option>
                          </select> --}}
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
                        <input type="tel" class="form-control numeric" autocomplete="off"
                            placeholder="Masukkan nomor telepon" required id="telepon" name="telepon">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat Lengkap</label>
                        <textarea class="form-control" autocomplete="off" placeholder="Masukkan alamat lengkap" required
                            id="alamat" rows="5" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status_tempat">Status Tempat Usaha</label>
                        {{-- <select class="form-control select2" name="status_tempat"
                              data-placeholder="Pilih Status Tempat Usaha" required id="status_tempat">
                              <option value=""></option>
                              <option value="milik sendiri">Milik Sendiri</option>
                              <option value="kontrak/sewa">Kontrak/Sewa</option>
                          </select> --}}
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
                    <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Bahan Baku</h5>
                    <div class="form-group">
                        <label for="bahan_baku">Jenis & Kapasitas Bahan Baku | <a href="#" class="text-success"
                                data-toggle="modal" data-target="#addBahanModal">Pilih</a></label>
                        <div id="cBahanBaku">
                            <div class="row">
                                <div class="col-md-5 mb-2 mb-md-0">
                                    {{-- <select class="form-control select2 bahan-baku"
                                          data-placeholder="Pilih Jenis Bahan Baku" required name="bahan_baku[]"
                                          id="bahan_baku">
                                          <option value=""></option>
                                          @foreach ($jenis_bahan as $row)
                                          <option value="{{ $row->JENIS_BAHAN }}">{{ $row->JENIS_BAHAN }}</option>
                                    @endforeach
                                    </select> --}}
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
                                data-target="#addPenjualanModal" class="text-success">Pilih</a></label>
                        <div id="cPenjualanBahan">
                            <div class="row">
                                <div class="col-md-5 mb-2 mb-md-0">
                                    {{-- <select class="form-control penjualan-bahan select2" required
                                          data-placeholder="Pilih Penjualan Bahan Baku" name="penjualan_bahan[]"
                                          id="penjualan_bahan">
                                          <option value=""></option>
                                          @foreach ($tempat_penjualan as $row)
                                          <option value="{{ strtolower($row->TEMPAT_PENJUALAN) }}">
                                    {{ $row->TEMPAT_PENJUALAN }}
                                    </option>
                                    @endforeach
                                    </select> --}}
                                    <input type="text" class="form-control readonly" placeholder="Penjualan bahan baku"
                                        required id="penjualan_bahan" name="penjualan_bahan[]">
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control readonly"
                                        placeholder="Keterangan penjualan bahan baku" required id="penjualan_bahan_ket"
                                        name="penjualan_bahan_ket[]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="proses_penjualan">Proses Penjualan</label>
                        {{-- <select class="form-control select2" data-placeholder="Pilih Proses Penjualan"
                              name="proses_penjualan" required id="proses_penjualan">
                              <option value=""></option>
                              <option value="dikirim">Dikirim</option>
                              <option value="diambil">Diambil</option>
                          </select> --}}
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="custom-control custom-radio" style="display: inline-block;">
                                    <input type="radio" required name="proses_penjualan" class="custom-control-input"
                                        id="dikirim" value="dikirim">
                                    <label class="custom-control-label" for="dikirim">Dikirim</label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="custom-control custom-radio" style="display: inline-block;">
                                    <input type="radio" required name="proses_penjualan" class="custom-control-input"
                                        id="diambil" value="diambil">
                                    <label class="custom-control-label" for="diambil">Diambil</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="proses_pembayaran">Proses Pembayaran</label>
                        <select class="form-control select2" data-placeholder="Pilih Proses Pembayaran"
                            name="proses_pembayaran" required id="proses_pembayaran">
                            <option value=""></option>
                            @foreach ($jenis_pembayaran as $row)
                            <option value="{{ strtolower($row->JENIS_PEMBAYARAN) }}">{{ $row->JENIS_PEMBAYARAN }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Mesin </h5>
                    <div class="form-group">
                        <label for="proses_pembayaran">Kepemilikan Mesin | <a href="#" class="text-success"
                                data-toggle="modal" data-target="#addMesinModal">Pilih</a></label>
                        <div id="cMesin">
                            <div class="row">
                                <div class="col-md-5 mb-2 mb-md-3">
                                    {{-- <select class="form-control mesin select2" style="width: 100%;"
                                          data-placeholder="Pilih Mesin" required name="mesin[]" id="mesin">
                                          <option value=""></option>
                                          @foreach ($mesin as $row)
                                          <option value="{{ strtolower($row->MESIN) }}">{{ $row->MESIN }}</option>
                                    @endforeach
                                    </select> --}}
                                    <input type="text" class="form-control readonly" placeholder="Mesin" required
                                        id="mesin" name="mesin[]">
                                </div>
                                <div class="col-md-5 mb-2 mb-md-0">
                                    {{-- <select class="form-control select2" required data-placeholder="Kepemilikan"
                                          name="kepemilikan[]" id="kepemilikan">
                                          <option value=""></option>
                                          <option value="milik sendiri">Milik Sendiri</option>
                                          <option value="dipinjamkan">Dipinjamkan</option>
                                      </select> --}}
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
                    <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Koordinat (Opsional)</h5>
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
                    <a href="#" class="text-success" id="addFromMap">Pilih dari map</a>
                </div>
                <input type="hidden" name="id_tempat" id="id_tempat">
                <input type="hidden" name="id_marker" id="id_marker">
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btnSubmit" type="submit">Simpan</button>
                    <button class="btn btn-primary" id="btnLoad" style="display: none;" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Menyimpan...
                    </button>
                    <button class="btn btn-secondary btnClose" type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="detailMarkerModal" class="modal fixed-left fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" style="overflow-y: initial !important" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder" id="placeName">Right fixed sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 80vh; overflow-y: auto;">
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Kategori</label><br>
                    <p id="kategoriText" class=""
                        style="font-size: 100%; text-transform: capitalize;">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Jenis Usaha</label>
                    <p id="jenisUsahaText" class="font-weight-bold" style="text-transform: capitalize;">Memuat...
                    </p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Tanggal Kunjungan</label>
                    <p id="tglKunjunganText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Contact Person</label>
                    <p id="cpText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Telepon</label>
                    <p id="teleponText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Alamat</label>
                    <p id="alamatText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Status Tempat Usaha</label>
                    <p id="statusTempatText" style="text-transform: capitalize;" class="font-weight-bold">Memuat...
                    </p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Jumlah Pekerja</label>
                    <p id="jmlPekerjaText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Foto</label>
                    <div class="row image-gallery">
                    </div>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Jenis & Kapasitas Bahan</label>
                    <p id="jenisBahanText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Penjualan Bahan Baku</label>
                    <p id="penjualanBahanBakuText" style="text-transform: capitalize;" class="font-weight-bold">
                        Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Proses Penjualan</label>
                    <p id="prosesPenjualanText" style="text-transform: capitalize;" class="font-weight-bold">
                        Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Proses Pembayaran</label>
                    <p id="prosesPembayaranText" style="text-transform: capitalize;" class="font-weight-bold">
                        Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Kepemilikan Mesin</label>
                    <p id="mesinText" style="text-transform: capitalize;" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Latitude</label>
                    <p id="latText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Longitude</label>
                    <p id="lngText" class="font-weight-bold">Memuat...</p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success" id="btnEdit">Edit</a>
                <a href="#" class="btn btn-danger" id="btnDelete">Hapus</a>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

<!-- Bahan Baku Modal-->
<div class="modal fade modal-child" id="addBahanModal" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" data-modal-parent="#addMarkerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Bahan Baku</h5>
            </div>
            <form id="addBahanForm">
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="3%">
                                    <div class="custom-control custom-checkbox" style="display: inline-block;">
                                        <input type="checkbox" id="checkAllBahan" class="custom-control-input">
                                        <label class="custom-control-label" for="checkAllBahan"></label>
                                    </div>
                                </th>
                                <th scope="col">Jenis Bahan</th>
                                <th scope="col">Kapasitas/Bulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis_bahan as $row)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox" style="display: inline-block;">
                                        <input type="checkbox" value="{{ $row->JENIS_BAHAN }}"
                                            data-id="{{ $row->ID_JENIS_BAHAN }} " name="c_bahan_baku[]" required
                                            id="c_bahan_baku{{ $row->ID_JENIS_BAHAN }}"
                                            class="custom-control-input c-bahan-baku">
                                        <label class="custom-control-label"
                                            for="c_bahan_baku{{ $row->ID_JENIS_BAHAN }}"></label>
                                    </div>
                                </th>
                                <td>{{ $row->JENIS_BAHAN }}</td>
                                <td><input type="tel" placeholder="Kapasitas (KG)" data-value="{{ $row->JENIS_BAHAN }}"
                                        name="c_bahan_baku_kg[]" id="c_bahan_baku_kg{{ $row->ID_JENIS_BAHAN }}"
                                        autocomplete="off" class="form-control numeric c-bahan-baku-kg" readonly></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="okBahanBaku" href="#">OK</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-child" id="addPenjualanModal" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" data-modal-parent="#addMarkerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Penjualan Bahan Baku</h5>
            </div>
            <form id="addPenjualanForm">
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="3%">
                                    <div class="custom-control custom-checkbox" style="display: inline-block;">
                                        <input type="checkbox" id="checkAllPenjualan" class="custom-control-input">
                                        <label class="custom-control-label" for="checkAllPenjualan"></label>
                                    </div>
                                </th>
                                <th scope="col">Penjualan Bahan Baku</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tempat_penjualan as $row)
                            <tr>
                                <th scope="row">
                                    <div class="custom-control custom-checkbox" style="display: inline-block;">
                                        <input type="checkbox" value="{{ $row->TEMPAT_PENJUALAN }}"
                                            data-id="{{ $row->ID_TEMPAT_PENJUALAN }} " name="c_penjualan_bahan[]"
                                            required id="c_penjualan_bahan{{ $row->ID_TEMPAT_PENJUALAN }}"
                                            class="custom-control-input c-penjualan-bahan">
                                        <label class="custom-control-label"
                                            for="c_penjualan_bahan{{ $row->ID_TEMPAT_PENJUALAN }}"></label>
                                    </div>
                                </th>
                                <td style="text-transform: capitalize;">{{ $row->TEMPAT_PENJUALAN }}</td>
                                <td><input type="text" placeholder="Keterangan"
                                        data-value="{{ $row->TEMPAT_PENJUALAN }}" name="c_penjualan_bahan_ket[]"
                                        id="c_penjualan_bahan_ket{{ $row->ID_TEMPAT_PENJUALAN }}" autocomplete="off"
                                        class="form-control c-penjualan-bahan-ket" readonly></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="okPenjualanBahan" href="#">OK</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-child" id="addMesinModal" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" data-modal-parent="#addMarkerModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Mesin</h5>
            </div>
            <form id="addMesinForm">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width="3%">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" id="checkAllMesin" class="custom-control-input">
                                            <label class="custom-control-label" for="checkAllMesin"></label>
                                        </div>
                                    </th>
                                    <th scope="col" width="40%">Mesin</th>
                                    <th scope="col" width="40%">Kepemilikan</th>
                                    <th scope="col">Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mesin as $row)
                                <tr>
                                    <th scope="row">
                                        <div class="custom-control custom-checkbox" style="display: inline-block;">
                                            <input type="checkbox" value="{{ $row->MESIN }}"
                                                data-id="{{ $row->ID_MESIN }} " name="c_mesin[]" required
                                                id="c_mesin{{ $row->ID_MESIN }}" class="custom-control-input c-mesin">
                                            <label class="custom-control-label"
                                                for="c_mesin{{ $row->ID_MESIN }}"></label>
                                        </div>
                                    </th>
                                    <td style="text-transform: capitalize;">{{ $row->MESIN }}</td>
                                    <td>
                                        <select class="form-control c-kepemilikan select2" required
                                            data-placeholder="Kepemilikan" name="c_kepemilikan[]"
                                            data-value="{{ $row->MESIN }}" disabled
                                            id="c_kepemilikan{{ $row->ID_MESIN }}">
                                            <option value=""></option>
                                            <option value="milik sendiri">Milik Sendiri</option>
                                            <option value="dipinjamkan">Dipinjamkan</option>
                                        </select>
                                    </td>
                                    <td><input type="tel" placeholder="Kuantitas" name="c_mesin_qty[]"
                                            id="c_mesin_qty{{ $row->ID_MESIN }}" autocomplete="off"
                                            data-value="{{ $row->MESIN }}" class="form-control c-mesin-qty numeric"
                                            readonly></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" id="okMesin" href="#">OK</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(function () {
        $('.select2').select2({
            allowClear: true
        });
        $('.datepicker').bootstrapMaterialDatePicker({
            time: false,
            format: 'DD-MM-YYYY'
        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        $(document).on('keydown paste focus mousedown', '.readonly', function(e){
            if(e.keyCode != 9) // ignore tab
                e.preventDefault();
        });

        $(".numeric").on("keypress keyup blur",function (event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        // Modal 2
        $('.modal-child').on('show.bs.modal', function () {
            var modalParent = $(this).attr('data-modal-parent');
            $(modalParent).css('opacity', 0);
        });
        
        $('.modal-child').on('hidden.bs.modal', function () {
            var modalParent = $(this).attr('data-modal-parent');
            $(modalParent).css('opacity', 1);
        });

        // Modal Bahan Baku
        $('.c-bahan-baku').on('change', function(e) {
            var id = $(this).attr('data-id');
            if($(this).is(':checked')) {
                $('#c_bahan_baku_kg' + id).prop('readonly', false)
            } else {
                $('#c_bahan_baku_kg' + id).prop('readonly', true);
                $('#c_bahan_baku_kg' + id).val('');
            }
        })

        // CheckAll checkbox
        $("#checkAllBahan").change(function(){ // Ketika user men-cek checkbox all      
        if($(this).is(":checked")) // Jika checkbox all diceklis
            $(".c-bahan-baku").prop("checked", true).change(); // ceklis semua checkbox siswa dengan class "c-bahan-baku"
        else // Jika checkbox all tidak diceklis
            $(".c-bahan-baku").prop("checked", false).change(); // un-ceklis semua checkbox siswa dengan class "c-bahan-baku"
        });

        
        //Foreach c bahan baku
        $('#okBahanBaku').on('click', function(e) {
            var cekBahanBaku = $('.c-bahan-baku:checked').length
            $('#cBahanBaku').html('');
            if(cekBahanBaku > 0) {
                $('.c-bahan-baku:checked').each(function(i, obj) {
                    var margin = i == 0 ? '' : ' mt-3';
                    var value = $(obj).val();
                    var id = $(obj).attr('data-id');
                    var value_kg = !$('#c_bahan_baku_kg' + id).val() ? '0' : $('#c_bahan_baku_kg' + id).val() ;
                    $('#cBahanBaku').append('<div class="row' + margin + '"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" value="' + value + '" placeholder="Jenis bahan baku" required name="bahan_baku[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)" value="' + value_kg + '" required name="bahan_baku_kg[]"></div></div>');
                });
            } else {
                $('#cBahanBaku').append('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Jenis bahan baku" required name="bahan_baku[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)" required name="bahan_baku_kg[]"></div></div>');
            }
            $('#addBahanModal').modal('hide');
        });

        // Penjualan bahan baku
        // Modal Bahan Baku
        $('.c-penjualan-bahan').on('change', function(e) {
            var id = $(this).attr('data-id');
            if($(this).is(':checked')) {
                $('#c_penjualan_bahan_ket' + id).prop('readonly', false)
            } else {
                $('#c_penjualan_bahan_ket' + id).prop('readonly', true);
                $('#c_penjualan_bahan_ket' + id).val('');
            }
        })

        // CheckAll checkbox
        $("#checkAllPenjualan").change(function(){ // Ketika user men-cek checkbox all      
        if($(this).is(":checked")) // Jika checkbox all diceklis
            $(".c-penjualan-bahan").prop("checked", true).change(); // ceklis semua checkbox siswa dengan class "c-penjualan-bahan"
        else // Jika checkbox all tidak diceklis
            $(".c-penjualan-bahan").prop("checked", false).change(); // un-ceklis semua checkbox siswa dengan class "c-penjualan-bahan"
        });

        //Foreach c bahan baku
        $('#okPenjualanBahan').on('click', function(e) {
            var cekPenjualan = $('.c-penjualan-bahan:checked').length
            $('#cPenjualanBahan').html('');
            if(cekPenjualan > 0) {
                $('.c-penjualan-bahan:checked').each(function(i, obj) {
                    var margin = i == 0 ? '' : ' mt-3';
                    var value = $(obj).val();
                    var id = $(obj).attr('data-id');
                    var value_ket = $('#c_penjualan_bahan_ket' + id).val() ;
                    $('#cPenjualanBahan').append('<div class="row' + margin + '"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" value="' + value + '" placeholder="Penjualan bahan baku" style="text-transform: capitalize;" required name="penjualan_bahan[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" value="' + value_ket + '" required name="penjualan_bahan_ket[]"></div></div>');
                });
            } else {
                $('#cPenjualanBahan').append('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Penjualan bahan baku" required id="bahan_baku" name="penjualan_bahan[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" required name="penjualan_bahan_ket[]"></div></div>');
            }
            $('#addPenjualanModal').modal('hide');
        });

        $('.c-mesin').on('change', function(e) {
            var id = $(this).attr('data-id');
            if($(this).is(':checked')) {
                $('#c_mesin_qty' + id).prop('readonly', false)
                $('#c_kepemilikan' + id).prop('disabled', false)
            } else {
                $('#c_mesin_qty' + id).prop('readonly', true);
                $('#c_kepemilikan' + id).prop('disabled', true)
                $('#c_kepemilikan' + id).val('').change();
                $('#c_mesin_qty' + id).val('');
            }
        })

        $("#checkAllMesin").change(function(){ // Ketika user men-cek checkbox all      
        if($(this).is(":checked")) // Jika checkbox all diceklis
            $(".c-mesin").prop("checked", true).change(); // ceklis semua checkbox siswa dengan class "c-mesin"
        else // Jika checkbox all tidak diceklis
            $(".c-mesin").prop("checked", false).change(); // un-ceklis semua checkbox siswa dengan class "c-mesin"
        });

        $('#okMesin').on('click', function(e) {
            var cekPenjualan = $('.c-mesin:checked').length
            $('#cMesin').html('');
            if(cekPenjualan > 0) {
                $('.c-mesin:checked').each(function(i, obj) {
                    var margin = i == 0 ? '' : ' mt-3 mt-md-0';
                    var value = $(obj).val();
                    var id = $(obj).attr('data-id');
                    var value_milik = $('#c_kepemilikan' + id).val();
                    var value_qty = !$('#c_mesin_qty' + id).val() ? '0' : $('#c_mesin_qty' + id).val();
                    
                    $('#cMesin').append('<div class="row ' + margin + '"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" style="text-transform: capitalize;" placeholder="Mesin" value="' + value + '" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" style="text-transform: capitalize;" value="' + value_milik + '" placeholder="Kepemilikan" style="text-transform: capitalize;" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" value="' + value_qty + '" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');
                });
            } else {
                $('#cMesin').append('<div class="row"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" placeholder="Mesin" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Kepemilikan" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');
            }
            $('#addMesinModal').modal('hide');
        });


        //  ============================ //

        function clearFormAdd() {
            $("#formCoord")[0].reset();
            $("label.error").hide();
            $('.select2').val('').change();
            $('.d-bahan-baku').val('').change();
            $('.d-mesin').val('').change();
            $('.d-penjualan-bahan').val('').change();
            $('.kepemilikan').val('').change();
            $('.clone').remove();
            $('#addBahanForm')[0].reset();
            $('#checkAllBahan').prop('checked', false).change();
            $('#addPenjualanForm')[0].reset();
            $('#checkAllPenjualan').prop('checked', false).change();
            $('#addMesinForm')[0].reset();
            $('#checkAllMesin').prop('checked', false).change();
            $('.c-kepemilikan').val('').change();
            $('#cBahanBaku').html('');
            $('#cPenjualanBahan').html('');
            $('#cMesin').html('');
            $('#cBahanBaku').html('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Jenis bahan baku" required name="bahan_baku[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)" required name="bahan_baku_kg[]"></div></div>');
            $('#cPenjualanBahan').html('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Penjualan bahan baku" required name="penjualan_bahan[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" required name="penjualan_bahan_ket[]"></div></div>');
            $('#cMesin').html('<div class="row"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" placeholder="Mesin" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Kepemilikan" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');
            $('#cExistImage').hide();
        }

        $('.btnClose').on('click', function(e) {
            clearFormAdd();
        })

        $('#overlay').delay(100).fadeOut();
        var csrf = $('meta[name="csrf-token"]').attr('content');
        var key = $('meta[name="key-api"]').attr('content');
        var view = $('meta[name="view"]').attr('content');
        var id_view = $('meta[name="view-id"]').attr('content');

        //  ============================= MAp ============================//
        var mymap = L.map('mapid').setView([-1, 117], 5);
        if ($(window).width() >= 993) {
            L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(mymap);
        } else {
            L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                //tileSize: 512,
                //zoomOffset: -1,
            }).addTo(mymap);
        }
        
        var manIcon = L.icon({
            iconUrl: 'assets/img/placeholder2.png',
            iconSize: [35, 35], // size of the icon
            iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -
                35
            ] // point from which the popup should open relative to the iconAnchor
        });
        var suppIcon = L.icon({
            iconUrl: 'assets/img/supplier.png',
            shadowUrl: 'assets/img/shadow.png',
            iconSize: [35, 35], // size of the icon
            shadowSize: [32, 35], // size of the shadow
            iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
            shadowAnchor: [8, 37], // the same for the shadow
            popupAnchor: [0, -
                35
            ] // point from which the popup should open relative to the iconAnchor
        });
        var nonsupIcon = L.icon({
            iconUrl: 'assets/img/non-supplier.png',
            shadowUrl: 'assets/img/shadow.png',
            iconSize: [35, 35], // size of the icon
            shadowSize: [32, 35], // size of the shadow
            iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
            shadowAnchor: [8, 37], // the same for the shadow
            popupAnchor: [0, -
                35
            ] // point from which the popup should open relative to the iconAnchor
        });
        var compIcon = L.icon({
            iconUrl: 'assets/img/competitor.png',
            shadowUrl: 'assets/img/shadow.png',
            iconSize: [35, 35], // size of the icon
            shadowSize: [32, 35], // size of the shadow
            iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
            shadowAnchor: [8, 37], // the same for the shadow
            popupAnchor: [0, -
                35
            ] // point from which the popup should open relative to the iconAnchor
        });
        var foundIcon = L.icon({
            iconUrl: 'assets/img/found-marker.png',
            iconSize: [35, 35], // size of the icon
            iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -
                35
            ] // point from which the popup should open relative to the iconAnchor
        });
        var searchControl = L.esri.Geocoding.geosearch().addTo(mymap);
        //var results = L.layerGroup();
        var marker = L.layerGroup().addTo(mymap);
        var circle;
        var manMarker;
        var newMarker;
        var foundMarker;
        var geocodeService = L.esri.Geocoding.geocodeService();
        var geocodeService2 = L.esri.Geocoding.geocodeService();
        if(sessionStorage["clickOnMap"]){
            sessionStorage.removeItem("clickOnMap")
        }
        //L.esri.basemapLayer('Gray').addTo(mymap);
        //L.esri.basemapLayer('GrayLabels').addTo(mymap);

        mymap.setMaxZoom(18);
        mymap.setMinZoom(3);
        L.control.scale().addTo(mymap);

        function markerOnClick(e) {
            //console.log(this._leaflet_id);
            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            if (foundMarker != undefined) {
                mymap.removeLayer(foundMarker);
            }
            var id_marker = this._leaflet_id;
            var id = this.options.ID_TEMPAT;
            var place = this.options.place;
            var lat = this.options.LAT;
            var lng = this.options.LNG;
            var badge =this.options.KATEGORI == 'supplier' ? 'font-weight-bold badge badge-success' : (this.options.KATEGORI == 'kompetitor' ? 'font-weight-bold badge badge-danger' : 'font-weight-bold badge badge-primary' )
            $("#placeName").html(place);
            $('#kategoriText').html(this.options.KATEGORI);
            $('#kategoriText').removeClass();
            $('#kategoriText').addClass(badge);
            $('#tglKunjunganText').html(moment(this.options.TANGGAL_KUNJUNGAN).format('DD-MM-YYYY'));
            $('#cpText').html(this.options.CP);
            $('#teleponText').html(this.options.TELEPON);
            $('#alamatText').html(this.options.ALAMAT);
            $('#statusTempatText').html(this.options.STATUS_USAHA);
            $('#jmlPekerjaText').html(this.options.JUMLAH_PEKERJA);
            $('#prosesPenjualanText').html(this.options.PROSES_PENJUALAN);
            $('#prosesPembayaranText').html(this.options.PROSES_PEMBAYARAN);
            $('#btnEdit').attr('data-id', id)
            $('#btnEdit').attr('data-marker', id_marker)
            $('#btnDelete').attr('data-id', id)
            $('#btnDelete').attr('data-lat', lat)
            $('#btnDelete').attr('data-lng', lng)
            $('#btnDelete').attr('data-marker', id_marker)
            $("#latText").html(lat)
            $("#lngText").html(lng)
            //console.log(id);
            $.ajax({
                url: "{{ route('getDetailCoord') }}",
                data: {
                    "_token": csrf,
                    "id": id
                },
                success: function (data) {
                    //Jenis Usaha
                    var jenis_usaha ='';
                    for(var i = 0; i < data.jenis_usaha.length; i++) {
                        jenis_usaha += '- ' + data.jenis_usaha[i].JENIS_USAHA + '<br>'
                    }

                    $('#jenisUsahaText').html(jenis_usaha);

                    //Jenis Bahan & Kapasitas
                    var jenis_bahan ='';
                    for(var i = 0; i < data.jenis_bahan.length; i++) {
                        jenis_bahan += '- ' + data.jenis_bahan[i].JENIS_BAHAN + ' (' + data.jenis_bahan[i].KAPASITAS + ' KG/Bulan)' + '<br>'
                    }

                    $('#jenisBahanText').html(jenis_bahan);

                    //Penjualan Bahan Baku

                    var penjualan ='';
                    for(var i = 0; i < data.penjualan.length; i++) {
                        penjualan += '- ' + data.penjualan[i].TEMPAT_PENJUALAN + ' (' + data.penjualan[i].KETERANGAN + ')' + '<br>'
                    }

                    $('#penjualanBahanBakuText').html(penjualan);

                    //Mesin

                    var mesin ='';
                    for(var i = 0; i < data.mesin.length; i++) {
                        mesin += '- ' + data.mesin[i].MESIN + ' ' + data.mesin[i].QTY + ' (' + data.mesin[i].KEPEMILIKAN + ')' + '<br>'
                    }

                    $('#mesinText').html(mesin);

                    //Image Handle
                    var img = '';
                    //var storage = '{{ asset('storage/images/') }}';
                    if(data.image.length > 0){
                        for (var i = 0; i < data.image.length; i++) {
                            img += '<div class="col-6 text-center mb-3"><a href="upload/img/' + data.image[i].GAMBAR + '" class="image-link"><img src="upload/img/thumbnail/' + data.image[i].GAMBAR + '" style="width:150px; height:100px; object-fit:cover; border-radius: 10px;" class="img-fluid" alt=""></a></div>'
                        }
                        $('.image-gallery').html(img);
                    } else {
                        img += '<div class="col-6 text-center mb-3"><a href="https://info.solokkota.go.id/uploads/No_Image_Available.jpg" class="image-link"><img src="https://info.solokkota.go.id/uploads/No_Image_Available.jpg" style="width:150px; height:100px; object-fit:cover; border-radius: 10px;" class="img-fluid" alt=""></a></div>';
                        $('.image-gallery').html(img);
                    }
                }
            });
            $("#detailMarkerModal").modal('show');
        }

        $(document).on('click', '.btnAdd', function () {
            $('#addMarkerModal').modal('show');
            $('#formCoord').attr('action', "{{ route('addCoord') }}");
            $('#addMarkerJudul').html('Tambah Tempat');
            $('#cExistImage').hide();
        });


        function manMarkerOnClick(){
            $(document).on('click', '.btnAdd', function () {
                $('#addMarkerModal').modal('show');
                $('#formCoord').attr('action', "{{ route('addCoord') }}");
                $('#addMarkerJudul').html('Tambah Tempat');
                $('#cExistImage').hide();
            });
        }

        function mapMarker(data, show) {
            for (var i = 0; i < data.length; i++) {
                var icon = data[i].KATEGORI == 'supplier' ? suppIcon : ( data[i].KATEGORI == 'kompetitor' ? compIcon : nonsupIcon )
                L.marker([data[i].LAT, data[i].LNG], {
                    icon: icon,
                    ID_TEMPAT: data[i].ID_TEMPAT,
                    place: data[i].NAMA_USAHA,
                    KATEGORI: data[i].KATEGORI,
                    CP: data[i].CP,
                    TELEPON: data[i].TELEPON,
                    ALAMAT: data[i].ALAMAT,
                    STATUS_USAHA: data[i].STATUS_USAHA,
                    JUMLAH_PEKERJA: data[i].JUMLAH_PEKERJA,
                    PROSES_PENJUALAN: data[i].PROSES_PENJUALAN,
                    PROSES_PEMBAYARAN: data[i].PROSES_PEMBAYARAN,
                    TANGGAL_KUNJUNGAN: data[i].TANGGAL_KUNJUNGAN,
                    LAT: data[i].LAT,
                    LNG: data[i].LNG
                }).addTo(marker).on('click', markerOnClick);
                //L.marker([data[i].LAT, data[i].LNG]).addTo(results);
                if (show) {
                    mymap.setView([data[i].LAT, data[i].LNG], 18);
                    //marker.bindPopup('<b>Added! </b>' + data[i].place).openPopup();
                } else {
                    //marker.bindPopup(data[i].place);
                }
            }
        }

        // Tidak digunakan
        function onLocationInput(e) {
            $('#lat').val(e.latlng.lat);
            $('#lng').val(e.latlng.lng);
            $('#addMarkerModal').modal('show');
        }

        //Tidak digunakan
        function onLocationFound(e) {
            var radius = e.accuracy / 2;
            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            if (foundMarker != undefined) {
                mymap.removeLayer(foundMarker);
            }
            manMarker = L.marker(e.latlng, {
                    icon: manIcon
                }).addTo(mymap)
                .bindPopup("Akurat sampai " + Math.round(radius) + " meter" + '<br>' +
                    '<div class="text-center mt-1"><button class="btn btn-xs btn-primary btnAdd">Tandai Lokasi Anda</button></div>'
                ).openPopup().on('click', manMarkerOnClick);
            circle = L.circle(e.latlng, radius, {
                color: 'red',
                opacity: 0.1
            }).addTo(mymap);
            $('#place').val('');
            $('#lat').val(e.latlng.lat);
            $('#lng').val(e.latlng.lng);

        }

        function onAccuratePositionFound(e) {
            var radius = e.accuracy / 2;
            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            if (foundMarker != undefined) {
                mymap.removeLayer(foundMarker);
            }
            manMarker = L.marker(e.latlng, {
                    icon: manIcon
                }).addTo(mymap)
                .bindPopup("Akurat sampai " + Math.round(radius) + " meter" + '<br>' +
                    '<div class="text-center mt-1"><button class="btn btn-xs btn-primary btnAdd">Tandai Lokasi Anda</button></div>'
                ).openPopup();
            circle = L.circle(e.latlng, radius, {
                color: 'red',
                opacity: 0.1
            }).addTo(mymap);
            //$('#place').val('');
            $('#lat').val(e.latlng.lat);
            $('#lng').val(e.latlng.lng);
            $('#overlay').delay(100).fadeOut();
        }

        function onAccuratePositionProgress(e) {
            var message = 'Sedang memporeses…';
            $("#overlay").fadeIn();
            $("#omessage").html(message)

        }

        function onLocationError(e) {
            alert(e.message);
        }

        function loadMarker(e) {
            //e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('getCoord') }}",
                data: {
                    "_token": csrf
                },
                success: function (data) {
                    //var locations = data;
                    mapMarker(data);
                }
            });
        }

        function clearMarker()
        {
            $(".leaflet-marker-icon").remove();
            $(".leaflet-popup").remove();
            $(".leaflet-marker-shadow").remove();
        }

        function searchGeo(data) {
            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            //results.clearLayers();
            for (var i = data.results.length - 1; i >= 0; i--) {
                foundMarker = L.marker(data.results[i].latlng, {
                    icon: foundIcon,
                    opacity: 0
                });
            }
            //results.addLayer(foundMarker);
        }

        mymap.on('contextmenu', function (e) {

            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            if (foundMarker != undefined) {
                mymap.removeLayer(foundMarker);
            }

            if(!sessionStorage["clickOnMap"]) {

                newMarker = L.marker(e.latlng, {
                        icon: foundIcon,
                        draggable: true
                }).addTo(mymap);

                geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
                    if (error) {
                        return;
                    }

                    
                    newMarker.bindPopup(result.address.Match_addr + '<br>' +
                        '<div class="text-center mt-1"><button class="btn btn-xs btn-primary btnAdd">Tandai Lokasi Ini</button></div>'
                    ).openPopup();
                    
                    //$('#place').val('');
                    $('#lat').val(e.latlng.lat);
                    $('#lng').val(e.latlng.lng);

                    //console.log(e.latlng);
                });

                newMarker.on('dragend', function () {
                    geocodeService2.reverse().latlng(newMarker.getLatLng()).run(function (error, result) {
                        if (error) {
                            return;
                        }

                        newMarker.bindPopup(result.address.Match_addr + '<br>' +
                            '<div class="text-center mt-1"><button class="btn btn-xs btn-primary btnAdd">Tandai Lokasi Ini</button></div>'
                        ).openPopup();
                        
                        //$('#place').val('');
                        $('#lat').val(newMarker.getLatLng().lat);
                        $('#lng').val(newMarker.getLatLng().lng);
                        //console.log(newMarker.getLatLng());
                    });
                    
                    
                });

            }



        });


        $('.location').on('click', function () {
            mymap.on('accuratepositionprogress', onAccuratePositionProgress);
            mymap.on('accuratepositionfound', onAccuratePositionFound);
            mymap.on('locationerror', onLocationError);

            mymap.findAccuratePosition({
                maxWait: 10000,
                desiredAccuracy: 20
            });

            mymap.locate({
                setView: true
            });

        });

        $(document).on('click', '.btnConfirm', function () {
            $('#addMarkerModal').modal('show');
            $('html').css('cursor', 'alias');
            $('html').css('pointer-events', 'auto');
            $('#mapid').css('cursor', 'alias');
            $('.widget').attr('style', 'pointer-events: auto !important; cursor : alias;');
            sessionStorage.removeItem("clickOnMap")
        });

        $('#addFromMap').on('click', function() {
            $('#addMarkerModal').modal('hide');
            $('html').css('cursor', 'not-allowed');
            $('html').css('pointer-events', 'none');
            $('.widget').attr('style', 'pointer-events: none !important; cursor : now-allowed;');
            $('#mapid').css('cursor', 'crosshair');
            $('#mapid').css('pointer-events', 'auto');
            sessionStorage.setItem("clickOnMap", 1);
        })

        mymap.on('click', function (e) {

            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            if (foundMarker != undefined) {
                mymap.removeLayer(foundMarker);
            }

            if(sessionStorage["clickOnMap"]) {

                newMarker = L.marker(e.latlng, {
                        icon: foundIcon,
                        draggable: true
                }).addTo(mymap);

                geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
                    if (error) {
                        return;
                    }
                    
                    newMarker.bindPopup(result.address.Match_addr + '<br>' +
                        '<div class="text-center mt-1"><button class="btn btn-xs btn-success btnConfirm">Pilih Lokasi Ini</button></div>'
                    ).openPopup();
                    
                    //$('#place').val('');
                    $('#lat').val(e.latlng.lat);
                    $('#lng').val(e.latlng.lng);

                    //console.log(e.latlng);
                });

                newMarker.on('dragend', function () {
                    geocodeService2.reverse().latlng(newMarker.getLatLng()).run(function (error, result) {
                        if (error) {
                            return;
                        }

                        newMarker.bindPopup(result.address.Match_addr + '<br>' +
                            '<div class="text-center mt-1"><button class="btn btn-xs btn-success btnConfirm">Pilih Lokasi Ini</button></div>'
                        ).openPopup();
                        
                        //$('#place').val('');
                        $('#lat').val(newMarker.getLatLng().lat);
                        $('#lng').val(newMarker.getLatLng().lng);
                        //console.log(newMarker.getLatLng());
                    });
                    
                    
                });

            }


        });
        
        loadMarker();

        $("#formCoord").submit(function (e) {
            e.preventDefault();
            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            if (foundMarker != undefined) {
                mymap.removeLayer(foundMarker);
            }
            $.ajax({
                url: $(this).attr('action'),
                //data: $(this).serialize(),
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: "POST",
                beforeSend: function () {
                    $('#btnSubmit').hide();
                    $('#btnLoad').show();
                    $('.btnClose').prop('disabled', true);
                },
                success: function (response) {
                    $('#btnSubmit').show();
                    $('#btnLoad').hide();
                    $('.btnClose').prop('disabled', false);
                    $("#addMarkerModal").modal('hide');
                    clearFormAdd();
                    console.log(response);
                    if(response[0].AKSI == 'tambah'){ // Jika aksinya tambah 
                        mapMarker(response, true); // tambahkan 1 marker
                    } else { // jika update
                        if($('#id_marker').val().length > 0){ // jika id marker memiliki value
                            marker.removeLayer($('#id_marker').val()); // remove marker berdasarkan id
                            if(!response[0].KOSONG){ // jika respon empty false (ada data lat dan lng)
                                mapMarker(response, true); // tambahkan 1 marker
                            }
                        }
                    }
                    
                },
                error: function (response) {
                    $('#btnSubmit').show();
                    $('#btnLoad').hide();
                    $('.btnClose').prop('disabled', false);
                    //$("#exampleModal").modal('hide');
                    alert('Something went wrong!');
                }
            });
        });

        searchControl.on('results', function (data) {
            searchGeo(data);
        });

        $('#addMarkerModal').on('shown.bs.modal', function (e) {
            //$("#place").focus();
        })

        $('#addMarkerModal').on('hidden.bs.modal', function (e) {
            if (manMarker != undefined) {
                mymap.removeLayer(manMarker);
            }
            if (circle != undefined) {
                mymap.removeLayer(circle);
            }
            if (newMarker != undefined) {
                mymap.removeLayer(newMarker);
            }
            if (foundMarker != undefined) {
                mymap.removeLayer(foundMarker);
            }
        })

        $('.add').on('click', function () {
            $('#addMarkerModal').modal('show');
            $('#formCoord').attr('action', "{{ route('addCoord') }}");
            $('#addMarkerJudul').html('Tambah Tempat');
            $('#cExistImage').hide();
            clearFormAdd();
        });

        $('body').magnificPopup({
            delegate: 'a.image-link',
            type: 'image',
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it
                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function
                opener: function (openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find(
                        'img');
                }
            }
        });

        // Validasi Checkbox pada jenis usaha
        var rCheckBox = $(':checkbox[required]');
        rCheckBox.change(function(){
            if(rCheckBox.is(':checked')) {
                rCheckBox.removeAttr('required');
            }
            else {
                rCheckBox.attr('required', 'required');
            }
        });

        // Edit Section
        $('#btnEdit').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var id_marker = $(this).attr('data-marker');
            $('#addMarkerJudul').html('Ubah Lokasi')
            $('#formCoord').attr('action', "{{ route('updateCoord') }}")
            $.ajax({
                url: "{{ route('getDetailCoord') }}",
                data: {
                    "_token": csrf,
                    "id": id
                },
                success: function (data) {
                    console.log(data)
                    $('input[name="kategori"][value="' + data.tempat.KATEGORI + '"]').prop("checked", true);
                    $('#nama_usaha').val(data.tempat.NAMA_USAHA);
                    $('#tgl_kunjungan').val(moment(data.tempat.TANGGAL_KUNJUNGAN).format('DD-MM-YYYY'));
                    $('#cp').val(data.tempat.CP);
                    $('#telepon').val(data.tempat.TELEPON);
                    $('#alamat').val(data.tempat.ALAMAT);
                    $('input[name="status_tempat"][value="' + data.tempat.STATUS_USAHA + '"]').prop("checked", true);
                    $('#jml_pekerja').val(data.tempat.JUMLAH_PEKERJA);
                    $('input[name="proses_penjualan"][value="' + data.tempat.PROSES_PENJUALAN + '"]').prop("checked", true);
                    $('#proses_pembayaran').val(data.tempat.PROSES_PEMBAYARAN).change();
                    $("#lat").val(data.tempat.LAT)
                    $("#lng").val(data.tempat.LNG)
                    $("#id_tempat").val(data.tempat.ID_TEMPAT);
                    $('#id_marker').val(id_marker);
                    // Foto
                    if(data.image.length > 0){
                        $('#cExistImage').show();
                        var imgList = '';
                        for(var i = 0; i < data.image.length; i++) {
                            imgList += '<li class="img-check"><input type="checkbox" name="del_image[]" value="' + data.image[i].GAMBAR + '" id="myCheckbox' + i + '"><label class="img-label" for="myCheckbox' + i + '"><img src="upload/img/thumbnail/' + data.image[i].GAMBAR + '" /></label></li>'
                        }
                        $('#imgList').html(imgList);
                    } else {
                        $('#cExistImage').hide();
                        $('#imgList').html('');
                    }

                    for(var i = 0; i < data.jenis_usaha.length; i++) {
                        $(':checkbox[value="' + data.jenis_usaha[i].JENIS_USAHA.toLowerCase() + '"]').prop('checked', true).change();
                    }

                    $('#cBahanBaku').html('');
                    for(var i = 0; i < data.jenis_bahan.length; i++) {
                        var margin = i == 0 ? '' : ' mt-3';
                        $('#cBahanBaku').append('<div class="row' + margin + '"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" value="' + data.jenis_bahan[i].JENIS_BAHAN + '" placeholder="Jenis bahan baku" required name="bahan_baku[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)" value="' + data.jenis_bahan[i].KAPASITAS + '" required name="bahan_baku_kg[]"></div></div>');

                        //  =============== untuk modal bahan baku ==============//
                        $('.c-bahan-baku[value="' + data.jenis_bahan[i].JENIS_BAHAN + '"]').prop('checked', true).change();
                        $('.c-bahan-baku-kg[data-value="' + data.jenis_bahan[i].JENIS_BAHAN  + '"]').val(data.jenis_bahan[i].KAPASITAS);
                    }

                    $('#cPenjualanBahan').html('');
                    for(var i = 0; i < data.penjualan.length; i++) {
                        var margin = i == 0 ? '' : ' mt-3';
                        $('#cPenjualanBahan').append('<div class="row' + margin + '"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" style="text-transform: capitalize;" value="' + data.penjualan[i].TEMPAT_PENJUALAN + '" placeholder="Penjualan bahan baku" required name="penjualan_bahan[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" value="' + data.penjualan[i].KETERANGAN + '" required name="penjualan_bahan_ket[]"></div></div>');

                        //  =============== untuk modal bahan baku ==============//
                        $('.c-penjualan-bahan[value="' + data.penjualan[i].TEMPAT_PENJUALAN + '"]').prop('checked', true).change();
                        $('.c-penjualan-bahan-ket[data-value="' + data.penjualan[i].TEMPAT_PENJUALAN  + '"]').val(data.penjualan[i].KETERANGAN);
                    }

                    $('#cMesin').html('');
                    for(var i = 0; i < data.mesin.length; i++) {
                        var margin = i == 0 ? '' : ' mt-3 mt-md-0';
                        var value = data.mesin[i].MESIN;
                        var value_milik = data.mesin[i].KEPEMILIKAN;
                        var value_qty = data.mesin[i].QTY;
                        
                        $('#cMesin').append('<div class="row ' + margin + '"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" placeholder="Mesin" style="text-transform: capitalize;" value="' + value + '" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" style="text-transform: capitalize;" value="' + value_milik + '" placeholder="Kepemilikan" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" value="' + value_qty + '" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');

                        $('.c-mesin[value="' + data.mesin[i].MESIN + '"]').prop('checked', true).change();
                        $('.c-kepemilikan[data-value="' + data.mesin[i].MESIN + '"]').val(data.mesin[i].KEPEMILIKAN).change();
                        $('.c-mesin-qty[data-value="' + data.mesin[i].MESIN  + '"]').val(data.mesin[i].QTY);
                    }

                    $('#addMarkerModal').modal('show');
                    $("#detailMarkerModal").modal('hide');
                }
            });
        })

        $('#btnDelete').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var id_marker = $(this).attr('data-marker');
            var lat = $(this).attr('data-lat');
            var lng = $(this).attr('data-lng');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data tempat akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delCoord') }}",
                        data: {
                            "_token": csrf,
                            "id": id
                        },
                        type: "POST",
                        success: function(response) {
                            $('#detailMarkerModal').modal('hide');
                            Swal.fire(
                                'Berhasil!',
                                'Lokasi berhasil dihapus',
                                'success'
                            )
                            marker.removeLayer(id_marker)
                        }
                    });
                }
            })
        });

        if(view != 0) {
            console.log('success')
        }

    })

</script>
@endpush