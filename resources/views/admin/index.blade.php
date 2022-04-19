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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ADMINS</h6>
    </div>
    <div class="card-body">
        <a href="{{route('admin.create')}}" class="btn btn-primary btn-sm float-right mb-3"><i class="fas fa-plus"></i> Add Admin</a>
        <div class="table-responsive">
            <table class="table table-striped datatables" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $serial = 1;
                    @endphp
                    @foreach ($data as $dataadmin)
                    <tr>
                        <td>{{$serial++}}</td>
                        <td>{{$dataadmin -> name}}</td>
                        <td>{{$dataadmin -> username}}</td>
                        <td>{{$dataadmin -> email}}</td>
                        <td>
                            <a href="{{route('admin.edit', $dataadmin->id)}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>Edit</a>
                            <!-- dd('$dataadmin') -->
                            <a href="{{url('admin/delete', $dataadmin->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Users?')"><i class="fas fa-trash"></i>Delete</a>
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
<script>
    $(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>
@endsection



