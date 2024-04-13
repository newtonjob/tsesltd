<x-app title="Reports" :links="['Admin', 'Reports']">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-toolbar  pb-7">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 "></div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <button class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#stock-report-modal">
                            <i class="ki-duotone ki-exit-down fs-2">
                                <i class="path1"></i><i class="path2"></i>
                            </i>
                            Download Stock Report
                        </button>
                    </div>
                </div>
            </div>
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="row g-5 g-xl-8">
                        <div class="col-md-3">
                            <div class="card bg-danger card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <span class="symbol symbol-35px me-2">
                                        <span class="symbol-label bg-white">
                                            <i class="ki-duotone ki-shop text-danger fs-2x">
                                                <i class="path1"></i><i class="path2"></i><i class="path3"></i>
                                                <i class="path4"></i><i class="path5"></i>
                                            </i>
                                        </span>
                                    </span>
                                    <div class="text-white fw-bold fs-2 my-2">{{ $locations->count() }}</div>
                                    <div class="fw-semibold text-white">Locations</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <span class="symbol symbol-35px me-2">
                                        <span class="symbol-label bg-white">
                                            <i class="ki-duotone ki-lots-shopping fs-2x text-warning">
                                                <i class="path1"></i><i class="path2"></i><i class="path3"></i><i class="path4"></i>
                                                <i class="path5"></i><i class="path6"></i><i class="path7"></i><i class="path8"></i>
                                            </i>
                                        </span>
                                    </span>
                                    <div class="text-white fw-bold fs-2 my-2">{{ number_format($stock) }}</div>
                                    <div class="fw-semibold text-white">Current Stock Quantity</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary card-xl-stretch mb-5 mb-xl-8">
                                <div class="card-body text-white">
                                    <span class="symbol symbol-35px me-2">
                                        <span class="symbol-label bg-white">
                                            <i class="ki-duotone ki-tag text-primary fs-2x">
                                                <i class="path1"></i><i class="path2"></i><i class="path3"></i>
                                            </i>
                                        </span>
                                    </span>
                                    <div class="fw-bold fs-2 my-2">₦{{ number_format($stockValue) }}</div>
                                    <div class="fw-semibold">Current Stock Value</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success card-xl-stretch mb-5 mb-xl-8">
                                <div class="card-body text-white">
                                     <span class="symbol symbol-35px me-2">
                                        <span class="symbol-label bg-white">
                                            <i class="ki-duotone ki-graph-up text-success fs-2x">
                                                <i class="path1"></i><i class="path2"></i><i class="path3"></i>
                                                <i class="path4"></i><i class="path5"></i><i class="path6"></i>
                                            </i>
                                        </span>
                                    </span>
                                    <div class="fw-bold fs-2 my-2">₦{{ number_format($stockProfit) }}</div>
                                    <div class="fw-semibold">Current Stock Profit Value</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-3">
                            <div class="card bg-body card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <div class="card-title fw-bold text-danger fs-5">Today's Sales</div>
                                    <div class="fw-bold fs-2 mb-2 mt-7">
                                        <i class="ki-duotone ki-arrow-up fs-2 text-danger ms-n1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        ₦{{ number_format($todaySales) }}
                                    </div>
                                    <div class="fw-semibold text-gray-400">
                                        Profit value: ₦{{ number_format($todayProfit) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card bg-body card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <div class="card-title fw-bold text-warning fs-5">This Week Sales</div>
                                    <div class="fw-bold fs-2 mb-2 mt-7">
                                        <i class="ki-duotone ki-arrow-up fs-2 text-warning ms-n1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        ₦{{ number_format($weekSales) }}
                                    </div>
                                    <div class="fw-semibold text-gray-400">Profit value: ₦{{ number_format($weekProfit) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card bg-body card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <div class="card-title fw-bold text-primary fs-5">This Month Sales</div>
                                    <div class="fw-bold fs-2 mb-2 mt-7">
                                        <i class="ki-duotone ki-arrow-up fs-2 text-primary ms-n1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        ₦{{ number_format($monthSales) }}
                                    </div>
                                    <div class="fw-semibold text-gray-400">Profit value: ₦{{ number_format($monthProfit) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card bg-body card-xl-stretch mb-xl-8">
                                <div class="card-body">
                                    <div class="card-title fw-bold text-success fs-5">2023 Sales</div>
                                    <div class="fw-bold fs-2 mb-2 mt-7">
                                        <i class="ki-duotone ki-arrow-up fs-2 text-success ms-n1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                        ₦{{ number_format($yearSales) }}
                                    </div>
                                    <div class="fw-semibold text-gray-400">
                                        Profit value: ₦{{ number_format($yearProfit) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-5 g-xl-8">
                        <div class="col-12">
                            <div class="card card-flush">
                                <div class="card-header pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Revenue Statistics</span>
                                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Monthly sales income</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <div class="d-flex flex-end">
                                            <button class="btn btn-sm fw-bold btn-linkedin" data-bs-toggle="modal" data-bs-target="#sales-report-modal">
                                                <i class="ki-duotone ki-exit-down fs-2">
                                                    <i class="path1"></i><i class="path2"></i>
                                                </i>
                                                Download Sales Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                                    <div id="revenue-chart" class="min-h-auto ps-4 pe-6" style="height: 500px"
                                         data-values="{{ $incomeStatistics->values() }}" data-keys="{{ $incomeStatistics->keys() }}"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
    <!--Stock Report Modal-->
    <div class="modal fade" id="stock-report-modal" tabindex="-1" aria-labelledby="stock-report-modal-label" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-gray-800">Download Stock Report</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-abstract-11 fs-1"><i class="path1"></i><i class="path2"></i></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('stock-export') }}">
                        <label class="required form-label" for="location">Location</label>
                        <select class="form-select mb-5" name="location_id[]" data-control="select2" data-placeholder="All Locations" multiple id="location">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-muted fs-7 mb-7">Stock report will be downloaded in CSV Excel format.</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ki-duotone ki-exit-down fs-2"><i class="path1"></i><i class="path2"></i></i>Download
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Sales Report Modal-->
    <div class="modal fade" id="sales-report-modal" tabindex="-1" aria-labelledby="sales-report-modal-label" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-gray-800">Download Sales Report</h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-abstract-11 fs-2"><i class="path1"></i><i class="path2"></i></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sales-export') }}">
                        <div class="text-muted fs-7 mb-4">Sales report will be downloaded in CSV Excel format.</div>
                        <div>
                            <label class="required form-label" for="user">Sales By</label>
                            <select class="form-select mb-7" name="user_id[]" data-control="select2" multiple data-placeholder="All" data-hide-search="true" id="user">
                                @foreach($administrators as $administrator)
                                    <option value="{{ $administrator->id }}">{{ $administrator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-5 fw-semibold form-label mb-5">Select Date Range:</label>
                            <div class="form-control frm-control-solid" id="date" readonly></div>
                            <input name="from" type="hidden" id="from">
                            <input name="to" type="hidden" id="to">
                        </div>
                        <div class="form-group mb-7">
                            <label class="form-label" for="product_id">Select Products <small>(Optional)</small></label>
                            <select class="form-control" id="product_id" name="product_id[]" data-placeholder="All Products" data-control="select2" multiple>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer mt-10">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ki-duotone ki-exit-down fs-2"><i class="path1"></i><i class="path2"></i></i>Download
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('admin/js/views/reports/index.js') }}"></script>
    @endpush
</x-app>
