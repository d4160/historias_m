<div>
    <input type="hidden" id="anamnesis_modal_id" name="anamnesis_id" value="{{ old('anamnesis_id') }}">

    <div class="form-group">
        <label for="anamnesis">Descripción</label>
        <textarea id="anamnesis" name="anamnesis" type="text" class="mb-2 form-control" placeholder="" rows="6">{{ old('anamnesis') }}</textarea>
        @error('anamnesis') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
    </div>
</div>

@push('scripts')
<script>
    $('#anamnesis_modal_id').change(() => {
        $('#anamnesis').val('CARGANDO...');
        Livewire.emit('onAnamnesisChanged', $('#anamnesis_modal_id').val());
    });

    Livewire.on('updateAnamnesisView', (data) => {
        $('#anamnesis_modal_id').val(data.id);
        $('#anamnesis').val(data.anamnesis);
    });

</script>
@endpush
