<x-guest-layout>

    <x-jet-validation-errors class="mb-3 rounded-0" />

    @if (session('status'))
        <div class="alert alert-success mb-3 rounded-0" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
        action="{{ route('login') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">Inicia sesión</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">Nuevo aquí? 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="link-primary fw-bolder">Crea una cuenta</a>
                @endif
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input
                class="form-control form-control-lg form-control-solid {{ $errors->has('email') ? 'is-invalid' : '' }}"
                type="email" name="email" :value="old('email')" required autocomplete="off" />
            <x-jet-input-error for="email"></x-jet-input-error>
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                <!--end::Label-->
                <!--begin::Link-->
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">{{ __('Forgot your password?') }}</a>
                @endif
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Input-->
            <input
                class="form-control form-control-lg form-control-solid mb-2 {{ $errors->has('password') ? ' is-invalid' : '' }}"
                type="password" name="password" required autocomplete="current-password" />
            <x-jet-input-error for="password"></x-jet-input-error>
            <!--end::Input-->

            <div class="my-3">
                <div class="custom-control custom-checkbox">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <label class="custom-control-label" for="remember_me">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button  class="btn btn-lg btn-primary fw-bolder me-3 my-2 w-100">
                <span class="indicator-label">Sign In</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Submit button-->
        </div>
        <!--end::Actions-->
    </form>

</x-guest-layout>
