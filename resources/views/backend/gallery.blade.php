@extends('backend.layouts.main')

@section('container')

<div id="content">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Gallery</h1>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Destinasi</th>
                                <th>Foto</th>
                                <th>Created at</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        @foreach ($gallery as $i=>$galeri )
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $galeri->nama_destinasi }}</td>
                                <td><img class="img-thumbnail" src="assets/img/{{ $galeri->foto }}" width="400px" /></td>
                                <td>{{ $galeri->created_at }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#EditModal{{ $galeri->id }}"><i
                                        class="fas fa-edit fa-sm mr-2"></i>Edit</a>
                                    <form method="POST" action="{{ route('gallery.destroy', $galeri->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" onclick="return confirm('Are your sure?')" class="btn btn-sm btn-danger"><i class="fas fa-trash fa-sm mr-2"></i><span>Delete</span></button>
                                        </div>
                                    </form>
                                    <a href="#" class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#DetailModal{{ $galeri->id_destinasi }}"><i
                                        class="fas fa-info fa-sm mr-2"></i>Detail</a>
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
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <select name="id_destinasi" class="form-control">
                                    <option selected>Pilih Destinasi</option>
                                    @foreach ($destinasi as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->nama_destinasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto">Foto Destinasi</label>
                                <input type="file" class="form-control" name="foto" required>
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
        @foreach ($gallery as $galeri)
        <div class="modal fade" id="EditModal{{ $galeri->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('gallery.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <select name="id_destinasi" class="form-control">
                                    <option value="{{ $galeri->id_destinasi }}">{{ $galeri->nama_destinasi }}</option>
                                    @foreach ($destinasi as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->nama_destinasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto">Foto Destinasi</label>
                                <input type="file" class="form-control" name="foto" value="{{ $galeri->foto }}">
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

        {{-- Modal Detail --}}
        @foreach ($gallery as $galeri)
        <div class="modal fade" id="DetailModal{{ $galeri->id_destinasi }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Gallery</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_destinasi" value="{{ $galeri->id_destinasi }}">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Created at</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <h6>Nama Destinasi : <b>{{ $galeri->nama_destinasi }}</b></h6>
                            @foreach ($galleryfoto->where('id_destinasi', $galeri->id_destinasi) as $i=>$galerifoto )
                            <tbody>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td><img class="img-thumbnail" src="assets/img/{{ $galerifoto->foto }}" width="400px" /></td>
                                    <td>{{ $galerifoto->created_at }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('gallery.destroy', $galerifoto->id) }}">
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
        </div>
        @endforeach
    </div>

</div>

@endsection
