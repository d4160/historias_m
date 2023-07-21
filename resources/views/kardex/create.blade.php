<!-- Modal -->
<div class="modal fade form-modal" id="medicamentoModal" tabindex="-1" role="dialog" aria-labelledby="examenClinicoModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:kardex />
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>

    @if($errors->has('peso') || $errors->has('talla'))

        $(function() {
            $('#medicamentoModal').modal({
            show: true
            });
        });

    @endif
</script>
@endsection
