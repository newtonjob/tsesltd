<x-auth>
    <form id="signup-form" action="{{ route('api.register') }}" class="form w-100" x-data x-submit
          @finish="location.reload()">
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
            <!--end::Title-->
        </div>

        @include('auth.partials.socialite-buttons')

        <div class="row">
            <!--begin::Input group--->
            <div class="col-md-6 mb-6">
                <input id="first-name" name="first_name" type="text" placeholder="First Name" class="form-control bg-transparent" required/>
            </div>
            <!--end::Input group--->
            <!--begin::Input group--->
            <div class="col-md-6 mb-6">
                <input id="last-name" name="last_name" type="text" placeholder="Last Name" class="form-control bg-transparent" required/>
            </div>
            <!--end::Input group--->
        </div>
        <!--begin::Input group--->
        <div class="fv-row mb-6">
            <!--begin::Email-->
            <input id="email" name="email" type="email" placeholder="Email" class="form-control bg-transparent" required/>
            <!--end::Email-->
        </div>
        <!--end::Input group--->
        <div class="row">
            <!--end::Input group--->
            <div class="col-md-6 mb-6">
                <select id="gender" name="gender" class="form-select bg-transparent" required>
                    <option value="M">male</option>
                    <option value="F">female</option>
                </select>
            </div>
            <!--end::Input group--->
            <!--end::Input group--->
            <div class="col-md-6 mb-6">
                <input id="phone" name="phone" type="tel" placeholder="Phone Number"
                       class="form-control bg-transparent" required/>
            </div>
            <!--end::Input group--->
        </div>
        <!--begin::Input group-->
        <div class="fv-row mb-6" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input id="password" name="password" type="password" class="form-control bg-transparent" placeholder="Password"/>
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group--->
        <!--begin::Input group-->
        <div class="fv-row mb-6" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input id="password-confirmation" name="password_confirmation" type="password" class="form-control bg-transparent" placeholder="Confirm Password"/>
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--end::Input wrapper-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Input group--->
        <!--begin::Accept-->
        <div class="fv-row mb-6">
            <label class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="" value=""/>
                <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                    I Accept the <a href="#" class="ms-1 link-primary">Terms</a>
                </span>
            </label>
        </div>
        <!--end::Accept-->
        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-user-circle"></i> Create Account
            </button>
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Already have an Account?
            <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a>
        </div>
        <!--end::Sign up-->
    </form>
</x-auth>
