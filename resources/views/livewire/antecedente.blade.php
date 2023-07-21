<input type="hidden" id="antecedentes_modal_id" name="antecedentes_id" value="{{ old('antecedentes_id') }}">

<div class="form-group">
    <div class="row">
        <div class="col">
            <label for="familiares">Familiares</label>
            <textarea id="familiares" name="familiares" type="text" class="mb-2 form-control" placeholder=""
                rows="2">{{ old('familiares') }}</textarea>
            @error('familiares') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col">
            <label for="personales">Personales</label>
            <textarea id="personales" name="personales" type="text" class="mb-2 form-control" placeholder=""
                rows="2">{{ old('personales') }}</textarea>
            @error('personales') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col">
            <label for="hab_nocivos">Hábitos Nocivos</label>
            <textarea id="hab_nocivos" name="hab_nocivos" type="text" class="mb-2 form-control" placeholder=""
                rows="2">{{ old('hab_nocivos') }}</textarea>
            @error('hab_nocivos') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col">
            <label for="antecedentes">Otros</label>
            <textarea id="antecedentes" name="antecedentes" type="text" class="mb-2 form-control" placeholder="" rows="3">{{ old('antecedentes') }}</textarea>
            @error('antecedentes') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#antecedentes_modal_id').change(() => {
        $('#antecedentes').val('CARGANDO...');
        Livewire.emit('onAntecedentesChanged', $('#antecedentes_modal_id').val());
    });

    Livewire.on('updateAntecedentesView', (data) => {
        $('#antecedentes_modal_id').val(data.id);
        $('#familiares').val(data.familiares);
        $('#personales').val(data.personales);
        $('#hab_nocivos').val(data.hab_nocivos);
        $('#antecedentes').val(data.antecedentes);
    });

</script>
@endpush
