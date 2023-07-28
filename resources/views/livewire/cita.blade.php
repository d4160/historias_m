<div>
    <div class="modal-header" id="citaModalHeader">
        <h4 class="modal-title">{{ $titulo }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg></button>
    </div>
    <div class="modal-body">
        <form method="POST" id="form" class="mt-0" action="">
            @csrf

            <span style="font-weight: bold; color: #7b7e8c; font-size: 17px;">Datos de Paciente</span>

            <div class="mt-2 form-group">
                <div class="row">
                    <div class="col">
                        <label for="num_document">DNI o CE</label>
                        <input id="num_document" name="num_document" minlength="8" maxLength="11" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('num_document') }}">
                        @error('num_document') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-7">
                        <label for="nombres">Nombres</label>
                        <input id="nombres" name="nombres" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('nombres') }}" required>
                        @error('nombres') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="last_name1">Apellido Paterno</label>
                        <input id="last_name1" name="last_name1" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('last_name1') }}" required>
                        @error('last_name1') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="last_name2">Apellido Materno</label>
                        <input id="last_name2" name="last_name2" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('last_name2') }}">
                        @error('last_name2') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="celular">Celular</label>
                        <input id="celular" name="celular" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('celular') }}">
                        @error('celular') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <span style="font-weight: bold; color: #7b7e8c; font-size: 17px;">Datos de Cita</span>

            <div class="mt-2 form-group">
                <div class="row">
                    <div class="col">
                        <label for="origen">Origen</label>
                        <input id="origen" name="origen" type="text" class="mb-2 form-control" placeholder="" value="{{ old('origen') }}">
                        @error('origen') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="fecha_hora">Fecha y hora</label>
                        <input id="fecha_hora" name="fecha_hora" type="text" class="mb-2 form-control" placeholder="" value="{{ old('fecha_hora') }}" required>
                        @error('fecha_hora') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-2 form-group">
                <div class="row">
                    <div class="col">
                        <label for="tipo">Tipo</label>
                        {{ Form::select('tipo', ['Consulta Médica' => 'Consulta Médica', 'Tomografía' => 'Tomografía', 'Rayos X' =>
                        'Rayos X', 'Laboratorio' => 'Laboratorio', 'Ecografía' => 'Ecografía', 'Resonancia Magnética' =>
                        'Resonancia Magnética', 'Otros' => 'Otros'], old('tipo'), ['id' =>
                        'tipo', 'class' => 'form-control', 'required' => 'required']) }}
                        @error('tipo') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col d-none" id="tipo_otros_parent">
                        <label for="tipo_otros">Otros</label>
                        <input id="tipo_otros" name="tipo_otros" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('tipo_otros') }}">
                        @error('tipo_otros') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="consultorio">Consultorio</label>
                        {{ Form::select('consultorio', ['Consultorio 1' => 'Consultorio 1', 'Consultorio 2' => 'Consultorio 2', 'Tópico' => 'Tópico'], old('consultorio'), ['id' =>
                        'consultorio', 'class' => 'form-control', 'required' => 'required']) }}
                        @error('consultorio') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="medico">Médico Tratante</label>
                        {{ Form::select('medico', ['Yamil Cabrera' => 'Yamil Cabrera', 'Daysy Mechan' => 'Daysy Mechan', 'Rodolfo Cairo' => 'Rodolfo Cairo'],
                        old('medico'), ['id' =>
                        'medico', 'class' => 'form-control', 'required' => 'required']) }}
                        @error('medico') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-5">
                        <label for="estado">Estado</label>
                        <input id="estado" name="estado" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('estado') }}">
                        @error('estado') <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'" --}}
            <button type="submit" id="btnGuardar"
                class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(() => {
        window.fecha_hora = flatpickr(document.getElementById('fecha_hora'), {
            //minDate: GetTodayDateTime(),
            minuteIncrement: 1,
            defaultDate: GetTodayDateTime(),
            enableTime: true
            //locale: 'es'
            //defaultDate: GetTodayDateTime()
        });
    });

    $('#btnGuardar').click((e) => {
        e.preventDefault();
        if($('#form').get(0).reportValidity()){
            $('#btnGuardar').prop('disabled',true);
            $('#btnGuardar').html('Guardando...');
            $('#form').submit();
        }
    });

    $('#tipo').change(() => {
        if($('#tipo').val() == 'Otros') {
            $('#tipo_otros_parent').removeClass('d-none');
        }
        else {
            $('#tipo_otros_parent').addClass('d-none');
        }
    });

    function CreateCitaModal() {
        $('#form').get(0).reset();
        Livewire.emit('createCita');
    }

    function EditCitaModal(id) {
        Livewire.emit('editCita', id);
    }

    Livewire.on('updateView', (action, cita, user) => {
        $('#form').attr('action', action);

        if (cita) {
            $('#num_document').val(user.num_document);
            $('#nombres').val(user.first_names);
            $('#last_name1').val(user.last_name1);
            $('#last_name2').val(user.last_name2);
            $('#celular').val(user.celular);
            $('#origen').val(cita.origen);
            $('#tipo').val(cita.tipo);
            if (cita.tipo == 'Otros') {
                $('#tipo_otros_parent').removeClass('d-none');
                $('#tipo_otros').val(cita.tipo_otros);
            }
            $('#consultorio').val(cita.consultorio);
            $('#medico').val(cita.medico);
            $('#estado').val(cita.estado);

            //if (cita.fecha) {
            //window.fecha_hora.set('minDate', '');
            window.fecha_hora.setDate(cita.fecha_hora);
            $('#fecha_hora').val(cita.fecha_hora);
            //}
            // else {
            //     SetTodayDate();
            // }
        }
        else {
            SetTodayDate();
        }
    });

    function SetTodayDate() {
        let today = GetTodayDateTime();
        //window.fecha_hora.set('minDate', today);
        window.fecha_hora.setDate(today);
        $('#fecha_hora').val(today);
    }

</script>
@endpush
