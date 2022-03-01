
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
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-primary d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            {{-- Filter Search --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Filter Data</h5>
                </div>
                <form id="filterForm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <select name="f_kategori" style="width: 100%;" data-placeholder="Pilih kategori" id="f_kategori" class="form-control select2">
                                    <option value=""></option>
                                    <option value="supplier">Supplier</option>
                                    <option value="non supplier">Non Supplier</option>
                                    <option value="kompetitor">Kompetitor</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="f_tgl_dari" id="f_tgl_dari" placeholder="Tanggal kunjungan dari" class="form-control datepicker">
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="f_tgl_sampai" id="f_tgl_sampai" placeholder="Tanggal kunjungan sampai" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <select name="f_lokasi" style="width: 100%;" data-placeholder="Pilih status lokasi" id="f_lokasi" class="form-control select2">
                                    <option value=""></option>
                                    <option value="1">Sudah Input</option>
                                    <option value="0">Belum Input</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <select name="f_jenis_usaha" style="width: 100%;" data-placeholder="Pilih jenis usaha" id="f_jenis_usaha" class="form-control select2">
                                    <option value=""></option>
                                    @foreach ($jenis_usaha as $row)
                                        <option value="{{ strtolower($row->JENIS_USAHA)}}">{{ $row->JENIS_USAHA }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="keyword" autocomplete="off" id="keyword" placeholder="Ketikkan keyword disini" class="form-control">
                            </div>
                        </div>
                        <div class="float-right mb-4">
                            <input type="hidden" id="jenis" value="{{ request()->input('i') }}">
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                            <a href="javascript:void(0)" id="refresh" class="btn btn-secondary btn-sm">Refresh</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar lokasi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="coordDataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Usaha</th>
                                    <th>Lokasi</th>
                                    <th>Kategori</th>
                                    <th>Jenis Usaha</th>
                                    <th>CP</th>
                                    <th>Telp</th>
                                    <th>Tgl Kunjungan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<a href="javascript:void" data-toggle="modal" data-target="#addMarkerModal"
    class="add btn btn-success btn-circle btn-lg">
    <i style="font-size: 25px;" class="fas fa-plus"></i>
</a>
@endsection

@section('modal')
<div class="modal fade" id="detailMarkerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                        <label for="exampleInputPassword1">Jenis Kendaraan Pengiriman</label>
                        <p id="jenisKendaraanText" class="font-weight-bold" style="text-transform: capitalize;">Memuat...
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
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Tutup</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="mapid" style="height: 580px !important; ">

                </div>
                <div class="leaflet-bottom leaflet-right">
                    <a href="javascript:void(0)" class="location2 btn btn-danger btn-circle btn-lg">
                        <img src="assets/img/gps.png" width="35px" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>    
@push('script')

    // ============================================= MAP ===========================================//

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
                '<div class="text-center mt-1"><button class="btn btn-xs btn-success btnConfirm">Pilih lokasi ini</button></div>'
            ).openPopup();
        circle = L.circle(e.latlng, radius, {
            color: 'red',
            opacity: 0.1
        }).addTo(mymap);
        //$('#place').val('');
        $('#lat').val(e.latlng.lat)
        $('#lng').val(e.latlng.lng)
        $('#overlay').delay(100).fadeOut();
    }

    function mapMarker(data, show) {
        //var icon = data.MARKER == 'red' ? redIcon : ( data.MARKER == 'blue' ? blueIcon : ( data.MARKER == 'green' ? greenIcon : ( data.MARKER == 'yellow' ? yellowIcon : blackIcon)))
        var icon;
        var label = '';
        var popUp;
        var classJenis;
        var arrayKodePlant;
        var arrayJarak;
        label = data.URUT === null ? '' : data.URUT;
        popUp = `<b>${data.NAMA_USAHA}</b>`
        if(data.JENIS !== 'PLANT') {
            var halfSize;
            var size = 30;
            var sizeHeight;
            var jarakText = '';
            var jmlPengiriman = (data.JUMLAH_PENGIRIMAN !== undefined) ? data.JUMLAH_PENGIRIMAN : 0;
            classJenis = data.JENIS.toLowerCase();
            size += parseInt(jmlPengiriman);
            console.log(size);
            size = size > 80 ? 80 : size;

            if(data.JENIS !== 'SOURCING') {
                if(data.KODE_PLANT && data.JARAK) {
                    arrayKodePlant = data.KODE_PLANT.split("|");
                    arrayJarak = data.JARAK.split("|");
                    for(var j = 0; j < arrayKodePlant.length; j++) {
                        jarakText += `<br><b>Jarak dari ${arrayKodePlant[j]}:</b>&nbsp;${arrayJarak[j]} Km`
                    }
                }
                popUp += jarakText
            }

            halfSize = size / 2;
            sizeHeight = size - 3;
            icon = L.divIcon({
                className: '',
                html: `<div class="custom-marker ${classJenis}-marker" style="width: ${size}px; height: ${size}px; line-height: ${sizeHeight}px;">${label}</div>`,
                iconSize: [halfSize, halfSize], // classSize of the icon,
                iconAnchor: [halfSize, halfSize], // point of the icon which will correspond to marker's location,
                popupAnchor: [0, -halfSize] // point from which the popup should open relative to the iconAnchor
            });
        } else {
            if(data.KATEGORI === 'ERI') {
                icon = blueIcon;
            } else if(data.KATEGORI === 'ETR') {
                icon = greenIcon;
            } else if(data.KATEGORI === 'ERA') {
                icon = redIcon;
            } else {
                icon = blackIcon;
            }
        }
        L.marker([data.LAT, data.LNG], {
            icon: icon,
            place: data.NAMA_USAHA
        }).addTo(marker).bindPopup(popUp);
        //L.marker([data.LAT, data.LNG]).addTo(results);
        if (show) {
            mymap.setView([data.LAT, data.LNG], 18);
            //marker.bindPopup('<b>Added! </b>' + data.place).openPopup();
        }
    }

    $('#mapModal').on('shown.bs.modal', function(){
        setTimeout(function() {
            mymap.invalidateSize();
        }, 10);
    });

    $('#mapModal').on('hidden.bs.modal', function() {
        clearMarker();
        $('#content-wrapper').css('cursor', 'alias');
        $('#content-wrapper').css('pointer-events', 'auto');
        $('#mapid').css('cursor', 'alias');
        sessionStorage.removeItem("clickOnMap")
    })

    $(document).on('click', '#addFromMap', function() {
        $('#mapModal').modal('show');
        $('#content-wrapper').css('cursor', 'not-allowed');
        $('#content-wrapper').css('pointer-events', 'none');
        $('#mapid').css('cursor', 'crosshair');
        $('.location2').show();
        $(".jarak").val('');
        sessionStorage.setItem("clickOnMap", 1);
    })

    $('.location2').on('click', function () {
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

    $(document).on('click', '.btnView', function(e){
        //e.preventDefault();
        var id = $(this).attr('data-id');
        $('.location2').hide();
        $.ajax({
            url: "{{ route('getDetailCoord') }}",
            data: {
                "_token": csrf,
                "id": id
            },
            success: function(data){
                $('#mapModal').modal('show');
                mapMarker(data.tempat, true)
            }
        });
    })

    $(document).on('click', '.btnConfirm', function () {
        $('#mapModal').modal('hide');
    });

    $("#formCoord").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
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
                $('#refresh').trigger('click');
                
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

    $(document).on({
        mouseenter: function () {
            var jenis = $(this).attr('data-jenis');
            console.log(jenis)
            $('input[name="jenis"][value="' + jenis + '"]').prop("checked", true).change()
        },
        // mouseleave: function () {
        //     //stuff to do on mouse leave
        // }
    }, '.btnEdit')

    // $(document).on('mouseover', '.btnEdit', function(e) {
    //     var jenis = $(this).attr('data-jenis');
    //     mouseenter: function () {
    //         $('input[name="jenis"][value="' + jenis + '"]').prop("checked", true).change()
    //     }
    //     // mouseleave: function () {
    //     //     $('input[name="jenis"][value="' + jenis + '"]').prop("checked", false).change()
    //     // }
    // })

    // Edit Section
    $(document).on('click', '.btnEdit', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        //console.log(id)
        //var id_marker = $(this).attr('data-marker');
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
                //$('input[name="jenis"][value="' + data.tempat.JENIS + '"]').prop("checked", true).change()
                $('.jenis:not(:checked)').attr('disabled', true);

                $('#nama_usaha').val(data.tempat.NAMA_USAHA);
                $('#alamat').val(data.tempat.ALAMAT);
                if(data.tempat.JENIS == 'SOURCING') {
                    $('input[name="kategori"][value="' + data.tempat.KATEGORI + '"]').prop("checked", true);
                    $('#tgl_kunjungan').val(moment(data.tempat.TANGGAL_KUNJUNGAN).format('DD-MM-YYYY'));
                    $('#cp').val(data.tempat.CP);
                    $('#telepon').val(data.tempat.TELEPON);
                    $('input[name="status_tempat"][value="' + data.tempat.STATUS_USAHA + '"]').prop("checked", true);
                    $('#jml_pekerja').val(data.tempat.JUMLAH_PEKERJA);
                    $('input[name="proses_penjualan"][value="' + data.tempat.PROSES_PENJUALAN + '"]').prop("checked", true);
                    $('#proses_pembayaran').val(data.tempat.PROSES_PEMBAYARAN).change();

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
                } else if(data.tempat.JENIS === 'LOCO' || data.tempat.JENIS === 'ETERLENE') {
                    $('#urut').val(data.tempat.URUT);
                    $('#tonase').val(data.tempat.TONASE);
                    $('#jumlah_pengiriman').val(data.tempat.JUMLAH_PENGIRIMAN);
                    $('#ekspedisi').val(data.tempat.EKSPEDISI).change();
                    //$('#plant_terdekat').val(data.tempat.PLANT_TERDEKAT).change();
                    //$('#jarak').val(data.tempat.JARAK_METER);

                    var jenis_kendaraan = [];
                    for(var i = 0; i < data.jenis_kendaraan.length; i++) {
                        jenis_kendaraan.push(data.jenis_kendaraan[i].JENIS_KENDARAAN);
                    }

                    $('#jenis_kendaraan').val(jenis_kendaraan).change();

                    $('#cJarak').html('');
                    for(var i = 0; i < data.jarak.length; i++) {
                        var margin = i == 0 ? '' : ' mt-3 mt-md-0';
                        var kode_plant = data.jarak[i].KODE_PLANT;
                        var plant = data.jarak[i].PLANT;
                        var jarak = data.jarak[i].JARAK;
                        var lat = data.jarak[i].LAT;
                        var lng = data.jarak[i].LNG;

                        $('#cJarak').append(`<div class="row ${margin}"><div class="col-md-6 mb-2 mb-md-3">
                            <input type="text" name="plant_nama[]" value="${plant}" class="form-control readonly" required  readonly placeholder="Plant">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control jarak decimal" placeholder="Jarak (Km)"
                                id="jarak${kode_plant}" value="${jarak}" name="jarak[]">
                        </div>
                        <input type="hidden" data-lat="${lat}" data-lng="${lng}" class="plants" id="plant${kode_plant}" name="plant[]" value="${kode_plant}"></div>`);

                        $('.c-plant[value="' + data.jarak[i].KODE_PLANT + '"]').prop('checked', true).change();
                        $('.c-plant-jarak[data-value="' + data.jarak[i].KODE_PLANT  + '"]').val(data.jarak[i].JARAK);
                    }

                }
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

                $('#addMarkerModal').modal('show');
            }
        });
    })

    $(document).on('click', '.btnDelete', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
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
                        Swal.fire(
                            'Berhasil!',
                            'Lokasi berhasil dihapus',
                            'success'
                        )
                        $('#refresh').trigger('click');
                    }
                });
            }
        })
    });

    $(document).on('click', '.btnDetail', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        //console.log(id);
        $.ajax({
            url: "{{ route('getDetailCoord') }}",
            data: {
                "_token": csrf,
                "id": id
            },
            success: function (data) {
                // var badge = data.tempat.MARKER == 'green' ? 'font-weight-bold badge badge-success' : (data.tempat.MARKER == 'red' ? 'font-weight-bold badge badge-danger' : (data.tempat.MARKER == 'yellow' ? 'font-weight-bold badge badge-warning' : (data.tempat.MARKER == 'blue' ? 'font-weight-bold badge badge-primary' : 'font-weight-bold badge badge-secondary')))
                var badge =data.tempat.KATEGORI == 'supplier' ? 'font-weight-bold badge badge-success' : (data.tempat.KATEGORI == 'kompetitor' ? 'font-weight-bold badge badge-danger' : (data.tempat.KATEGORI == 'non supplier' ? 'font-weight-bold badge badge-warning' : 'font-weight-bold badge badge-secondary'))
                $("#placeName").html(data.tempat.NAMA_USAHA);
                var lat = data.tempat.LAT == null ? '-' : data.tempat.LAT;
                var lng = data.tempat.LNG == null ? '-' : data.tempat.LNG;
                $("#latText").html(lat)
                $("#lngText").html(lng)
                $("#userText").html(data.tempat.USERNAME)

                
                if(data.tempat.JENIS === 'SOURCING') {
                    $('.sourcing-detail').removeClass('d-none');
                    $('.loco-detail').addClass('d-none');
                    $('.plant-detail').addClass('d-none');
                    $('#kategoriText').html(data.tempat.KATEGORI);
                    $('#kategoriText').removeClass();
                    $('#kategoriText').addClass(badge);
                    $('#tglKunjunganText').html(moment(data.tempat.TANGGAL_KUNJUNGAN).format('DD-MM-YYYY'));
                    $('#cpText').html(data.tempat.CP);
                    $('#teleponText').html(data.tempat.TELEPON);
                    $('#alamatText').html(data.tempat.ALAMAT);
                    $('#statusTempatText').html(data.tempat.STATUS_USAHA);
                    $('#jmlPekerjaText').html(data.tempat.JUMLAH_PEKERJA);

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
                } else if(data.tempat.JENIS === 'LOCO' || data.tempat.JENIS === 'ETERLENE') {
                    $('.sourcing-detail').addClass('d-none');
                    $('.plant-detail').addClass('d-none');
                    $('.loco-detail').removeClass('d-none');
                    $('#alamatText2').html(data.tempat.ALAMAT);
                    $('#tonaseText').html(data.tempat.TONASE);
                    $('#jmlPengirimanText').html(data.tempat.JUMLAH_PENGIRIMAN);

                    //Jenis Kendaraan
                    var jenis_kendaraan ='';
                    for(var i = 0; i < data.jenis_kendaraan.length; i++) {
                        jenis_kendaraan += '- ' + data.jenis_kendaraan[i].JENIS_KENDARAAN + '<br>'
                    }

                    $('#jenisKendaraanText').html(jenis_kendaraan);

                    var jarak ='';
                    for(var i = 0; i < data.jarak.length; i++) {
                        jarak += '<tr><td style="text-transform: capitalize;">' + data.jarak[i].KODE_PLANT +'</td><td>' + data.jarak[i].JARAK +' Km</td></tr>'
                    }
                    $('#jarakTable').html(jarak);
                } else {
                    $('.sourcing-detail').addClass('d-none');
                    $('.plant-detail').removeClass('d-none');
                    $('.loco-detail').addClass('d-none');
                    $("#btnEdit").addClass("disabled")
                    $("#btnHapus").addClass("disabled")
                    $('#alamatText3').html(data.tempat.ALAMAT);
                }

                //Image Handle
                var img = '';
                //var storage = '{{ asset('storage/images/') }}';
                if(data.image.length > 0){
                    for (var i = 0; i < data.image.length; i++) {
                        img += '<div class="col-4 mb-3"><a href="upload/img/' + data.image[i].GAMBAR + '" class="image-link"><img src="upload/img/thumbnail/' + data.image[i].GAMBAR + '" style="width:150px; height:100px; object-fit:cover; border-radius: 10px;" class="img-fluid" alt=""></a></div>'
                    }
                    $('.image-gallery').html(img);
                } else {
                    img += '<div class="col-4 mb-3"><a href="https://info.solokkota.go.id/uploads/No_Image_Available.jpg" class="image-link"><img src="https://info.solokkota.go.id/uploads/No_Image_Available.jpg" style="width:150px; height:100px; object-fit:cover; border-radius: 10px;" class="img-fluid" alt=""></a></div>';
                    $('.image-gallery').html(img);
                }
            }
        });
        $("#detailMarkerModal").modal('show');
    });

    var oTable = $('#coordDataTable').DataTable({
        processing: true,
        serverSide: true,
        stateSave : true,
        //searching: true,
        ajax: {
            url: "{{ route('getFilterRecord') }}",
            data: function (d) {
                d.JENIS_INPUT = $('#jenis').val(),
                d.KATEGORI = $('#f_kategori').val(),
                d.TGL_DARI = $('#f_tgl_dari').val(),
                d.TGL_SAMPAI = $('#f_tgl_sampai').val(),
                d.LOKASI = $('#f_lokasi').val(),
                d.JENIS = $('#f_jenis_usaha').val(),
                d.KEYWORD = $('#keyword').val()
            }
        },
        columns: [
            { 
                data: 'DT_RowIndex', 
                name: 'DT_RowIndex' },
            {
                data: 'NAMA_USAHA',
                name: 'NAMA_USAHA'
            },
            {
                data: 'LOKASI',
                name: 'LOKASI'
            },
            {
                data: 'KATEGORI',
                name: 'KATEGORI'
            },
            {
                data: 'JENIS_USAHA',
                name: 'JENIS_USAHA'
            },
            
            {
                data: 'CP',
                name: 'CP'
            },
            {
                data: 'TELEPON',
                name: 'TELEPON'
            },
            {
                data: 'TANGGAL_KUNJUNGAN',
                name: 'TANGGAL_KUNJUNGAN'
            },
            {
                data: 'AKSI',
                name: 'AKSI'
            }
        ],
        order: [[7, 'desc']],
        columnDefs: [
            { orderable: false, targets: [0, 4, 8] }
        ],
    });

    $('#filterForm').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });

    $('#refresh').on('click', function(e) {
        $('#filterForm')[0].reset();
        $('.select2').val('').change()
        oTable.draw();
        e.preventDefault();
    });
@endpush
</script>


