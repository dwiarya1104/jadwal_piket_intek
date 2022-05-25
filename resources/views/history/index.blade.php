@extends('layouts.master')

@section('main')
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
                                    <input class="form-control float-left mb-3" type="date" name="tanggal">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        {{-- <div class="row">
                            <div class="col">
                                <label for="">
                                    Date :
                                </label>
                                <div class="col-4">
                                    <input class="form-control float-left mb-3" type="date">
                                    <button onclick={{ url('/history') }}>Filter</button>
                                </div>
                            </div>
                        </div> --}}
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
                                        <td>{{ $d->upload_bukti }}</td>
                                        <td>{{ $d->updated_at }}</td>
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
