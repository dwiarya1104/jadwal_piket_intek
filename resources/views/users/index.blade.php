@extends('layouts.master')

@section('main')
    <!-- Modal ADD USER -->
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold h5" id="addUserLabel">Add Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('users.store') }}" method="POST" exctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="#" class="font-weight-bold h6">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" id="email" placeholder="Name" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="#" class="font-weight-bold h6">Username</label>
                                <input type="text" class="form-control" name="username" id="email" placeholder="Username"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="font-weight-bold h6">Email</label>
                            <input type="email" class="form-control" name="email" id="inputAddress" placeholder="Email"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="font-weight-bold h6">Password</label>
                            <input type="password" class="form-control @error('name') is-invalid @enderror" name="password"
                                id="password" placeholder="Password" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}

    @foreach ($data as $del)
        <div class="modal fade" id="modalDelete{{ $del->id }}" tabindex="-1" aria-labelledby="modalHapusBarang"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <i class="fas fa-exclamation-circle mb-2"
                            style="color: #e74a3b; font-size:120px; justify-content:center; display:flex"></i>
                        <h5 class="text-center">Are you sure you want to delete this User?</h5>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ url('users/delete', $del->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, Delete it!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <section>
        <div class="container-fluid">
            <!-- DataTales Example -->
            @if ($message = Session::get('success'))
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
                        <i class="fas fa-plus"></i>Add Office Boys
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
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $serial++ }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->username }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->roles->pluck('name')->implode('') }}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm"><i class="fas fa-edit" data-toggle="modal"
                                                    data-target="#modalUpdate{{ $d->id }}"></i></a>
                                            <a class="btn btn-danger btn-sm"><i class="fas fa-trash" data-toggle="modal"
                                                    data-target="#modalDelete{{ $d->id }}"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @include('users/edit')

    </section>
@endsection
