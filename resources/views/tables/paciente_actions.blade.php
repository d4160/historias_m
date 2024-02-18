<div class="flex space-x-1 justify-center">
    <ul class="table-controls">
        <li><a href="{{ route('patients.edit', $paciente_id) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>

        @if ($historias_count > 0)
        <li><span data-toggle="modal" data-target="#historiaModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="OpenPacienteModal('{{ $paciente_full_name }}', '{{ $paciente_id }}', '{{ route('patients.update2', $paciente_id) }}', '{{ $paciente_proxima_cita }}', '{{ $paciente_estado }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></span></li>
        @endif
        <li>
            <form method="POST" id="delete_{{ $paciente_id }}_form" action="{{ route('patients.destroy', $paciente_id) }}" style="display: inline-block">
                @csrf
                <a href="javascript:void(0);" class="bs-tooltip patient_remove confirm"
                                        {{-- form_id="delete_{{ $patient->id }}_form"
                                        patient_full_name="{{ $patient->full_name }}" --}}
                                        data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar" onclick="ConfirmDeletePac('delete_{{ $paciente_id }}_form', '{{ $paciente_full_name }}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </a>
            </form>
        </li>
    </ul>
</div>
