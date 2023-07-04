<input type="hidden" id="examen_clinico_modal_id" name="examen_clinico_id" value="{{ old('examen_clinico_id') }}">

<div class="form-group">
    <label for="funciones_vitales">Funciones Vitales</label>
    <textarea id="funciones_vitales" name="funciones_vitales" type="text" class="mb-2 form-control" placeholder="" rows="3">{{ old('funciones_vitales') }}</textarea>
    @error('funciones_vitales') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
</div>


<div class="form-group">
    <div class="row">
        <div class="col">
            <label for="peso">Peso (Kg)</label>
            <input id="peso" name="peso" min="0.0" type="number" step="0.1" class="mb-2 form-control" placeholder="" value="{{ old('peso') }}" required>
            @error('peso') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
        <div class="col">
            <label for="talla">Talla (m)</label>
            <input id="talla" name="talla" min="0.0" type="number" step="0.01" class="mb-2 form-control" placeholder="" value="{{ old('talla') }}" required>
            @error('talla') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col">
            <label for="deposiciones">Deposiciones</label>
            <input id="deposiciones" name="deposiciones" type="text" class="mb-2 form-control" placeholder="" value="{{ old('deposiciones') }}" required>
            @error('deposiciones') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
        <div class="col">
            <label for="orina">Orina</label>
            <input id="orina" name="orina" type="text" class="mb-2 form-control" placeholder="" value="{{ old('orina') }}" required>
            @error('orina') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="fur">Fecha de Última Regla</label>
    <input id="fur" name="fur" type="text" class="mb-2 form-control" placeholder="" value="{{ old('fur') }}" required>
    @error('fur') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
</div>

<div class="form-group">
    <label for="otros">Otros</label>
    <textarea id="otros" name="otros" type="text" class="mb-2 form-control" placeholder="" rows="3">{{ old('otros') }}</textarea>
    @error('otros') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
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
        $('#funciones_vitales').val(data.funciones_vitales);
        $('#peso').val(data.peso);
        $('#talla').val(data.talla);
        $('#deposiciones').val(data.deposiciones);
        $('#orina').val(data.orina);
        $('#fur').val(data.fur);
        $('#otros').val(data.otros);
    });

</script>
@endpush
