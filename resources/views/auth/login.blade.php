<x-auth>
    <div x-data="{ forgot: false, email: '' }">
        <form
            action="{{ route('api.login') }}" method="POST" class="form w-100"
            x-submit @finish="location.reload()"
            x-show="! forgot" x-transition:enter
        >
            <div class="text-center mb-10">
                <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
            </div>

            @include('auth.partials.socialite-buttons')

            <div class="fv-row mb-8">
                <input
                    id="email" type="email" name="email" placeholder="Email"
                    class="form-control bg-transparent" required
                    x-model="email" aria-label="email"
                />
            </div>

            <div class="fv-row mb-8" data-kt-password-meter="true">
                <!--begin::Wrapper-->
                <div class="mb-1">
                    <!--begin::Input wrapper-->
                    <div class="position-relative mb-3">
                        <input id="password" name="password" type="password"
                               class="form-control bg-transparent" placeholder="Password"/>
                        <span
                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                            data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                    </div>
                    <!--end::Input wrapper-->
                </div>
                <!--end::Wrapper-->
            </div>

            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold my-8">
                <div class="">
                    <label for="remember" class="form-check form-check-inline">
                        <input id="remember" name="remember" class="form-check-input" type="checkbox"/>
                        <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">
                            Remember me
                        </span>
                    </label>
                </div>

                <a href="javascript:" class="link-primary" @click="forgot = true">
                    Forgot your password?
                </a>
            </div>

            <div class="d-grid mb-10">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-sign-in-alt"></i> Log In
                </button>
            </div>
            <!--end::Submit button-->
            <!--begin::Sign up-->
            <div class="text-gray-500 text-center fw-semibold fs-6">
                Do not have an account yet?
                <a href="{{ route('register') }}" class="link-primary">Sign Up for free</a>
            </div>
            <!--end::Sign up-->
        </form>
        <form action="{{ route('api.password.forgot') }}" style="display: none"
              class="form w-100" x-submit x-show="forgot" x-transition:enter
        >
            <!--begin::Heading-->
            <div class="text-center mb-11">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder mb-3">
                    Reset Password
                </h1>
                <!--end::Title-->

                <!--begin::Subtitle-->
                <div class="text-gray-500 fw-semibold fs-6">
                    Enter your email address below, we'll email you a special<br> link to reset your
                    password.
                </div>
                <!--end::Subtitle--->
            </div>

            <div class="fv-row mb-8">
                <input type="text" placeholder="Email" name="email" required x-model="email"
                       class="form-control bg-transparent" aria-label="email"/>
            </div>

            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold my-8">
                <div></div>

                <a href="javascript:" @click="forgot = false" class="link-primary">
                    Ready to login?
                </a>
            </div>

            <div class="d-grid mb-10">
                <button type="submit" class="btn btn-primary">
                    Get Password Reset Link
                </button>
            </div>
        </form>
    </div>
</x-auth>
