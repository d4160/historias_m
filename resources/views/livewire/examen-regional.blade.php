<div>
    <input type="hidden" id="examen_regional_modal_id" name="examen_regional_id" value="{{ old('examen_regional_id') }}">

    <div class="form-group">
        <label for="examen_regional">Descripción</label>
        <textarea id="examen_regional" name="examen_regional" type="text" class="mb-2 form-control" placeholder="" rows="8">{{ old('examen_regional') }}</textarea>
        @error('examen_regional') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
    </div>
</div>

@push('scripts')
<script>
    $('#examen_regional_modal_id').change(() => {
        $('#examen_regional').val('CARGANDO...');
        Livewire.emit('onExamenRegionalChanged', $('#examen_regional_modal_id').val());
    });

    Livewire.on('updateExamenRegionalView', (data) => {
        $('#examen_regional_modal_id').val(data.id);
        $('#examen_regional').val(data.examen_regional);
    });

</script>
@endpush
