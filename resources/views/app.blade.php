<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
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
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/sbadmin/js/sb-admin-2.js"></script>

    <script>
        $(function () {
            $('#overlay').delay(100).fadeOut();
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var mymap = L.map('mapid').setView([-1, 117], 5);
            L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=UyiGFyFAZELpBWUZ6VQd', {
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


            function mapMarker(data, show = false) {
                for (var i = 0; i < data.length; i++) {
                    var marker = L.marker([data[i].lat, data[i].lng], {
                        icon: newIcon
                    }).addTo(mymap);
                    if (show) {
                        mymap.setView([data[i].lat, data[i].lng], 18);
                        marker.bindPopup('<b>Added! </b>' + data[i].place).openPopup();
                    } else {
                        marker.bindPopup(data[i].place);
                    }
                }
                // marker.on('click', function (e) {
                //     map.setView(e.latlng, 13);
                // });
            }

            // marker.on('click', function (e) {
            //     map.setView(e.latlng, 13);
            // });

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

                    // L.marker(result.latlng).addTo(mymap).bindPopup()
                    //     .openPopup();

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
                    ).openPopup();
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

            $("#formCoord").submit(function (e) {
                e.preventDefault();
                $("#addMarkerModal").modal('hide');
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
                    data: $(this).serialize(),
                    type: "POST",
                    success: function (response) {
                        $("#exampleModal").modal('hide');
                        mapMarker(response, true);
                        $("#formCoord")[0].reset();
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
                // results.clearLayers();
                // for (var i = data.results.length - 1; i >= 0; i--) {
                //     results.addLayer(L.marker(data.results[i].latlng));
                // }
                searchGeo(data);
            });

            $('#addMarkerModal').on('shown.bs.modal', function (e) {
                $("#place").focus();
            })

            $('.btnAdd').on('click', function () {
                $('#addMarkerModal').modal('show');
            });

        })

    </script>

</body>

</html>
