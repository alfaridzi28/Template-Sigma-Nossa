<div class="modal fade" id="modalAddSubmodule" tabindex="-1" aria-labelledby="modalAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalAddModalLabel">Create New Submodule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('submodule.store') }}" method="post">
                    @method('post')
                    @csrf

                    <div class="form-group">
                        <input type="number" id="id-submodule" class="form-control" name="module_id" placeholder="module_id"
                            value="{{ $module->id }}" required="" hidden>
                    </div>

                    <div class="form-group">
                        <label for="subtitle" class="col-form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle" placeholder="Subtitle"
                            value="{{ old('subtitle') }}" required="">
                    </div>

                    <div class="form-group">
                        <label for="url" class="col-form-label">Url</label>
                        <input type="text" class="form-control" name="url" placeholder="Url" value="{{ old('url') }}"
                            required="">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Module</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
