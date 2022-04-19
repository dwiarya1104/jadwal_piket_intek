@extends('layouts.master')

@section('main')


<div class="container">
<div class="card shadow m-0 p-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">EDIT ADMIN</h6>
    </div>
    <div class="card-body">
            <form action="{{route('admin.update', $data->id)}}" method="POST" exctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="#">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{$data->name}}">
            </div>
            <div class="form-group col-md-6">
            <label for="#">Username</label>
            <input type="text" class="form-control" name="username" id="name" placeholder="Username" value="{{$data->username}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Email</label>
            <input type="email" class="form-control" name="email" id="inputAddress" placeholder="Email" value="{{$data->email}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary bt-sm">Edit</button>
            <a href="{{route('admin.index')}}" type="submit" class="btn btn-primary bt-sm">Cancel</a>
        </div>
        </form>
    </div>
</div>

</div>

@endsection
