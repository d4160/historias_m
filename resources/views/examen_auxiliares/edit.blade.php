<!-- Modal -->
<div wire:ignore.self class="modal fade form-modal" id="examEditModal" tabindex="-1" role="dialog" aria-labelledby="examEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="examEditModalHeader">
                <h4 class="modal-title">Editar <span id="exam-edit-title">Examen Auxiliar</span></h4>
                {{--  (<span id="exam_edit_titulo"></span>)  --}}
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form id="exam_edit_form" method="POST" class="mt-0" action="{{ route('examen_auxiliares.update', old('exam_edit_id', 1)) }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="exam_edit_id" id="exam_edit_id" value="{{ old('exam_edit_id') }}">
                    <div class="form-group">
                        <label for="edit_titulo">Título *</label>
                        {{ Form::select('edit_titulo', ['Tomografía' => 'Tomografía', 'Rayos X' => 'Rayos X', 'Laboratorio' => 'Laboratorio', 'Ecografía' => 'Ecografía', 'Resonancia Magnética' => 'Resonancia Magnética'], old('edit_titulo'), ['id' => 'edit_titulo', 'class' => 'mb-2 form-control', 'required' => 'required']) }}
                        @error('edit_titulo') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="created_at_edit">Fecha y hora de subida</label>
                        <div class="d-flex">
                            <input id="created_at_edit" name="created_at_edit" value="{{ old('created_at_edit') }}" class="form-control" type="text" placeholder="" data-input>
                            <button type="button" class="btn" id="created_now_edit">Ahora</button>
                        </div>
                        {{--  readonly="readonly"  --}}
                        {{--  <a class="input-button" title="toggle" data-toggle>
                            <i class="icon-calendar"></i>
                        </a>  --}}
                    </div>
                    <div class="form-group">
                        <label for="edit_descripcion">Descripción</label>
                        <textarea class="mb-2 form-control" id="edit_descripcion" name="edit_descripcion" rows="2">{{ old('edit_descripcion') }}</textarea>
                        @error('edit_descripcion') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group mt-4" id="replace_file">
                        <a target="_blank" id="edit_file_download"><span class="font-weight-bold">Archivo actual</span>: <span id="edit_file_url"></span></a><br>
                        <label for="edit_file1" style="letter-spacing: 0px;" class="mt-4 font-weight-bold">Reemplazar por: </label>
                        <input type="file" class="form-control-file" id="edit_file1" name="edit_file">
                        @error('edit_file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                        <label class="mt-1">(No elegir ninguno para conservar el archivo actual)</label>
                    </div>
                    <div class="form-group mb-4" id="put_file">
                        <label for="edit_file2">Archivo</label>
                        <input type="file" class="form-control-file" id="edit_file2" name="edit_file2">
                        @error('edit_file2') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" id="btnGuardarEditExam" class="mt-2 mb-2 btn btn-primary btn-block btn_submit2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent

<script>

    $(() => {
        let createdExam = flatpickr(document.getElementById('created_at_edit'), {
            maxDate: GetTodayDate(),
            enableTime: true,
            minuteIncrement: 1
            //locale: 'es'
            //defaultDate: GetTodayDateTime()
        });

        $('#created_at_edit').val(GetTodayDateTime());
        //createdExam.setDate(GetTodayDateTime(), false);

        $('#created_now_edit').click(() => {
            $('#created_at_edit').val(GetTodayDateTime());
            //createdExam.setDate(GetTodayDateTime(), false);
        });
    });

    $('#btnGuardarEditExam').click((e) => {
        e.preventDefault();
        $('#btnGuardarEditExam').prop('disabled',true);
        // $(this).css('color', 'black');
        // this.style.setProperty( 'color', 'black', 'important' );
        $('#btnGuardarEditExam').html('Guardando...');
        $('#exam_edit_form').submit();
    });

    @if($errors->has('edit_titulo') || $errors->has('edit_descripcion') || $errors->has('edit_file'))


        $(function() {
            $('#examModal').modal({
                show: false
            });
            $('#examEditModal').modal({
                show: true
            });
        });


    @endif
</script>

@endsection
