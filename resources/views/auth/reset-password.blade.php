<x-layouts.auth title="Yabaja - Cambiar Password">

    <x-slot name="styles">
        <style>
            .fxt-template-layout4 .fxt-bg-img:before {
                background-color: rgba(2, 2, 3, 0);
            }

            .fxt-template-layout4 .fxt-bg-wrap:before {
                background-color: #2762AB;
            }

            .fxt-template-layout4 .checkbox input[type=checkbox]:checked + label::before {
                background-color: #2762AB;
                border-color: #2762AB;
            }
        </style>
    </x-slot>

    <div class="row">
        <div class="col-md-6 col-12 fxt-bg-wrap">
            <div class="fxt-bg-img" data-bg-image="{{ asset('assets/img/back-2.png') }} ">
                <div class="fxt-header">


                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                        <p></p>
                    </div>
                </div>
                <ul class="fxt-socials">
                    {{--  <li class="fxt-facebook fxt-transformY-50 fxt-transition-delay-4"><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="fxt-twitter fxt-transformY-50 fxt-transition-delay-5"><a href="#" title="twitter"><i class="fab fa-twitter"></i></a></li>
                    <li class="fxt-google fxt-transformY-50 fxt-transition-delay-6"><a href="#" title="google"><i class="fab fa-google-plus-g"></i></a></li>
                    <li class="fxt-linkedin fxt-transformY-50 fxt-transition-delay-7"><a href="#" title="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                    <li class="fxt-youtube fxt-transformY-50 fxt-transition-delay-8"><a href="#" title="youtube"><i class="fab fa-youtube"></i></a></li>  --}}
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-12 fxt-bg-color">
            <div class="fxt-content">
                <div class="fxt-form">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                        <a href="/" class="fxt-logo"><img src="{{ asset('assets/img/logo.png') }}" alt="Logo"></a>
                    </div>

                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                        <h1 style="color: #2762AB; font-family: Montserrat, sans; font-size: 33px;">{{ __('Reset Password') }}</h1>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}" class="mt-5">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div id="email-field" class="form-group">
                            <label for="email" class="input-label">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Escriba su correo" value="{{ old('email', $request->email) }}" required>
                        </div>

                        <div id="password-field" class="form-group">
                            <label for="password" class="input-label">{{ 'Nueva contraseña' }}</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="*******" required autocomplete="current-password" autofocus>
                            <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>

                        <div id="password_confirmation-field" class="form-group">
                            <label for="password_confirmation" class="input-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="*******" required autocomplete="current-password"><i toggle="#password_confirmation" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </div>

                        <div class="d-sm-flex justify-content-between">
                            <div class="field-wrapper">
                                <button type="submit" id="btnSubmit" class="fxt-btn-fill" style="font-family: Montserrat, sans; background-color: #EE8903;">{{ __('Reset Password') }}</button>
                            </div>
                        </div>
                    </form>

                    <p class="terms-conditions d-flex justify-content-center" style="font-size: 14px;"><a href="/">Yabaja </a>© {{ date('Y') }} Todos los derechos reservados. <br>.
                </div>
                <div class="fxt-footer">
                    {{--  <p>Dont have an account?<a href="register-4.html" class="switcher-text2 inline-text">Register</a></p>  --}}
                </div>
            </div>
        </div>
    </div>
  
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
