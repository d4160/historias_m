<!-- Modal -->
<div class="modal fade form-modal" id="antecedentesModal" tabindex="-1" role="dialog" aria-labelledby="antecedentesModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="antecedentesModalHeader">
                <h4 class="modal-title">Antecedentes - H.C. <span id="antecedentes_hc"></span> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formAntecedentes" class="mt-0" action="{{ route('citas.update_antecedentes') }}" enctype="multipart/form-data">
                    @csrf

                    <livewire:antecedente/>
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
                    <button type="submit" id="btnGuardarAntecedentes" class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>

    $('#btnGuardarAntecedentes').click(() => {
        $('#btnGuardarAntecedentes').prop('disabled',true);
        // $(this).css('color', 'black');
        // this.style.setProperty( 'color', 'black', 'important' );
        $('#btnGuardarAntecedentes').html('Guardando...');
        $('#formAntecedentes').submit();
    });

    @if($errors->has('antecedentes'))

        $(function() {
            $('#antecedentesModal').modal({
                show: true
            });
        });

    @endif
</script>
@endsection
