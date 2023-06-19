@extends('backend.layouts.main')

@section('container')

     <!-- Main Content -->
     <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">
                <!-- Pelanggan -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                        Touris</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $touris }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-warning text-uppercase mb-1">
                                        Destinasi</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $destinasi }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-award fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paket -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-info text-uppercase mb-1">
                                        Gallery</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $gallery }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-6 mb-4">

                </div>

                <div class="col-lg-6 mb-4">

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

@endsection



