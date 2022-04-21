@extends('layouts.master')

@section('main')

    <section>
        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert    ">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">SCHEDULES</h6>
                </div>
                <div class="card-body">
                    @hasrole('admin')
                        <a href="{{ route('schedule.create') }}" class="btn btn-primary float-right btn-sm mb-3"
                            data-bs-toggle="modal" data-bs-target="#addSchedule">+ Add Schedule</a>
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
                                    <th> Start Time </th>
                                    <th> End Time </th>
                                    <th> Status </th>
                                    <th> Bukti </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @hasrole('user')
                                    @foreach ($data as $schedule)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $schedule->task_title }}</td>
                                            <td>{{ $schedule->task_description }}</td>
                                            <td>{{ $schedule->user->name }}</td>
                                            <td>{{ $schedule->start_time }}</td>
                                            <td>{{ $schedule->end_time }}</td>
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <span class='badge badge-warning'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Completed')
                                                    <span class='badge badge-success'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Incompleted')
                                                    <span class='badge badge-danger'>{{ $schedule->status }}</span>
                                                @endif
                                            </td>
                                            <td><img src="{{ asset('bukti/' . $schedule->upload_bukti) }}" alt=""
                                                    style="width: 50px;"></td>
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <a href="{{ route('schedule.editUser', $schedule->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                @elseif($schedule['status'] == 'Incompleted')
                                                    <i class="fas fa-times"
                                                        style="font-size: 30px; color:#e74a3b; align-items:center"></i>
                                                @elseif($schedule['status'] == 'Completed')
                                                    <i class="fas fa-check"
                                                        style="font-size: 30px; color:#1cc88a; align-items:center"></i>
                                                @endif

                                                @hasrole('admin')
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this Users?')"><i
                                                            class="fas fa-trash"></i></a>
                                                @endhasrole
                                            </td>
                                        </tr>
                                    @endforeach
                                @endhasrole

                                @hasrole('admin')
                                    @foreach ($dataadmin as $schedule)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $schedule->task_title }}</td>
                                            <td>{{ $schedule->task_description }}</td>
                                            <td>{{ $schedule->user->name }}</td>
                                            <td>{{ $schedule->start_time }}</td>
                                            <td>{{ $schedule->end_time }}</td>
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <span class='badge badge-warning'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Completed')
                                                    <span class='badge badge-success'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Incompleted')
                                                    <span class='badge badge-danger'>{{ $schedule->status }}</span>
                                                @endif
                                            </td>
                                            <td><img src="{{ asset('bukti/' . $schedule->upload_bukti) }}" alt=""
                                                    style="width: 50px;"></td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('schedule.edit', $schedule->id) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('schedule.delete', $schedule->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this Users?')"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endhasrole
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </section>
@endsection
