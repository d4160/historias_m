<!-- Modal -->
<div class="modal fade form-modal" id="examenClinicoModal" tabindex="-1" role="dialog" aria-labelledby="examenClinicoModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" id="examenClinicoModalHeader">
                <h4 class="modal-title">Examen Clínico - H.C. <span id="examen_clinico_hc"></span> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formExamenClinico" class="mt-0 darkForm" action="{{ route('historias.update_examen_clinico') }}" enctype="multipart/form-data">
                    @csrf

                    <livewire:examen-clinico/>
                    {{--  <div class="form-group">
                        <label for="lab_descripcion">Descripción</label>
                        <textarea class="mb-2 form-control" id="lab_descripcion" name="lab_descripcion" rows="2">{{ old('lab_descripcion') }}</textarea>
                        @error('lab_descripcion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="lab_file">Archivo</label>
                        <input type="file" class="form-control-file" id="lab_file" name="lab_file">
                        @error('lab_file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>  --}}

                    {{--  onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'"  --}}
                    <button type="submit" id="btnGuardarExamenClinico" class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>

    $('#btnGuardarExamenClinico').click((e) => {
        e.preventDefault();
        $('#btnGuardarExamenClinico').prop('disabled',true);
        $('#btnGuardarExamenClinico').html('Guardando...');
        $('#formExamenClinico').submit();
    });

    @if($errors->has('peso') || $errors->has('talla'))

        $(function() {
            $('#examenClinicoModal').modal({
                show: true
            });
        });

    @endif
</script>
@endsection
