<div>
    <input type="hidden" id="impresion_diagnostica_modal_id" name="impresion_diagnostica_id" value="{{ old('impresion_diagnostica_id') }}">

    <input type="hidden" id="id_historia_id" name="id_historia_id" value="{{ old('id_historia_id') }}">

    <div class="form-group">
        <label for="impresion_diagnostica">Descripción</label>
        <textarea id="impresion_diagnostica" name="impresion_diagnostica" type="text" class="mb-2 form-control" placeholder="" rows="14">{{ old('impresion_diagnostica') }}</textarea>
        @error('impresion_diagnostica') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
    </div>
</div>

@push('scripts')
<script>
    $('#impresion_diagnostica_modal_id').change(() => {
        $('#impresion_diagnostica').val('CARGANDO...');
        Livewire.emit('onImpresionDiagnosticaChanged', $('#impresion_diagnostica_modal_id').val());
    });

    Livewire.on('updateImpresionDiagnosticaView', (data) => {
        $('#impresion_diagnostica_modal_id').val(data.id);
        $('#impresion_diagnostica').val(data.impresion_diagnostica);
    });

</script>
@endpush
