<div class="modal fade" id="modalEditModule" tabindex="-1" aria-labelledby="modalEditModuleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditModuleLabel">Edit Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module.update', 'update') }}" method="post">
                    @method('put')
                    @csrf

                    <input type="hidden" name="id" id="input-id" value="" />

                    <div class="form-group">
                        <label for="title" class="col-form-label">Title</label>
                        <input type="text" id="input-title" class="form-control" name="title" placeholder="title" value="{{ old('title') }}" required="">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>