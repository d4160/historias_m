<input type="hidden" id="antecedentes_modal_id" name="antecedentes_id" value="{{ old('antecedentes_id') }}">

<div class="form-group">
    <label for="antecedentes">Descripción</label>
    <textarea id="antecedentes" name="antecedentes" type="text" class="mb-2 form-control" placeholder="" rows="5">{{ old('antecedentes') }}</textarea>
    @error('antecedentes') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
</div>

@push('scripts')
<script>
    $('#antecedentes_modal_id').change(() => {
        $('#antecedentes').val('CARGANDO...');
        Livewire.emit('onAntecedentesChanged', $('#antecedentes_modal_id').val());
    });

    Livewire.on('updateAntecedentesView', (data) => {
        $('#antecedentes_modal_id').val(data.id);
        $('#antecedentes').val(data.antecedentes);
    });

</script>
@endpush
