<x-app title="Point of Sale"  :links="['Admin', 'Point of Sale']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <livewire:pos />
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
     </div>
    <!--end:::Main-->

    @push('scripts')
        <script src="{{ asset('admin/js/custom/pages/general/pos.js') }}"></script>
    @endpush
</x-app>
