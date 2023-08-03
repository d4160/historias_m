<x-layouts.admin title="Detalle de administrador" bodyTitle="Datos del administrador">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet" type="text/css">

        @livewireStyles
    </x-slot>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('admins.update', $admin->id) }}">
                        @csrf

                        <span style="font-weight: bold; color: #313131; font-size: 17px;">Datos Personales</span>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="otros">DNI o CE</label>
                                <input id="otros" name="otros" type="text" class="form-control" placeholder="77777777" value="{{ $admin->otros }}" required minlength="8" maxlength="11">
                            </div>
                            <div class="col">
                                <label for="first_names">Nombres</label>
                                <input id="first_names" name="first_names" type="text" class="form-control" placeholder="" value="{{ $admin->first_names }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name1">Apellido Paterno</label>
                                <input id="last_name1" name="last_name1" type="text" class="form-control" placeholder="" value="{{ $admin->last_name1 }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name2">Apellido Materno</label>
                                <input id="last_name2" name="last_name2" type="text" class="form-control" placeholder="" value="{{ $admin->last_name2 }}" required>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">Usuario</label>
                                <input id="num_document" name="num_document" value="{{ $admin->num_document }}" class="form-control" type="text" placeholder="" required>
                            </div>
                            <div class="col">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="" value="{{ $admin->email }}">
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btnSubmit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script src="{{ asset('assets/js/components/ui-accordions.js') }}"></script>
        <script>

            $(function () {
                RegisterHistoriaEvents();

                {{--  var f1 = flatpickr(document.getElementById('fecha_nacimiento'), {
                    maxDate: GetTodayDate()
                });  --}}

                {{--  $("#fecha_nacimiento").inputmask("9999/99/99");

                CalculateAge('#fecha_nacimiento', '#edad');  --}}

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
                );
            });

            $('.btnSubmit').click(function(e){
                e.preventDefault();
                if(this.form.reportValidity()){
                    $(this).prop('disabled',1);
                    // $(this).css('color', 'black');
                    this.style.setProperty( 'color', 'black', 'important' );
                    $(this).val('Guardando...');
                    this.form.submit();
                }
            });
        </script>

        @livewireScripts
    </x-slot>

</x-layouts.admin>
