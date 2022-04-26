@extends('layouts.master')

@section('main')
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
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right mb-3"><i
                            class="fas fa-plus"></i>Add Office Boys</a>
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
                                            <a href="{{ url('users/delete', $dataob->id) }}" class="btn btn-danger btn-sm"
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
