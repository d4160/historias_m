<!-- Modal -->
<div wire:ignore.self class="modal fade form-modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="editModalHeader">
                <h4 class="modal-title">Editar Resultado (<span id="result_title">{{ old('edit_title', 'Title') }}</span>)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="POST" class="mt-0" action="{{ route('results.update', old('edit_id', 1)) }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="edit_id" id="edit_id" value="{{ old('edit_id') }}">
                    <div class="form-group">
                        <label for="edit_title">Título</label>
                        <input id="edit_title" type="text" class="mb-2 form-control" name="edit_title" placeholder="" value="{{ old('edit_title') }}" required>
                        @error('edit_title') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Descripción</label>
                        <textarea class="mb-2 form-control" id="edit_description" name="edit_description" rows="2">{{ old('edit_description') }}</textarea>
                        @error('edit_description') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <a target="_blank" id="edit_file_download">Archivo actual: <span id="edit_file_url"></span></a><br>
                        <label for="edit_file" style="letter-spacing: 0px;" class="mt-2">Reemplazar por: </label>
                        <input type="file" class="form-control-file" id="edit_file" name="edit_file">
                        @error('edit_file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                        <label class="mt-1">(No elegir ninguno para conservar el archivo actual)</label>
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
