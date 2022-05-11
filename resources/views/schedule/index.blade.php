@extends('layouts.master')

@section('main')

    {{-- MODAL SHOW --}}

    <!-- Modal -->
    @foreach ($dataadmin as $da)
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

    {{-- MODAL DELETE --}}
    @foreach ($dataadmin as $del)
        <div class="modal fade" id="modalDelete{{ $del->id }}" tabindex="-1" aria-labelledby="modalHapusBarang"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <i class="fas fa-exclamation-circle mb-2"
                            style="color: #e74a3b; font-size:120px; justify-content:center; display:flex"></i>
                        <h5 class="text-center">Are you sure you want to delete this Schedule?</h5>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('schedule.delete', $del->id) }}" method="POST">
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

    <!-- Modal ADD SCHEDULE -->
    {{-- @include('sweetalert::alert') --}}
    <div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="addScheduleLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold h5" id="addScheduleLabel">Add Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('schedule.store') }}" id="formAdd" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="#" class="font-weight-bold h6">Task Title</label>
                            <input type="text" class="form-control @error('task_title') is-invalid @enderror"
                                id="task_title" name="task_title" id="task_title" placeholder="Task Title" required>
                            @error('task_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="#" class="font-weight-bold h6">Description</label>
                            <input type="text" class="form-control  @error('task_description') is-invalid @enderror"
                                name="task_description" id="task_description" placeholder="Description" required>
                            @error('task_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="#" class="font-weight-bold h6">AssignTo</label>
                        <div class="input-group">
                            {!! Form::select('user_id', $users, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Office Boys --', 'id' => 'user_id', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="#" class="font-weight-bold h6 mt-3">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" id="tanggal"
                                placeholder="Start Time" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL --}}

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
                                    {{-- <th> Start Time </th>
                                    <th> End Time </th> --}}
                                    <th> Status </th>
                                    <th> Bukti </th>
                                    @hasrole('admin')
                                        <th> Update At </th>
                                    @endhasrole
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
                                            <td>{{ $schedule->tanggal }}</td>
                                            {{-- <td>{{ $schedule->start_time }}</td>
                                            <td>{{ $schedule->end_time }}</td> --}}
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <span class='badge badge-warning'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Completed')
                                                    <span class='badge badge-success'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Incompleted')
                                                    <span class='badge badge-danger'>{{ $schedule->status }}</span>
                                                @endif
                                            </td>
                                            {{-- @php
                                                dd($schedule->id);
                                            @endphp --}}
                                            <td><img src="{{ asset('storage/bukti/' . $schedule->upload_bukti) }}" alt=""
                                                    style="width: 50px;"></td>
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    {{-- <a href="{{ route('schedule.editUser', $schedule->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> --}}
                                                    <a class="btn btn-success btn-sm"><i class="fas fa-edit"
                                                            data-toggle="modal"
                                                            data-target="#modalEditUser{{ $schedule->id }}"></i></a>
                                                @elseif($schedule['status'] == 'Incompleted')
                                                    <i class="fas fa-times"
                                                        style="font-size: 30px; color:#e74a3b; align-items:center"
                                                        title="Incompleted"></i>
                                                @elseif($schedule['status'] == 'Completed')
                                                    <i class="fas fa-check"
                                                        style="font-size: 30px; color:#1cc88a; align-items:center"
                                                        title="Completed"></i>
                                                @endif
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
                                            <td>{{ $schedule->tanggal }}</td>
                                            {{-- <td>{{ $schedule->start_time }}</td>
                                            <td>{{ $schedule->end_time }}</td> --}}
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <span class='badge badge-warning'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Completed')
                                                    <span class='badge badge-success'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Incompleted')
                                                    <span class='badge badge-danger'>{{ $schedule->status }}</span>
                                                @endif
                                            </td>
                                            <td><img src="{{ asset('storage/bukti/' . $schedule->upload_bukti) }}" alt=""
                                                    style="width: 50px;">
                                            </td>
                                            <td>{{ $schedule->updated_at }}</td>
                                            <td>
                                                {{-- <a href="{{ route('schedule.edit', $schedule->id) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a> --}}
                                                <a class="btn btn-success btn-sm"><i class="fas fa-edit" data-toggle="modal"
                                                        data-target="#modalUpdateAdmin{{ $schedule->id }}"></i></a>

                                                <a class="btn btn-danger btn-sm"><i class="fas fa-trash" data-toggle="modal"
                                                        data-target="#modalDelete{{ $schedule->id }}"></i></a>
                                                <a class="btn btn-primary btn-sm"><i class="fas fa-eye" data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $schedule->id }}"></i></a>

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
        @include('schedule/editUser')
        @include('schedule/edit')

        @include('sweetalert::alert')
    </section>
@endsection
