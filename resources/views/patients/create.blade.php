<x-layouts.admin title="Nuevo paciente" bodyTitle="Nuevo paciente">
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

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('patients.store') }}">
                        @csrf

                        <span style="font-weight: bold; color: darkgray; font-size: 17px;">Datos Personales</span>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">DNI o CE</label>
                                <input id="num_document" name="num_document" type="text" class="form-control" placeholder="77777777" value="{{ old('num_document') }}" required autofocus minlength="8" maxlength="11">
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
                                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                <input id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control" type="text" placeholder="" readonly="readonly" required>
                            </div>
                            <div class="col">
                                <label for="edad">Edad</label>
                                <input id="edad" name="edad" type="text" class="form-control" placeholder="" value="{{ old('edad') }}" readonly required>
                            </div>
                            <div class="col">
                                <label for="estado_civil">Estado Civil</label>
                                {{ Form::select('estado_civil', ['S (Soltero)' => 'S (Soltero)', 'C (Casado)' => 'C (Casado)', 'Co (Conviviente)' => 'Co (Conviviente)', 'D (Divorciado)' => 'D (Divorciado)', 'V (Viudo)' => 'V (Viudo)'], old('estado_civil'), ['id' => 'estado_civil', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="ocupacion">Ocupación</label>
                                <input id="ocupacion" name="ocupacion" type="text" class="form-control" placeholder="" value="{{ old('ocupacion') }}" required>
                            </div>
                        </div>

                        <livewire:procedencia />

                        <div class="mb-4 row">
                            <div class="col">
                                <label style="font-weight: bold; color: darkgray; font-size: 17px;" for="otros">Otros</label>
                                <textarea id="otros" name="otros" type="text" class="form-control" placeholder="">{{ old('otros') }}</textarea>
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
        <script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script>
            $(() => {
                var f1 = flatpickr(document.getElementById('fecha_nacimiento'), {
                    maxDate: GetTodayDate()
                });

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

            CalculateAge('#fecha_nacimiento', '#edad');

        </script>

        @livewireScripts
    </x-slot>

</x-layouts.admin>
