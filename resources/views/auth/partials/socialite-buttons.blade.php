<div class="row g-3 mb-7">
    <div class="col-12">
        <a href="{{ route('oauth.create', 'google') }}" class="btn btn-flex flex-center btn-light-primary btn-lg w-100 mb-5">
            <img alt="Logo" src="{{ asset('admin/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3"/>
            Continue with Google
        </a>
    </div>
    <div class="col-12 d-none">
        <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
            <img alt="Logo" src="{{ asset('admin/media/svg/brand-logos/apple-black.svg') }}" class="theme-light-show h-15px me-3"/>
            <img alt="Logo" src="{{ asset('admin/media/svg/brand-logos/apple-black-dark.svg') }}" class="theme-dark-show h-15px me-3"/>
            Continue with Apple
        </a>
    </div>
</div>
<div class="separator separator-content my-10">
    <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
</div>
