<!-- Modal -->
<div class="modal fade form-modal" id="admin_import_csv" tabindex="-1" role="dialog" aria-labelledby="admin_import_csv" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="admin_import_csv_Header">
                <h4 class="modal-title">Importar CSV</h4><br>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <p>¡Atención! Esto puede durar varios minutos, ¡se recomienda un límite máximo de 300 entradas!</p>
                <form method="POST" class="mt-0" action="{{ route('admins.import') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="file">Archivo CSV</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        @error('file') <div class="invalid-feedback" style="display: block;">{{ $message }}</div> @enderror
                    </div>

                    {{--  onclick="this.form.submit(); this.disabled = true; this.innerText='Guardando...'"  --}}
                    <button type="submit" class="mt-2 mb-2 btn btn-primary btn-block btn_submit">Importar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    @if($errors->has('file'))

        $(function() {
            $('#admin_import_csv').modal({
                show: true
            });
        });

    @endif
</script>
@endsection
