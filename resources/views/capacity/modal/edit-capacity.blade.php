<div class="modal fade" id="modalEditCapacity" tabindex="-1" aria-labelledby="modalEditCapacityLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditCapacityLabel">Edit Capacity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('capacity.update', 'update') }}" method="post">
                    @method('put')
                    @csrf

                    <input type="hidden" name="id" id="id" />

                    <div class="form-group">
                        <label for="node" class="col-form-label">Node</label>
                        <input type="text" class="form-control" id="node" name="node" placeholder="Node">
                    </div>
                    <div class="form-group">
                        <label for="port" class="col-form-label">Port</label>
                        <input type="text" class="form-control" id="port" name="port" placeholder="Port">
                    </div>
                    <div class="form-group">
                        <label for="ruas" class="col-form-label">Ruas</label>
                        <input type="text" class="form-control" id="ruas" name="ruas" placeholder="Ruas">
                    </div>
                    <div class="form-group">
                        <label for="nbr" class="col-form-label">Nbr</label>
                        <input type="text" class="form-control" id="nbr" name="nbr" placeholder="Nbr">
                    </div>
                    <div class="form-group">
                        <label for="capacity" class="col-form-label">Capacity</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Capacity">
                    </div>
                    <div class="form-group">
                        <label for="label" class="col-form-label">Label</label>
                        <input type="text" class="form-control" id="label" name="label" placeholder="Label">
                    </div>
                    <div class="form-group">
                        <label for="regional" class="col-form-label">Regional</label>
                        <input type="text" class="form-control" id="regional" name="regional" placeholder="Regional">
                    </div>
                    <div class="form-group">
                        <label for="link" class="col-form-label">Link</label>
                        <input type="text" class="form-control" id="link" name="link" placeholder="Link">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="editBtn" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>