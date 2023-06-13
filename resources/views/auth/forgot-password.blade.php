<x-layouts.auth title="DMI - Resultados en línea">
    <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

    <p><strong>Importante</strong>:</p>
  	<ul>
      <li>Este formulario es solo para administradores.</li>
      <li>No olvide revisar su bandeja de spam y promociones si no encuentra el mensaje.</li>
  	</ul>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" class="text-left" action="{{ route('password.email') }}">
        @csrf

        <div class="form">

            <div id="email-field" class="field-wrapper input">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <input id="email" name="email" type="email" class="form-control" placeholder="{{ __('Email') }}" :value="old('email')" required autofocus>
            </div>

            <div class="d-sm-flex justify-content-between">
                <div class="field-wrapper">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">{{ __('Email Password Reset Link') }}</button>
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
