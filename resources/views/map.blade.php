@extends('app')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="">
            <!-- Page Heading -->
            <div id="mapid"></div>
            <div class="leaflet-top leaflet-right">
                <a id="sidebarToggleTop" href="javascript:void" class="menu-btn btn btn-primary btn-circle widget">
                    <i style="font-size: 15px;" class="fa fa-bars"></i>
                </a>
            </div>
            <div class="leaflet-bottom leaflet-right">
                <a href="javascript:void" class="location btn btn-info btn-circle btn-lg widget">
                    <i style="font-size: 25px;" class="fas fa-street-view"></i>
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
