<x-layouts.admin title="Kardex" bodyTitle="Kardex">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        @livewireStyles
    </x-slot>

    @include('kardex.create')
    @include('kardex.edit');

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">

                    <div class="m-3 row mt-4">
                        <div class="col">
                            <label for="paciente" class="font-weight-bold">Paciente {{ $user->num_document }}</label>
                            <input id="paciente" name="paciente" type="text" class="form-control" placeholder="" value="{{ $user->full_name }}" disabled>
                        </div>
                        <div class="col">
                            <label for="edad" class="font-weight-bold">Edad</label>
                            <input id="edad" name="edad" type="text" class="form-control" placeholder="" value="{{ $user->edad }}" disabled>
                        </div>
                        <div class="col">
                            <label for="procedencia" class="font-weight-bold">Procedencia</label>
                            <input id="procedencia" name="procedencia" type="text" class="form-control" placeholder="" value="{{ $user->provincia->nombre_prov }}" disabled>
                        </div>
                    </div>

                    <div class="m-3 row mt-4">
                        <div class="col">
                            <label for="hc" class="font-weight-bold">Historia Clínica</label>
                            <input id="hc" name="hc" type="text" class="form-control" placeholder="" value="@php(printf("%06d", $historia->id))" disabled>
                        </div>
                        <div class="col">
                            <label for="fecha_hc" class="font-weight-bold">Fecha y Hora de H.C.</label>
                            <input id="fecha_hc" name="fecha_hc" type="text" class="form-control" placeholder="" value="{{ $historia->created_at }}" disabled>
                        </div>
                        <div class="col">
                            <label for="paciente" class="font-weight-bold">Diagnóstico</label>
                            <input id="paciente" name="paciente" type="text" class="form-control" placeholder="" value="{{ $historia->impresionDiagnostica->impresion_diagnostica }}" disabled>
                        </div>
                    </div>

                    <div class="m-3 row mt-4">
                        <div class="col">
                            <label style="font-weight: bold; color: #7b7e8c; font-size: 17px;" for="observaciones">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" type="text" class="form-control" placeholder="">{{ $kardex->observaciones }}</textarea>
                        </div>
                    </div>

                    <div class="row ml-3 mr-4 mb-4" style="justify-content:space-between;">
                        <div>
                            <a href="{{ route('kardex.update', $kardex->id) }}" class="mt-3 ml-3 btn btn-success">Guardar</a>
                        </div>
                        <div>
                            <a href="{{ route('patients.edit', $patient_id) }}" class="mt-3 ml-3 btn btn-info">Regresar a la página del paciente</a>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="mb-4 table-responsive">

                        <div class="page-header">
                            <label class="ml-3" style="font-weight: bold; color: black; font-size: 17px; margin-bottom: 31px;">Medicamentos</label>

                            <button type="button" data-toggle="modal" data-target="#examModal"
                            class="ml-3 btn btn-success" style="margin-bottom: 10px;" onclick="$('#exam_modal_historia_id').val({{ $historia->id }}); $('#formExam').attr('action', '{{ route('kardex.detalles_store') }}'); $('#exam-title').text('Medicamento');">Nuevo Medicamento</button>
                        </div>

                        <table id="exam_table" class="table style-3 table-hover">
                            {{--  table-hover  --}}
                            <thead>
                                <tr>
                                    <th class="text-center">Nº</th>
                                    <th class="text-center">Medicamento</th>
                                    <th class="text-center">Dosis</th>
                                    <th class="text-center">Vía</th>
                                    <th class="text-center">Frecuencia</th>
                                    <th class="text-center">Día 1</th>
                                    <th class="text-center">Día 2</th>
                                    <th class="text-center">Día 3</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($kardex->detalles as $det)
                                <tr>
                                    {{--  class="checkbox-column"  --}}
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $det->medicamento }}</td>
                                    <td class="text-center">{{ $det->dosis }}</td>
                                    <td class="text-center">{{ $det->via }}</td>
                                    <td class="text-center">{{ $det->frecuencia }}</td>
                                    <td class="text-center">{{ $det->dia1 }}</td>
                                    <td class="text-center">{{ $det->dia2 }}</td>
                                    <td class="text-center">{{ $det->dia3 }}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            @if($det->url)
                                            <li><a href="{{ Storage::url($det->url) }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>
                                            @endif

                                            <li><span data-toggle="modal" data-target="#examEditModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="$('#exam_edit_form').attr('action', '{{ route('kardex.update', $det->id) }}'); $('#exam_edit_id').val('{{ $det->id }}'); $('#exam-edit-title').text('Tratamiento'); $('#exam_edit_titulo').text('{{ addslashes($det->tratamiento) }}'); $('#edit_titulo').val('{{ addslashes($det->tratamiento) }}'); $('#edit_descripcion').val(`{{ old('edit_descripcion', addslashes($det->descripcion)) }}`); $('#edit_form').prop('action', '{{ route('kardex.update', $det->id) }}'); $('#edit_file_url').text('{{ addslashes(substr($det->url, 31)) }}'); $('#edit_file_download').attr('href', '{{ Storage::url(addslashes($det->url)) }}');if('{{ addslashes($det->url) }}' == ''){ $('#replace_file').hide();$('#put_file').show(); }else{ $('#replace_file').show();$('#put_file').hide(); } "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                            <li><form id="delete_exam_{{ $det->id }}_form" method="POST" action="{{ route('kardex.destroy', $det->id) }}" style="display: inline-block">
                                                @csrf
                                                <a href="javascript:void(0);" class="bs-tooltip exam_remove confirm"
                                                                        form_id="delete_exam_{{ $det->id }}_form"
                                                                        exam_aux_title="{{ addslashes($det->tratamiento) }}"
                                                                        data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                </a>
                                            </form></li>
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
                RegisterDeleteExamEvents();
            });

            c2 = $('#exam_table').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    /*e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'*/
                },
                columnDefs:[ {
                    /*targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }*/
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

            function RegisterDeleteExamEvents() {
                $('.exam_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let exam_aux_title = $(this).attr('exam_aux_title');
                    swal({
                        title: `¿Está seguro de eliminar el medicamento '${exam_aux_title}' del registro del sistema?`,
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
        @livewireScripts
    </x-slot>

</x-layouts.admin>
