<x-app title="Transfer t{{ $transfer->id }}" :links="['Admin', 'Transfer', 't'.$transfer->id]">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                            <a href="{{ route('transfers.index') }}"
                               class="btn btn-icon btn-light btn-sm ms-auto me-lg-n7">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </a>
                            <a href="{{ route('transfers.waybill.show', $transfer) }}" class="btn btn-primary btn-sm">Get Waybill</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="transfer_details" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4 flex-row-fluid">
                                        <div class="card-header border-0 cursor-pointer" role="button">
                                            <div class="card-title">
                                                <h2>Transfer Information</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th class="min-w-100px">Transfer id</th>
                                                            <th class="min-w-150px">Initiated by</th>
                                                            <th class="min-w-100px">Transfer Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-700">
                                                        <tr>
                                                            <td>{{ sprintf("%04d",$transfer->id) }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                        <a href="{{ route('users.show', $transfer->creator) }}">
                                                                            <div class="symbol-label">
                                                                                <img src="{{ $transfer->creator->photo }}" alt="{{ $transfer->creator->name }}" class="w-100" />
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <div class="ms-5">
                                                                        <a href="{{ route('users.show', $transfer->creator) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                                            {{ $transfer->creator->name }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{ $transfer->created_at->format('d M Y, h:i a') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-7 gap-lg-10 mt-5">
                                    <div class="card card-flush py-4 flex-row-fluid">
                                        <div class="card-header border-0 cursor-pointer" role="button">
                                            <div class="card-title">
                                                <h2>Transfer Details</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th class="min-w-125x">Product</th>
                                                            <th class="min-w-100px">Location From</th>
                                                            <th class="min-w-100px">Location To</th>
                                                            <th class="min-w-75px">Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($transfer->products as $product)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="symbol symbol-50px">
                                                                            <span class="symbol-label" style="background-image:url({{ $product->image?->thumbnail }});">
                                                                            </span>
                                                                        </span>
                                                                        <div class="ms-5">
                                                                            <span class="text-gray-600">{{ $product->name }}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $product->pivot->from_location->name }}</td>
                                                                <td>{{ $product->pivot->to_location->name }}</td>
                                                                <td>{{ $product->pivot->quantity }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <!--end::Main-->
</x-app>
