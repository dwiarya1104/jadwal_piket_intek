@extends('layouts.master')

@section('main')
    <!-- Modal ADD USER -->
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.store') }}" method="POST" exctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="#">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" id="email" placeholder="Name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#">Username</label>
                                <input type="text" class="form-control" name="username" id="email" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Email</label>
                            <input type="email" class="form-control" name="email" id="inputAddress" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Password</label>
                            <input type="password" class="form-control @error('name') is-invalid @enderror" name="password"
                                id="password" placeholder="Password">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL UPDATE USER --}}
    {{-- END MODAL --}}
    <section>
        <div class="container-fluid">
            <!-- DataTales Example -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert    ">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card shadow m-0 p-0">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">OFFICE BOYS</h6>
                </div>
                <div class="card-body">
                    {{-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right mb-3"><i
                            class="fas fa-plus"></i>Add Office Boys</a> --}}
                    <button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal"
                        data-target="#addUser">
                        <i class="fas fa-plus"></i>Add Office Boys</a>
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped datatables" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach ($data as $dataob)
                                    <tr>
                                        <td>{{ $serial++ }}</td>
                                        <td>{{ $dataob->name }}</td>
                                        <td>{{ $dataob->username }}</td>
                                        <td>{{ $dataob->email }}</td>
                                        <td>{{ $dataob->roles->pluck('name')->implode('') }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $dataob->id) }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ url('users/delete', $dataob->id) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this Users?')"><i
                                                    class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        </div>
    </section>
@endsection
