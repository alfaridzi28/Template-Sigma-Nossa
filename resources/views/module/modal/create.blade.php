<div class="modal fade" id="modalAddModule" tabindex="-1" aria-labelledby="modalAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddModalLabel">Create New Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('module.store') }}" method="post">
                    @method('post')
                    @csrf
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Module</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>