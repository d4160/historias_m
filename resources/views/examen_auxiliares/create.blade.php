<!-- Modal -->
<div class="modal fade form-modal" id="examModal" tabindex="-1" role="dialog" aria-labelledby="examModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="examModalHeader">
                <h4 class="modal-title">Nuevo <span id="exam-title">Examen Auxiliar</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formExam" class="mt-0" action="{{ route('examen_auxiliares.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="exam_modal_historia_id" name="historia_id" value="{{ old('historia_id') }}">
                    <div class="form-group">
                        <label for="titulo">Título *</label>
                        {{ Form::select('titulo', ['Tomografía' => 'Tomografía', 'Rayos X' => 'Rayos X', 'Laboratorio' => 'Laboratorio', 'Ecografía' => 'Ecografía', 'Resonancia Magnética' => 'Resonancia Magnética', 'Otros' => 'Otros'], old('titulo'), ['id' => 'titulo', 'class' => 'mb-2 form-control', 'required' => 'required']) }}
                        @error('titulo') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="created_at">Fecha y hora de subida</label>
                        <div class="d-flex">
                            <input id="created_at" name="created_at" value="{{ old('created_at') }}" class="form-control" type="text" placeholder="" data-input>
                            <button type="button" class="btn" id="created_now">Ahora</button>
                        </div>
                        {{--  readonly="readonly"  --}}
                        {{--  <a class="input-button" title="toggle" data-toggle>
                            <i class="icon-calendar"></i>
                        </a>  --}}
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="mb-2 form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4 form-group">
                        <label for="file">Archivo</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        @error('file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    {{--  onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'"  --}}
                    <button type="submit" id="btnGuardarExam" class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>

    $(() => {
        let createdExam = flatpickr(document.getElementById('created_at'), {
            maxDate: GetTodayDate(1),
            enableTime: true,
            minuteIncrement: 1,
            defaultDate: GetTodayDateTime()
            //locale: 'es'
            //defaultDate: GetTodayDateTime()
        });

        $('#created_now').click(() => {
            createdExam.setDate(GetTodayDateTime());
        });
    });

    $('#btnGuardarExam').click((e) => {
        e.preventDefault();
        $('#btnGuardarExam').prop('disabled',true);
        // $(this).css('color', 'black');
        // this.style.setProperty( 'color', 'black', 'important' );
        $('#btnGuardarExam').html('Guardando...');
        $('#formExam').submit();
    });

    @if($errors->has('titulo') || $errors->has('descripcion') || $errors->has('file'))

        $(function() {
            $('#examModal').modal({
                show: true
            });
        });

    @endif
</script>
@endsection
