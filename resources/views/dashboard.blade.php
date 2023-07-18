<x-layouts.admin title="Resultados en línea" bodyTitle="Resultados en línea">

    @php
        $user = Auth::user();
    @endphp

    <div class="ml-3 layout-top-spacing">
        <h6>Hola, {{ $user->full_name }}.</h6>
        <p>Bienvenido(a) a Mis Resultados en Línea.</p>
        <br>
        @php
            $user = Auth::user();
        @endphp
        @if ($user->user_role_id > 1 && $user->user_role_id < 5)
            <p><strong>Rol</strong>: Administrador</p>
            <a type="button" class="ml-3 btn btn-primary" href="{{ route('patients.all') }}">Buscar paciente</a>
            <a type="button" class="ml-3 btn btn-secondary" href="{{ route('patients.create') }}">Nuevo paciente</a>
        @elseif ($user->user_role_id === 1)
            <p><strong>Rol</strong>: Súper Usuario</p>
            <a type="button" class="ml-3 btn btn-primary" href="{{ route('patients.all') }}">Buscar paciente</a>
            <a type="button" class="ml-3 btn btn-secondary" href="{{ route('patients.create') }}">Nuevo paciente</a>
            <br><br>
            <a type="button" class="ml-3 btn btn-primary" href="{{ route('admins.all') }}">Buscar Administrador</a>
            <a type="button" class="ml-3 btn btn-secondary" href="{{ route('admins.create') }}">Nuevo administrador</a>
        @elseif ($user->user_role_id === 5)
            <p><strong>Rol</strong>: Paciente</p>
            <a type="button" class="ml-3 btn btn-primary" href="{{ route('results.all') }}">Ir a mis resultados</a>
        @endif
    </div>

</x-layouts.admin>
