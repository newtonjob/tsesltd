 <!--begin:: Edit role Modal-->
    <div class="modal fade" id="edit-role-modal" tabindex="-1" aria-labelledby="edit-role-modal-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Admin Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form x-data x-submit action="{{ route('api.users.update', $user) }}" id="edit-role-form" method="POST" @finish="location.reload()">
                        @method('put')
                        <div class="mb-10">
                            <label class="form-label" for="role_id">Select New Role</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option></option>
                                @foreach($roles ?? [] as $role)
                                    <option value="{{ $role->id }}" @selected($role->is($user->role))>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Apply changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end:: Edit role Modal-->
