<x-app title="{{ $role->name }}" :links="['Admin', 'Roles', $role->name ]">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid " >
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <form action="{{ route('api.roles.update', $role) }}" x-data x-submit @finish="location.reload()" method="POST">
                        @method('put')
                        <div class="form-group w-md-50 mb-5">
                            <h4 class="text-gray-600"><label for="name">Role Name</label></h4>
                            <input id="name" class="form-control" type="text" name="name" value="{{ $role->name }}" required>
                        </div>
                        <div class="card">
                            <div class="card-body pt-5">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class="text-start text-gray-600 fw-bold fs-5 text-uppercase">
                                            <th>Ability</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach($abilities as $ability)
                                            <tr>
                                                <td>
                                                    <span class="text-gray-600 text-hover-primary mb-1">{{ $ability }}</span>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">{{ $ability->description() }}</a>
                                                </td>
                                                <td class="form-check form-switch form-check-solid">
                                                    <input class="form-check-input h-20px w-45px" name="abilities[]" type="checkbox" value="{{ $ability->value }}" @checked($role->abilities->contains($ability))/>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-7 mb-5"><hr></div>
                                <div class="text-end p-2">
                                    <button type="submit" class="btn btn-primary">
                                        Apply Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
</x-app>
