<!-- Modal -->
<div class="modal fade form-modal" id="citaModal" tabindex="-1" role="dialog" aria-labelledby="citaModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:cita />
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>

    @if($errors->has('num_document'))

        $(function() {
            $('#citaModal').modal({
            show: true
            });
        });

    @endif
</script>
@endsection
