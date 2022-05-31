@extends('layouts.master')

@section('main')
    @foreach ($data as $del)
        <div class="modal fade" id="modalDelete{{ $del->id }}" tabindex="-1" aria-labelledby="modalHapusBarang"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <i class="fas fa-exclamation-circle mb-2"
                            style="color: #e74a3b; font-size:120px; justify-content:center; display:flex"></i>
                        <h5 class="text-center">Are you sure you want to delete this History?</h5>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ url('history/delete/' . $del->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes, Delete it</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    {{-- MODAL SHOW --}}

    @foreach ($data as $da)
        <div class="modal fade" id="exampleModalCenter{{ $da->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Detail Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($da->upload_bukti)
                            <img src="{{ asset('storage/bukti/' . $da->upload_bukti) }}" alt="" width="70%"
                                style="display:flex;margin-left: auto; margin-right:auto">
                        @else
                            <h4 class="text-center my-5">No Image Yet</h4>
                        @endif
                        <hr>
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col col-lg">
                                    Task Title
                                </div>
                                <div class="col-md-auto">
                                    :
                                </div>
                                <div class="col col-lg">
                                    <p>{{ $da->task_title }}</p>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col col-lg">
                                    Description
                                </div>
                                <div class="col-md-auto">
                                    :
                                </div>
                                <div class="col col-lg">
                                    <p>{{ $da->task_description }}</p>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col col-lg">
                                    AssigntTo
                                </div>
                                <div class="col-md-auto">
                                    :
                                </div>
                                <div class="col col-lg">
                                    <p>{{ $da->user->name }}</p>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col col-lg">
                                    Tanggal
                                </div>
                                <div class="col-md-auto">
                                    :
                                </div>
                                <div class="col col-lg">
                                    <p>{{ $da->tanggal }}</p>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col col-lg">
                                    Status
                                </div>
                                <div class="col-md-auto">
                                    :
                                </div>
                                <div class="col col-lg">
                                    @if ($da['status'] == 'On Progress')
                                        <p class='badge badge-warning'>
                                            {{ $da->status }}
                                        </p>
                                    @elseif ($da['status'] == 'Completed')
                                        <p class='badge badge-success'>
                                            {{ $da->status }}
                                        </p>
                                    @elseif ($da['status'] == 'Incompleted')
                                        <p class='badge badge-danger'>
                                            {{ $da->status }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col col-lg">
                                    CreatedAt
                                </div>
                                <div class="col-md-auto">
                                    :
                                </div>
                                <div class="col col-lg">
                                    <p>{{ $da->created_at }}</p>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col col-lg">
                                    UpdatedAt
                                </div>
                                <div class="col-md-auto">
                                    :
                                </div>
                                <div class="col col-lg">
                                    <p>{{ $da->updated_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- END MODAL SHOW --}}



    <section>
        <div class="container-fluid">
            @if ($message = Session::get('success'))
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">HISTORIES</h6>
                </div>
                <div class="card-body">
                    @hasrole('admin')
                        <div class="row">
                            <div class="col">
                                <h6>Date:</h6>
                            </div>
                        </div>
                        <form id="filter-tanggal" method="GET" action={{ url('/history') }}>
                            <div class="row justify-content-start">
                                <div class="col-3">
                                    @if ($date == null)
                                        <input class="form-control float-left mb-3" type="date" name="tanggal"
                                            value={{ Carbon\Carbon::now() }}>
                                    @else
                                        <input class="form-control float-left mb-3" type="date" name="tanggal"
                                            value={{ $date }}>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    @endhasrole
                    <div class="table-responsive">
                        <table class="table table-striped datatables" style="font-size:13px;" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead style="font-size: 13px;">
                                <tr>
                                    <th> ID </th>
                                    <th> Task Title </th>
                                    <th> Description </th>
                                    <th> AssignTo </th>
                                    <th> Tanggal </th>
                                    <th> Status </th>
                                    <th> Bukti </th>
                                    <th> UpdatedAt </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    // $serial = 1;
                                    dd($data);
                                @endphp --}}
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->task_title }}</td>
                                        <td>{{ $d->task_description }}</td>
                                        <td>{{ $d->user->name }}</td>
                                        <td>{{ $d->tanggal }}</td>
                                        <td>
                                            @if ($d['status'] == 'On Progress')
                                                <span class='badge badge-warning'>{{ $d->status }}</span>
                                            @elseif ($d['status'] == 'Completed')
                                                <span class='badge badge-success'>{{ $d->status }}</span>
                                            @elseif ($d['status'] == 'Incompleted')
                                                <span class='badge badge-danger'>{{ $d->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <img src={{ asset('storage/bukti/' . $d->upload_bukti) }} alt=""
                                                style="width: 50px;">
                                            {{-- {{ $d->upload_bukti }} --}}
                                        </td>
                                        <td>{{ $d->updated_at }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $d->id }}">
                                                <i class="fas fa-eye"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modalDelete{{ $d->id }}"><i
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
        @include('sweetalert::alert')
    </section>
@endsection
