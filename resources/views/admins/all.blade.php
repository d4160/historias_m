<x-layouts.admin title="Listado de administradores" bodyTitle="Listado de administradores">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
    </x-slot>

    @include('admins.import_csv')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('admins.create') }}" class="mt-3 ml-3 btn btn-success">Registrar Nuevo Administrador</a>
                        </div>
                        {{--  <div class="col-2">
                            <button type="button" data-toggle="modal" data-target="#admin_import_csv"
                                class="mt-3 ml-3 btn btn-info" style="margin-bottom: 10px;">Importar CSV</button>
                        </div>  --}}

                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="mb-4 table-responsive">
                        <table id="style-2" class="table style-3 table-hover">
                            <thead>
                                <tr>
                                    <th class="checkbox-column"> Id </th>
                                    <th>Usuario</th>
                                    <th>DNI o CE</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td class="checkbox-column">{{ $admin->id }}</td>
                                    <td>{{ $admin->num_document }}</td>
                                    <td>{{ $admin->otros }}</td>
                                    <td>{{ $admin->first_names }}</td>
                                    <td>{{ $admin->last_names }}</td>
                                    <td>{{ $admin->email }}</td>
                                    {{--  {{ $admin->results()->count() }}  --}}
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{ route('admins.edit', $admin->id) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                            <li>
                                                <form method="POST" id="delete_{{ $admin->id }}_form" action="{{ route('admins.destroy', $admin->id) }}" style="display: inline-block">
                                                    @csrf
                                                    <a href="javascript:void(0);" class="bs-tooltip admin_remove confirm"
                                                                            form_id="delete_{{ $admin->id }}_form"
                                                                            admin_full_name="{{ $admin->full_name }}"
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
        <script>

            $(function () {
                RegisterDeleteAdminEvents();
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
                "pageLength": 5
            });

            multiCheck(c2);

            function RegisterDeleteAdminEvents() {
                $('.admin_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let admin_full_name = $(this).attr('admin_full_name');
                    swal({
                        title: `¿Está seguro de eliminar al administrador '${admin_full_name}' del registro del sistema?`,
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
        </script>
    </x-slot>

</x-layouts.admin>
