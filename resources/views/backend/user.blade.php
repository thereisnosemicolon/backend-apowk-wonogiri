@extends('backend.layouts.main')

@section('container')

<div id="content">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data User</h1>
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

                <a href="#" class="float-right mb-3 btn btn-sm btn-success shadow-sm " data-toggle="modal" data-target="#AddModal"><i
                    class="fas fa-plus fa-sm text-white-50 mr-2"></i>Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>User Role</th>
                                <th>Created at</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        @foreach ($users as $i=>$user )
                        <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                @if ($user->user_role == 1)
                                <td><span class="badge bg-primary text-white">admin</span></td>
                                @else
                                <td><span class="badge bg-success text-white">touris</span></td>
                                @endif
                                <td>{{ $user->created_at }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#EditModal{{ $user->id }}"><i
                                        class="fas fa-edit fa-sm mr-2"></i>Edit</a>
                                    <form method="POST" action="{{ route('user.destroy', $user->id) }}">
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
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Nama" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <select name="user_role" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="2">Touris</option>
                                </select>
                            </div>
                            <div class="mb-4">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
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
        @foreach ($users as $user)
        <div class="modal fade" id="EditModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                            </div>
                            <div class="mb-3">
                                <select name="user_role" class="form-control">
                                    <option value="{{ $user->user_role }}">{{ $user->user_role }}</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Touris</option>
                                </select>
                            </div>
                            <div class="mb-3">
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" value="{{ $user->email }}">
                            </div>
                            <div class="mb-4">
                            <input type="password" class="form-control" name="password" value="" placeholder="Password">
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
