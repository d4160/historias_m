<!-- Modal -->
<div wire:ignore.self class="modal fade form-modal" id="procEditModal" tabindex="-1" role="dialog" aria-labelledby="procEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="procEditModalHeader">
                <h4 class="modal-title">Editar Procedimiento (<span id="proc_titulo">{{ old('proc_edit_titulo', 'Title') }}</span>)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form id="proc_edit_form" method="POST" class="mt-0" action="{{ route('examen_auxiliares.update', old('proc_edit_id', 1)) }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="proc_edit_id" id="proc_edit_id" value="{{ old('proc_edit_id') }}">
                    <div class="form-group">
                        <label for="proc_edit_titulo">Título</label>
                        <input id="proc_edit_titulo" type="text" class="mb-2 form-control" name="lab_edit_titulo" placeholder="" value="{{ old('lab_edit_titulo') }}" required>
                        @error('lab_edit_titulo') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="proc_edit_descripcion">Descripción</label>
                        <textarea class="mb-2 form-control" id="proc_edit_descripcion" name="lab_edit_descripcion" rows="2">{{ old('lab_edit_descripcion') }}</textarea>
                        @error('lab_edit_descripcion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group" id="proc_replace_file">
                        <a target="_blank" id="proc_edit_file_download">Archivo actual: <span id="proc_edit_file_url"></span></a><br>
                        <label for="proc_edit_file1" style="letter-spacing: 0px;" class="mt-2">Reemplazar por: </label>
                        <input type="file" class="form-control-file" id="proc_edit_file1" name="lab_edit_file">
                        @error('lab_edit_file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                        <label class="mt-1">(No elegir ninguno para conservar el archivo actual)</label>
                    </div>
                    <div class="form-group" id="proc_put_file">
                        <label for="proc_edit_file2">Archivo</label>
                        <input type="file" class="form-control-file" id="proc_edit_file2" name="lab_edit_file2">
                        @error('lab_edit_file2') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent

<script>
    @if($errors->has('lab_edit_titulo') || $errors->has('lab_edit_descripcion') || $errors->has('lab_edit_file'))


        $(function() {
            $('#procModal').modal({
                show: false
            });
            $('#procEditModal').modal({
                show: true
            });
        });


    @endif
</script>

@endsection
