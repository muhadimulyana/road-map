
@extends('app')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
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
                            <a href="javascript:void" id="refresh" class="btn btn-secondary btn-sm">Refresh</a>
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
    class="add btn btn-success btn-circle btn-lg widget">
    <i style="font-size: 25px;" class="fas fa-plus"></i>
</a>
@endsection

@push('script')
<script>
    $(function() {
        $('.select2').select2({
            allowClear: true
        });
        $('.datepicker').bootstrapMaterialDatePicker({
            time: false,
            format: 'DD-MM-YYYY'
        });
    });
</script>
<script>
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
        console.log($('#f_kategori').val())
        oTable.draw();
        e.preventDefault();
    });

    $('#refresh').on('click', function(e) {
        $('#filterForm')[0].reset();
        $('.select2').val('').change()
        oTable.draw();
        e.preventDefault();
    });
</script>
@endpush