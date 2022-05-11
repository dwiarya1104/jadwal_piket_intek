{{-- @extends('layouts.master')

@section('main')
    <div class="container">
        <div class="card shadow m-0 p-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">EDIT OFFICE BOYS</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $data->id) }}" method="POST" exctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="#">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                value="{{ $data->name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="#">Username</label>
                            <input type="text" class="form-control" name="username" id="name" placeholder="Username"
                                value="{{ $data->username }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Email</label>
                        <input type="email" class="form-control" name="email" id="inputAddress" placeholder="Email"
                            value="{{ $data->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary bt-sm">Edit</button>
                        <a href="{{ route('users.index') }}" type="submit" class="btn btn-primary bt-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection --}}

<!-- Modal Update-->
@foreach ($data as $d)
    <div class="modal fade" id="modalUpdate{{ $d->id }}" tabindex="-1" aria-labelledby="modalUpdateBarang"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM UPDATE BARANG-->
                    <form action="{{ route('users.update', $d->id) }}" method="POST" exctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold h6" for="#">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ $d->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold h6" for="#">Username</label>
                                <input type="text" class="form-control" name="username" id="name"
                                    placeholder="Username" value="{{ $d->username }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold h6" for="inputAddress">Email</label>
                            <input type="email" class="form-control" name="email" id="inputAddress"
                                placeholder="Email" value="{{ $d->email }}" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary bt-sm right">Save Change</button>
                        </div>
                    </form>
                    <!--END FORM UPDATE BARANG-->
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- End Modal UPDATE Barang-->
