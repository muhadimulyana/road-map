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
    <meta name="view" content="{{ $view }}">
    <meta name="view-id" content="{{ $id }}">
    <title>Road Map PAN ERA GROUP</title>

    <!-- Custom fonts for this template-->
    <link href="assets/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="assets/leaflet/leaflet.css">
    <script src="assets/leaflet/leaflet.js"></script> --}}
    {{-- <link rel="stylesheet" href="assets/plugin/leaflet/leaflet.css">
    <script src="assets/plugin/leaflet/leaflet.js"></script>
    <script src="assets/plugin/leaflet/esri-leaflet.js"></script>
    <link rel="stylesheet" href="assets/plugin/leaflet/esri-leaflet-geocoder.css">
    <script src="assets/plugin/leaflet/esri-leaflet-geocoder.js"></script> --}}
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

    {{-- Datatable --}}
    <link href="assets/plugin//datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

        .location2 {
            position: static;
            margin-bottom: 40px;
            margin-right: 40px;
            bottom: 60px;
            right: 150px;
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

        .select2 {
            width: 100%;
        }

        /* Checkbox Image */
        ul.img-list {
            list-style-type: none !important;
            padding: 0;
        }

        li.img-check {
            display: inline-block;
        }

        input[type="checkbox"][id^="myCheckbox"] {
            display: none;
        }

        label.img-label {
            border: 1px solid #fff;
            display: block;
            position: relative;
            margin: 10px;
            cursor: pointer;
        }

        label.img-label:before {
            background-color: white;
            color: white;
            content: " ";
            display: block;
            border-radius: 50%;
            border: 1px solid grey;
            position: absolute;
            top: -5px;
            left: -5px;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 28px;
            transition-duration: 0.4s;
            transform: scale(0);
        }

        label.img-label img {
            height: 100px;
            width: 100px;
            border-radius: 10px;
            object-fit: cover;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
        }

        :checked+label.img-label {
            border-color: #ddd;
            border-radius: 10px;
        }

        :checked+label.img-label:before {
            content: "✓";
            background-color: grey;
            transform: scale(1);
            z-index: 1;
        }

        :checked+label.img-label img {
            transform: scale(0.9);
            /* box-shadow: 0 0 5px #333; */
            z-index: -1;
        }

        .btn-group-sm>.btn, .btn-smx {
            padding: .25rem .3rem;
            font-size: .775rem;
            line-height: 1.5;
            border-radius: .2rem;
        }

        .color-pin { 
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        .color-pin + img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        .color-pin:checked + img {
            outline: 2px solid #108de1;
        }

        /* Open 2 modal */
        /* .modal:nth-of-type(even) {
            z-index: 1052 !important;
        }
        .modal-backdrop.show:nth-of-type(even) {
            z-index: 1051 !important;
        } */
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @yield('overlay')
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('/') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3" id="brand">Road Map</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Route::is('/') ? 'active' : '' }}" >
                <a class="nav-link" style="padding: 0.2rem 1rem;" href="{{ route('/') }}">
                    <i class="fas fa-fw fa-map-marker-alt"></i>
                    <span>Map</span></a>
            </li>
            <li class="nav-item {{ Route::is('list') ? 'active' : '' }}" >
                <a class="nav-link" style="padding: 0.2rem 1rem;" href="{{ route('list') }}">
                    <i class="fas fa-fw fa-list-ul"></i>
                    <span>Daftar Lokasi</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item"  >
                <a class="nav-link" id="btnLogout" style="padding: 0.2rem 1rem;" href="javascript:void(0)">
                    <i class=" fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
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
        @yield('content')
        <!-- End of Content Wrapper -->

        <!-- Add Modal-->
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
                            <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Bahan Baku</h5>
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
                            <h5 class="text-primary mt-3 mb-3" style="text-decoration: underline;">Mesin </h5>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pilih Penjualan Bahan Baku</h5>
                    </div>
                    <form id="addPenjualanForm">
                        <div class="modal-body">
                            <div class="table-responsive">
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
                                            <th scope="col">Proses Penjualan</th>
                                            <th scope="col" width="15%">Proses Pembayaran</th>
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
                                            <td>
                                                <select class="form-control c-proses-penjualan select2" required
                                                    data-placeholder="Proses Penjualan" name="c_proses_penjualan[]"
                                                    data-value="{{ $row->TEMPAT_PENJUALAN }}" disabled
                                                    id="c_proses_penjualan{{ $row->ID_TEMPAT_PENJUALAN }}">
                                                    <option value=""></option>
                                                    <option value="dikirim">Dikirim</option>
                                                    <option value="diambil">Diambil</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control c-proses-pembayaran select2"
                                                    data-placeholder="Pilih Proses Pembayaran"
                                                    data-value="{{ $row->TEMPAT_PENJUALAN }}" name="c_proses_pembayaran[]"
                                                    required id="c_proses_pembayaran{{ $row->ID_TEMPAT_PENJUALAN }}" disabled>
                                                    <option value=""></option>
                                                    @foreach ($jenis_pembayaran as $row)
                                                    <option value="{{ strtolower($row->JENIS_PEMBAYARAN) }}">
                                                        {{ $row->JENIS_PEMBAYARAN }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
        @yield('modal')
    </div>
    <!-- End of Page Wrapper -->



    <!-- Bootstrap core JavaScript-->
    <script src="assets/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugin/select2/select2.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/sbadmin/js/sb-admin-2.js"></script>
    <script src="assets/plugin/magnific/magnific-popup.min.js"></script>

    {{-- Moment --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
    {{-- Datepicker --}}
    <script src="assets/plugin/datepicker/js/bootstrap-material-datetimepicker.js"></script>
    {{-- Sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- Datatable --}}
    <script src="assets/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugin/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function() {
            // ============================= Funtion =======================
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var key = $('meta[name="key-api"]').attr('content');
            var view = $('meta[name="view"]').attr('content');
            var id_view = $('meta[name="view-id"]').attr('content');

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
                    $('#c_proses_penjualan' + id).prop('disabled', false);
                    $('#c_proses_pembayaran' + id).prop('disabled', false);
                } else {
                    $('#c_penjualan_bahan_ket' + id).prop('readonly', true);
                    $('#c_penjualan_bahan_ket' + id).val('');
                    $('#c_proses_penjualan' + id).prop('disabled', true);
                    $('#c_proses_pembayaran' + id).prop('disabled', true);
                    $('#c_proses_penjualan' + id).val('').change();
                    $('#c_proses_pembayaran' + id).val('').change();
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
                        var value_penjualan = $('#c_proses_penjualan' + id).val();
                        var value_pembayaran = $('#c_proses_pembayaran' + id).val();
                        $('#cPenjualanBahan').append('<div class="row' + margin + '"><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" value="' + value + '" placeholder="Penjualan bahan baku" style="text-transform: capitalize;" required name="penjualan_bahan[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" value="' + value_ket + '" required name="penjualan_bahan_ket[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Proses penjualan bahan baku" style="text-transform: capitalize;" value="' + value_penjualan + '" required name="proses_penjualan[]"></div><div class="col-md-3"><input type="text" class="form-control readonly" style="text-transform: capitalize;" placeholder="Proses pembayaran bahan baku" value="' + value_pembayaran + '" required name="proses_pembayaran[]"></div></div>');
                    });
                } else {
                    $('#cPenjualanBahan').append('<div class="row"><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Penjualan bahan baku" required id="bahan_baku" name="penjualan_bahan[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" required name="penjualan_bahan_ket[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Proses penjualan bahan baku" style="text-transform: capitalize;" required name="proses_penjualan[]"></div><div class="col-md-3"><input type="text" class="form-control readonly" style="text-transform: capitalize;" placeholder="Proses pembayaran bahan baku" required name="proses_pembayaran[]"></div</div>');
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
                $('#cPenjualanBahan').html('<div class="row"><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Penjualan bahan baku" required id="bahan_baku" name="penjualan_bahan[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" required name="penjualan_bahan_ket[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Proses penjualan bahan baku" style="text-transform: capitalize;" required name="proses_penjualan[]"></div><div class="col-md-3"><input type="text" class="form-control readonly" style="text-transform: capitalize;" placeholder="Proses pembayaran bahan baku" required name="proses_pembayaran[]"></div</div>');
                $('#cMesin').html('<div class="row"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" placeholder="Mesin" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Kepemilikan" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');
                $('#cExistImage').hide();
            }

            $('.btnClose').on('click', function(e) {
                clearFormAdd();
            })

            $('#overlay').delay(100).fadeOut();

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
                $('#addMarkerJudul').html('Tambah Lokasi');
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
            $(document).on('click', '#btnEdit', function(e) {
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
                        $('.color-pin[value=' + data.tempat.MARKER).prop('checked', true);
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
                            $('#cPenjualanBahan').append('<div class="row' + margin + '"><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" value="' + data.penjualan[i].TEMPAT_PENJUALAN + '" placeholder="Penjualan bahan baku" style="text-transform: capitalize;" required name="penjualan_bahan[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" value="' + data.penjualan[i].KETERANGAN + '" required name="penjualan_bahan_ket[]"></div><div class="col-md-3 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Proses penjualan bahan baku" style="text-transform: capitalize;" value="' + data.penjualan[i].PROSES_PENJUALAN + '" required name="proses_penjualan[]"></div><div class="col-md-3"><input type="text" class="form-control readonly" style="text-transform: capitalize;" placeholder="Proses pembayaran bahan baku" value="' + data.penjualan[i].PROSES_PEMBAYARAN + '" required name="proses_pembayaran[]"></div></div>')

                            //  =============== untuk modal bahan baku ==============//
                            $('.c-penjualan-bahan[value="' + data.penjualan[i].TEMPAT_PENJUALAN + '"]').prop('checked', true).change();
                            $('.c-penjualan-bahan-ket[data-value="' + data.penjualan[i].TEMPAT_PENJUALAN  + '"]').val(data.penjualan[i].KETERANGAN);
                            $('.c-proses-penjualan[data-value="' + data.penjualan[i].TEMPAT_PENJUALAN  + '"]').val(data.penjualan[i].PROSES_PENJUALAN).change();
                            $('.c-proses-pembayaran[data-value="' + data.penjualan[i].TEMPAT_PENJUALAN  + '"]').val(data.penjualan[i].PROSES_PEMBAYARAN).change();
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

            $(document).on('click', '#btnDelete', function(e) {
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

            $(document).on('click', '.btnAdd', function () {
                $('#addMarkerModal').modal('show');
                $('#formCoord').attr('action', "{{ route('addCoord') }}");
                $('#addMarkerJudul').html('Tambah Lokasi');
                $('#cExistImage').hide();
            });

            $('#btnLogout').on('click', function(e) {
                Swal.fire({
                title: 'Apakah anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#logout-form').submit();
                }
            })
            })

            // ===============================MAP ==============================

            var mymap = L.map('mapid', {
                zoomControl: false
            }).setView([-1, 117], 5);
            if ($(window).width() >= 993) {
                L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key, {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    tileSize: 512,
                    zoomOffset: -1,
                    noWrap: true
                }).addTo(mymap);
            } else {
                L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key, {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    noWrap: true
                    //tileSize: 512,
                    //zoomOffset: -1,
                }).addTo(mymap);
            }
            mymap.setMaxBounds([[-90,-180],   [90,180]])
            mymap.on('drag', function() {
                mymap.panInsideBounds([[-90,-180],   [90,180]], { animate: false });
            });
            
            var manIcon = L.icon({
                iconUrl: 'assets/img/placeholder2.png',
                iconSize: [35, 35], // size of the icon
                iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
                popupAnchor: [0, -
                    35
                ] // point from which the popup should open relative to the iconAnchor
            });
            var greenIcon = L.icon({
                iconUrl: 'assets/img/marker/green-1.png',
                shadowUrl: 'assets/img/shadow.png',
                iconSize: [35, 35], // size of the icon
                shadowSize: [32, 35], // size of the shadow
                iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
                shadowAnchor: [8, 37], // the same for the shadow
                popupAnchor: [0, -
                    35
                ] // point from which the popup should open relative to the iconAnchor
            });
            var blueIcon = L.icon({
                iconUrl: 'assets/img/marker/blue-2.png',
                shadowUrl: 'assets/img/shadow.png',
                iconSize: [35, 35], // size of the icon
                shadowSize: [32, 35], // size of the shadow
                iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
                shadowAnchor: [8, 37], // the same for the shadow
                popupAnchor: [0, -
                    35
                ] // point from which the popup should open relative to the iconAnchor
            });
            var redIcon = L.icon({
                iconUrl: 'assets/img/marker/red-1.png',
                shadowUrl: 'assets/img/shadow.png',
                iconSize: [35, 35], // size of the icon
                shadowSize: [32, 35], // size of the shadow
                iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
                shadowAnchor: [8, 37], // the same for the shadow
                popupAnchor: [0, -
                    35
                ] // point from which the popup should open relative to the iconAnchor
            });
            var yellowIcon = L.icon({
                iconUrl: 'assets/img/marker/yellow-1.png',
                shadowUrl: 'assets/img/shadow.png',
                iconSize: [35, 35], // size of the icon
                shadowSize: [32, 35], // size of the shadow
                iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
                shadowAnchor: [8, 37], // the same for the shadow
                popupAnchor: [0, -
                    35
                ] // point from which the popup should open relative to the iconAnchor
            });
            var purpleIcon = L.icon({
                iconUrl: 'assets/img/marker/purple.png',
                shadowUrl: 'assets/img/shadow.png',
                iconSize: [35, 35], // size of the icon
                shadowSize: [32, 35], // size of the shadow
                iconAnchor: [18, 35], // point of the icon which will correspond to marker's location
                shadowAnchor: [8, 37], // the same for the shadow
                popupAnchor: [0, -
                    35
                ] // point from which the popup should open relative to the iconAnchor
            });
            var blackIcon = L.icon({
                iconUrl: 'assets/img/marker/black-2.png',
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
            L.control.zoom({position: 'topright'}).addTo(mymap);
            var searchControl = L.esri.Geocoding.geosearch({ position: 'topright'}).addTo(mymap);
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

            //Tidak dipakai
            function manMarkerOnClick(){
                $(document).on('click', '.btnAdd', function () {
                    $('#addMarkerModal').modal('show');
                    $('#formCoord').attr('action', "{{ route('addCoord') }}");
                    $('#addMarkerJudul').html('Tambah Lokasi');
                    $('#cExistImage').hide();
                });
            }

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
                var badge =this.options.MARKER == 'green' ? 'font-weight-bold badge badge-success' : (this.options.MARKER == 'red' ? 'font-weight-bold badge badge-danger' : (this.options.MARKER == 'yellow' ? 'font-weight-bold badge badge-warning' : (this.options.MARKER == 'blue' ? 'font-weight-bold badge badge-primary' : 'font-weight-bold badge badge-secondary')))
                markerPopup(this._leaflet_id, false);
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
                $('#btnEdit').attr('data-id', id)
                $('#btnEdit').attr('data-marker', id_marker)
                $('#btnDelete').attr('data-id', id)
                $('#btnDelete').attr('data-lat', lat)
                $('#btnDelete').attr('data-lng', lng)
                $('#btnDelete').attr('data-marker', id_marker)
                $("#latText").html(lat)
                $("#lngText").html(lng)
                $('#userText').html(this.options.USERNAME)
                //mymap.setView([lat, lng], 18);
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
                            jenis_bahan += '<tr><td>' + data.jenis_bahan[i].JENIS_BAHAN +'</td><td>' + data.jenis_bahan[i].KAPASITAS +'KG/Bulan</td></tr>'
                        }

                        $('#jenisBahanTable').html(jenis_bahan);

                        //Penjualan Bahan Baku

                        var penjualan ='';
                        for(var i = 0; i < data.penjualan.length; i++) {
                            penjualan += '<tr><td style="text-transform: capitalize;">' + data.penjualan[i].TEMPAT_PENJUALAN +'</td><td>' + data.penjualan[i].KETERANGAN +'</td><td style="text-transform: capitalize;">' + data.penjualan[i].PROSES_PENJUALAN +'</td><td style="text-transform: capitalize;">' + data.penjualan[i].PROSES_PEMBAYARAN +'</td></tr>'
                        }

                        $('#penjualanBahanBakuTable').html(penjualan);

                        //Mesin

                        var mesin ='';
                        for(var i = 0; i < data.mesin.length; i++) {
                            mesin += '<tr><td style="text-transform: capitalize;">' + data.mesin[i].MESIN +'</td><td style="text-transform: capitalize;">' + data.mesin[i].KEPEMILIKAN +'</td><td>' + data.mesin[i].QTY +'</td></tr>'
                        }

                        $('#mesinTable').html(mesin);

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


            function onAccuratePositionProgress(e) {
                var message = 'Sedang memporeses…';
                $("#overlay").fadeIn();
                $("#omessage").html(message)

            }

            function onLocationError(e) {
                alert(e.message);
            }


            function clearMarker(){
                $(".leaflet-marker-icon").remove();
                $(".leaflet-popup").remove();
                $(".leaflet-marker-shadow").remove();
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

            searchControl.on('results', function (data) {
                searchGeo(data);
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

            @stack('script')

        });

    </script>
    

    

</body>

</html>