@if(! user()->hasVerifiedEmail())
    <div class="mb-9 px-9">
        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-4">
            <!--begin::Icon-->
            <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
            </i>
            <!--end::Icon-->
            <div class="d-flex flex-stack flex-grow-1 ">
                <div class=" fw-semibold">
                    <h4 class="text-gray-900 fw-bold">Verification Alert!</h4>
                    <form action="{{ route('api.verification.resend') }}" x-submit>
                        <div class="fs-6 text-gray-700 ">Your profile isn't verified yet. Please click the link we sent to your email to verify. Can't find the link? &nbsp;
                            <button class="btn text-primary btn-link fw-bold" type="submit">Resend verification link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
