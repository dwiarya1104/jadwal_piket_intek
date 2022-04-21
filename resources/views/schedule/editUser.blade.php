@extends('layouts.master')

@section('main')
    <div class="container">
        <div class="card shadow m-0 p-0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">EDIT SCHEDULE</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('schedule.updateUser', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="#" class="font-weight-bold h6">Status</label>
                    <div class="input-group">
                        <select class="form-control" name="status">
                            <option value="On Progress">On Progress</option>
                            <option value="Completed"> Completed</option>
                            <option value="Incompleted">Incompleted</option>
                        </select>
                    </div>

                    <label for="#" class="font-weight-bold h6 mt-3">Bukti</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
                        <div class="custom-file">
                            <input type="file" name="upload_bukti" class="custom-file-input" id="inputGroupFile01" required>
                            @error('task_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary bt-sm mt-4">Add</button>
                        <a href="#" type="submit" class="btn btn-primary bt-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
