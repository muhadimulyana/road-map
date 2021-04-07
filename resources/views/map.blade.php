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
                    <a id="sidebarToggleTop" href="javascript:void(0)" class="menu-btn btn btn-primary btn-circle widget text-white mt-3 ml-3" style="pointer-events: auto;">
                        <i style="font-size: 15px;" class="fa fa-bars"></i>
                    </a>
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
@endsection

<script>
@push('script')

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
        for (var i = 0; i < data.length; i++) {
            var icon = data[i].MARKER == 'red' ? redIcon : ( data[i].MARKER == 'blue' ? blueIcon : ( data[i].MARKER == 'green' ? greenIcon : ( data[i].MARKER == 'yellow' ? yellowIcon : blackIcon)))
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
                LNG: data[i].LNG,
                USERNAME: data[i].USERNAME,
                MARKER: data[i].MARKER
            }).bindPopup(data[i].NAMA_USAHA).addTo(marker).on('click', markerOnClick).on('mouseover', markerOnHover).on('mouseout', markerOnOut);
            //marker.bindPopup(data[i].NAMA_USAHA);
            //L.marker([data[i].LAT, data[i].LNG]).addTo(results);
            if (show) {
                mymap.setView([data[i].LAT, data[i].LNG], 18);
                //marker.bindPopup('<b>Added! </b>' + data[i].place).openPopup();
            } else {
                //marker.bindPopup(data[i].place);
            }
        }
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

@endpush
</script>