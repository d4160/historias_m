<x-layouts.admin title="Reumainnova - Nueva Cita" bodyTitle="Datos básicos de la cita">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    </x-slot>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('historias.store', $patient_id) }}">
                        @csrf

                        <label style="font-weight: bold; color: black; font-size: 17px;">PACIENTE</label>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="getFullNameAttribute">Nombre completo</label>
                                <input id="getFullNameAttribute" name="getFullNameAttribute" type="text" class="form-control" placeholder="" value="{{ $patient->getFullNameAttribute() }}" readonly>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">DNI o CE</label>
                                <input id="num_document" name="num_document" type="text" class="form-control" placeholder="" value="{{ $patient->num_document }}" readonly>
                            </div>
                            <div class="col">
                                <label for="edad">Edad</label>
                                <input id="edad" name="edad" type="text" class="form-control" placeholder="" value="{{ $patient->edad }}" readonly>
                            </div>
                        </div>

                        <label style="font-weight: bold; color: black; font-size: 17px;">CITA</label>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="numero">Número</label>
                                <input id="numero" name="numero" type="text" class="form-control" placeholder="001349" value="@php(printf("%06d", $next_id))" readonly>
                            </div>
                            <div class="col">
                                <label for="sede">Sede</label>
                                <input id="sede" name="sede" value="{{ old('sede') }}" class="form-control" type="text" placeholder="" required>
                            </div>
                            <div class="col">
                                <label for="fecha_hora">Fecha y Hora</label>
                                <input id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora') }}" class="form-control" type="text" placeholder="" readonly="readonly" autofocus required>
                            </div>
                        </div>

                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script>

            $(() => {
                var f2 = flatpickr(document.getElementById('fecha_hora'), {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            });

            $('#btnSubmit').click(function(e){
                e.preventDefault();
                if(this.form.reportValidity()){
                    $(this).prop('disabled',true);
                    // $(this).css('color', 'black');
                    this.style.setProperty( 'color', 'black', 'important' );
                    $(this).val('Guardando...');
                    this.form.submit();
                }
            });

        </script>
    </x-slot>

</x-layouts.admin>
