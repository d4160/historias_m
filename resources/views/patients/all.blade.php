<x-layouts.admin title="Listado de pacientes" bodyTitle="Listado de pacientes">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css">

        @livewireStyles
    </x-slot>

    @include('patients.import_csv')
    @include('patients.edit_modal')
    @include('historias.historias_list')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('patients.create') }}" class="mt-3 ml-3 btn btn-success">Registrar Nuevo Paciente</a>
                        </div>
                        {{--  <div class="col-2">
                            <button type="button" data-toggle="modal" data-target="#paciente_import_csv"
                                class="mt-3 ml-3 btn btn-success" style="margin-bottom: 10px;">Importar CSV</button>
                        </div>  --}}

                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="mb-4 table-responsive">
                        <table id="style-2" class="table style-3 table-hover">
                            <thead>
                                <tr>
                                    <th class="checkbox-column"> Id </th>
                                    <th>Nª documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th class="text-center">Nº Historias</th>
                                    <th class="text-center">Fecha y Hora de Registro</th>
                                    <th class="text-center">Próxima Cita</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center" style="min-width:174px!important;">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $count = 0; $estado = '';
                                @endphp
                                @foreach($patients as $patient)
                                <tr>
                                    <td class="checkbox-column">{{ $patient->id }}</td>
                                    <td>{{ $patient->num_document }}</td>
                                    <td>{{ $patient->first_names }}</td>
                                    <td>{{ $patient->last_names }}</td>
                                    @php
                                    $count = $patient->historias_count;
                                    $estado = $patient->paciente->estado;
                                    @endphp
                                    <td class="text-center"><span class="shadow-none badge badge-primary" style="font-size: 17px; font-weight: normal;">{{ $count }}</span>
                                    @if ($count > 0)
                                    <span data-toggle="modal" data-target="#historiasModal"><a class="bs-tooltip" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver Historias" onclick="OpenHistoriasModal('{{ $patient->full_name }}', '{{ $patient->paciente->id }}');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-file-text br-6"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></a></span>
                                    @endif
                                    </td>
                                    <td class="text-center">{{ substr($patient->created_at, 0, 16) }}</td>
                                    <td class="text-center">{{ $patient->paciente->proxima_cita }}</td>
                                    <td class="text-center">
                                    @if ($count > 0)
                                    @switch($estado)
                                        @case('Atendido')
                                            <span class="badge badge-danger" style="color:#8dbf42;border-color:#8dbf42;"> {{ $estado }} </span>
                                            @break

                                        @case('')
                                        @case('Pendiente')
                                            <span class="badge badge-danger" style="color: #e7515a;border-color:#e7515a;"> {{ 'Pendiente' }} </span>
                                            @break

                                        @default
                                            <span class="badge badge-warning"> {{ $estado }} </span>
                                    @endswitch
                                    @endif
                                    </td>
                                    {{--  {{ $patient->results()->count() }}  --}}
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{ route('patients.edit', $patient->paciente->id) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>

                                            @if ($count > 0)
                                            <li><span data-toggle="modal" data-target="#historiaModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="OpenPacienteModal('{{ $patient->full_name }}', '{{ $patient->paciente->id }}', '{{ route('patients.update2', $patient->paciente->id) }}', '{{ $patient->paciente->proxima_cita }}', '{{ $patient->paciente->estado }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></span></li>
                                            @endif
                                            <li>
                                                <form method="POST" id="delete_{{ $patient->id }}_form" action="{{ route('patients.destroy', $patient->id) }}" style="display: inline-block">
                                                    @csrf
                                                    <a href="javascript:void(0);" class="bs-tooltip patient_remove confirm"
                                                                            form_id="delete_{{ $patient->id }}_form"
                                                                            patient_full_name="{{ $patient->full_name }}"
                                                                            data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script>

            $(function () {
                RegisterDeletePatientEvents();
            });

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
                "pageLength": 10
            });

            multiCheck(c2);

            function RegisterDeletePatientEvents() {
                $('.patient_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let patient_full_name = $(this).attr('patient_full_name');
                    swal({
                        title: `¿Está seguro de eliminar al paciente '${patient_full_name}' del registro del sistema?`,
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
                });
            }

            function OpenPacienteModal(pacienteFullname, id, route, proximaCita, estado) {
                $('#hc_number').html(pacienteFullname);

                $('#formHC').attr('action', route);
                $('#hc_modal_id').val(id);
                window.f1.setDate(proximaCita);
                $('#proxima_cita').val(proximaCita);
                $('#estado').val(estado ? estado : 'Pendiente');
            }

            function OpenHistoriasModal(pacienteFullname, id) {
                $('#pac_fullname').html(pacienteFullname);
                $('#historias_modal_id').val(id).change();;
            }

        </script>
        @livewireScripts
    </x-slot>

</x-layouts.admin>
