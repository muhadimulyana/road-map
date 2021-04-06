
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
            <div class="modal-body" style="height: 70vh; overflow-y: auto;">
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
                        <i style="font-size: 25px;" class="fas fa-street-view"></i>
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
        var icon = data.MARKER == 'red' ? redIcon : ( data.MARKER == 'blue' ? blueIcon : ( data.MARKER == 'green' ? greenIcon : ( data.MARKER == 'yellow' ? yellowIcon : blackIcon)))
        L.marker([data.LAT, data.LNG], {
            icon: icon,
            place: data.NAMA_USAHA
        }).addTo(marker).bindPopup(data.NAMA_USAHA);
        //L.marker([data.LAT, data[i].LNG]).addTo(results);
        if (show) {
            mymap.setView([data.LAT, data.LNG], 18);
            //marker.bindPopup('<b>Added! </b>' + data[i].place).openPopup();
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

    $('#addFromMap').on('click', function() {
        $('#mapModal').modal('show');
        $('#content-wrapper').css('cursor', 'not-allowed');
        $('#content-wrapper').css('pointer-events', 'none');
        $('#mapid').css('cursor', 'crosshair');
        $('.location2').show();
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
                var badge = data.tempat.MARKER == 'green' ? 'font-weight-bold badge badge-success' : (data.tempat.MARKER == 'red' ? 'font-weight-bold badge badge-danger' : (data.tempat.MARKER == 'yellow' ? 'font-weight-bold badge badge-warning' : (data.tempat.MARKER == 'blue' ? 'font-weight-bold badge badge-primary' : 'font-weight-bold badge badge-secondary')))
                $("#placeName").html(data.tempat.NAMA_USAHA);
                $('#kategoriText').html(data.tempat.KATEGORI);
                $('#kategoriText').removeClass();
                $('#kategoriText').addClass(badge);
                $('#tglKunjunganText').html(moment(data.tempat.TANGGAL_KUNJUNGAN).format('DD-MM-YYYY'));
                $('#cpText').html(data.tempat.CP);
                $('#teleponText').html(data.tempat.TELEPON);
                $('#alamatText').html(data.tempat.ALAMAT);
                $('#statusTempatText').html(data.tempat.STATUS_USAHA);
                $('#jmlPekerjaText').html(data.tempat.JUMLAH_PEKERJA);
                var lat = data.tempat.LAT == null ? '-' : data.tempat.LAT;
                var lng = data.tempat.LNG == null ? '-' : data.tempat.LNG;
                $("#latText").html(lat)
                $("#lngText").html(lng)
                $("#userText").html(data.tempat.USERNAME)
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
        //searching: true,
        ajax: {
            url: "{{ route('getFilterRecord') }}",
            data: function (d) {
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

<script>
        // $('#overlay').delay(100).fadeOut();
        // var csrf = $('meta[name="csrf-token"]').attr('content');
        // var key = $('meta[name="key-api"]').attr('content');
        // $('.select2').select2({
        //     allowClear: true
        // });
        // $('.datepicker').bootstrapMaterialDatePicker({
        //     time: false,
        //     format: 'DD-MM-YYYY'
        // });

        // $(document).on('keydown paste focus mousedown', '.readonly', function(e){
        //     if(e.keyCode != 9) // ignore tab
        //         e.preventDefault();
        // });

        // $(".numeric").on("keypress keyup blur",function (event) {
        //     $(this).val($(this).val().replace(/[^\d].+/, ""));
        //     if ((event.which < 48 || event.which > 57)) {
        //         event.preventDefault();
        //     }
        // });

        // $('body').magnificPopup({
        //     delegate: 'a.image-link',
        //     type: 'image',
        //     gallery: {
        //         enabled: true
        //     },
        //     zoom: {
        //         enabled: true, // By default it's false, so don't forget to enable it
        //         duration: 300, // duration of the effect, in milliseconds
        //         easing: 'ease-in-out', // CSS transition easing function
        //         opener: function (openerElement) {
        //             return openerElement.is('img') ? openerElement : openerElement.find(
        //                 'img');
        //         }
        //     }
        // });

        // // Validasi Checkbox pada jenis usaha
        // var rCheckBox = $(':checkbox[required]');
        // rCheckBox.change(function(){
        //     if(rCheckBox.is(':checked')) {
        //         rCheckBox.removeAttr('required');
        //     }
        //     else {
        //         rCheckBox.attr('required', 'required');
        //     }
        // });

        // // Modal 2
        // $('.modal-child').on('show.bs.modal', function () {
        //     var modalParent = $(this).attr('data-modal-parent');
        //     $(modalParent).css('opacity', 0);
        // });
        
        // $('.modal-child').on('hidden.bs.modal', function () {
        //     var modalParent = $(this).attr('data-modal-parent');
        //     $(modalParent).css('opacity', 1);
        // });

        // // Modal Bahan Baku
        // $('.c-bahan-baku').on('change', function(e) {
        //     var id = $(this).attr('data-id');
        //     if($(this).is(':checked')) {
        //         $('#c_bahan_baku_kg' + id).prop('readonly', false)
        //     } else {
        //         $('#c_bahan_baku_kg' + id).prop('readonly', true);
        //         $('#c_bahan_baku_kg' + id).val('');
        //     }
        // })

        // // CheckAll checkbox
        // $("#checkAllBahan").change(function(){ // Ketika user men-cek checkbox all      
        // if($(this).is(":checked")) // Jika checkbox all diceklis
        //     $(".c-bahan-baku").prop("checked", true).change(); // ceklis semua checkbox siswa dengan class "c-bahan-baku"
        // else // Jika checkbox all tidak diceklis
        //     $(".c-bahan-baku").prop("checked", false).change(); // un-ceklis semua checkbox siswa dengan class "c-bahan-baku"
        // });

        
        // //Foreach c bahan baku
        // $('#okBahanBaku').on('click', function(e) {
        //     var cekBahanBaku = $('.c-bahan-baku:checked').length
        //     $('#cBahanBaku').html('');
        //     if(cekBahanBaku > 0) {
        //         $('.c-bahan-baku:checked').each(function(i, obj) {
        //             var margin = i == 0 ? '' : ' mt-3';
        //             var value = $(obj).val();
        //             var id = $(obj).attr('data-id');
        //             var value_kg = !$('#c_bahan_baku_kg' + id).val() ? '0' : $('#c_bahan_baku_kg' + id).val() ;
        //             $('#cBahanBaku').append('<div class="row' + margin + '"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" value="' + value + '" placeholder="Jenis bahan baku" required name="bahan_baku[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)" value="' + value_kg + '" required name="bahan_baku_kg[]"></div></div>');
        //         });
        //     } else {
        //         $('#cBahanBaku').append('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Jenis bahan baku" required name="bahan_baku[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)" required name="bahan_baku_kg[]"></div></div>');
        //     }
        //     $('#addBahanModal').modal('hide');
        // });

        // // Penjualan bahan baku
        // // Modal Bahan Baku
        // $('.c-penjualan-bahan').on('change', function(e) {
        //     var id = $(this).attr('data-id');
        //     if($(this).is(':checked')) {
        //         $('#c_penjualan_bahan_ket' + id).prop('readonly', false)
        //     } else {
        //         $('#c_penjualan_bahan_ket' + id).prop('readonly', true);
        //         $('#c_penjualan_bahan_ket' + id).val('');
        //     }
        // })

        // // CheckAll checkbox
        // $("#checkAllPenjualan").change(function(){ // Ketika user men-cek checkbox all      
        // if($(this).is(":checked")) // Jika checkbox all diceklis
        //     $(".c-penjualan-bahan").prop("checked", true).change(); // ceklis semua checkbox siswa dengan class "c-penjualan-bahan"
        // else // Jika checkbox all tidak diceklis
        //     $(".c-penjualan-bahan").prop("checked", false).change(); // un-ceklis semua checkbox siswa dengan class "c-penjualan-bahan"
        // });

        // //Foreach c bahan baku
        // $('#okPenjualanBahan').on('click', function(e) {
        //     var cekPenjualan = $('.c-penjualan-bahan:checked').length
        //     $('#cPenjualanBahan').html('');
        //     if(cekPenjualan > 0) {
        //         $('.c-penjualan-bahan:checked').each(function(i, obj) {
        //             var margin = i == 0 ? '' : ' mt-3';
        //             var value = $(obj).val();
        //             var id = $(obj).attr('data-id');
        //             var value_ket = $('#c_penjualan_bahan_ket' + id).val() ;
        //             $('#cPenjualanBahan').append('<div class="row' + margin + '"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" value="' + value + '" placeholder="Penjualan bahan baku" style="text-transform: capitalize;" required name="penjualan_bahan[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" value="' + value_ket + '" required name="penjualan_bahan_ket[]"></div></div>');
        //         });
        //     } else {
        //         $('#cPenjualanBahan').append('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Penjualan bahan baku" required id="bahan_baku" name="penjualan_bahan[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" required name="penjualan_bahan_ket[]"></div></div>');
        //     }
        //     $('#addPenjualanModal').modal('hide');
        // });

        // $('.c-mesin').on('change', function(e) {
        //     var id = $(this).attr('data-id');
        //     if($(this).is(':checked')) {
        //         $('#c_mesin_qty' + id).prop('readonly', false)
        //         $('#c_kepemilikan' + id).prop('disabled', false)
        //     } else {
        //         $('#c_mesin_qty' + id).prop('readonly', true);
        //         $('#c_kepemilikan' + id).prop('disabled', true)
        //         $('#c_kepemilikan' + id).val('').change();
        //         $('#c_mesin_qty' + id).val('');
        //     }
        // })

        // $("#checkAllMesin").change(function(){ // Ketika user men-cek checkbox all      
        //     if($(this).is(":checked")) // Jika checkbox all diceklis
        //         $(".c-mesin").prop("checked", true).change(); // ceklis semua checkbox siswa dengan class "c-mesin"
        //     else // Jika checkbox all tidak diceklis
        //         $(".c-mesin").prop("checked", false).change(); // un-ceklis semua checkbox siswa dengan class "c-mesin"
        // });

        // $('#okMesin').on('click', function(e) {
        //     var cekPenjualan = $('.c-mesin:checked').length
        //     $('#cMesin').html('');
        //     if(cekPenjualan > 0) {
        //         $('.c-mesin:checked').each(function(i, obj) {
        //             var margin = i == 0 ? '' : ' mt-3 mt-md-0';
        //             var value = $(obj).val();
        //             var id = $(obj).attr('data-id');
        //             var value_milik = $('#c_kepemilikan' + id).val();
        //             var value_qty = !$('#c_mesin_qty' + id).val() ? '0' : $('#c_mesin_qty' + id).val();
                    
        //             $('#cMesin').append('<div class="row ' + margin + '"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" style="text-transform: capitalize;" placeholder="Mesin" value="' + value + '" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" style="text-transform: capitalize;" value="' + value_milik + '" placeholder="Kepemilikan" style="text-transform: capitalize;" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" value="' + value_qty + '" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');
        //         });
        //     } else {
        //         $('#cMesin').append('<div class="row"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" placeholder="Mesin" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Kepemilikan" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');
        //     }
        //     $('#addMesinModal').modal('hide');
        // });

        // function clearFormAdd() {
        //     $("#formCoord")[0].reset();
        //     $("label.error").hide();
        //     $('.select2').val('').change();
        //     $('.d-bahan-baku').val('').change();
        //     $('.d-mesin').val('').change();
        //     $('.d-penjualan-bahan').val('').change();
        //     $('.kepemilikan').val('').change();
        //     $('.clone').remove();
        //     $('#addBahanForm')[0].reset();
        //     $('#checkAllBahan').prop('checked', false).change();
        //     $('#addPenjualanForm')[0].reset();
        //     $('#checkAllPenjualan').prop('checked', false).change();
        //     $('#addMesinForm')[0].reset();
        //     $('#checkAllMesin').prop('checked', false).change();
        //     $('.c-kepemilikan').val('').change();
        //     $('#cBahanBaku').html('');
        //     $('#cPenjualanBahan').html('');
        //     $('#cMesin').html('');
        //     $('#cBahanBaku').html('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Jenis bahan baku" required name="bahan_baku[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Kapasitas (KG/Bulan)" required name="bahan_baku_kg[]"></div></div>');
        //     $('#cPenjualanBahan').html('<div class="row"><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Penjualan bahan baku" required name="penjualan_bahan[]"></div><div class="col-md-7"><input type="text" class="form-control readonly" placeholder="Keterangan penjualan bahan baku" required name="penjualan_bahan_ket[]"></div></div>');
        //     $('#cMesin').html('<div class="row"><div class="col-md-5 mb-2 mb-md-3"><input type="text" class="form-control readonly" placeholder="Mesin" required name="mesin[]"></div><div class="col-md-5 mb-2 mb-md-0"><input type="text" class="form-control readonly" placeholder="Kepemilikan" required  name="kepemilikan[]"></div><div class="col-md-2"><input type="text" class="form-control readonly" placeholder="Kuantitas" required name="mesin_qty[]"></div></div>');
        //     $('#cExistImage').hide();
        // }

        // $('.btnClose').on('click', function(e) {
        //     clearFormAdd();
        // })

        // $('.add').on('click', function () {
        //     $('#addMarkerModal').modal('show');
        //     $('#formCoord').attr('action', "{{ route('addCoord') }}");
        //     $('#addMarkerJudul').html('Tambah Lokasi');
        //     $('#cExistImage').hide();
        //     clearFormAdd();
        // });
</script>

