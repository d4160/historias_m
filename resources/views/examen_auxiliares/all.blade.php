<x-layouts.admin title="Exámenes Auxiliares" bodyTitle="Exámenes Auxiliares">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    </x-slot>

    @include('examen_auxiliares.create')
    @include('examen_auxiliares.edit');

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">

                    <div class="m-3 row mt-4">
                        <div class="col">
                            <label for="paciente" class="font-weight-bold">Paciente {{ $patient->num_document }}</label>
                            <input id="paciente" name="paciente" type="text" class="form-control" placeholder="" value="{{ $patient->full_name }}" disabled>
                        </div>
                        <div class="col">
                            <label for="hc" class="font-weight-bold">Historia Clínica</label>
                            <input id="hc" name="hc" type="text" class="form-control" placeholder="" value="@php(printf("%06d", $historia->id))" disabled>
                        </div>
                        <div class="col">
                            <label for="hc" class="font-weight-bold">Fecha y Hora de H.C.</label>
                            <input id="hc" name="hc" type="text" class="form-control" placeholder="" value="{{ $historia->created_at }}" disabled>
                        </div>
                    </div>

                    <div class="row mx-1">
                        <div class="col">
                            <a href="{{ route('patients.edit', $patient_id) }}" class="mt-3 ml-3 btn btn-info">Regresar a la página del paciente</a>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="mb-4 table-responsive">

                        <div class="page-header">
                            <label class="ml-3" style="font-weight: bold; color: black; font-size: 17px; margin-bottom: 31px;">Lista de exámenes Auxiliares</label>

                            <button type="button" data-toggle="modal" data-target="#examModal"
                            class="ml-3 btn btn-success" style="margin-bottom: 10px;" onclick="$('#exam_modal_historia_id').val({{ $historia->id }})">Nuevo Examen Auxiliar</button>
                        </div>

                        <table id="exam_table" class="table style-3 table-hover">
                            {{--  table-hover  --}}
                            <thead>
                                <tr>
                                    <th class="text-center">Nº</th>
                                    <th class="text-center">Título</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Fecha de subida</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($historia->examenesAuxiliares as $exam)
                                <tr>
                                    {{--  class="checkbox-column"  --}}
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $exam->titulo }}</td>
                                    <td class="text-center">{{ substr($exam->descripcion, 0, 50).'...' }}</td>
                                    <td class="text-center">{{ $exam->url ? $exam->updated_at : 'Todavia no subido' }}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            @if($exam->url)
                                            <li><a href="{{ Storage::url($exam->url) }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>
                                            @endif

                                            <li><span data-toggle="modal" data-target="#examEditModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="$('#exam_edit_form').attr('action', '{{ route('examen_auxiliares.update', $exam->id) }}'); $('#exam_edit_id').val('{{ $exam->id }}'); $('#exam_edit_titulo').text('{{ addslashes($exam->titulo) }}'); $('#edit_titulo').val('{{ addslashes($exam->titulo) }}'); $('#edit_descripcion').val(`{{ old('edit_descripcion', addslashes($exam->descripcion)) }}`); $('#edit_form').prop('action', '{{ route('examen_auxiliares.update', $exam->id) }}'); $('#edit_file_url').text('{{ addslashes(substr($exam->url, 31)) }}'); $('#edit_file_download').attr('href', '{{ Storage::url(addslashes($exam->url)) }}');if('{{ addslashes($exam->url) }}' == ''){ $('#replace_file').hide();$('#put_file').show(); }else{ $('#replace_file').show();$('#put_file').hide(); } $('#created_at_edit').val('{{ substr($exam->created_at, 0, 16) }}'); createdExam.setDate('{{ $exam->created_at }}');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                            <li><form id="delete_exam_{{ $exam->id }}_form" method="POST" action="{{ route('examen_auxiliares.destroy', $exam->id) }}" style="display: inline-block">
                                                @csrf
                                                <a href="javascript:void(0);" class="bs-tooltip exam_remove confirm"
                                                                        form_id="delete_exam_{{ $exam->id }}_form"
                                                                        exam_aux_title="{{ addslashes($exam->titulo) }}"
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
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
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
                        title: `¿Está seguro de eliminar el examen auxiliar '${exam_aux_title}' del registro del sistema?`,
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
