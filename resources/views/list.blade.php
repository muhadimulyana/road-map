
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

            <!-- Page Heading -->

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
                                    <th>Tgl Kunjungan</th>
                                    <th>CP</th>
                                    <th>Telp</th>
                                    <th>Tgl Buat</th>
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
@endsection

@push('script')
<script>
    $('#coordDataTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: "{{ route('getAllCoords') }}",
        columns: [
            { 
                data: 'DT_RowIndex', 
                name: 'no' },
            {
                data: 'NAMA_USAHA',
                name: 'nama_usaha'
            },
            {
                data: 'LOKASI',
                name: 'lokasi'
            },
            {
                data: 'KATEGORI',
                name: 'kategori'
            },
            {
                data: 'TANGGAL_KUNJUNGAN',
                name: 'tgl_kunjungan'
            },
            {
                data: 'CP',
                name: 'cp'
            },
            {
                data: 'TELEPON',
                name: 'telp'
            },
            {
                data: 'TANGGAL_BUAT',
                name: 'lat'
            },
            {
                data: 'AKSI',
                name: 'aksi'
            }
        ]
    });
</script>
@endpush