<!-- Modal -->
<div class="modal fade form-modal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="createModalHeader">
                <h4 class="modal-title">Nuevo Resultado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="mt-0" action="{{ route('results.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="create_modal_user_id" name="user_id" value="{{ old('user_id') }}">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input id="title" type="text" class="mb-2 form-control" name="title" placeholder="" required value="{{ old('title') }}">
                        @error('title') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="mb-2 form-control" id="description" name="description" rows="2">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Archivo</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                        @error('file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    {{--  onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'"  --}}
                    <button type="submit" id="btnCreateSubmit" class="mt-2 mb-2 btn btn-primary btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
