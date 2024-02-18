<!-- Modal -->
<div class="modal fade form-modal" id="historiasModal" tabindex="-1" role="dialog" aria-labelledby="historiasModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="historiasModalHeader">
                <h4 class="modal-title">Historia del paciente '<span id="pac_fullname"></span>'</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <div class="modal-body">
                <livewire:historias/>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
</script>
@endsection