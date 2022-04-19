@extends('layouts.master')

@section('main')
<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong>Add Schedule</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('schedule.store')}}" id="formAdd" method="POST" exctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="#"class="font-weight-bold h6">Task Title</label>
                    <input type="text" class="form-control @error('task_title') is-invalid @enderror" id="task_title" name="task_title" id="task_title" placeholder="Task Title">
                    @error('task_title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="#" class="font-weight-bold h6">Description</label>
                    <textarea name="task_description" id="" class="form-control" cols="10" rows="2" placeholder="Description"></textarea>
                    {{-- <input type="text" class="form-control" name="task_description" id="task_description" placeholder="Description"> --}}
                </div>

                <label for="#" class="font-weight-bold h6">AssignTo</label>
                <div class="input-group">
                        {!! Form::select('user_id', $users, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Office Boys --', 'id' => 'user_id', 'required']) !!}

                        {{-- @foreach ($data as $ob)
                        <option value="{{ $ob->id }}">{{$ob->user->name}}</option>
                        @endforeach --}}
                  </div>

            <div class="form-group">
                <label for="#" class="font-weight-bold h6 mt-3">Start Time</label>
                <input type="date" class="form-control" name="start_time" id="start_time" placeholder="Start Time">
            </div>

            <div class="form-group">
                <label for="end_time" class="font-weight-bold h6">End Time</label>
                <input type="date" class="form-control" name="end_time" id="end_time" placeholder="End Time">
            </div>

            <label for="#" class="font-weight-bold h6">Status</label>
            <div class="input-group">
                {{-- {!! Form::select('status', $status, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Office Boys --', 'id' => 'status', 'required']) !!} --}}
                <select class="form-control" name="status">
                    <option value="">--Select Status--</option>
                    <option value="Completed">  Completed</option>
                    <option value="Incompleted">Incompleted</option>
                    <option value="On Progress">On Progress</option>
                </select>
                {{-- <select name="status" id="status" class="form-control">
                    @foreach ($data as $ob)
                    <option value="{{ $ob->id }}">{{$ob->status}}</option>
                    @endforeach
                </select> --}}
              </div>

              <label for="#" class="font-weight-bold h6 mt-3">Bukti</label>
              <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <div class="custom-file">
                  <input type="file" name="upload_bukti" class="custom-file-input" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn_add" id="btnAdd">Submit</button>
        </div>
      </div>
    </div>
  </div>

<section>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SCHEDULES</h6>
    </div>
    <div class="card-body">
        @hasrole('admin')
        {{-- <button type="button" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i>Add New Schedule
          </button> --}}
        <a href="{{route('schedule.create')}}" class="btn btn-primary float-right btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addSchedule">+ Add Schedule</a>
        {{-- <a  class="btn btn-primary float-right btn-sm mb-3" onclick="addForm()">+ Add Scheduless</a> --}}
        @endhasrole
        <div class="table-responsive">
            <table class="table table-striped datatables" style="font-size:13px;" id="dataTable" width="100%" cellspacing="0">
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
                        <td>{{$serial++}}</td>
                        <td>{{$schedule -> task_title }}</td>
                        <td>{{$schedule-> task_description}}</td>
                        <td>{{$schedule->user->name}}</td>
                        <td>{{$schedule-> start_time}}</td>
                        <td>{{$schedule-> end_time}}</td>
                        <td>
                            {{-- status (COMPLETED,INCOMPLETED,ON PROGRESS) --}}
                            @if($schedule['status']== 'On Progress')
                                <span class='badge badge-warning'>{{$schedule->status}}</span>
                            @elseif ($schedule['status']== 'Completed')
                                <span class='badge badge-success'>{{$schedule->status}}</span>
                            @elseif ($schedule['status'] == 'Incompleted')
                                <span class='badge badge-danger'>{{$schedule->status}}</span>
                            @endif
                        </td>
                        <td><img src="{{ asset('bukti/'. $schedule->upload_bukti)}}" alt=""  style="width: 50px;" ></td>
                        {{-- <img src="{{asset('assets/img/undraw_profile.svg')}}" alt=""/> --}}
                        <td>
                            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            @hasrole('admin')
                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Users?')"><i class="fas fa-trash"></i></a>
                            @endhasrole
                        </td>
                    </tr>
                    @endforeach
                    @endhasrole

                    @hasrole('admin')
                    @foreach ($dataadmin as $schedule)
                    <tr>
                        <td>{{$serial++}}</td>
                        <td>{{$schedule -> task_title }}</td>
                        <td>{{$schedule-> task_description}}</td>
                        <td>{{$schedule->user->name}}</td>
                        <td>{{$schedule-> start_time}}</td>
                        <td>{{$schedule-> end_time}}</td>
                        <td>
                            {{-- status (COMPLETED,INCOMPLETED,ON PROGRESS) --}}
                            @if($schedule['status']== 'On Progress')
                                <span class='badge badge-warning'>{{$schedule->status}}</span>
                            @elseif ($schedule['status']== 'Completed')
                                <span class='badge badge-success'>{{$schedule->status}}</span>
                            @elseif ($schedule['status'] == 'Incompleted')
                                <span class='badge badge-danger'>{{$schedule->status}}</span>
                            @endif
                        </td>
                        <td><img src="{{ asset('bukti/'. $schedule->upload_bukti)}}" alt="" style="width: 50px;"></td>
                        {{-- <img src="{{asset('assets/img/undraw_profile.svg')}}" alt=""/> --}}
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="{{route('schedule.delete', $schedule->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Users?')"><i class="fas fa-trash"></i></a>
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
<!-- /.container-fluid -->

</div>
<script type="text/javascript">
function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Company');
        }



    // $(document).ready(function() {
    //     $('#formAdd').on('submit',function(){
    //         $('#btnAdd').prop('disabled',true);
    //     })
    // })
</script>
</section>
@endsection
