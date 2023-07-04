<input type="hidden" id="tratamiento_modal_id" name="tratamiento_id" value="{{ old('tratamiento_id') }}">

<div class="form-group">
    <label for="tratamiento">Descripción</label>
    <textarea id="tratamiento" name="tratamiento" type="text" class="mb-2 form-control" placeholder="" rows="14">{{ old('tratamiento') }}</textarea>
    @error('tratamiento') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
</div>

@push('scripts')
<script>
    $('#tratamiento_modal_id').change(() => {
        $('#tratamiento').val('CARGANDO...');
        Livewire.emit('onTratamientoChanged', $('#tratamiento_modal_id').val());
    });

    Livewire.on('updateTratamientoView', (data) => {
        $('#tratamiento_modal_id').val(data.id);
        $('#tratamiento').val(data.tratamiento);
    });

</script>
@endpush
