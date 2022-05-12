@foreach ($data as $da)
    <div class="modal fade" id="modalEditUser{{ $da->id }}" tabindex="-1" aria-labelledby="modalUpdateBarang"
        aria-hidden="true">
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
                    <form action="{{ route('schedule.updateUser', $da->id) }}" method="POST"
                        enctype="multipart/form-data">
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
                        <div class="form-group">
                            <input type="file" class="form-control" name="upload_bukti">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary bt-sm right">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
