<span
    @class([
        'fw-bold fs-8 px-2 py-1 ms-2 badge',
        'badge-light-primary' => $user->isSuperAdmin(),
        'badge-light-warning' => $user->isCustomer(),
        'badge-light-success' => ! $user->isSuperAdmin(),
    ])>
    {{ ucwords($user->isAdmin() ? ($user->role ? $user->role->name : 'Admin') : $user->type) }}
</span>
