<!--begin:: Edit type Modal-->
<div class="modal fade" id="edit-type-modal" tabindex="-1" aria-labelledby="edit-type-modal-label" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Account Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form x-data x-submit action="{{ route('api.users.update', $user) }}" id="edit-type-form" method="POST" @finish="location.reload()">
                    @method('put')
                    <div class="mb-10">
                        <label class="form-label" for="type">Change to</label>
                        <select class="form-control" name="type" id="type">
                            <option></option>
                            <option value="admin" @selected($user->isAdmin())>Admin</option>
                            <option value="customer" @selected($user->isCustomer())>Customer</option>
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
<!--end:: Edit type Modal-->
