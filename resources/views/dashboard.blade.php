<x-layouts.admin title="DMI - Resultados en línea" bodyTitle="Resultados en línea">

    @php
        $user = Auth::user();
    @endphp

    <div class="ml-3 layout-top-spacing">
        <h6>Hola {{ $user->full_name }},</h6>
        <p>Bienvenid@ al sistema de Resultados en Línea de DMI.</p>
        <br>
        @php
            $user = Auth::user();
        @endphp
        @if ($user->user_role_id === 1 || $user->user_role_id === 2)
            <p><strong>Rol</strong>: Administrador</p>
            <a type="button" class="ml-3 btn btn-primary" href="{{ route('patients.all') }}">Buscar paciente</a>
        @elseif ($user->user_role_id === 3)
            <p><strong>Rol</strong>: Paciente</p>
            <a type="button" class="ml-3 btn btn-primary" href="{{ route('results.all') }}">Ir a mis resultados</a>
        @endif
    </div>

</x-layouts.admin>
