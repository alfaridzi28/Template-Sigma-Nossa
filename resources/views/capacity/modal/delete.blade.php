<!-- Modal -->
<div class="modal fade" id="deleteModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="#" method="post" class="" id="delete-form">
                @csrf
                @method('delete')
                <div class="row text-center">
                    <div class="modal-body">
                        Are you sure you want to delete this data?
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>