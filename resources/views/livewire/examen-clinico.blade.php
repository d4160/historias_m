<div>
    <input type="hidden" id="examen_clinico_modal_id" name="examen_clinico_id" value="{{ old('examen_clinico_id') }}">

    <span style="font-weight: bold; color: #313131; font-size: 17px;">Funciones Vitales</span>

    <div class="mt-2 form-group">
        <div class="row">
            <div class="col">
                <label for="fc">FC (latidos por minuto)</label>
                <input id="fc" name="fc" min="0" type="number" step="1" class="mb-2 form-control" placeholder=""
                    value="{{ old('fc') }}">
                @error('fc') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
            <div class="col">
                <label for="fr">FR (respiraciones por minuto)</label>
                <input id="fr" name="fr" min="0" type="number" step="1" class="mb-2 form-control" placeholder=""
                    value="{{ old('fr') }}">
                @error('fr') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="mt-2 form-group">
        <div class="row">
            <div class="col">
                <label for="pa">PA (mmHg)</label>
                <input id="pa" name="pa" type="text" maxlength="10" class="mb-2 form-control" placeholder=""
                    value="{{ old('pa') }}">
                @error('pa') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
            <div class="col">
                <label for="sat">Saturación (%)</label>
                <input id="sat" name="sat" min="0" type="number" step="1" class="mb-2 form-control" placeholder=""
                    value="{{ old('sat') }}">
                @error('sat') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>

            <div class="col">
                <label for="temperatura">Temperatura (ºC)</label>
                <input id="temperatura" name="temperatura" min="0" type="number" step="0.1" class="mb-2 form-control"
                    placeholder="" value="{{ old('temperatura') }}">
                @error('temperatura') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <span style="font-weight: bold; color: #313131; font-size: 17px;">Otros Datos</span>

    <div class="mt-2 form-group">
        <div class="row">
            <div class="col">
                <label for="peso">Peso (Kg)</label>
                <input id="peso" name="peso" min="0.0" type="number" step="0.1" class="mb-2 form-control" placeholder="" value="{{ old('peso') }}">
                @error('peso') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
            <div class="col">
                <label for="talla">Talla (m)</label>
                <input id="talla" name="talla" min="0.0" type="number" step="0.01" class="mb-2 form-control" placeholder="" value="{{ old('talla') }}">
                @error('talla') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
            <div class="col">
                <label for="deposiciones">Deposiciones</label>
                <input id="deposiciones" name="deposiciones" type="text" class="mb-2 form-control" placeholder=""
                    value="{{ old('deposiciones') }}">
                @error('deposiciones') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col">
                <label for="orina">Orina</label>
                <input id="orina" name="orina" type="text" class="mb-2 form-control" placeholder="" value="{{ old('orina') }}">
                @error('orina') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
            <div class="col">
                <label for="fur">Fecha de Última Regla</label>
                <input id="fur" name="fur" type="text" class="mb-2 form-control" placeholder="" value="{{ old('fur') }}" required>
                @error('fur') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
            <div class="col">
                <label for="otros">Otros</label>
                <textarea id="otros" name="otros" type="text" class="mb-2 form-control" placeholder=""
                    rows="3">{{ old('otros') }}</textarea>
                @error('otros') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#examen_clinico_modal_id').change(() => {
        $('#funciones_vitales').val('CARGANDO...');
        $('#peso').val('CARGANDO...');
        $('#talla').val('CARGANDO...');
        $('#deposiciones').val('CARGANDO...');
        $('#orina').val('CARGANDO...');
        $('#fur').val('CARGANDO...');
        Livewire.emit('onExamenClinicoChanged', $('#examen_clinico_modal_id').val());
    });

    Livewire.on('updateExamenClinicoView', (data) => {
        $('#examen_clinico_modal_id').val(data.id);
        $('#fc').val(data.fc);
        $('#fr').val(data.fr);
        $('#sat').val(data.sat);
        $('#pa').val(data.pa);
        $('#temperatura').val(data.temperatura);
        $('#peso').val(data.peso);
        $('#talla').val(data.talla);
        $('#deposiciones').val(data.deposiciones);
        $('#orina').val(data.orina);
        $('#fur').val(data.fur);
        $('#otros').val(data.otros);
    });

</script>
@endpush
