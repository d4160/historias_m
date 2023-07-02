<!-- Modal -->
<div class="modal fade form-modal" id="procModal" tabindex="-1" role="dialog" aria-labelledby="procModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="procModalHeader">
                <h4 class="modal-title">Nuevo Procedimiento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="mt-0" action="{{ route('examen_auxiliares.store', 4) }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="proc_modal_cita_id" name="cita_id" value="{{ old('cita_id') }}">
                    <div class="form-group">
                        <label for="proc_titulo">Título</label>
                        <input id="proc_titulo" type="text" class="mb-2 form-control" name="lab_titulo" placeholder="" required value="{{ old('lab_titulo') }}">
                        @error('lab_titulo') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="proc_descripcion">Descripción</label>
                        <textarea class="mb-2 form-control" id="proc_descripcion" name="lab_descripcion" rows="2">{{ old('lab_descripcion') }}</textarea>
                        @error('lab_descripcion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="proc_file">Archivo</label>
                        <input type="file" class="form-control-file" id="proc_file" name="lab_file">
                        @error('lab_file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    {{--  onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'"  --}}
                    <button type="submit" class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    @if($errors->has('lab_titulo') || $errors->has('lab_descripcion') || $errors->has('lab_file'))

        $(function() {
            $('#procModal').modal({
                show: true
            });
        });

    @endif
</script>
@endsection
