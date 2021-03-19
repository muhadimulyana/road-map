<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="key-api" content="{{ $key }}">
    <title>Road Map</title>

    <!-- Custom fonts for this template-->
    <link href="assets/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="assets/leaflet/leaflet.css">
    <script src="assets/leaflet/leaflet.js"></script> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.5.3/dist/esri-leaflet.js"
        integrity="sha512-K0Vddb4QdnVOAuPJBHkgrua+/A9Moyv8AQEWi0xndQ+fqbRfAFd47z4A9u1AW/spLO0gEaiE1z98PK1gl5mC5Q=="
        crossorigin=""></script>

    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
        integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
        crossorigin=""></script>
    <script src="assets/leaflet/accurate.js"></script>

    <link rel="stylesheet" href="assets/plugin/magnific/magnific.css">
    <link href="assets/plugin/select2/select2.css" rel="stylesheet" />

    {{-- Datepicker --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugin/datepicker/css/bootstrap-material-datetimepicker.css">


    <style>
        body {
            padding: 0;
            margin: 0;
        }

        #overlay {
            background: #ffffff;
            color: #666666;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 25%;
            opacity: .80;
        }

        #mapid {
            height: 100vh;
        }

        .menu-btn {
            position: fixed;
            width: 40px;
            height: 40px;
            top: 10px;
            right: 10px;
            pointer-events: auto;
        }

        .add {
            position: fixed;
            width: 40px;
            height: 40px;
            bottom: 20px;
            right: 10px;
            pointer-events: auto;
        }

        .location {
            position: fixed;
            width: 40px;
            height: 40px;
            bottom: 80px;
            right: 10px;
            pointer-events: auto;
        }

        .btn-group-xs>.btn,
        .btn-xs {
            padding: .35rem .4rem;
            font-size: .675rem;
            line-height: .5;
            border-radius: .2rem;
        }

        .modal.right.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }

        @media (min-width: 768px) {
            .menu-btn {
                display: none;
            }
        }

        .modal .modal-dialog-aside {
            width: 400px;
            max-width: 80%;
            height: 100%;
            margin: 0;
            transform: translate(0);
            transition: transform .2s;
        }

        .modal .modal-dialog-aside .modal-content {
            height: inherit;
            border: 0;
            border-radius: 0;
        }

        .modal .modal-dialog-aside .modal-content .modal-body {
            overflow-y: auto
        }

        .modal.fixed-left .modal-dialog-aside {
            margin-left: auto;
            transform: translateX(100%);
        }

        .modal.fixed-right .modal-dialog-aside {
            margin-right: auto;
            transform: translateX(-100%);
        }

        .modal.show .modal-dialog-aside {
            transform: translateX(0);
        }

        .form-control.error {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6e707e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ed3960;
            border-radius: .35rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        label.error {
            color: #d3333b;
            font-size: 12px;
            display: block;
            margin-top: 2px;
        }

        input[type="file"] {}

        .mfp-bg,
        .mfp-gallery {
            z-index: 9999;
        }

        .form-control::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #d6d5d5;
            /* Firefox */
        }

        .form-control:-ms-input-placeholder {
            /* Internet Explorer 10-11 */
            color: #d6d5d5;
        }

        .form-control::-ms-input-placeholder {
            /* Microsoft Edge */
            color: #d6d5d5;
        }

        .select2{
            width: 100%;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div id="overlay">
            <!-- <div class="spinner"></div> -->
            <img width="120px" src="assets/img/loading2.gif">
            <br />
            <strong id="omessage">Sedang memproses...</strong>
        </div>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3" id="brand">Road Map</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->
            <div class="sidebar-heading">
                User
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    <i class=" fas fa-door-closed"></i>
                    <span> {{ __('Logout') }}</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="">
                    <!-- Page Heading -->
                    <div id="mapid"></div>
                    <div class="leaflet-top leaflet-right">
                        <a id="sidebarToggleTop" href="javascript:void" class="menu-btn btn btn-primary btn-circle">
                            <i style="font-size: 15px;" class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="leaflet-bottom leaflet-right">
                        <a href="javascript:void"
                            class="location btn btn-info btn-circle btn-lg">
                            <i style="font-size: 25px;" class="fas fa-street-view"></i>
                        </a>
                        <a href="javascript:void" data-toggle="modal" data-target="#addMarkerModal" class="add btn btn-success btn-circle btn-lg">
                            <i style="font-size: 25px;" class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="addMarkerModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="formCoord">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Tambah Tempat</h4>
                        <button class="close btnClose" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: 70vh; overflow-y: auto;">
                        <h5 class="text-primary mb-3" style="text-decoration: underline;">Tempat Usaha</h5>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control select2" required data-placeholder="Pilih Kategori"
                                name="kategori" id="kategori">
                                {{-- <option value=""> -- Pilih Kategori -- </option> --}}
                                <option value=""></option>
                                <option value="supplier">Supplier</option>
                                <option value="non supplier">Non Supplier</option>
                                <option value="kompetitor">Kompetitor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Usaha</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama usaha" required
                                id="nama_usaha" name="nama_usaha">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Kunjungan</label>
                            <input type="text" class="form-control datepicker" placeholder="Pilih tanggal kunjungan" required
                                id="tgl_kunjungan" name="tgl_kunjungan">
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
                            <input type="text" class="form-control" placeholder="Masukkan kontak person" required
                                id="cp" name="cp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telepon</label>
                            <input type="text" class="form-control" placeholder="Masukkan nomor telepon" required
                                id="telepon" name="telepon">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat Lengkap</label>
                            <textarea class="form-control" placeholder="Masukkan alamat lengkap" required id="alamat"
                                rows="5" name="alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status_tempat">Status Tempat Usaha</label>
                            <select class="form-control select2" name="status_tempat"
                                data-placeholder="Pilih Status Tempat Usaha" required id="status_tempat">
                                <option value=""></option>
                                <option value="milik sendiri">Milik Sendiri</option>
                                <option value="kontrak/sewa">Kontrak/Sewa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jumlah Pekerja</label>
                            <input type="text" class="form-control" placeholder="Masukkan jumlah pekerja" required
                                id="jml_pekerja" name="jml_pekerja">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto</label><br>
                            <input type="file" style="line-height: normal !important; font-size: 14px !important;"
                                multiple="multiple" id="file" name="file[]">
                        </div>
                        <hr>
                        <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Bahan Baku</h5>
                        <div class="form-group">
                            <label for="bahan_baku">Jenis & Kapasitas Bahan Baku | <a href="#" class="text-success"
                                    id="tBahanBaku">Tambah</a></label>
                            <div id="cBahanBaku">
                                <div class="row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <select class="form-control select2 bahan-baku"
                                            data-placeholder="Pilih Jenis Bahan Baku" required name="bahan_baku[]"
                                            id="bahan_baku">
                                            <option value=""></option>
                                            @foreach ($jenis_bahan as $row)
                                            <option value="{{ $row->JENIS_BAHAN }}">{{ $row->JENIS_BAHAN }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control"
                                            placeholder="Masukan kapasitas (KG/Bulan)" required id="bahan_baku_kg"
                                            name="bahan_baku_kg[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penjualan_bahan">Penjualan Bahan Baku | <a href="#"
                                    id="tPenjualanBahan" class="text-success">Tambah</a></label>
                            <div id="cPenjualanBahan">
                                <div class="row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <select class="form-control penjualan-bahan select2" required data-placeholder="Pilih Penjualan Bahan Baku"
                                            name="penjualan_bahan[]" id="penjualan_bahan">
                                            <option value=""></option>
                                            @foreach ($tempat_penjualan as $row)
                                            <option value="{{ strtolower($row->TEMPAT_PENJUALAN) }}">{{ $row->TEMPAT_PENJUALAN }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control"
                                            placeholder="Keterangan penjualan bahan baku" required id="penjualan_bahan_ket"
                                            name="penjualan_bahan_ket[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="proses_penjualan">Proses Penjualan</label>
                            <select class="form-control select2" data-placeholder="Pilih Proses Penjualan"
                                name="proses_penjualan" required id="proses_penjualan">
                                <option value=""></option>
                                <option value="dikirim">Dikirim</option>
                                <option value="diambil">Diambil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="proses_pembayaran">Proses Pembayaran</label>
                            <select class="form-control select2" data-placeholder="Pilih Proses Pembayaran"
                                name="proses_pembayaran" required id="proses_pembayaran">
                                <option value=""></option>
                                @foreach ($jenis_pembayaran as $row)
                                <option value="{{ strtolower($row->JENIS_PEMBAYARAN) }}">{{ $row->JENIS_PEMBAYARAN }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Mesin </h5>
                        <div class="form-group">
                            <label for="proses_pembayaran">Kepemilikan Mesin | <a href="#"
                                    class="text-success" id="tMesin">Tambah</a></label>
                            <div id="cMesin">
                                <div class="row">
                                    <div class="col-md-12 mb-2 mb-md-3">
                                        <select class="form-control mesin select2" style="width: 100%;" data-placeholder="Pilih Mesin" required name="mesin[]"
                                            id="mesin">
                                            <option value=""></option>
                                            @foreach ($mesin as $row)
                                            <option value="{{ strtolower($row->MESIN) }}">{{ $row->MESIN }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <select class="form-control select2" required data-placeholder="Kepemilikan"
                                            name="kepemilikan[]" id="kepemilikan">
                                            <option value=""></option>
                                            <option value="milik sendiri">Milik Sendiri</option>
                                            <option value="dipinjamkan">Dipinjamkan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Jumlah mesin" required
                                            id="mesin_qty" name="mesin_qty[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Koordinat </h5>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Latitude</label>
                            <input type="text" class="form-control" id="lat" placeholder="Masukkan koordinat latitude" name="lat" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Longitude</label>
                            <input type="text" class="form-control" id="lng" placeholder="Masukkan koordinat longitude"  name="lng" required>
                        </div>
                    </div>
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
                        <p id="kategoriText" class="font-weight-bold badge badge-primary" style="font-size: 100%; text-transform: capitalize;">Memuat...</p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Jenis Usaha</label>
                        <p id="jenisUsahaText" class="font-weight-bold" style="text-transform: capitalize;">Memuat...</p>
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
                        <p id="statusTempatText" style="text-transform: capitalize;" class="font-weight-bold">Memuat...</p>
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
                        <p id="penjualanBahanBakuText" style="text-transform: capitalize;" class="font-weight-bold">Memuat...</p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Proses Penjualan</label>
                        <p id="prosesPenjualanText" style="text-transform: capitalize;" class="font-weight-bold">Memuat...</p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Proses Pembayaran</label>
                        <p id="prosesPembayaranText" style="text-transform: capitalize;" class="font-weight-bold">Memuat...</p>
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
                    {{-- <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Informasi</label>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tristique elit at interdum
                            condimentum. Vivamus in ultricies augue. Suspendisse viverra ante orci, malesuada cursus
                            purus fringilla et. In a mauris sollicitudin, luctus nulla ac, sagittis ante. Proin non nunc
                            posuere, bibendum augue at, bibendum justo. Curabitur venenatis eget diam eget mattis. Duis
                            lacus augue, eleifend sit amet commodo sed, vehicula a orci. Nam ut semper est, ut faucibus
                            erat. Sed eget feugiat lectus. Phasellus laoreet magna a pellentesque congue. Donec posuere
                            nibh nec lectus pharetra, a commodo ex malesuada. Mauris ultrices est lobortis, bibendum est
                            ac, dignissim magna. Suspendisse aliquam nunc nec lorem finibus consequat. Nulla vitae
                            tellus vitae massa mattis facilisis cursus sed erat. In hac habitasse platea dictumst.</p>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-success" id="btnEdit">Edit</a>
                    <button type="button" class="btn btn-danger">Hapus</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div> <!-- modal-bialog .// -->
    </div> <!-- modal.// -->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugin/select2/select2.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/sbadmin/js/sb-admin-2.js"></script>
    <script src="assets/plugin/magnific/magnific-popup.min.js"></script>

    {{-- Validate --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    {{-- Moment --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    {{-- Datepicker --}}
    <script src="assets/plugin/datepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script>
        $(function () {
            $('.select2').select2({
                allowClear: true
            });
            $('.datepicker').bootstrapMaterialDatePicker({
                time: false
            });

            $('#overlay').delay(100).fadeOut();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var key = $('meta[name="key-api"]').attr('content');
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
            var newIcon = L.icon({
                iconUrl: 'assets/img/new.png',
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
            var results = L.layerGroup().addTo(mymap);
            var marker;
            var circle;
            var manMarker;
            var newMarker;
            var foundMarker;
            var geocodeService = L.esri.Geocoding.geocodeService();
            //L.esri.basemapLayer('Gray').addTo(mymap);
            //L.esri.basemapLayer('GrayLabels').addTo(mymap);

            mymap.setMaxZoom(18);
            mymap.setMinZoom(3);
            L.control.scale().addTo(mymap);

            function markerOnClick() {

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

                var id = this.options.ID_TEMPAT;
                var place = this.options.place;
                var lat = this.options.LAT;
                var lng = this.options.LNG;
                $("#placeName").html(place);
                $('#kategoriText').html(this.options.KATEGORI);
                $('#tglKunjunganText').html(moment(this.options.TANGGAL_KUNJUNGAN).format('DD-MM-YYYY'));
                $('#cpText').html(this.options.CP);
                $('#teleponText').html(this.options.TELEPON);
                $('#alamatText').html(this.options.ALAMAT);
                $('#statusTempatText').html(this.options.STATUS_USAHA);
                $('#jmlPekerjaText').html(this.options.JUMLAH_PEKERJA);
                $('#prosesPenjualanText').html(this.options.PROSES_PENJUALAN);
                $('#prosesPembayaranText').html(this.options.PROSES_PEMBAYARAN);
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
                        for (var i = 0; i < data.image.length; i++) {
                            img += '<div class="col-6 text-center mb-3"><a href="upload/img/' + data.image[i].GAMBAR + '" class="image-link"><img src="upload/img/thumbnail/' + data.image[i].GAMBAR + '" style="width:150px; height:100px; object-fit:cover; border-radius: 10px;" class="img-fluid" alt=""></a></div>'
                        }
                        $('.image-gallery').html(img);
                    }
                });
                $("#detailMarkerModal").modal('show');
            }

            function manMarkerOnClick(){
                $('.btnAdd').on('click', function () {
                    $('#addMarkerModal').modal('show');
                });
            }

            function mapMarker(data, show) {
                for (var i = 0; i < data.length; i++) {
                    marker = L.marker([data[i].LAT, data[i].LNG], {
                        icon: newIcon,
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
                    }).addTo(mymap).on('click', markerOnClick);
                    if (show) {
                        mymap.setView([data[i].LAT, data[i].LNG], 18);
                        //marker.bindPopup('<b>Added! </b>' + data[i].place).openPopup();
                    } else {
                        //marker.bindPopup(data[i].place);
                    }
                }
                // marker.on('click', function (e) {
                //     map.setView(e.latlng, 13);
                // });
                // marker.on('click', function (e) {
                //     console.log(e.latlng);
                // });
            }

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
            });

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
                geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
                    if (error) {
                        return;
                    }

                    newMarker = L.marker(e.latlng, {
                            icon: foundIcon
                        }).addTo(mymap)
                        .bindPopup(result.address.Match_addr + '<br>' +
                            '<div class="text-center mt-1"><button class="btn btn-xs btn-primary btnAdd">Tandai Lokasi Ini</button></div>'
                        ).openPopup();
                    $('#place').val('');
                    $('#lat').val(e.latlng.lat);
                    $('#lng').val(e.latlng.lng);
                    $('.btnAdd').on('click', function () {
                        $('#addMarkerModal').modal('show');
                    });
                });

            });


            function onLocationInput(e) {
                $('#lat').val(e.latlng.lat);
                $('#lng').val(e.latlng.lng);
                $('#addMarkerModal').modal('show');
            }

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

                $('.btnAdd').on('click', function () {
                    $('#addMarkerModal').modal('show');
                });
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
                $('#place').val('');
                $('#lat').val(e.latlng.lat);
                $('#lng').val(e.latlng.lng);
                $('#overlay').delay(100).fadeOut();

                $('.btnAdd').on('click', function () {
                    $('#addMarkerModal').modal('show');
                });
            }

            function onAccuratePositionProgress(e) {
                var message = 'Sedang memporeses… (akurasi: ' + e.accuracy / 2 + ' meter)';
                $("#overlay").fadeIn();
                $("#omessage").html(message)

            }

            function onLocationError(e) {
                alert(e.message);
            }

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

            // $('#formCoord').validate({ // initialize the plugin
            //     rules: {
            //         "place": {
            //             required: true
            //         },
            //         "file[]": {
            //             required: false,
            //             extension: "jpeg|png|jpg",
            //             filesize: 2
            //         },
            //     },
            //     messages: {
            //         "place": {
            //             required: "Nama tempat tidak boleh kosong"
            //         },
            //         "file[]": {
            //             extension: "File yang diperbolehkan hanya JPEG dan PNG",
            //             filesize: "Maksimum ukuran file 2 MB"
            //         }
            //     },
            //     submitHandler: function (form) {

            //     }
            // });

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
                    url: "{{ route('addCoord') }}",
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
                        $("#formCoord")[0].reset();
                        mapMarker(response, true);
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
                results.clearLayers();
                for (var i = data.results.length - 1; i >= 0; i--) {
                    foundMarker = L.marker(data.results[i].latlng, {
                        icon: foundIcon,
                        opacity: 0
                    });
                }
                results.addLayer(foundMarker);
            }

            searchControl.on('results', function (data) {
                searchGeo(data);
            });

            $('#addMarkerModal').on('shown.bs.modal', function (e) {
                $("#place").focus();
            })

            $('#addMarkerModal').on('hidden.bs.modal', function (e) {
                $("#formCoord")[0].reset();
                $("label.error").hide();
                $('.select2').val('').change();
                $('.d-bahan-baku').val('').change();
                $('.d-mesin').val('').change();
                $('.d-penjualan-bahan').val('').change();
                $('.kepemilikan').val('').change();
                $('.clone').remove();
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

            $('.btnAdd').on('click', function () {
                $('#addMarkerModal').modal('show');
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

            // For Form Element
            // =============================== //
            var max_field = 10000;
            // Tambah Jenis Bahan Baku //
            var iBahanBaku = 1; // Jumlah field bahan baku
            $('#tBahanBaku').on('click', function(e) {
                e.preventDefault();
                var vBahanBaku = $('.bahan-baku').filter(function () { return this.value === '' }); // Jumlah class bahan baku yg ttidak memiliki value
                if(vBahanBaku.length == 0) {
                    if(max_field >= iBahanBaku) {
                        $('#cBahanBaku').append('<div class="row mt-3 clone"><div class="col-md-5 mb-2 mb-md-0"><select class="form-control select2 bahan-baku d-bahan-baku" required data-placeholder="Pilih Jenis Bahan Baku" name="bahan_baku[]" style="width: 100%;"><option value=""></option></select></div><div class="col-md-6"><input type="text" class="form-control" placeholder="Masukan kapasitas (KG/Bulan)" required id="bahan_baku_kg" name="bahan_baku_kg[]"></div><div class="col-md-1"><a href="#" class="text-danger hBahanBaku mt-1"><small>Hapus</small></a></div></div>');
                    } else {
                        alert('Error!');
                    }
                } else if(vBahanBaku.length > 0) {
                    $('#tBahanBaku').click(false);
                    alert('Mohon lengkapi data jenis bahan baku sebelumnya!');
                }

                //Isi select bahan baku
                $(".d-bahan-baku").select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('getBahanBaku') }}",
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    }
                });
            })

            //Hapus field jenis bahan baku
            $('#cBahanBaku').on("click", ".hBahanBaku", function(e){ //user click on remove text
                e.preventDefault(); 
                $(this).parents('.row').remove(); iBahanBaku--;
            });

            //============== End ================= //

             // Tambah Penjualan Bahan Baku //
             var iPenjualan = 1; // Jumlah field bahan baku
            $('#tPenjualanBahan').on('click', function(e) {
                e.preventDefault();
                var vPenjualan = $('.penjualan-bahan').filter(function () { return this.value === '' }); // Jumlah class bahan baku yg ttidak memiliki value
                if(vPenjualan.length == 0) {
                    if(max_field >= iPenjualan) {
                        $('#cPenjualanBahan').append('<div class="row mt-3 clone"><div class="col-md-5 mb-2 mb-md-0"><select class="form-control penjualan-bahan d-penjualan-bahan select2" required data-placeholder="Pilih Penjualan Bahan Baku" name="penjualan_bahan[]" style="width: 100%;"> <option value=""></option></select></div><div class="col-md-6"><input type="text" class="form-control" placeholder="Keterangan penjualan bahan baku" required name="penjualan_bahan_ket[]"></div><div class="col-md-1"><a href="#" class="text-danger hPenjualanBahan mt-1"><small>Hapus</small></a></div></div>');
                    } else {
                        alert('Error!');
                    }
                } else if(vPenjualan.length > 0) {
                    $('#tPenjualanBahan').click(false);
                    alert('Mohon lengkapi data penjualan bahan baku sebelumnya!');
                }

                //Isi select bahan baku
                $(".d-penjualan-bahan").select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('getPenjualanBahan') }}",
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    }
                });
            })

            //Hapus field jenis bahan baku
            $('#cPenjualanBahan').on("click", ".hPenjualanBahan", function(e){ //user click on remove text
                e.preventDefault(); 
                $(this).parents('.row').remove(); iPenjualan--;
            });

            // ============== End ============ //

            // Tambah Mesin //
            var iMesin = 1; // Jumlah field Mesin
            $('#tMesin').on('click', function(e) {
                e.preventDefault();
                var vMesin = $('.mesin').filter(function () { return this.value === '' }); // Jumlah class bahan baku yg ttidak memiliki value
                if(vMesin.length == 0) {
                    if(max_field >= iMesin) {
                        $('#cMesin').append('<div class="row mt-3 clone"><div class="col-md-12 mb-2 mb-md-2"><select class="form-control mesin d-mesin" style="width: 100%;" required data-placeholder="Pilih Mesin" name="mesin[]"><option value=""></option></select></div><div class="col-md-6 mb-2 mb-md-0"><select class="form-control kepemilikan"  style="width: 100%;" data-placeholder="Kepemilikan" name="kepemilikan[]" required><option value=""></option><option value="milik sendiri">Milik Sendiri</option><option value="dipinjamkan">Dipinjamkan</option></select></div><div class="col-md-5"><input type="text" class="form-control" required placeholder="Jumlah mesin" name="mesin_qty[]"></div><div class="col-md-1"><a href="#" class="text-danger hMesin mt-1"><small>Hapus</small></a></div></div>');
                    } else {
                        alert('Error!');
                    }
                } else if(vMesin.length > 0) {
                    $('#tMesin').click(false);
                    alert('Mohon lengkapi data mesin sebelumnya!');
                }

                //Isi select bahan baku
                $(".d-mesin").select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('getMesin') }}",
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    }
                });

                $('.kepemilikan').select2({
                    allowClear: true
                });
            })

            //Hapus field jenis bahan baku
            $('#cMesin').on("click", ".hMesin", function(e){ //user click on remove text
                e.preventDefault(); 
                $(this).parents('.row').remove(); iPenjualan--;
            });

            // ============== End ============ //

            // Validasi Checkbox 
            var requiredCheckboxes = $(':checkbox[required]');

            requiredCheckboxes.change(function(){

                if(requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                }

                else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });

        })

    </script>

</body>

</html>