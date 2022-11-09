<div class="modal fade" id="modalEditSubmodule" tabindex="-1" aria-labelledby="modalEditSubmoduleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSubmoduleLabel">Edit Submodule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('submodule.update', 'update') }}" method="post">
                    @method('put')
                    @csrf

                    <input type="hidden" name="id" id="input-id" value="" />

                    <div class="form-group">
                        <label for="subtitle" class="col-form-label">Subtitle</label>
                        <input type="text" id="input-subtitle" class="form-control" name="subtitle" placeholder="Subtitle"
                            value="{{ old('subtitle') }}" required="">
                    </div>

                     <div class="form-group">
                        <label for="url" class="col-form-label">url</label>
                        <input type="text" id="input-url" class="form-control" name="url" placeholder="Url"
                            value="{{ old('url') }}" required="">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>