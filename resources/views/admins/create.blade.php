<x-layouts.admin title="Nuevo administrador" bodyTitle="Nuevo administrador">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">

        @livewireStyles
    </x-slot>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="m-4" :errors="$errors" />

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('admins.store') }}">
                        @csrf

                        <span style="font-weight: bold; color: #7b7e8c; font-size: 17px;">Datos Personales</span>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="otros">DNI o CE</label>
                                <input id="otros" name="otros" type="text" class="form-control" placeholder="77777777" value="{{ old('otros') }}" required autofocus minlength="8" maxlength="11">
                            </div>
                            <div class="col">
                                <label for="first_names">Nombres</label>
                                <input id="first_names" name="first_names" type="text" class="form-control" placeholder="" value="{{ old('first_names') }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name1">Apellido Paterno</label>
                                <input id="last_name1" name="last_name1" type="text" class="form-control" placeholder="" value="{{ old('last_name1') }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name2">Apellido Materno</label>
                                <input id="last_name2" name="last_name2" type="text" class="form-control" placeholder="" value="{{ old('last_name2') }}" required>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">Usuario</label>
                                <input id="num_document" name="num_document" value="{{ old('num_document') }}" class="form-control" type="text" placeholder="" required>
                                {{--  readonly="readonly"  --}}
                            </div>
                            <div class="col">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <input type="submit" id="btnSubmit" onclick="" class="btn btn-primary" value="Guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script>
            $(() => {
                {{--  var f1 = flatpickr(document.getElementById('fecha_nacimiento'), {
                    maxDate: GetTodayDate()
                });  --}}

                $("#email").inputmask(
                    {
                        mask:"*{1,31}[.*{1,31}][.*{1,31}][.*{1,31}]@*{1,31}[.*{2,6}][.*{1,2}]",
                        greedy:!1,onBeforePaste:function(m,a){return(m=m.toLowerCase()).replace("mailto:","")},
                        definitions:{"*":
                            {
                                validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                                cardinality:1,
                                casing:"lower"
                            }
                        }
                    }
                )

                {{--  $("#fecha_nacimiento").inputmask("9999/99/99");  --}}
            });

            $('#btnSubmit').click(function(e){
                e.preventDefault();
                if(this.form.reportValidity()){
                    $(this).prop('disabled',true);
                    this.style.setProperty( 'color', 'black', 'important' );
                    $(this).val('Guardando...');
                    this.form.submit();
                }
            });

            {{--  CalculateAge('#fecha_nacimiento', '#edad');  --}}

        </script>

        @livewireScripts
    </x-slot>

</x-layouts.admin>
