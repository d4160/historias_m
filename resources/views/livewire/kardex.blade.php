<div>
    <div class="modal-header" id="medicamentoModalHeader">
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
        <form method="POST" id="formMedicamento" class="mt-0" action="">
            @csrf

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="fecha">Fecha</label>
                        <input id="fecha" name="fecha" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('fecha') }}">
                        @error('fecha') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label for="medicamento">Medicamento</label>
                        <input id="medicamento" name="medicamento" type="text" class="mb-2 form-control" placeholder="" value="{{ old('medicamento') }}" required>
                        @error('medicamento') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label for="dosis">Dosis</label>
                        <input id="dosis" name="dosis" type="text" maxLength="25" class="mb-2 form-control" placeholder="" value="{{ old('dosis') }}" required>
                        @error('dosis') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="via">Vía</label>
                        <input id="via" name="via" maxLength="31" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('via') }}">
                        @error('via') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label for="frecuencia">Frecuencia</label>
                        <input id="frecuencia" name="frecuencia" type="text" class="mb-2 form-control" placeholder=""
                            value="{{ old('frecuencia') }}">
                        @error('frecuencia') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label for="dia1">Día 1</label>
                        <input id="dia1" name="dia1" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia1') }}">
                        @error('dia1') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="dia2">Día 2</label>
                        <input id="dia2" name="dia2" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia2') }}">
                        @error('dia2') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label for="dia3">Día 3</label>
                        <input id="dia3" name="dia3" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia3') }}">
                        @error('dia3') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label for="dia4">Día 4</label>
                        <input id="dia4" name="dia4" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia4') }}">
                        @error('dia4') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="dia5">Día 5</label>
                        <input id="dia5" name="dia5" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia5') }}">
                        @error('dia5') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    <div class="col">
                        <label for="dia6">Día 6</label>
                        <input id="dia6" name="dia6" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia6') }}">
                        @error('dia6') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    <div class="col">
                        <label for="dia7">Día 7</label>
                        <input id="dia7" name="dia7" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia7') }}">
                        @error('dia7') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="col">
                        <label for="dia8">Día 8</label>
                        <input id="dia8" name="dia8" type="text" class="mb-2 form-control" placeholder="" value="{{ old('dia8') }}">
                        @error('dia8') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'" --}}
            <button type="submit" id="btnGuardarMedicamento"
                class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
        </form>
    </div>
</div>

@push('scripts')
<script>

    $(() => {
        window.createdExam = flatpickr(document.getElementById('fecha'), {
            //minDate: GetTodayDate(),
            minuteIncrement: 1,
            defaultDate: GetTodayDate()
            //locale: 'es'
            //defaultDate: GetTodayDateTime()
        });
    });

    $('#btnGuardarMedicamento').click((e) => {
        e.preventDefault();
        if($('#formMedicamento').get(0).reportValidity()){
            $('#btnGuardarMedicamento').prop('disabled',true);
            $('#btnGuardarMedicamento').html('Guardando...');
            $('#formMedicamento').submit();
        }
    });

    function CreateMedicamentoModal(id) {
        $('#formMedicamento').get(0).reset();
        Livewire.emit('createMedicamento', id);
    }

    function EditMedicamentoModal(id) {
        Livewire.emit('editMedicamento', id);
    }

    Livewire.on('updateKardexView', (action, med) => {
        $('#formMedicamento').attr('action', action);

        if (med) {
            $('#medicamento').val(med.medicamento);
            $('#dosis').val(med.dosis);
            $('#via').val(med.via);
            $('#frecuencia').val(med.frecuencia);
            $('#dia1').val(med.dia1);
            $('#dia2').val(med.dia2);
            $('#dia3').val(med.dia3);
            $('#dia4').val(med.dia4);
            $('#dia5').val(med.dia5);
            $('#dia6').val(med.dia6);
            $('#dia7').val(med.dia7);
            $('#dia8').val(med.dia8);

            //if (med.fecha) {
            $('#fecha').val(med.fecha);
            window.createdExam.setDate(med.fecha);
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
        let today = GetTodayDate();
        window.createdExam.setDate(today);
        $('#fecha').val(today);
    }

</script>
@endpush
