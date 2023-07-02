<!-- Modal -->
<div wire:ignore.self class="modal fade form-modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="editModalHeader">
                <h4 class="modal-title">Editar Medicamento (<span id="medicamento_title">{{ old('edit_title', 'Title') }}</span>)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="POST" class="mt-0" action="{{ route('medicamentos.update', ['id' => old('edit_id', 1), 'cita_id' => $cita->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="edit_id" id="edit_id" value="{{ old('edit_id') }}">
                    <div class="form-group">
                        <label for="edit_medicamento">Medicamento</label>
                        <input id="edit_medicamento" type="text" class="mb-2 form-control" name="edit_medicamento" placeholder="" required value="{{ old('edit_medicamento') }}">
                        @error('edit_medicamento') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_concentracion">Concentración</label>
                        <input id="edit_concentracion" type="text" class="mb-2 form-control" name="edit_concentracion" placeholder="" required value="{{ old('edit_concentracion') }}">
                        @error('edit_concentracion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_dosis">Dosis</label>
                        <input id="edit_dosis" type="text" class="mb-2 form-control" name="edit_dosis" placeholder="" required value="{{ old('edit_dosis') }}">
                        @error('edit_dosis') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_frecuencia">Frecuencia</label>
                        <input id="edit_frecuencia" type="text" class="mb-2 form-control" name="edit_frecuencia" placeholder="" required value="{{ old('edit_frecuencia') }}">
                        @error('edit_frecuencia') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_via">Vía</label>
                        {{ Form::select('edit_via', ['Oral' => 'Oral', 'Endovenosa' => 'Endovenosa', 'Intramuscular' => 'Intramuscular', 'Subcutáneo' => 'Subcutáneo', 'Rectal' => 'Rectal', 'Nasal' => 'Nasal', 'Ocular' => 'Ocular', 'Tópica' => 'Tópica'], old('edit_via'), ['id' => 'edit_via', 'class' => 'form-control', 'required' => 'required']) }}
                        @error('edit_via') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" id="btnEditSubmit" class="mt-2 mb-2 btn btn-primary btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent

<script>
    @if($errors->has('edit_title') || $errors->has('edit_description') || $errors->has('edit_file'))


        $(function() {
            $('#createModal').modal({
                show: false
            });
            $('#editModal').modal({
                show: true
            });
        });


    @endif

    $('#btnEditSubmit').click(function(e){
        e.preventDefault();
        if(this.form.reportValidity()){
            $(this).prop('disabled',true);
            $(this).html('Guardando...');
            this.form.submit();
        }
    });
</script>

@endsection
