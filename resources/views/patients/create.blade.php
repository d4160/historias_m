<x-layouts.admin title="Nuevo paciente" bodyTitle="Nuevo paciente">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />

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

                        <span style="font-weight: bold; color: #7b7e8c; font-size: 17px;">Datos Personales</span>

                        <div class="mb-4 mt-2 row">
                            <div class="col">
                                <label for="created_at">Fecha de registro *</label>
                                <input id="created_at" name="created_at" value="{{ old('created_at') }}" class="form-control" type="text" placeholder="" required>
                                {{--  readonly="readonly"  --}}
                            </div>
                            
                            <livewire:documento autofocus='autofocus'/>
                            
                            <div class="col">
                                <label for="first_names">Nombres *</label>
                                <input id="first_names" name="first_names" type="text" class="form-control" placeholder="" value="{{ old('first_names') }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name1">Apellido Paterno *</label>
                                <input id="last_name1" name="last_name1" type="text" class="form-control" placeholder="" value="{{ old('last_name1') }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name2">Apellido Materno *</label>
                                <input id="last_name2" name="last_name2" type="text" class="form-control" placeholder="" value="{{ old('last_name2') }}" required>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <div class="col">
                                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                <input id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control" type="text" placeholder="">
                                {{--  readonly="readonly"  --}}
                            </div>
                            <div class="col">
                                <label for="edad">Edad *</label>
                                <input id="edad" name="edad" type="text" class="form-control" placeholder="" value="{{ old('edad') }}" required>
                            </div>
                            <div class="col">
                                <label for="estado_civil">Estado Civil</label>
                                {{ Form::select('estado_civil', ['S (Soltero)' => 'S (Soltero)', 'C (Casado)' => 'C (Casado)', 'Co (Conviviente)' => 'Co (Conviviente)', 'D (Divorciado)' => 'D (Divorciado)', 'V (Viudo)' => 'V (Viudo)'], old('estado_civil'), ['id' => 'estado_civil', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="ocupacion">Ocupación</label>
                                <input id="ocupacion" name="ocupacion" type="text" class="form-control" placeholder="" value="{{ old('ocupacion') }}">
                            </div>
                        </div>

                        <livewire:procedencia />

                        <span style="font-weight: bold; color: #7b7e8c; font-size: 17px;">Otros Datos</span>

                        <div class="mb-4 mt-2 row">
                            <div class="col">
                                <label for="celular">Celular</label>
                                <input id="celular" name="celular" value="{{ old('celular') }}" class="form-control" type="text" placeholder="">
                                {{--  readonly="readonly"  --}}
                            </div>
                            <div class="col">
                                <label for="refiere">Refiere</label>
                                <input id="refiere" name="refiere" type="text" class="form-control" placeholder="" value="{{ old('refiere') }}">
                            </div>
                            {{--  <div class="col">
                                <label for="medico_tratante">Médico Tratante</label>
                                <input id="medico_tratante" name="medico_tratante" type="text" class="form-control" placeholder="" value="{{ old('medico_tratante') }}">
                            </div>  --}}
                            <div class="col">
                                <label for="otros">Otros</label>
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
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }} "></script>
        <script>
            $(() => {
                var f1 = flatpickr(document.getElementById('created_at'), {
                    maxDate: GetTodayDate()
                });

                $('#created_at').val(GetTodayDate());

                {{--  $("#email").inputmask(
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
                )  --}}

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
