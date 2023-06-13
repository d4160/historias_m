<x-layouts.auth title="DMI - Resultados en línea">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" class="text-left" action="{{ route('password.update') }}">
        @csrf

        <div class="form">

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div id="email-field" class="field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <input id="email" name="email" type="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email', $request->email) }}" required autofocus>
            </div>

            <div id="password-field" class="mb-2 field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}" required autocomplete="current-password">
            </div>

            <div id="password_confirmation-field" class="mb-2 field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" required autocomplete="current-password">
            </div>

            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                </div>
            </div>

        </div>
    </form>
  
  	<x-slot name="scripts">
        <script>
            $('#btnSubmit').click(function(e){
                e.preventDefault();
                if(this.form.reportValidity()){
                    $(this).prop('disabled',true);
                    // $(this).css('color', 'black');
                    // this.style.setProperty( 'color', 'black', 'important' );
                    $(this).html('Cargando...');
                    this.form.submit();
                }
            });
        </script>
    </x-slot>
</x-layouts.auth>
