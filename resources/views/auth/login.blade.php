<x-layouts.auth title="DMI - Resultados en línea - Login">
    <h1 class="">Resultados en línea <a href="https://dmiperu.com/"><span class="brand-name">DMI</span></a></h1>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" class="text-left" action="{{ route('login') }}">
        @csrf

        <div class="form">

            <div id="num_document-field" class="field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <input id="num_document" name="num_document" type="text" maxlength="21" minlength="3" class="form-control" placeholder="Nº de documento" :value="old('num_document')" required>
            </div>

            <div id="password-field" class="mb-2 field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}" required autocomplete="current-password">
            </div>

            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper toggle-pass">
                    <p class="d-inline-block">Mostrar contraseña</p>
                    <label class="switch s-primary">
                        <input type="checkbox" id="toggle-password" class="d-none">
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="field-wrapper">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">{{ __('Login') }}</button>
                </div>

            </div>

            <div class="text-center field-wrapper keep-logged-in">
                <div class="n-chk new-checkbox checkbox-outline-primary">
                    <label class="new-control new-checkbox checkbox-outline-primary">
                        <input id="remember_me" type="checkbox" class="new-control-input" name="remember">
                        <span class="new-control-indicator"></span>{{ __('Remember me') }}
                    </label>
                </div>
            </div>

            <div class="field-wrapper">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-pass-link">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

        </div>
    </form>

    <x-slot name="scripts">
        <script>
            $('#toggle-password').change((e) => {
                if ($('#toggle-password').is(':checked')) {
                    $('#password').get(0).type = 'type';
                }
                else {
                    $('#password').get(0).type = 'password';
                }
            });

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
