<!-- Modal -->
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('user.update', 'test') }}" method="post">
                    @method('put')
                    @csrf

                    <input type="hidden" name="id" id="input-id" value="" />

                    <div class="form-group">
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" id="input-username" class="form-control" name="username" placeholder="Username"
                            value="{{ old('username') }}" required="" disabled>
                    </div>

                    <div class="form-group" {{-- {{ old('ldap') == true ? 'style="display: none"' : '' }} --}} >
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" id="input-password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <input type="text" id="input-description" class="form-control" name="description" placeholder="Description"
                            value="{{ old('description') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role</label>
                        <select id="input-role" class="form-control" name="role" required>
                            <option selected>Choose Role...</option>
                            <option value="superadmin">Superadmin</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="dso">DSO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status</label>
                        <select id="input-active" class="form-control" name="active">
                            <option value="1">Active</option>
                            <option value="0">In-active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description-status" class="col-form-label">Discription Status</label>
                        <input type="text" class="form-control" id="input-active-reason" placeholder="Discription Status"
                            name="active_reason" placeholder="(Fill as user's inactive reason)" value="{{ old('active_reason', '') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="module" class="col-form-label">Modul</label>
                        <select id="input-module" name="module[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Modul">
                            @foreach ($submodules as $submodule)
                            <option value="{{ $submodule->slug }}">
                                {{ $submodule->slug }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>