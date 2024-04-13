<x-app title="Roles" :links="['Admin', 'Roles']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                        @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="card card-flush h-md-100">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ $role->name }}</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-1">
                                        <div class="fw-bold text-gray-600 mb-5">Total users with this role: {{ $role->users_count }}</div>
                                        <div class="d-flex flex-column text-gray-600">
                                            @foreach($role->abilities->take(5) as $ability)
                                                <div class="d-flex align-items-center py-2">
                                                    <span class="bullet bg-primary me-3"></span>
                                                    {{ $ability }}
                                                </div>
                                            @endforeach
                                            @if(count($role->abilities) > 5)
                                                <div class='d-flex align-items-center py-2'><span class='bullet bg-primary me-3'></span> <em>and {{ count($role->abilities) - 5 }} more...</em></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer flex-wrap pt-0">
                                        <a href="{{ route('roles.show', $role) }}" class="btn btn-light btn-active-primary my-1 me-2">Edit Role</a>
                                        <button type="submit" form="delete-role-form" class="btn btn-light-danger btn-active-danger my-1">Delete Role</button>
                                        <form x-data x-submit id="delete-role-form" action="{{ route('api.roles.destroy', $role) }}" method="POST" @finish="location.reload()" data-confirm="Are you sure you want to delete this role?">
                                            @method('delete')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="ol-md-4">
                            <div class="card h-md-100">
                                <div class="card-body d-flex flex-center">
                                    <button id="add-role-drawer-toggle" type="button" class="btn btn-clear d-flex flex-column flex-center">
                                        <img src="{{ asset('admin/media/illustrations/sketchy-1/4.png') }}" alt="" class="mw-100 mh-150px mb-7"/>
                                        <span class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
    <!--begin:: Add role drawer-->
    <div  id="add-role-drawer"
          class="bg-body"
          data-kt-drawer="true"
          data-kt-drawer-name="add-role"
          data-kt-drawer-activate="true"
          data-kt-drawer-width="{default:'100%', 'md': '450px'}"
          data-kt-drawer-toggle="#add-role-drawer-toggle"
          data-kt-drawer-close="#add-role-drawer-close"
    >
        <!--begin::Card-->
        <div class="card shadow-none rounded-0 w-100">
            <!--begin::Header-->
            <div class="card-header" id="add-role-header">
                <h3 class="card-title fw-bold text-gray-700">
                    Create Role
                </h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary h-40px w-40px me-n6" id="add-role-drawer-close">
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body" id="add-role-body">
                <!--begin::Content-->
                <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#add-role-body" data-kt-scroll-dependencies="#add-role-header" data-kt-scroll-offset="5px">
                    <!--begin::Wrapper-->
                    <div class="mb-0">
                        <form x-data x-submit action="{{ route('api.roles.store') }}" id="add-role-form" method="POST" @finish="location.reload()">
                            <div class="mb-10">
                                <label class="form-label text-gray-700" for="name">Role Name</label>
                                <input id="name" class="form-control form-control-solid" type="text" name="name" required>
                            </div>
                            <div class="mb-10">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class="text-start text-gray-700 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Abilities</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($abilities as $ability)
                                            <tr>
                                                <td>
                                                    <label class="form-check-label" for="ability-{{ $loop->index }}">
                                                        {{ $ability }}
                                                    </label>
                                                </td>
                                                <td class="form-check form-switch form-check-solid">
                                                    <input class="form-check-input h-20px w-45px" name="abilities[]" type="checkbox" value="{{ $ability->value }}" id="ability-{{ $loop->index }}" checked/>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary fw-bold mb-15 w-100">
                                Create Role
                            </button>
                        </form>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end:: Add role drawer-->
</x-app>
