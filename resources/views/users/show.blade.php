<x-app title="Profile" :links="['Home', 'Profile']">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <!--begin::Navbar-->
                <div class="card card-flush mb-9" id="user_profile_panel">
                    <!--begin::Hero nav-->
                    <div class="card-header rounded-top bgi-size-cover h-200px" style="background-position: 100% 50%; background-image: url('{{ asset('admin/media/misc/profile-head-bg.jpg') }}');"></div>
                    <!--end::Hero nav-->
                    <!--begin::Body-->
                    <div class="card-body mt-n19">
                        <!--begin::Details-->
                        <div class="m-0">
                            <!--begin: Pic-->
                            <div class="d-flex flex-stack align-items-end pb-4 mt-n19">
                                <!--begin::Image input-->
                                <form action="{{ route('api.users.update', $user) }}" id="photo-form"
                                      method="POST" class="form" x-data x-submit @finish="location.reload()"
                                      enctype="multipart/form-data" @change="$dispatch('submit')"
                                >
                                    @method('PUT')
                                    <div class="image-input image-input-outline symbol symbol-125px symbol-lg-150px symbol-fixed position-relative mt-n3">
                                        <img src="{{ $user->photo }}" alt="image" class="border border-white border-4 rounded-circle"/>
                                        <div class="position-absolute translate-middle bottom-0 start-100 ms-n3 mb-9 bg-success rounded-circle h-15px w-15px"></div>
                                        <!--begin::Label-->
                                        <label class="position-absolute translate-middle bottom-0 start-100 ms-n8 my-5 btn btn-icon btn-circle btn-active-color-primary w-30px h-30px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Photo">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input id="photo" type="file" name="photo" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                </form>
                                <!--end::Image input-->
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="d-flex flex-stack flex-wrap align-items-end">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">
                                            {{ $user->name }}
                                        </a>
                                        <x-users.badge :$user />
                                        @if($user->isBanned())
                                            <span class="badge badge-danger">Suspended</span>
                                        @endif
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Text-->
                                    <span class="fw-bold text-gray-600 fs-6 mb-2 d-block">
                                        {{ $user->email }}
                                        <x-users.verification-badge :$user />
                                    </span>
                                    <!--end::Text-->
                                    <!--begin::Info-->
                                    <div class="d-flex align-items-center flex-wrap fw-semibold fs-7 pe-2">
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary">
                                            {{ $user->phone }}
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                                <a href="{{ route('users.orders.index', $user) }}" class="btn btn-sm btn-light-info m-3 fw-bold">
                                    <span class="svg-icon svg-icon-muted svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M20 22H4C3.4 22 3 21.6 3 21V2H21V21C21 21.6 20.6 22 20 22Z" fill="currentColor"/>
                                            <path d="M12 14C9.2 14 7 11.8 7 9V5C7 4.4 7.4 4 8 4C8.6 4 9 4.4 9 5V9C9 10.7 10.3 12 12 12C13.7 12 15 10.7 15 9V5C15 4.4 15.4 4 16 4C16.6 4 17 4.4 17 5V9C17 11.8 14.8 14 12 14Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    View Orders
                                </a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Nav items-->
                <div class="rounded bg-gray-200 d-flex flex-stack flex-wrap mb-9 p-2">
                    <!--begin::Nav-->
                    <ul class="nav flex-wrap border-transparent">
                        <!--begin::Nav item-->
                        <li class="nav-item my-1">
                            <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1 active" data-bs-toggle="tab" href="#profile">
                                Profile
                            </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item my-1">
                            <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" data-bs-toggle="tab" href="#account-status">
                                Account Status
                            </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item my-1">
                            <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" data-bs-toggle="tab" href="#change-password">
                                Change Password
                            </a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item my-1">
                            <a class="btn btn-sm btn-color-gray-600 bg-state-body btn-active-color-gray-800 fw-bolder fw-bold fs-6 fs-lg-base nav-link px-3 px-lg-4 mx-1" data-bs-toggle="tab" href="#advanced">
                                Advanced
                            </a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Nav items-->
                <div class="tab-content">
                    <!--begin::Basic info-->
                    <div id="profile" class="tab-pane active">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Profile Details</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div class="collapse show">
                                <form action="{{ route('api.users.update', $user) }}" method="POST" class="form" x-data x-submit>
                                    @method('PUT')
                                    <div class="card-body border-top p-9">
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="fname">Full Name</label>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-6 fv-row">
                                                        <input id="fname" name="first_name" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{ $user->first_name }}" required>
                                                    </div>
                                                    <div class="col-lg-6 fv-row">
                                                        <input name="last_name" type="text" class="form-control form-control-lg form-control-solid" placeholder="Last name" value="{{ $user->last_name }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="email">Email</label>
                                            <div class="col-lg-8 fv-row">
                                                <input id="email" name="email" type="email" class="form-control form-control-lg form-control-solid" placeholder="Email address" value="{{ $user->email }}" required>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="gender">Gender</label>
                                            <div class="col-lg-8 fv-row">
                                                <select id="gender" name="gender" class="form-control form-select form-select-solid form-select-lg fw-semibold" data-control="select2" data-hide-search="true" required>
                                                    <option value="M" @selected($user->gender->isMale())>Male</option>
                                                    <option value="F" @selected($user->gender->isFemale())>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6" for="phone">
                                                <span class="required">Contact Phone</span>
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
                                            </label>
                                            <div class="col-lg-8 fv-row">
                                                <input id="phone" name="phone" type="tel" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="{{ $user->phone}}" required>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button type="submit" class="btn btn-primary">Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                    <div id="account-status" class="tab-pane">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header card-header-stretch border-bottom border-gray-200">
                                <!--begin::Title-->
                                <div class="card-title">
                                    <h3 class="fw-bold m-0">Account Status</h3>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tab panel-->
                                <div class="card-body p-0 tab-pane fade show active">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-bordered align-middle gy-4 gs-9">
                                            <thead class="border-bottom border-gray-200 fs-6 text-gray-600 fw-bold bg-light bg-opacity-75">
                                            <tr>
                                                <th class="min-w-125px">Last Login</th>
                                                <th class="min-w-125px">Login count</th>
                                                <th class="min-w-125px">Status</th>
                                                <th class="min-w-200px"></th>
                                            </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                            <!--begin::Table row-->
                                            <tr>
                                                <td>{{ $user->last_login?->format('d M Y, h:i a') ?? 'None' }}</td>
                                                <td>{{ $user->login_count }}</td>
                                                @if($user->isBanned())
                                                    <td><span class="badge badge-light-danger">Suspended</span></td>
                                                    <td>
                                                        @can('create', $user, 'admin')
                                                            <form action="{{ route('api.users.update', $user) }}" method="POST" x-data x-submit @finish="location.reload()">
                                                                @method('put')
                                                                <input type="hidden" name="banned_until" value="{{ null }}">
                                                                <button class="btn btn-success btn-active-light-primary btn-sm">
                                                                    <i class="fa fa-unlock"></i> Reactivate Account
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                @else
                                                    <td>
                                                        <div class="badge badge-light-success">Active</div>
                                                    </td>
                                                    <td>
                                                        @can('create', $user, 'admin')
                                                            <form action="{{ route('api.users.update', $user) }}" method="POST" x-data x-submit @finish="location.reload()" data-confirm>
                                                                @method('put')
                                                                <input type="hidden" name="banned_until" value="{{ now()->addCentury() }}">
                                                                <button class="btn btn-danger btn-active-light-primary btn-sm">
                                                                    <i class="fa fa-lock"></i> Suspend Account
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                @endif
                                            </tr>
                                            <!--end::Table row-->
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tab panel-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                    </div>
                    <!--end::Basic info-->
                    <!--begin::Basic info-->
                    <div id="change-password" class="tab-pane">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Change Password</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div class="collapse show">
                                <!--begin::Form-->
                                <form id="password-form" action="{{ route('api.users.update', $user) }}" method="POST" class="form" x-data x-submit @finish="location.reload()">
                                    @method('PUT')
                                    <!--begin::Card body-->
                                    <div class="card-body border-top p-9">
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="current_password">
                                                Current Password
                                            </label>
                                            <div class="col-lg-8 fv-row">
                                                <input id="current_password" name="current_password" type="password" class="form-control form-control-lg form-control-solid" required>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6" for="password">
                                                <span class="required">New Password</span>
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Password must contain a minimum of 8 characters, both uppercase and lower case letters, and numbers"></i>
                                            </label>
                                            <div class="col-lg-8 fv-row">
                                                <input id="password" name="password" type="password" class="form-control form-control-lg form-control-solid" required>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6" for="password_confirmation">
                                                Confirm New Password
                                            </label>
                                            <div class="col-lg-8 fv-row">
                                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control form-control-lg form-control-solid" required>
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Actions-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Content-->
                        </div>
                    </div>
                    <!--end::Basic info-->
                    <!--begin::Basic info-->
                    <div id="advanced" class="tab-pane">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header card-header-stretch border-bottom border-gray-200">
                                <!--begin::Title-->
                                <div class="card-title">
                                    <h3 class="fw-bold m-0">Advanced</h3>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tab panel-->
                                <div class="card-body tab-pane fade show active">
                                    <div class="rounded border border-dashed border-gray-300 p-6 mt-3 mb-10">
                                            <div class="d-md-flex flex-stack">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <div class="fw-bold fs-4 mb-1 me-1">Notifications</div>
                                                    </div>
                                                    <div class="fw-semibold fs-6 text-gray-700 mb-4 me-3">Receive email notifications whenever activities happen, e.g New orders, payment notifications etc.</div>
                                                </div>

                                                <div class="text-nowrap">
                                                    <form action="{{ route("api.users.update", $user) }}" x-submit
                                                          x-data @change="$dispatch('submit')"
                                                    >
                                                        @method('put')

                                                        <div class="form-check form-switch form-check-solid">
                                                            <input type="hidden" name="notifiable" value="0">
                                                            <input class="form-check-input h-30px w-50px" name="notifiable" type="checkbox" value="1" @checked($user->notifiable)/>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @can('create', $user, 'admin')
                                        <div class="rounded border border-dashed border-gray-300 p-6 mt-3 mb-10">
                                            <div class="d-md-flex flex-stack">
                                                <div class="d-flex flex-column">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <div class="fw-bold fs-4 mb-1 me-1">Change Account Type</div>
                                                    </div>
                                                    <div class="fw-semibold fs-6 text-gray-700 mb-4 me-3">Change the user account type to an admin or customer. When next they log in, the experience and privileges will change.</div>
                                                </div>

                                                <div class="text-nowrap">
                                                    <a href="#edit-type-modal" data-bs-toggle="modal" class="btn btn-primary">Change Account Type</a>
                                                </div>
                                            </div>
                                        </div>
                                        @admin($user)
                                            <div class="rounded border border-dashed border-gray-300 p-6 mb-10">
                                                <div class="d-md-flex flex-stack">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <div class="fw-bold fs-4 mb-1 me-1">Change Role</div>
                                                        </div>
                                                        <div class="fw-semibold fs-6 text-gray-700 me-3 mb-4">Assign this admin account another role.</div>
                                                    </div>

                                                    <div class="text-nowrap">
                                                        <a href="#edit-role-modal" data-bs-toggle="modal" class="btn btn-primary">Change Role</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endadmin
                                    @endcan
                                    <div class="rounded border border-dashed border-gray-300 p-6 mt-3 mb-10">
                                        <div class="d-md-flex flex-stack">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-1">
                                                    <div class="fw-bold fs-4 mb-1 me-1">Delete Account</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-700 mb-4 me-3">{{ ! user()->is($user) ? 'Permanently delete this user account. The user will no
                                                    longer have access to Bensu with their credentials.' : 'Permanently delete your account. This will deny you any access to Bensu with your present credentials.' }}</div>
                                            </div>
                                            <div class="text-nowrap">
                                                <form action="{{ route('api.users.destroy', $user) }}" method="POST" data-confirm="Are you sure you want to delete this account?" x-submit x-data @finish="location.href = @js(route('dashboard'))"
                                                >
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete account</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Tab panel-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                    </div>
                    <!--end::Basic info-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    @include('users.partials.edit-type-modal')
    @include('users.partials.edit-role-modal')
</x-app>
