<div class="col">
    <label for="num_document">DNI o CE *</label>
    <input p_id="{{ $p_id }}" id="num_document" name="num_document" type="text" class="form-control" placeholder="77777777" value="{{ old('num_document', $value) }}" required {{ $autofocus }} minlength="8" maxlength="11">
</div>

@push('scripts')
<script>

    $( "#num_document" ).on( "focusout", function() {
        console.log($('#num_document').attr('p_id'));
        Livewire.emit('numDocFocusout', $('#num_document').val(), $('#num_document').attr('p_id'));
    } );

    Livewire.on('numDocAlreadyExists', () => {
        Snackbar.show({
            text: 'DNI o CE ya esta registrado',
            actionTextColor: '#fff',
            backgroundColor: '#e7515a',
            actionText: 'OK'
        });

        $('#num_document').focus();
    });

</script>
@endpush