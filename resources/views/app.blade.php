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
            <li class="nav-item" >
                <a class="nav-link" style="padding: 0.2rem 1rem;" href="{{ route('/') }}">
                    <i class="fas fa-fw fa-map-marker-alt"></i>
                    <span>Map</span></a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" style="padding: 0.2rem 1rem;" href="{{ route('list') }}">
                    <i class="fas fa-fw fa-list-ul"></i>
                    <span>Daftar Lokasi</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item"  >
                <a class="nav-link" style="padding: 0.2rem 1rem;" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        @yield('content')
        <!-- End of Content Wrapper -->

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

    @stack('script')
    

</body>

</html>