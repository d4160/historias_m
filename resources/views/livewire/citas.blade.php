<div class="widget-content widget-content-area">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="n-chk">
                <strong>Ordenar por</strong> &ensp;
                <label class="new-control new-radio square-radio radio-primary">
                    <input type="radio" class="new-control-input" name="option" value="1" checked>
                    <span class="new-control-indicator"></span>Fecha Cita
                </label>
                <label class="new-control new-radio square-radio radio-primary">
                    <input type="radio" class="new-control-input" name="option" value="2">
                    <span class="new-control-indicator"></span>Fecha Registro
                </label>
            </div>
        </div>
    </div>
    <div class="mt-2 row">
        <div class="col d-flex justify-content-center">
            <label class="new-control">
                <input id="fecha_filter" wire:model="date" autocomplete="off" name="fecha_filter" type="text" class="mb-2 form-control" placeholder="">
                <button class="mb-2 btn btn-outline-primary" id="btnToday">Hoy</button>
                <button class="mb-2 btn btn-outline-primary" id="btnClear">Limpiar</button>
            </label>
        </div>
    </div>
    <div class="mb-4 table-responsive">
        <table id="style-2" class="table style-3 table-hover">
            <thead>
                <tr>
                    <th class="checkbox-column"> Id </th>
                    <th>Fecha Registro</th>
                    <th>Fecha Cita</th>
                    <th>Paciente</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Consultorio</th>
                    <th class="text-center">Médico Tratante</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                    {{-- style="min-width:174px!important;" --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                <tr>
                    {{-- class="checkbox-column" --}}
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->created_at }}</td>
                    <td>{{ substr($cita->fecha_hora, 0, 16) }}</td>
                    <td>{{ $cita->paciente->user->full_name }}</td>
                    <td class="text-center">{{ $cita->tipo == 'Otros' ? $cita->tipo_otros : $cita->tipo }}</td>
                    <td class="text-center">{{ $cita->consultorio }}</td>
                    <td class="text-center">{{ $cita->medico }}</td>
                    <td class="text-center">
                        {{ $cita->estado }}
                        {{-- @switch($cita->estado)
                            @case('Paciente confirmado')
                                <span class="badge badge-danger" style="color:#8dbf42;border-color:#8dbf42;"> Paciente confirmado </span>
                            @break

                            @case('Paciente no confirmado')
                                <span class="badge badge-danger" style="color: #e7515a;border-color:#e7515a;"> Paciente no confirmado </span>
                            @break

                            @default
                                <span class="badge badge-warning"> {{ $estado }} </span>
                        @endswitch --}}
                    </td>
                    <td class="text-center">
                        <ul class="table-controls">

                            <li><span data-toggle="modal" data-target="#citaModal"><a href="javascript:void(0);"
                                        class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Editar" onclick="EditCitaModal({{ $cita->id }})"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="p-1 mb-1 feather feather-edit-2 br-6">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg></a></li>

                            <li>
                                <form id="delete_cita_{{ $cita->id }}_form" method="POST"
                                    action="{{ route('citas.destroy', $cita->id) }}" style="display: inline-block">
                                    @csrf
                                    <a href="javascript:void(0);"
                                        onclick="ConfirmDeleteCita('delete_cita_{{ $cita->id }}_form', '{{ $cita->paciente->user->full_name }}')"
                                        class="bs-tooltip exam_remove confirm"
                                        form_id="delete_exam_{{ $cita->id }}_form" data-container="body"
                                        data-html="true" data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="p-1 mb-1 feather feather-trash br-6">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                        </svg>
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

@push('scripts')
<script>
    let prev_fecha_filter = '';
    let count = 0;

    $(() => {
        window.fecha_filter = flatpickr(document.getElementById('fecha_filter'), {
            //locale: 'es'
            //defaultDate: GetTodayDateTime()
        });
    });

    $('input[type=radio][name=option]').change(function() {
        //console.log(this.value);
        count = 0;
        ClearDataTable();
        Livewire.emit('filterByOption', this.value);
    });

    $('#btnClear').click((e) => {
        //console.log('btnClear');
        let curr = $('#fecha_filter').val();
        if (curr) {
            //ClearDataTable();
            count = 0;
            $('#fecha_filter').val('').change();
        }
    });

    $('#btnToday').click((e) => {
        let today = GetTodayDate();
        let curr = $('#fecha_filter').val();
        if (curr != today) {
            //ClearDataTable();
            count = 0;
            window.fecha_filter.setDate(today);
            $('#fecha_filter').val(today).change();
        }
    });

    $('#fecha_filter').change(() => {
        console.log('change');
        if (prev_fecha_filter != $('#fecha_filter').val()) {
            ClearDataTable();
            prev_fecha_filter = $('#fecha_filter').val();
            setTimeout(() => {
                Livewire.emit('filterByDate', $('#fecha_filter').val());
            }, 0.1);
        }
    });

    Livewire.on('setDataTable', () => {
        //SetDataTable();
        console.log('setDataTable');
    });

    Livewire.on('render', () => {
        console.log('render');
        count++;
        if (count % 2 != 0)
            SetDataTable();
    });

</script>
@endpush
