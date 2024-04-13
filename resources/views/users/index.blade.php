<x-app title="{{ $type = request()->type == 'admin' ? 'Administrators' : 'Customers' }}" :links="['Admin', 'Users', $type]">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"/>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search User" aria-label="search">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createUser">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"/>
                                                <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"/>
                                            </svg>
                                        </span>
                                        New {{ str($type)->singular() }}
                                    </button>
                                    @if(request()->type === 'admin' && user()->isSuperAdmin())
                                        <a href="{{ route('roles.index') }}" class="btn btn-light-success">
                                            Manage Roles
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" data-table data-search-using="#search">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        @if(request()->type === 'admin')
                                            <th>Role</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Gender</th>
                                        <th>Orders</th>
                                        <th>Phone Number</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="{{ route('users.show', $user) }}">
                                                        <div class="symbol-label">
                                                            <img src="{{ $user->photo }}" alt="Customer" class="w-100">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('users.show', $user) }}" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('users.show', $user) }}" class="text-gray-600 text-hover-primary mb-1">{{ $user->email ?? 'None' }}</a>
                                            </td>
                                            @if(request()->type === 'admin')
                                                <td>
                                                    <div
                                                        @class(['badge',
                                                            'badge-light-primary' => $user->isSuperAdmin(),
                                                            'badge-light-warning' => $user->role === null,
                                                            'badge-light-success' => ! $user->isSuperAdmin(),
                                                        ])>
                                                        {{ $user->role ? $user->role->name : 'None' }}
                                                    </div>
                                                </td>
                                            @endif
                                            <td>
                                                <div @class([
                                                    'badge',
                                                    'badge-light-danger'    => $user->isBanned(),
                                                    'badge-light-success'   => ! $user->isBanned()
                                                ])>
                                                    {{ $user->isBanned() ? 'Suspended' : 'Active' }}
                                                </div>
                                            </td>
                                            <td>{{ $user->gender }}</td>
                                            <td data-order="{{ $user->orders_count }}">
                                                <a href="{{ route('users.orders.index', $user) }}">{{ $user->orders_count }}</a>
                                            </td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--begin::Modal - Create User-->
                    <div class="modal fade" id="createUser" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form x-submit action="{{ route('api.users.store') }}">
                                    <div class="modal-header">
                                        <h2 class="fw-bold">Create New {{ str($type)->singular() }}</h2>
                                        <div id="createUser_close" class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal" aria-label="Close">
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="modal-body py-10 px-lg-17">
                                        <div class="me-n7 pe-7">
                                            <div class="row">
                                                <div class="col-md-6 mb-6">
                                                    <input name="type" type="hidden" value="{{ request()->type }}">
                                                    <input name="first_name" placeholder="First Name" class="form-control" aria-label="first name" required>
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    <input name="last_name" placeholder="Last Name" class="form-control" aria-label="last name">
                                                </div>
                                            </div>
                                            <div class="fv-row mb-6">
                                                <input name="email" type="email" placeholder="Email Address" class="form-control" aria-label="email">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-6">
                                                    <input name="phone" type="tel" placeholder="Phone Number" class="form-control" aria-label="phone" required>
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    <select name="gender" class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Gender" aria-label="gender" required>
                                                        <option></option>
                                                        <option value="M">male</option>
                                                        <option value="F">female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @if(request()->type === 'admin')
                                                <div class="fv-row mb-6">
                                                    <select name="role_id" data-control="select2" data-placeholder="Select an Admin Role" data-hide-search="true" class="form-select" required>
                                                        <option></option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer flex-center">
                                        <button type="submit" class="btn btn-primary mb-10">
                                            <i class="fa fa-user-circle"></i> Create {{ str($type)->singular() }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
</x-app>
