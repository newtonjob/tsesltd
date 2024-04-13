<x-auth>
    <form method="post" action="{{ route('api.password.reset') }}"
                  x-data x-submit @finish="location.reload()"
            >
                <div class="text-center mb-11">
                    <h1 class="text-dark fw-bolder mb-3"> Create a New Password</h1>

                    <div class="text-gray-500 fw-semibold fs-6">
                        Let's set up a fresh password for you.
                    </div>
                </div>

                <div class="fv-row mb-8">
                    <input type="text" value="{{ request('email') }}" readonly name="email"
                           class="form-control bg-transparent" aria-label="email" required
                    />
                </div>

                <div class="fv-row mb-8">
                    <input type="password" placeholder="Set a new Password" name="password" required
                           class="form-control bg-transparent" aria-label="password"
                    />
                </div>

                <div class="fv-row mb-8">
                    <input type="password" placeholder="Confirm your Password" name="password_confirmation" required
                           class="form-control bg-transparent" aria-label="password_confirmation"
                    />
                </div>

                <input type="hidden" name="token" value="{{ request('token') }}">

                <div class="d-grid mb-10">
                    <button type="submit" class="btn btn-primary">
                        Set new Password
                    </button>
                </div>

                <div class="text-gray-500 text-center fw-semibold fs-6">
                    <a href="{{ route('login') }}" class="link-primary fw-semibold">
                        Back to Login?
                    </a>
                </div>
            </form>
</x-auth>
