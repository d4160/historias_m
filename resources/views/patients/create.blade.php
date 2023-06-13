<x-layouts.admin title="DMI - Nuevo paciente" bodyTitle="Nuevo paciente">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
    </x-slot>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="m-4" :errors="$errors" />

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('patients.store') }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">Nº documento</label>
                                <input id="num_document" name="num_document" type="text" class="form-control" placeholder="77777777" value="{{ old('num_document') }}" required autofocus minlength="8" maxlength="11">
                            </div>
                            <div class="col">
                                <label for="num_document_confirmation">Confirme Nº documento</label>
                                <input id="num_document_confirmation" name="num_document_confirmation" type="text" class="form-control" placeholder="" value="{{ old('num_document_confirmation') }}" required minlength="8" maxlength="11">
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <div class="col">
                                <label for="first_names">Nombres</label>
                                <input id="first_names" name="first_names" type="text" class="form-control" placeholder="" value="{{ old('first_names') }}" required>
                            </div>
                            <div class="col">
                                <label for="last_names">Apellidos</label>
                                <input id="last_names" name="last_names" type="text" class="form-control" placeholder="" value="{{ old('last_names') }}" required>
                            </div>
                        </div>
                        <input type="submit" id="btnSubmit" onclick="" class="btn btn-primary" value="Guardar">
                    </form>
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
                    this.style.setProperty( 'color', 'black', 'important' );
                    $(this).val('Guardando...');
                    this.form.submit();
                }
            });
        </script>
    </x-slot>

</x-layouts.admin>
