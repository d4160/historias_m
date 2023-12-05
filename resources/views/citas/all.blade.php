<x-layouts.admin title="Listado de citas" bodyTitle="Listado de citas">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">

        @livewireStyles
    </x-slot>

    @include('citas.save')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col">
                            <a data-toggle="modal" data-target="#citaModal"                                style="margin-bottom: 10px;" onclick="CreateCitaModal()" class="mt-3 ml-3 btn btn-success">Registrar Nueva Cita</a>
                        </div>
                    </div>
                </div>
                <livewire:citas :citas="$citas" />
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }} "></script>
        <script>

            $(function () {
                @if (\Session::has('notification'))
                    Snackbar.show({
                        text: '{{ \Session::get('notification') }}',
                        actionTextColor: '#fff',
                        backgroundColor: '{{ \Session::get('color') }}',
                        actionText: 'OK'
                    });
                @endif

                SetDataTable();
            });

            function ClearDataTable() {
                console.log('destroy');
                $('#style-2').dataTable().fnDestroy();
            }

            function SetDataTable() {
                c2 = $('#style-2').DataTable({
                    headerCallback:function(e, a, t, n, s) {
                        e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    },
                    columnDefs:[ {
                        targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                            return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                        }
                    }],
                    "oLanguage": {
                        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                        "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        "sSearchPlaceholder": "Buscar...",
                        "sLengthMenu": "Mostrar :  _MENU_",
                        "sEmptyTable": "No hay datos disponibles en la tabla",
                        "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    },
                    "lengthMenu": [5, 10, 20, 50],
                    "pageLength": 10,
                    //"bDestroy": true
                });

                //multiCheck(c2);
            }

            function ConfirmDeleteCita(form_id, paciente) {
                swal({
                    title: `¿Está seguro de eliminar la cita del paciente '${paciente}' del registro del sistema?`,
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: 'Eliminar',
                    padding: '2em'
                    }).then(function(result) {
                        if (result.value) {
                        let form = $(`#${form_id}`);
                        form.submit();
                    }
                });
            }
        </script>
        @livewireScripts
    </x-slot>

</x-layouts.admin>
