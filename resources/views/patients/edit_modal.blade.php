<!-- Modal -->
<div class="modal fade form-modal" id="historiaModal" tabindex="-1" role="dialog" aria-labelledby="historiaModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="historiaModalHeader">
                <h4 class="modal-title">Paciente '<span id="hc_number"></span>'</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formHC" class="mt-0" action="">
                    @csrf

                    <input type="hidden" id="hc_modal_id" name="historia_id" value="{{ old('historia_id') }}">
                    <div class="form-group">
                        <label for="proxima_cita">Próxima Cita</label>
                        <input id="proxima_cita" name="proxima_cita" value="{{ old('proxima_cita') }}" class="form-control" type="text" placeholder="" readonly="readonly" required>
                        @error('proxima_cita') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        {{ Form::select('estado', ['Atendido' => 'Atendido', 'Evaluación' => 'Evaluación', 'Pendiente' => 'Pendiente'], old('estado'), ['id' => 'estado', 'class' => 'form-control', 'required' => 'required']) }}
                        @error('estado') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    {{--  onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'"  --}}
                    <button type="submit" id="btnGuardarHC" class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>

    $('#btnGuardarHC').click((e) => {
        e.preventDefault();
        $('#btnGuardarHC').prop('disabled',true);
        $('#btnGuardarHC').html('Guardando...');
        $('#formHC').submit();
    });

    window.f1 = flatpickr(document.getElementById('proxima_cita'), {
        minDate: GetTodayDate(1)
    });

    @if($errors->has('proxima_cita') || $errors->has('estado'))

        $(function() {
            $('#historiaModal').modal({
                show: true
            });
        });

    @endif
</script>
@endsection
