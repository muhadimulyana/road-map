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
            width: 350px;
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
                        <a href="javascript:void" data-toggle="modal" data-target="#modal_aside_right"
                            class="location btn btn-light btn-circle btn-lg">
                            <i style="font-size: 25px;" class="fas fa-compass"></i>
                        </a>
                        <a href="javascript:void" class="add btn btn-success btn-circle btn-lg">
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
    <div class="modal fade" id="addMarkerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formCoord">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Marker</h5>
                        <button class="close btnClose" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Place</label>
                            <input type="text" class="form-control" required id="place" name="place">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Langitude</label>
                            <input type="text" class="form-control" id="lng" name="lng" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto</label><br>
                            <input type="file" style="line-height: normal !important; font-size: 14px !important;"
                                multiple="multiple" id="file" name="file[]">
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
                        <label for="exampleInputPassword1">Latitude</label>
                        <p id="latText" class="font-weight-bold"></p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Longitude</label>
                        <p id="lngText" class="font-weight-bold"></p>
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
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Foto</label>
                        <div class="row image-gallery">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div> <!-- modal-bialog .// -->
    </div> <!-- modal.// -->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/sbadmin/js/sb-admin-2.js"></script>
    <script src="assets/plugin/magnific/magnific-popup.min.js"></script>

    {{-- Validate --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <script>
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than {0} MB');
        $(function () {
            $('#overlay').delay(100).fadeOut();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var key = $('meta[name="key-api"]').attr('content');
            var mymap = L.map('mapid').setView([-1, 117], 5);
            L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key, {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mymap);
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
                var id = this.options.id;
                var place = this.options.place;
                var lat = this.options.lat;
                var lng = this.options.lng;
                $("#placeName").html(place);
                $("#latText").html(lat)
                $("#lngText").html(lng)
                //console.log(id);
                $.ajax({
                    url: "{{ route('getMarkerImage') }}",
                    data: {
                        "_token": csrf,
                        "id": id
                    },
                    success: function (data) {
                        var html = '';
                        var storage = '{{ asset('storage/images/') }}';
                        for (var i = 0; i < data.length; i++) {
                            html += '<div class="col-6 text-center mb-3"><a href="upload/img/' + data[i].gambar + '" class="image-link"><img src="upload/img/thumbnail/' + data[i].gambar + '" style="width:150px; height:100px; object-fit:cover; border-radius: 10px;" class="img-fluid" alt=""></a></div>'
                        }
                        $('.image-gallery').html(html);
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
                    marker = L.marker([data[i].lat, data[i].lng], {
                        icon: newIcon,
                        id: data[i].id,
                        place: data[i].place,
                        lat: data[i].lat,
                        lng: data[i].lng
                    }).addTo(mymap).on('click', markerOnClick);
                    if (show) {
                        mymap.setView([data[i].lat, data[i].lng], 18);
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

            $('.add').on('click', function () {
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
                        $("#addMarkerModal").modal('hide');
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

        })

    </script>

</body>

</html>
