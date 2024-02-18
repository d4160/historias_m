<div class="flex space-x-1 justify-center">
    <span class="shadow-none badge badge-primary" style="font-size: 17px; font-weight: normal;">{{ $historias_count }}</span>
    @if ($historias_count > 0)
        <span data-toggle="modal" data-target="#historiasModal"><a class="bs-tooltip" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver Atenciones" onclick="OpenHistoriasModal('{{ $paciente_full_name }}', '{{ $paciente_id }}');"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-file-text br-6"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></a></span>
    @endif
</div>