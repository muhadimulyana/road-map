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
            <div id="mapid">
                <div class="leaflet-top leaflet-left">
                    <a id="sidebarToggleTop" href="javascript:void(0)"
                        class="menu-btn btn btn-primary btn-circle widget text-white mt-3 ml-3"
                        style="pointer-events: auto;">
                        <i style="font-size: 15px;" class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="leaflet-top leaflet-left ml-3 mt-3" style="min-width: 300px;">
                    <div style="pointer-events: auto;">
                        <select name="search" class="form-control search" data-placeholder="Cari lokasi customer, distributor atau sourcing" id="search">
                            <option value=""></option>
                        </select>
                    </div>
                    {{-- <input type="email" class="form-control form-control-user" id="search"
                        placeholder="Ketikkan kata kunci disini"> --}}
                </div>
            </div>
            <div class="leaflet-top leaflet-right">
                <div style="margin-right: 10px; margin-top: 120px; pointer-events: auto;">
                    <div class="dropdown show filter">
                        <a class="btn btn-light btn-sm dropdown-toggle"
                            style="border: 2px solid rgba(0, 0, 0, 0.3); height: 34px; line-height: 34px;" href="#"
                            role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-filter" style="line-height: 22px;"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item filter-map active" data-val="all" href="#">SEMUA</a>
                            @foreach (session()->get('akses')['app']['AKSES_INPUT'] as $k => $val)
                            @if ($val !== 'PLANT')
                            <a class="dropdown-item filter-map" data-val="{{ strtolower($val) }}" href="#">{{ $val
                                }}</a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="leaflet-bottom leaflet-right">
                <a href="javascript:void" class="location btn btn-info btn-circle btn-lg widget">
                    {{-- <i style="font-size: 25px;" class="fas fa-street-view"></i> --}}
                    <img src="assets/img/gps.png" width="35px" alt="">
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
                <div class="sourcing-detail d-none">
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Kategori</label><br>
                        <p id="kategoriText" class="" style="font-size: 100%; text-transform: capitalize;">Memuat...</p>
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
                        <label for="exampleInputPassword1">Jenis & Kapasitas Bahan</label>
                        <div class='table-responsive'>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Kapasitas</th>
                                    </tr>
                                </thead>
                                <tbody id="jenisBahanTable">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Penjualan Bahan Baku</label>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tempat Penj.</th>
                                    <th scope="col">Ket</th>
                                    <th scope="col">Proses Penj.</th>
                                    <th scope="col">Proses Pemb.</th>
                                </tr>
                            </thead>
                            <tbody id="penjualanBahanBakuTable">
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Kepemilikan Mesin</label>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Mesin</th>
                                    <th scope="col">Kepemilikan</th>
                                    <th scope="col">Qty</th>
                                </tr>
                            </thead>
                            <tbody id="mesinTable">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="loco-detail d-none">
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Alamat</label>
                        <p id="alamatText2" class="font-weight-bold">Memuat...</p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Tonase Per Bulan (Ton)</label>
                        <p id="tonaseText" class="font-weight-bold">Memuat...</p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Jumlah Pengiriman Per Bulan</label>
                        <p id="jmlPengirimanText" class="font-weight-bold">Memuat...</p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Ekspedisi</label>
                        <p id="ekspedisiText" class="font-weight-bold" style="text-transform: capitalize;">
                            Memuat...
                        </p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Jenis Kendaraan Pengiriman</label>
                        <p id="jenisKendaraanText" class="font-weight-bold" style="text-transform: capitalize;">
                            Memuat...
                        </p>
                    </div>
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Jarak Dari Plant</label>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Plant</th>
                                    <th scope="col">Jarak</th>
                                </tr>
                            </thead>
                            <tbody id="jarakTable">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="plant-detail d-none">
                    <div class="form-group border-bottom">
                        <label for="exampleInputPassword1">Alamat</label>
                        <p id="alamatText3" class="font-weight-bold">Memuat...</p>
                    </div>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Foto</label>
                    <div class="row image-gallery">
                    </div>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Latitude</label>
                    <p id="latText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">Longitude</label>
                    <p id="lngText" class="font-weight-bold">Memuat...</p>
                </div>
                <div class="form-group border-bottom">
                    <label for="exampleInputPassword1">User Input</label>
                    <p id="userText" class="font-weight-bold">Memuat...</p>
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

<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="mapid2" style="height: 580px !important; ">

                </div>
                <div class="leaflet-bottom leaflet-right">
                    {{-- <a href="javascript:void(0)" class="location2 btn btn-danger btn-circle btn-lg">
                        <img src="assets/img/gps.png" width="35px" alt="">
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    @push('script')

    var mymap2 = L.map('mapid2', {
        zoomControl: false,
        maxBoundsViscosity: 1.0
    }).setView([-1, 117], 5);
    if ($(window).width() >= 993) {
        L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            tileSize: 512,
            zoomOffset: -1,
            noWrap: true
        }).addTo(mymap2);
    } else {
        L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=' + key, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            noWrap: true
            //tileSize: 512,
            //zoomOffset: -1,
        }).addTo(mymap2);
    }
    mymap2.setMaxBounds([[-90,-180],[90,180]])

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

    function markerPopup(id, status){
        marker.eachLayer(function(layer) {
            if (layer._leaflet_id == id){
                if(status){
                    layer.openPopup();
                } else {
                    layer.closePopup();
                }
            };
        });
    }

    function markerOnHover(e) {
        markerPopup(this._leaflet_id, true)
    }

    function markerOnOut(e) {
        markerPopup(this._leaflet_id, false)
    }

    function mapMarker(data, show) {
        mymap.removeLayer(marker);
        marker = L.layerGroup().addTo(mymap);
        var loc;
        var icon;
        var htmlIcon;
        var label = '';
        var popUp;
        var classJenis;
        var arrayKodePlant;
        var arrayJarak;
        var defaultSize = 25;
        var maxWidthMarker = 80;
        var range = maxWidthMarker - defaultSize;
        var innerSize;
        for (var i = 0; i < data.length; i++) {
            //var icon = data[i].MARKER == 'red' ? locoIcon : ( data[i].MARKER == 'blue' ? blueIcon : ( data[i].MARKER == 'green' ? greenIcon : ( data[i].MARKER == 'yellow' ? yellowIcon : blackIcon)))
            label = data[i].URUT === null ? '' : data[i].URUT;
            popUp = `<b>${data[i].NAMA_USAHA}</b>`
            if(data[i].JENIS !== 'PLANT') {

                classJenis = data[i].JENIS.toLowerCase();
                var size = defaultSize;
                var halfSize;
                var sizeHeight;

                if(data[i].JENIS !== 'SOURCING') {
                    var jarakText = '';
                    var jmlPengiriman = (data[i].JUMLAH_PENGIRIMAN !== undefined) ? data[i].JUMLAH_PENGIRIMAN : 0;
                    var maxPengiriman = data[i].MAX_KIRIM;
                    var persenPengiriman = (jmlPengiriman / maxPengiriman); 
                    size = (range * persenPengiriman) + defaultSize;
                    //size = size < 25 ? 25 : (size > 80 ? 80 : size);

                    if(data[i].KODE_PLANT && data[i].JARAK) {
                        arrayKodePlant = data[i].KODE_PLANT.split("|");
                        arrayJarak = data[i].JARAK.split("|");
                        for(var j = 0; j < arrayKodePlant.length; j++) {
                            jarakText += `<br><b>Jarak dari ${arrayKodePlant[j]}:</b>&nbsp;${arrayJarak[j]} Km`
                        }
                    }
                    popUp += ` (${data[i].JUMLAH_PENGIRIMAN})`
                    popUp += jarakText
                }

                halfSize = size / 2;
                sizeHeight = size - 3;
                if(data[i].EKSPEDISI === 0) {
                    htmlIcon = `<div class="custom-marker ${classJenis}-marker" style="width: ${size}px; height: ${size}px; line-height: ${sizeHeight}px;"> ${label} </div>`;
                } else {
                    innerSize = size * 0.65;
                    sizeHeight = innerSize;
                    htmlIcon = `<div class="custom-marker outer-marker" style="width: ${size}px; height: ${size}px; display: flex; justify-content: center; align-items: center">
                        <div class="custom-marker inner-marker" style="width: ${innerSize}px; height: ${innerSize}px; line-height: ${sizeHeight}px;">
                            ${label}
                        </div>
                    </div>`;
                }
                

                icon = L.divIcon({
                    className: '',
                    html: htmlIcon,
                    iconSize: [halfSize, halfSize], // classSize of the icon,
                    iconAnchor: [halfSize, halfSize], // point of the icon which will correspond to marker's location,
                    popupAnchor: [0, -halfSize] // point from which the popup should open relative to the iconAnchor
                });
            } else {
                if(data[i].KATEGORI === 'ERI') {
                    icon = blueIcon;
                } else if(data[i].KATEGORI === 'ETR') {
                    icon = greenIcon;
                } else if(data[i].KATEGORI === 'ERA') {
                    icon = redIcon;
                } else {
                    icon = blackIcon;
                }
            }

            loc = L.marker([data[i].LAT, data[i].LNG], {
                icon: icon,
                URUT: data[i].URUT,
                ID_TEMPAT: data[i].ID_TEMPAT,
                JENIS: data[i].JENIS,
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
                TONASE: data[i].TONASE,
                JUMLAH_PENGIRIMAN: data[i].JUMLAH_PENGIRIMAN,
                EKSPEDISI: data[i].EKSPEDISI,
                LAT: data[i].LAT,
                LNG: data[i].LNG,
                USERNAME: data[i].USERNAME,
                MARKER: data[i].MARKER
            }).bindPopup(popUp).addTo(marker).on('click', markerOnClick).on('mouseover', markerOnHover).on('mouseout', markerOnOut);
            //marker.bindPopup(data[i].NAMA_USAHA);
            //L.marker([data[i].LAT, data[i].LNG]).addTo(results);
            if (show) {
                mymap.setView([data[0].LAT, data[0].LNG], 12);
                //marker.bindPopup('<b>Added! </b>' + data[i].place).openPopup();
            }
            L.DomUtil.addClass(loc._icon, `${data[i].ID_TEMPAT}`);

        }
        console.log(marker._layers);
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

    function clearMarker2(){
        // $(".leaflet-marker-icon").remove();
        // $(".leaflet-popup").remove();
        // $(".leaflet-marker-shadow").remove();
        if (manMarker != undefined) {
            mymap2.removeLayer(manMarker);
        }
        if (circle != undefined) {
            mymap2.removeLayer(circle);
        }
        if (newMarker != undefined) {
            mymap2.removeLayer(newMarker);
        }
        if (foundMarker != undefined) {
            mymap2.removeLayer(foundMarker);
        }
    }
        
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
                if(response[0].AKSI == 'tambah'){ // Jika aksinya tambah 
                    mapMarker(response, true); // tambahkan 1 marker
                } else { // jika update
                    if($('#id_marker').val().length > 0){ // jika id marker memiliki value
                        marker.removeLayer($('#id_marker').val()); // remove marker berdasarkan id
                        if(response[0].LAT.length !== 0 && response[0].LAT.length !== 0){ // jika respon empty false (ada data lat dan lng)
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

    // $(document).on('click', '.btnConfirm', function () {
    //     $('#addMarkerModal').modal('show');
    //     $('html').css('cursor', 'alias');
    //     $('html').css('pointer-events', 'auto');
    //     $('#mapid').css('cursor', 'alias');
    //     $('.widget').attr('style', 'pointer-events: auto !important; cursor : alias;');
    //     sessionStorage.removeItem("clickOnMap")
    // });

    // $(document).on('click', '#addFromMap', function() {
    //     $('#addMarkerModal').modal('hide');
    //     $('html').css('cursor', 'not-allowed');
    //     $('html').css('pointer-events', 'none');
    //     $('.widget').attr('style', 'pointer-events: none !important; cursor : now-allowed;');
    //     $('#mapid').css('cursor', 'crosshair');
    //     $('#mapid').css('pointer-events', 'auto');
    //     $(".jarak").val('');
    //     sessionStorage.setItem("clickOnMap", 1);
    // })

    $('#mapModal').on('shown.bs.modal', function(){
        setTimeout(function() {
            mymap2.invalidateSize();
        }, 10);
    });

    $('#mapModal').on('hidden.bs.modal', function() {
        $('#content-wrapper').css('cursor', 'alias');
        $('#content-wrapper').css('pointer-events', 'auto');
        $('#mapid2').css('cursor', 'alias');
        sessionStorage.removeItem("clickOnMap")
    })

    $(document).on('click', '#addFromMap', function() {
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
        $('#mapModal').modal('show');
        $('#content-wrapper').css('cursor', 'not-allowed');
        $('#content-wrapper').css('pointer-events', 'none');
        $('#mapid2').css('cursor', 'crosshair');
        $('.location2').show();
        $(".jarak").val('');
        sessionStorage.setItem("clickOnMap", 1);
    })

    $(document).on('click', '.btnConfirm', function () {
        $('#mapModal').modal('hide');
    });

    $(document).on('click', '.filter-map', function() {
        var val = $(this).attr('data-val');
        $('.dropdown-item').removeClass('active');
        $(this).addClass('active');
        $('.custom-marker').removeClass('d-none');
        if(val !== 'all') {
            $('.custom-marker').addClass('d-none');
            $(`.${val}-marker`).removeClass('d-none');
        }
    });

    mymap2.on('click', function (e) {

        if (manMarker != undefined) {
            mymap2.removeLayer(manMarker);
        }
        if (circle != undefined) {
            mymap2.removeLayer(circle);
        }
        if (newMarker != undefined) {
            mymap2.removeLayer(newMarker);
        }
        if (foundMarker != undefined) {
            mymap2.removeLayer(foundMarker);
        }

        if(sessionStorage["clickOnMap"]) {

            newMarker = L.marker(e.latlng, {
                    icon: foundIcon,
                    draggable: true
            }).addTo(mymap2);

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

    $("#search").select2({
        placeholder: "Pilih/Ketik Nama Pengguna",
        allowClear: true,
        //tags: true,
        ajax: { 
          url: "{{ route('getFilterCoord') }}",
          type: "get",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              searchTerm: params.term // search term
            };
          },
          processResults: function (response) {
            return {
                results: response
            };
          },
          cache: true
        }
    });

    $("#search").on('change', function(e) {
        e.preventDefault();
        var objLocation = $(this).val();
        var lat, lng;
        objLocation = objLocation.split('|');
        lat = objLocation[1];
        lng = objLocation[2];

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

        foundMarker = L.marker([lat, lng], {
                        icon: foundIcon,
                        opacity: 0
                    }).addTo(mymap);

        mymap.setView([lat, lng], 18);

        if (foundMarker != undefined) {
            mymap.removeLayer(foundMarker);
        }
    })

@endpush
</script>