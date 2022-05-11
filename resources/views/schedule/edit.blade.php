{{-- @extends('layouts.master')

@section('main')
    <div class="container">
        <div class="card shadow m-0 p-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">EDIT SCHEDULE</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('schedule.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="#" class="font-weight-bold h6">Task Title</label>
                        <input type="text" class="form-control @error('task_title') is-invalid @enderror" id="task_title"
                            name="task_title" id="task_title" placeholder="Task Title" value="{{ $data->task_title }}">
                        @error('task_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="#" class="font-weight-bold h6">Description</label>
                        <input type="text" class="form-control" name="task_description" id="task_description"
                            placeholder="Description" value="{{ $data->task_description }}">
                    </div>

                    <label for="#" class="font-weight-bold h6">AssignTo</label>
                    <div class="input-group">
                        {!! Form::select('user_id', $users, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Office Boys --', 'id' => 'user_id', 'required']) !!}
                    </div>

                    <div class="form-group">
                        <label for="#" class="font-weight-bold h6 mt-3">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Start Time">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary bt-sm mt-4">Add</button>
                        <a href="#" type="submit" class="btn btn-primary bt-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection --}}

@foreach ($dataadmin as $ok)
    <div class="modal fade" id="modalUpdateAdmin{{ $ok->id }}" tabindex="-1"
        aria-labelledby="modalUpdateBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--FORM UPDATE BARANG-->
                    <form action="{{ route('schedule.update', $ok->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="#" class="font-weight-bold h6">Task Title</label>
                            <input type="text" class="form-control @error('task_title') is-invalid @enderror"
                                id="task_title" name="task_title" id="task_title" placeholder="Task Title"
                                value="{{ $ok->task_title }}">
                            @error('task_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="#" class="font-weight-bold h6">Description</label>
                            <input type="text" class="form-control" name="task_description" id="task_description"
                                placeholder="Description" value="{{ $ok->task_description }}">
                        </div>

                        <label for="#" class="font-weight-bold h6">AssignTo</label>
                        <div class="input-group">
                            {!! Form::select('user_id', $users, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Office Boys --', 'id' => 'user_id', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="#" class="font-weight-bold h6 mt-3">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal"
                                placeholder="Start Time">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary bt-sm mt-4">Save Change</button>
                        </div>
                    </form>
                    <!--END FORM UPDATE BARANG-->
                </div>
            </div>
        </div>
    </div>
@endforeach
