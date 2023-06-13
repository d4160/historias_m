<x-layouts.admin title="DMI - Detalle de paciente" bodyTitle="Detalle de paciente">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
    </x-slot>

    @include('results.create')
    @include('results.edit')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('patients.update', $patient->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">Nº documento</label>
                                <input id="num_document" type="text" class="form-control" placeholder="77777777" value="{{ $patient->num_document }}" readonly minlength="8" maxlength="11">
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <div class="col">
                                <label for="first_names">Nombres</label>
                                <input id="first_names" name="first_names" type="text" class="form-control" placeholder="" value="{{ $patient->first_names }}" required>
                            </div>
                            <div class="col">
                                <label for="last_names">Apellidos</label>
                                <input id="last_names" name="last_names" type="text" class="form-control" placeholder="" value="{{ $patient->last_names }}" required>
                            </div>
                        </div>
                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Guardar">
                    </form>

                    <div class="row">
                        <div class="col col-md-10">
                            <h4>Listado de resultados</h4>
                        </div>
                        <div class="col">
                            <button type="button" data-toggle="modal" data-target="#createModal"
                                class="ml-3 btn btn-success" onclick="$('#create_modal_user_id').val({{ $patient->id }})">Nuevo Resultado</button>
                            {{--  onclick="$('#createModal').modal('toggle');"  --}}
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="mb-4 table-responsive">
                        <table id="style-2" class="table style-3 table-hover">
                            {{--  table-hover  --}}
                            <thead>
                                <tr>
                                    <th class="checkbox-column">Id</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patient->results as $result)
                                <tr>
                                    <td class="checkbox-column"> {{ $result->id }} </td>
                                    <td>{{ $result->title }}</td>
                                    <td>{{ $result->description }}</td>
                                    <td>{{ $result->created_at }}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            {{--  Storage::url($result->url)  --}}
                                            <li><a href="{{ URL::to('/') . '/storage/' . $result->url }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>

                                            <li><span data-toggle="modal" data-target="#editModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"
                                                onclick="$('#result_title').text('{{ $result->title }}'); $('#edit_title').val('{{ $result->title }}'); $('#edit_description').val('{{ $result->description }}');
                                                $('#edit_form').prop('action', '{{ route('results.update', $result->id) }}'); $('#edit_id').val('{{ $result->id  }}'); $('#edit_file_url').text('{{ substr($result->url, 8) }}'); $('#edit_file_download').attr('href', '{{ URL::to('/') . '/storage/' . $result->url }}')"
                                                ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                            <li>
                                                <form id="delete_{{ $result->id }}_form" method="POST" action="{{ route('results.destroy', $result->id) }}" style="display: inline-block">
                                                    @csrf
                                                    <a href="javascript:void(0);" class="bs-tooltip result_remove confirm"
                                                                            form_id="delete_{{ $result->id }}_form"
                                                                            result_title="{{ $result->title }}"
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
        <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script>

            $(function () {
                RegisterDeleteResultEvents();
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
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            multiCheck(c2);

            function RegisterDeleteResultEvents() {
                $('.result_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let result_title = $(this).attr('result_title');
                    swal({
                        title: `¿Está seguro de eliminar el resultado '${result_title}' ?`,
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
