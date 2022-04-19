@extends('layouts.master')

@section('main')

<div class="container">
    <form action="{{route('admin.store')}}" method="POST" exctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="#">Name</label>
        <input type="text" class="form-control" name="name" id="email" placeholder="Name">
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
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary bt-sm">Add</button>
        <a href="{{route('users.index')}}" type="submit" class="btn btn-primary bt-sm">Cancel</a>
    </div>
</form>
</div>

@endsection
