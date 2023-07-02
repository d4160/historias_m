<!-- Modal -->
@if($tratamiento)
    
<div class="modal fade form-modal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="createModalHeader">
                <h4 class="modal-title">Nuevo Medicamento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="mt-0" action="{{ route('medicamentos.store', ['id'=>$tratamiento->id,'cita_id'=>$cita->id]) }}">
                    @csrf

                    <input type="hidden" id="create_modal_user_id" name="user_id" value="{{ old('user_id') }}">
                    <div class="form-group">
                        <label for="medicamento">Medicamento</label>
                        <input id="medicamento" type="text" class="mb-2 form-control" name="medicamento" placeholder="" required value="{{ old('medicamento') }}">
                        @error('medicamento') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="concentracion">Concentración</label>
                        <input id="concentracion" type="text" class="mb-2 form-control" name="concentracion" placeholder="" required value="{{ old('concentracion') }}">
                        @error('concentracion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="dosis">Dosis</label>
                        <input id="dosis" type="text" class="mb-2 form-control" name="dosis" placeholder="" required value="{{ old('dosis') }}">
                        @error('dosis') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="frecuencia">Frecuencia</label>
                        <input id="frecuencia" type="text" class="mb-2 form-control" name="frecuencia" placeholder="" required value="{{ old('frecuencia') }}">
                        @error('frecuencia') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="via">Vía</label>
                        {{ Form::select('via', ['Oral' => 'Oral', 'Endovenosa' => 'Endovenosa', 'Intramuscular' => 'Intramuscular', 'Subcutáneo' => 'Subcutáneo', 'Rectal' => 'Rectal', 'Nasal' => 'Nasal', 'Ocular' => 'Ocular', 'Tópica' => 'Tópica'], old('via'), ['id' => 'via', 'class' => 'form-control', 'required' => 'required']) }}
                        {{--  <input id="via" type="text" class="mb-2 form-control" name="via" placeholder="" required value="{{ old('via') }}">  --}}
                        @error('via') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    {{--  onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'"  --}}
                    <button type="submit" id="btnCreateSubmit" class="mt-2 mb-2 btn btn-primary btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endif

@section('scripts')
@parent
<script>
    @if($errors->has('title') || $errors->has('description') || $errors->has('file'))

        $(function() {
            $('#createModal').modal({
                show: true
            });
        });

    @endif

    $('#btnCreateSubmit').click(function(e){
        e.preventDefault();
        if(this.form.reportValidity()){
            $(this).prop('disabled',true);
            // $(this).css('color', 'black');
            // this.style.setProperty( 'color', 'black', 'important' );
            $(this).html('Guardando...');
            this.form.submit();
        }
    });
</script>
@endsection
