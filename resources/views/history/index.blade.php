@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            @if ($message = Session::get('success'))
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">SCHEDULES</h6>
                </div>
                <div class="card-body">
                    @hasrole('admin')
                        {{-- <a href="{{ route('schedule.create') }}" class="btn btn-primary float-right btn-sm mb-3"
                        data-bs-toggle="modal" data-bs-target="#addSchedule">+ Add Schedule</a> --}}
                        <button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal"
                            data-target="#addSchedule">
                            <i class="fas fa-plus"></i>Add Schedule
                        </button>
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
                                    <th> Bukti </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // $serial = 1;
                                    dd($data);
                                @endphp
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
                                        <td>{{ $d }}</td>
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
