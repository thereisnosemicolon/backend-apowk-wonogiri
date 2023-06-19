@extends('backend.layouts.main')

@section('container')

<div id="content">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Touris</h1>
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
                <a href="{{ route('pengunjung.cetak') }}" class="float-right mb-3 btn btn-sm btn-success shadow-sm mr-2"><i
                     class="fas fa-print fa-sm text-white-50 mr-2"></i>Cetak Excel</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>NoHp</th>
                                <th>Active</th>
                                <th>Created at</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        @foreach ($pengunjung as $i=>$touris )
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $touris->name }}</td>
                                <td>{{ $touris->alamat }}</td>
                                <td>{{ $touris->nohp }}</td>
                                @if ($touris->fl_active == 1)
                                <td><span class="badge bg-success text-white">active</span></td>
                                @else
                                <td><span class="badge bg-danger text-white">not active</span></td>
                                @endif
                                <td>{{ $touris->created_at }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#EditModal{{ $touris->id }}"><i
                                        class="fas fa-edit fa-sm mr-2"></i>Edit</a>
                                    <form method="POST" action="{{ route('pengunjung.destroy', $touris->id) }}">
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
                        <form action="{{ route('pengunjung.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <select name="id_user" class="form-control">
                                    <option selected>Pilih User</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="nohp" placeholder="No. Handphone" required>
                            </div>
                            <div class="mb-4">
                                <textarea name="alamat" class="form-control" id="alamat" cols="5" rows="5" placeholder="Alamat"></textarea>
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
        @foreach ($pengunjung as $touris)
        <div class="modal fade" id="EditModal{{ $touris->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengunjung.update', $touris->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $touris->id }}">
                            <div class="mb-3">
                                <select name="id_user" class="form-control">
                                    <option value="{{ $touris->user }}">{{ $touris->name }}</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nohp" placeholder="No. Handphone" value="{{ $touris->nohp }}">
                            </div>
                            <div class="mb-4">
                                <textarea name="alamat" class="form-control" id="alamat" cols="5" rows="5" placeholder="Alamat" value="{{ $touris->alamat }}">{{ $touris->alamat }}</textarea>
                            </div>
                            <div class="form-check">
                                <input type="hidden" value="0" name="fl_active">
                                <input class="form-check-input" name="fl_active" type="checkbox" value="1" checked>
                                <label class="form-check-label">Active</label>
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
