<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="modalAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create New Capacity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('capacity.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="input-id">
                    <div class="form-group">
                        <label for="node" class="col-form-label">Node</label>
                        <input type="text" class="form-control" id="input-node" name="node" placeholder="Node" required="">
                    </div>
                    <div class="form-group">
                        <label for="port" class="col-form-label">Port</label>
                        <input type="text" class="form-control" id="input-port" name="port" placeholder="Port" required="">
                    </div>
                    <div class="form-group">
                        <label for="ruas" class="col-form-label">Ruas</label>
                        <input type="text" class="form-control" id="input-ruas" name="ruas" placeholder="Ruas" required="">
                    </div>
                    <div class="form-group">
                        <label for="nbr" class="col-form-label">Nbr</label>
                        <input type="text" class="form-control" id="input-nbr" name="nbr" placeholder="Nbr" required="">
                    </div>
                    <div class="form-group">
                        <label for="capacity" class="col-form-label">Capacity</label>
                        <input type="text" class="form-control" id="input-capacity" name="capacity" placeholder="Capacity" required="">
                    </div>
                    <div class="form-group">
                        <label for="label" class="col-form-label">Label</label>
                        <input type="text" class="form-control" id="input-label" name="label" placeholder="Label" required="">
                    </div>
                    <div class="form-group">
                        <label for="regional" class="col-form-label">Regional</label>
                        <input type="text" class="form-control" id="input-regional" name="regional" placeholder="Regional" required="">
                    </div>
                    <div class="form-group">
                        <label for="link" class="col-form-label">Link</label>
                        <input type="text" class="form-control" id="input-link" name="link" placeholder="Link" required="">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Capacity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>