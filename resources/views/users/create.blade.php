@extends('layouts.master')

@section('main')
    <div class="container">
        <div class="card shadow m-0 p-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ADD OFFICE BOYS</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" exctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="#">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                id="email" placeholder="Name">
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary bt-sm">Add</button>
                        <a href="{{ route('users.index') }}" type="submit" class="btn btn-primary bt-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
