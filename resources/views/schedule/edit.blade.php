@extends('layouts.master')

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

                    {{-- <div class="form-group">
                        <label for="#" class="font-weight-bold h6 mt-3">Start Time</label>
                        <input type="datetime-local" class="form-control" name="start_time" id="start_time"
                            placeholder="Start Time">
                    </div>

                    <div class="form-group">
                        <label for="end_time" class="font-weight-bold h6">End Time</label>
                        <input type="datetime-local" class="form-control" name="end_time" id="end_time"
                            placeholder="End Time">
                    </div> --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary bt-sm mt-4">Add</button>
                        <a href="#" type="submit" class="btn btn-primary bt-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
