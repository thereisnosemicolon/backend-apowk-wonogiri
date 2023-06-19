@extends('backend.layouts.main')

@section('container')

<div id="content">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Destinasi</h1>
        </div>

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        </div>
        @endif

        @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('fail') }}
        </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">

                <a href="#" class="float-right mb-3 btn btn-sm btn-primary shadow-sm " data-toggle="modal" data-target="#AddModal"><i
                    class="fas fa-plus fa-sm text-white-50 mr-2"></i>Tambah Data</a>
                <a href="{{ route('destinasi.cetak') }}" class="float-right mb-3 btn btn-sm btn-success shadow-sm mr-2"><i
                     class="fas fa-print fa-sm text-white-50 mr-2"></i>Cetak Excel</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Destinasi</th>
                                <th>Lokasi</th>
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Deskripsi</th>
                                <th>Created at</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        @foreach ($destinasi as $i=>$destination )
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $destination->nama_destinasi }}</td>
                                <td>{{ $destination->lokasi }}</td>
                                <td>{{ $destination->longitude }}</td>
                                <td>{{ $destination->latitude }}</td>
                                <td>{{ $destination->deskripsi }}</td>
                                <td>{{ $destination->created_at }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#EditModal{{ $destination->id }}"><i
                                        class="fas fa-edit fa-sm mr-2"></i>Edit</a>
                                    <form method="POST" action="{{ route('destinasi.destroy', $destination->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" onclick="return confirm('Are your sure?')" class="btn btn-sm btn-danger"><i class="fas fa-trash fa-sm mr-2"></i><span>Delete</span></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal Input --}}
        <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('destinasi.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nama_destinasi" placeholder="Nama Destinasi" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="longitude" placeholder="Longitude" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="latitude" placeholder="Latitude" required>
                            </div>
                            <div class="mb-4">
                                <textarea name="deskripsi" class="form-control" id="deskripsi" cols="5" rows="5" placeholder="Deskripsi"></textarea>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- Modal Edit --}}
        @foreach ($destinasi as $destination)
        <div class="modal fade" id="EditModal{{ $destination->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('destinasi.update', $destination->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $destination->id }}">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nama_destinasi" placeholder="Nama Destinasi" value="{{ $destination->nama_destinasi }}">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="lokasi" placeholder="Lokasi" value="{{ $destination->lokasi }}">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="longitude" placeholder="Longitude" value="{{ $destination->longitude }}">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="latitude" placeholder="Latitude" value="{{ $destination->latitude }}">
                            </div>
                            <div class="mb-4">
                                <textarea name="deskripsi" class="form-control" id="deskripsi" cols="5" rows="5" placeholder="Deskripsi">{{ $destination->deskripsi }}</textarea>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-warning">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
