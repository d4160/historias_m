<!-- Modal -->
<div class="modal fade form-modal" id="examModal" tabindex="-1" role="dialog" aria-labelledby="examModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="examModalHeader">
                <h4 class="modal-title">Nuevo Examen Auxiliar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="mt-0" action="{{ route('examen_auxiliares.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="exam_modal_historia_id" name="historia_id" value="{{ old('historia_id') }}">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input id="titulo" type="text" class="mb-2 form-control" name="titulo" placeholder="" required value="{{ old('titulo') }}">
                        @error('titulo') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="mb-2 form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Archivo</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        @error('file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
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
    @if($errors->has('titulo') || $errors->has('descripcion') || $errors->has('file'))

        $(function() {
            $('#examModal').modal({
                show: true
            });
        });

    @endif
</script>
@endsection
