<x-layouts.admin title="Detalle de paciente" bodyTitle="Datos del paciente">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet" type="text/css">

        @livewireStyles
    </x-slot>

    @include('results.create')
    @include('results.edit')
    @include('historias.anamnesis_edit')
    @include('historias.antecedentes_edit')
    @include('historias.examen_clinico_edit')
    @include('historias.examen_regional_edit')
    @include('historias.impresion_diagnostica_edit')
    @include('historias.tratamiento_edit')
    @include('historias.edit')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('patients.update', $patient_id) }}">
                        @csrf

                        <span style="font-weight: bold; color: darkgray; font-size: 17px;">Datos Personales</span>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">DNI o CE</label>
                                <input id="num_document" name="num_document" type="text" class="form-control" placeholder="77777777" value="{{ $patient->num_document }}" required autofocus minlength="8" maxlength="11">
                            </div>
                            <div class="col">
                                <label for="first_names">Nombres</label>
                                <input id="first_names" name="first_names" type="text" class="form-control" placeholder="" value="{{ $patient->first_names }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name1">Apellido Paterno</label>
                                <input id="last_name1" name="last_name1" type="text" class="form-control" placeholder="" value="{{ $patient->last_name1 }}" required>
                            </div>
                            <div class="col">
                                <label for="last_name2">Apellido Materno</label>
                                <input id="last_name2" name="last_name2" type="text" class="form-control" placeholder="" value="{{ $patient->last_name2 }}" required>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <div class="col">
                                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                <input id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $patient->fecha_nacimiento }}" class="form-control" type="text" placeholder="" readonly="readonly" required>
                            </div>
                            <div class="col">
                                <label for="edad">Edad</label>
                                <input id="edad" name="edad" type="text" class="form-control" placeholder="" value="{{ $patient->edad }}" readonly>
                            </div>
                            <div class="col">
                                <label for="estado_civil">Estado Civil</label>
                                {{ Form::select('estado_civil', ['S (Soltero)' => 'S (Soltero)', 'C (Casado)' => 'C (Casado)', 'Co (Conviviente)' => 'Co (Conviviente)', 'D (Divorciado)' => 'D (Divorciado)', 'V (Viudo)' => 'V (Viudo)'], $patient->estado_civil, ['id' => 'estado_civil', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="ocupacion">Ocupación</label>
                                <input id="ocupacion" name="ocupacion" type="text" class="form-control" placeholder="" value="{{ $patient->ocupacion }}" required>
                            </div>
                        </div>

                        <livewire:procedencia :patient="$patient"/>

                        <div class="mb-4 row">
                            <div class="col">
                                <label style="font-weight: bold; color: darkgray; font-size: 17px;" for="otros">Otros</label>
                                <textarea id="otros" name="otros" type="text" class="form-control" placeholder="">{{ $patient->otros }}</textarea>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btnSubmit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>Historia Clínica</h3>
        </div>
        <form method="POST" id="historia_nuevo_form" action="{{ route('citas.store', $patient_id) }}" style="display: inline-block">
            @csrf
            <a href="javascript:void(0);" class="ml-3 btn btn-success historia_nuevo confirm" 
                                    form_id="historia_nuevo_form"
                                    patient_full_name="{{ $patient->full_name }}">
                Nueva Historia
            </a>
        </form>
        </a>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="mb-4 table-responsive">
                        <table id="style-2" class="table style-3 table-hover">
                            {{--  table-hover  --}}
                            <thead>
                                <tr>
                                    <th class="checkbox-column">Id</th>
                                    <th>Nro. de H.C.</th>
                                    <th>Fecha y Hora</th>
                                    <th>Exámenes y Otros</th>
                                    <th>Proxima Cita</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historias as $historia)
                                <tr>
                                    <td class="checkbox-column"> {{ $historia->id }} </td>
                                    <td id="historia_{{ $historia->id }}_id">@php(printf("%06d", $historia->id))</td>
                                    <td>{{ $historia->created_at }}</td>
                                    <td>
                                        <ul class="table-controls">

                                            <li><span data-toggle="modal" data-target="#anamnesisModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Anamnesis" onclick="OpenAnamnesisModal(historia_{{ $historia->id }}_id, {{ $historia->anamnesis_id }})"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M223 620 c-4 -14 -14 -20 -34 -20 -16 0 -29 -4 -29 -10 0 -5 -24 -10
                                            -53 -10 -29 0 -58 -5 -65 -12 -17 -17 -17 -539 0 -556 9 -9 69 -12 209 -12
                                            166 0 200 2 213 16 13 12 16 40 16 140 0 166 -19 164 -22 -3 l-3 -128 -200 0
                                            -200 0 0 265 0 265 55 1 55 1 -50 -6 -50 -6 0 -255 0 -255 179 -3 c123 -2 183
                                            1 192 9 11 9 14 59 14 248 0 130 -4 241 -8 248 -4 6 -28 14 -52 16 -39 3 -37
                                            4 10 3 l55 -1 3 -122 c4 -163 22 -163 22 0 0 82 -4 127 -12 135 -7 7 -36 12
                                            -64 12 -29 0 -56 5 -59 10 -3 6 -16 10 -28 10 -12 0 -28 9 -35 20 -7 11 -22
                                            20 -33 20 -12 0 -23 -8 -26 -20z m47 -10 c0 -5 -7 -10 -15 -10 -8 0 -15 5 -15
                                            10 0 6 7 10 15 10 8 0 15 -4 15 -10z m60 -50 c0 -18 -7 -20 -75 -20 -68 0 -75
                                            2 -75 20 0 18 7 20 75 20 68 0 75 -2 75 -20z m-128 -54 c13 -23 94 -22 106 1
                                            7 11 27 18 66 21 l56 5 -2 -239 -3 -239 -172 -3 -173 -2 0 241 0 242 57 -6
                                            c36 -4 60 -12 65 -21z m88 4 c0 -5 -16 -10 -35 -10 -19 0 -35 5 -35 10 0 6 16
                                            10 35 10 19 0 35 -4 35 -10z"/>
                                            <path d="M160 375 l0 -86 93 3 92 3 0 80 0 80 -40 1 c-32 1 -34 1 -7 -3 l32
                                            -4 0 -70 c0 -39 -4 -69 -10 -69 -5 0 -10 9 -10 19 0 11 -4 23 -10 26 -5 3 -10
                                            17 -10 29 0 13 -7 29 -16 37 -24 20 -46 0 -63 -59 -9 -29 -19 -52 -23 -52 -4
                                            0 -8 31 -8 69 l0 70 33 4 c28 3 26 4 -10 5 l-43 2 0 -85z m108 18 c-4 -22 -22
                                            -20 -26 1 -2 10 3 16 13 16 10 0 15 -7 13 -17z m22 -63 c0 -16 -7 -20 -35 -20
                                            -28 0 -35 4 -35 20 0 16 7 20 35 20 28 0 35 -4 35 -20z"/>
                                            <path d="M125 250 c-4 -6 40 -10 124 -10 81 0 131 4 131 10 0 6 -48 10 -124
                                            10 -73 0 -127 -4 -131 -10z"/>
                                            <path d="M125 200 c-4 -6 40 -10 124 -10 81 0 131 4 131 10 0 6 -48 10 -124
                                            10 -73 0 -127 -4 -131 -10z"/>
                                            <path d="M130 150 c0 -6 48 -10 125 -10 77 0 125 4 125 10 0 6 -48 10 -125 10
                                            -77 0 -125 -4 -125 -10z"/>
                                            <path d="M125 100 c4 -6 58 -10 131 -10 76 0 124 4 124 10 0 6 -50 10 -131 10
                                            -84 0 -128 -4 -124 -10z"/>
                                            <path d="M527 513 c-11 -10 -8 -419 3 -447 28 -74 50 13 52 210 1 88 4 123 5
                                            79 5 -115 23 -121 23 -7 0 75 -3 92 -15 92 -9 0 -15 9 -15 24 0 13 -3 31 -6
                                            40 -6 16 -35 22 -47 9z m33 -43 c0 -31 -16 -41 -26 -15 -8 19 2 45 16 45 5 0
                                            10 -13 10 -30z m-5 -50 c3 -5 -1 -10 -10 -10 -9 0 -13 5 -10 10 3 6 8 10 10
                                            10 2 0 7 -4 10 -10z m5 -150 c0 -100 -2 -120 -15 -120 -12 0 -15 20 -15 120 0
                                            100 3 120 15 120 13 0 15 -20 15 -120z m0 -152 c0 -17 -20 -47 -20 -31 0 6 -3
                                            18 -6 27 -4 11 -1 16 10 16 9 0 16 -6 16 -12z"/>
                                            </g>
                                            </svg></a></li>

                                            <li><span data-toggle="modal" data-target="#antecedentesModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Antecedentes" onclick="OpenAntecedentesModal(historia_{{ $historia->id }}_id, {{ $historia->antecedente_id }})"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M0 565 c0 -43 4 -75 10 -75 6 0 10 28 10 65 l0 65 160 0 160 0 0 -45
                                            0 -45 45 0 45 0 0 -54 c0 -30 4 -58 10 -61 6 -4 10 21 10 67 0 74 0 74 -43
                                            116 l-43 42 -182 0 -182 0 0 -75z m420 -17 c0 -4 -13 -8 -30 -8 -28 0 -30 3
                                            -30 37 l0 37 30 -29 c17 -16 30 -32 30 -37z"/>
                                            <path d="M40 555 c0 -24 3 -25 55 -25 52 0 55 1 55 25 0 24 -3 25 -55 25 -52
                                            0 -55 -1 -55 -25z m90 -5 c0 -5 -16 -10 -35 -10 -19 0 -35 5 -35 10 0 6 16 10
                                            35 10 19 0 35 -4 35 -10z"/>
                                            <path d="M180 509 c-6 -11 -10 -45 -9 -75 2 -46 -1 -57 -19 -70 -18 -12 -22
                                            -25 -22 -70 l0 -54 39 0 c22 0 43 5 46 10 4 6 -8 10 -29 10 -20 0 -36 5 -36
                                            10 0 6 13 10 29 10 17 0 33 5 36 10 4 6 -8 10 -29 10 -20 0 -36 5 -36 10 0 6
                                            20 10 45 10 25 0 45 5 45 10 0 6 -19 10 -42 10 -40 0 -41 1 -26 17 10 9 37 19
                                            60 22 l43 6 3 55 c2 30 7 59 13 65 19 19 8 25 -46 25 -45 0 -56 -4 -65 -21z
                                            m80 -9 c0 -5 -16 -10 -36 -10 -21 0 -33 4 -29 10 3 6 19 10 36 10 16 0 29 -4
                                            29 -10z m-2 -67 c-3 -35 -6 -38 -33 -38 -27 0 -30 3 -33 38 -3 37 -3 37 33 37
                                            36 0 36 0 33 -37z"/>
                                            <path d="M0 460 c0 -5 5 -10 10 -10 6 0 10 5 10 10 0 6 -4 10 -10 10 -5 0 -10
                                            -4 -10 -10z"/>
                                            <path d="M0 260 l0 -170 140 0 c87 0 140 4 140 10 0 6 -50 10 -130 10 l-130 0
                                            0 160 c0 100 -4 160 -10 160 -6 0 -10 -63 -10 -170z"/>
                                            <path d="M322 384 c-30 -21 -28 -38 3 -18 34 22 105 21 144 -2 32 -19 71 -84
                                            71 -119 0 -34 -39 -100 -70 -119 -39 -22 -113 -23 -146 -1 -45 29 -66 74 -61
                                            133 4 50 -5 68 -17 36 -22 -57 7 -142 63 -180 38 -26 115 -33 150 -15 14 8 28
                                            -1 72 -45 54 -55 75 -64 97 -42 22 22 13 43 -42 97 l-53 52 14 41 c22 66 -6
                                            140 -69 178 -41 25 -124 27 -156 4z m250 -291 c47 -47 60 -73 35 -73 -19 0
                                            -110 97 -103 109 11 17 17 14 68 -36z"/>
                                            <path d="M363 358 c-48 -13 -83 -60 -83 -115 0 -38 5 -50 34 -79 30 -30 40
                                            -34 84 -34 43 0 55 5 81 30 35 35 47 83 32 123 -15 39 -24 33 -16 -12 9 -52
                                            -15 -98 -61 -117 -67 -28 -134 17 -134 91 0 75 67 119 136 90 40 -17 61 -11
                                            29 8 -32 19 -67 24 -102 15z"/>
                                            <path d="M270 340 c0 -5 5 -10 11 -10 5 0 7 5 4 10 -3 6 -8 10 -11 10 -2 0 -4
                                            -4 -4 -10z"/>
                                            <path d="M365 301 c-4 -7 5 -11 24 -11 21 0 31 -5 31 -15 0 -8 -7 -15 -15 -15
                                            -8 0 -15 -9 -15 -20 0 -20 1 -20 26 -4 38 25 30 68 -13 72 -17 2 -34 -2 -38
                                            -7z"/>
                                            <path d="M80 195 c0 -24 2 -25 76 -25 47 0 73 4 69 10 -3 6 -33 10 -66 10 -81
                                            0 -75 18 9 23 l67 3 -77 2 c-77 2 -78 2 -78 -23z"/>
                                            </g>
                                            </svg></a></li>

                                            <li><span data-toggle="modal" data-target="#examenClinicoModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Examen Clínico" onclick="OpenExamenClinicoModal(historia_{{ $historia->id }}_id, {{ $historia->examen_clinico_id }})"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M48 592 c-26 -25 -28 -33 -28 -104 0 -49 -4 -78 -11 -80 -20 -7 0
                                            -76 32 -112 16 -19 40 -37 54 -40 20 -5 25 -13 25 -37 0 -17 6 -32 15 -35 8
                                            -4 15 -17 15 -30 0 -74 61 -134 138 -134 34 0 49 6 78 32 44 42 53 80 54 231
                                            0 103 2 119 20 137 11 11 31 20 45 20 58 0 90 -85 40 -108 -74 -34 -15 -153
                                            63 -126 56 20 68 102 18 126 -17 7 -28 24 -35 53 -18 73 -94 100 -143 50 -33
                                            -32 -38 -61 -38 -207 l0 -120 -34 -34 c-46 -46 -101 -48 -145 -4 -37 37 -52
                                            98 -27 112 9 5 16 22 16 38 0 23 5 31 25 36 14 3 38 21 54 40 32 36 52 105 32
                                            112 -7 2 -11 32 -11 81 0 74 -2 79 -30 104 -34 31 -65 35 -74 10 -10 -26 20
                                            -51 43 -36 14 9 21 9 30 0 13 -13 15 -157 2 -157 -5 0 -12 -12 -16 -27 -11
                                            -47 -43 -73 -90 -73 -47 0 -78 25 -89 73 -3 15 -13 27 -21 27 -12 0 -15 15
                                            -15 73 0 80 11 103 41 84 15 -9 22 -8 35 5 9 9 14 24 11 32 -10 24 -49 18 -79
                                            -12z m62 4 c0 -3 -4 -8 -10 -11 -5 -3 -10 -1 -10 4 0 6 5 11 10 11 6 0 10 -2
                                            10 -4z m120 -6 c0 -5 -2 -10 -4 -10 -3 0 -8 5 -11 10 -3 6 -1 10 4 10 6 0 11
                                            -4 11 -10z m-172 -225 c6 -29 40 -63 78 -75 52 -18 126 23 135 74 2 11 10 21
                                            18 24 10 3 11 -2 6 -19 -42 -141 -230 -141 -270 -1 -6 20 -4 23 11 20 11 -2
                                            20 -12 22 -23z m554 -71 c15 -31 -13 -74 -47 -74 -31 0 -59 40 -50 70 14 43
                                            78 45 97 4z m-432 -74 c0 -13 -7 -20 -20 -20 -13 0 -20 7 -20 20 0 13 7 20 20
                                            20 13 0 20 -7 20 -20z"/>
                                            <path d="M536 284 c-7 -19 10 -44 29 -44 19 0 36 25 29 44 -8 21 -50 21 -58 0z"/>
                                            </g>
                                            </svg></a></li>

                                            <li><span data-toggle="modal" data-target="#examenRegionalModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Examen Regional" onclick="OpenExamenRegionalModal(historia_{{ $historia->id }}_id, {{ $historia->examen_regional_id }})"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M288 628 c-17 -14 -31 -48 -20 -48 4 0 13 9 20 21 28 44 85 4 66 -48
                                            -12 -35 -48 -43 -64 -14 -16 30 -32 27 -20 -4 8 -22 7 -25 -14 -25 -33 0 -41
                                            -13 -72 -123 -25 -87 -26 -99 -13 -113 20 -19 45 -9 58 24 8 24 10 21 10 -23
                                            1 -27 -2 -87 -6 -132 -5 -68 -9 -84 -24 -88 -12 -4 -19 -16 -19 -31 0 -22 4
                                            -24 49 -24 55 0 55 -1 67 108 3 34 10 62 14 62 4 0 11 -28 14 -62 12 -109 12
                                            -108 67 -108 45 0 49 2 49 24 0 16 -7 27 -20 31 -15 5 -20 15 -20 41 0 19 -4
                                            34 -10 34 -5 0 -10 -18 -10 -40 0 -34 4 -42 25 -50 35 -13 31 -20 -13 -20
                                            l-38 0 -18 135 c-10 74 -22 135 -26 135 -4 0 -16 -61 -26 -135 l-18 -135 -38
                                            0 c-43 0 -48 7 -15 19 22 9 24 17 30 108 9 132 9 273 0 273 -5 0 -17 -30 -28
                                            -67 -11 -36 -26 -68 -34 -71 -17 -6 -12 23 20 130 22 76 37 88 109 88 72 0 87
                                            -12 109 -88 32 -107 37 -136 20 -130 -8 3 -23 35 -34 71 -11 37 -23 67 -27 67
                                            -9 0 -10 -215 -2 -247 13 -46 19 -21 17 64 -2 70 0 82 8 61 13 -33 38 -43 58
                                            -24 13 14 12 26 -13 113 -31 110 -39 123 -72 123 -21 0 -23 2 -13 27 25 67
                                            -33 131 -83 91z"/>
                                            <path d="M290 460 c0 -5 5 -10 10 -10 6 0 10 5 10 10 0 6 -4 10 -10 10 -5 0
                                            -10 -4 -10 -10z"/>
                                            <path d="M330 460 c0 -5 5 -10 10 -10 6 0 10 5 10 10 0 6 -4 10 -10 10 -5 0
                                            -10 -4 -10 -10z"/>
                                            </g>
                                            </svg></a></li>

                                            <li><span><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Exámenes Auxiliares" href="{{ route('examenes_auxiliares.index', $historia->id)}}"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M240 621 c0 -5 6 -12 13 -15 10 -5 10 -7 0 -12 -9 -4 -13 -34 -13
                                            -99 0 -85 2 -94 23 -108 31 -21 18 -29 -26 -15 -28 9 -36 15 -31 27 17 42 16
                                            63 -6 87 -30 31 -70 31 -98 1 -24 -26 -27 -48 -11 -79 9 -16 6 -25 -14 -47
                                            -28 -29 -53 -127 -43 -167 5 -17 2 -24 -9 -24 -12 0 -15 -15 -15 -80 l0 -80
                                            109 0 c134 0 140 4 122 88 -18 86 -30 109 -61 122 -27 11 -28 13 -17 45 7 19
                                            14 35 17 37 3 2 31 -6 62 -16 47 -16 59 -17 72 -7 20 17 20 45 1 61 -17 14
                                            -20 40 -6 40 6 0 13 -4 16 -10 3 -5 35 -10 70 -10 68 0 65 3 79 -63 5 -22 2
                                            -29 -18 -38 -31 -14 -42 -43 -56 -142 -14 -96 -8 -107 61 -107 42 0 49 3 49
                                            20 0 16 7 20 30 20 23 0 30 -4 30 -20 0 -16 7 -20 30 -20 l30 0 0 230 c0 193
                                            -2 230 -14 230 -19 0 -46 -27 -46 -47 0 -8 -6 -13 -12 -10 -13 4 -13 11 -2 60
                                            8 36 -27 77 -66 77 -51 0 -91 -75 -58 -108 9 -9 0 -12 -40 -12 l-52 0 0 79 c0
                                            54 -4 81 -12 85 -10 5 -10 7 0 12 27 13 9 24 -38 24 -27 0 -50 -4 -50 -9z m60
                                            -21 c0 -5 -4 -10 -10 -10 -5 0 -10 5 -10 10 0 6 5 10 10 10 6 0 10 -4 10 -10z
                                            m18 -112 c-3 -81 -4 -83 -28 -83 -28 0 -41 32 -18 47 10 7 10 11 1 15 -20 8
                                            -15 23 7 23 11 0 20 5 20 10 0 6 -9 10 -20 10 -22 0 -27 15 -7 24 10 5 10 7 0
                                            12 -23 11 -13 24 17 24 l31 0 -3 -82z m206 26 c31 -30 9 -84 -34 -84 -10 0
                                            -26 7 -34 16 -9 8 -16 24 -16 34 0 10 7 26 16 34 8 9 24 16 34 16 10 0 26 -7
                                            34 -16z m-340 -40 c31 -30 9 -84 -34 -84 -24 0 -50 26 -50 50 0 24 26 50 50
                                            50 10 0 26 -7 34 -16z m422 -291 c-6 -16 -116 -18 -116 -3 0 6 12 10 27 10 15
                                            0 37 10 50 22 21 20 23 30 23 123 0 56 3 105 8 109 8 9 16 -240 8 -261z m-56
                                            207 c16 -16 20 -33 20 -83 0 -76 -7 -88 -56 -96 l-38 -6 -14 -80 c-14 -84 -25
                                            -106 -42 -89 -7 7 -7 34 0 85 14 95 23 117 56 125 25 6 26 9 19 53 -12 77 -16
                                            81 -95 81 -56 0 -70 3 -70 15 0 12 18 15 100 15 87 0 103 -3 120 -20z m-308
                                            -41 c64 -25 76 -35 61 -50 -9 -9 -27 -6 -73 11 -33 12 -62 21 -64 19 -5 -6
                                            -36 -101 -36 -111 0 -4 8 -8 18 -8 34 0 53 -25 69 -94 11 -49 12 -71 4 -79
                                            -17 -17 -28 1 -43 68 l-13 60 -45 5 c-75 9 -79 16 -59 111 6 28 20 60 30 70
                                            25 25 84 25 151 -2z m368 -254 c0 -37 -4 -65 -10 -65 -11 0 -14 113 -3 123 12
                                            13 13 7 13 -58z m-451 5 c6 -28 11 -55 11 -60 0 -6 -31 -10 -70 -10 l-70 0 0
                                            60 0 60 59 0 59 0 11 -50z m411 30 c0 -16 -7 -20 -30 -20 -23 0 -30 4 -30 20
                                            0 16 7 20 30 20 23 0 30 -4 30 -20z m-84 -98 c-13 -13 -16 9 -9 59 l8 54 3
                                            -54 c2 -29 1 -56 -2 -59z m84 48 c0 -5 -13 -10 -30 -10 -16 0 -30 5 -30 10 0
                                            6 14 10 30 10 17 0 30 -4 30 -10z"/>
                                            </g>
                                            </svg></a></li>

                                            <li><span data-toggle="modal" data-target="#impresionDiagnosticaModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Impresión Diagnóstica" onclick="OpenImpresionDiagnosticaModal(historia_{{ $historia->id }}_id, {{ $historia->impresion_diagnostica_id }})"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M215 620 c-10 -11 -28 -20 -40 -20 -13 0 -28 -7 -35 -15 -7 -8 -34
                                            -15 -63 -17 l-52 -3 -3 -132 c-2 -84 1 -133 7 -133 6 0 12 51 13 128 l3 127
                                            43 0 c50 0 57 -18 10 -25 l-33 -5 0 -240 0 -240 188 -3 187 -2 0 141 c0 108 3
                                            140 13 136 9 -3 12 -41 12 -148 l0 -144 -212 -3 -213 -2 0 125 c0 79 -4 125
                                            -10 125 -7 0 -10 -47 -8 -132 l3 -133 225 0 225 0 3 138 c2 104 6 137 15 137
                                            20 0 96 68 113 102 27 52 -2 108 -56 108 -16 0 -31 -4 -35 -10 -3 -5 -12 -7
                                            -20 -3 -10 3 -15 20 -15 49 l0 44 -55 0 c-40 0 -57 4 -61 15 -4 8 -18 15 -33
                                            15 -15 0 -31 8 -39 20 -7 11 -23 20 -36 20 -12 0 -31 -9 -41 -20z m67 -20 c8
                                            -12 24 -20 40 -20 24 0 28 -4 28 -30 0 -30 -1 -30 -55 -30 -30 0 -55 -4 -55
                                            -10 0 -6 26 -10 59 -10 33 0 63 5 66 10 3 6 17 10 31 10 28 0 33 -30 9 -50
                                            -19 -16 -19 -79 0 -104 12 -15 15 -53 15 -163 l0 -143 -170 0 -170 0 2 228 3
                                            227 25 -2 c14 -1 42 -5 63 -9 23 -4 37 -2 37 4 0 6 -12 12 -27 14 -22 2 -28 8
                                            -28 28 0 21 5 26 31 28 22 2 34 9 37 23 7 25 43 25 59 -1z m186 -77 c2 -25 -1
                                            -33 -12 -33 -9 0 -16 9 -16 20 0 16 -7 20 -35 20 -25 0 -35 4 -35 16 0 12 10
                                            14 48 12 45 -3 47 -4 50 -35z m19 -64 c8 -8 17 -8 31 0 32 17 60 13 72 -10 17
                                            -31 6 -59 -43 -107 l-43 -42 -41 35 c-46 39 -64 79 -52 113 9 24 56 31 76 11z"/>
                                            <path d="M220 414 c-11 -18 -20 -20 -57 -16 -28 3 -43 1 -43 -7 0 -6 12 -11
                                            27 -11 14 0 35 -7 45 -16 16 -16 18 -16 24 0 9 23 21 20 28 -9 4 -14 10 -25
                                            15 -25 4 0 13 11 19 25 10 21 18 25 57 25 25 0 45 5 45 10 0 6 -22 10 -50 10
                                            -36 0 -52 -5 -59 -17 -8 -15 -11 -12 -23 17 -14 34 -15 34 -28 14z"/>
                                            <path d="M120 270 c0 -5 24 -10 54 -10 30 0 58 5 61 10 4 6 -17 10 -54 10 -34
                                            0 -61 -4 -61 -10z"/>
                                            <path d="M270 270 c0 -5 24 -10 54 -10 30 0 58 5 61 10 4 6 -17 10 -54 10 -34
                                            0 -61 -4 -61 -10z"/>
                                            <path d="M120 210 c0 -5 24 -10 54 -10 30 0 58 5 61 10 4 6 -17 10 -54 10 -34
                                            0 -61 -4 -61 -10z"/>
                                            <path d="M270 210 c0 -5 24 -10 54 -10 30 0 58 5 61 10 4 6 -17 10 -54 10 -34
                                            0 -61 -4 -61 -10z"/>
                                            <path d="M120 150 c0 -5 24 -10 54 -10 30 0 58 5 61 10 4 6 -17 10 -54 10 -34
                                            0 -61 -4 -61 -10z"/>
                                            <path d="M270 150 c0 -5 24 -10 54 -10 30 0 58 5 61 10 4 6 -17 10 -54 10 -34
                                            0 -61 -4 -61 -10z"/>
                                            <path d="M482 404 c-11 -12 -10 -17 2 -30 15 -14 17 -14 32 0 14 14 14 18 0
                                            31 -18 18 -18 18 -34 -1z"/>
                                            </g>
                                            </svg></a></li>

                                            <li><span data-toggle="modal" data-target="#tratamientoModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tratamiento" onclick="OpenTratamientoModal(historia_{{ $historia->id }}_id, {{ $historia->tratamiento_id }})"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M296 604 c-9 -8 -16 -31 -16 -50 0 -32 -2 -34 -34 -34 -62 0 -66 -12
                                            -66 -196 l0 -164 -30 0 c-16 0 -30 5 -30 10 0 6 -22 10 -50 10 l-50 0 0 -79 0
                                            -79 218 5 217 5 74 42 c85 47 102 66 83 96 -8 13 -12 67 -12 169 0 168 -5 181
                                            -66 181 -32 0 -34 2 -34 34 0 54 -20 66 -110 66 -58 0 -83 -4 -94 -16z m182
                                            -46 c2 -22 -1 -38 -7 -38 -6 0 -11 14 -11 30 l0 30 -70 0 -70 0 0 -30 c0 -16
                                            -4 -30 -10 -30 -11 0 -14 63 -3 74 4 4 43 5 88 4 l80 -3 3 -37z m-38 -18 c0
                                            -17 -7 -20 -50 -20 -43 0 -50 3 -50 20 0 17 7 20 50 20 43 0 50 -3 50 -20z
                                            m138 -196 l3 -150 -73 -32 c-79 -35 -121 -41 -112 -18 3 8 0 24 -6 36 -11 20
                                            -18 21 -101 18 l-89 -3 0 146 c0 80 3 149 7 153 4 3 88 5 187 4 l181 -3 3
                                            -151z m-203 -189 c0 -17 -8 -20 -52 -23 -86 -5 -61 -22 32 -22 74 0 94 4 155
                                            32 54 23 74 28 83 19 15 -15 -1 -30 -81 -75 l-64 -36 -164 0 -164 0 0 45 c0
                                            44 0 45 33 45 21 0 41 8 52 20 16 18 29 20 94 18 68 -3 76 -5 76 -23z m-275
                                            -55 l0 -60 -30 0 -30 0 0 60 0 60 30 0 30 0 0 -60z"/>
                                            <path d="M345 451 c-45 -20 -70 -60 -70 -112 0 -42 5 -53 33 -81 47 -48 117
                                            -48 164 0 28 28 33 39 33 82 0 42 -5 54 -31 81 -33 33 -92 46 -129 30z m94
                                            -25 c47 -25 63 -83 37 -135 -35 -66 -137 -66 -172 0 -47 91 44 182 135 135z"/>
                                            <path d="M360 390 c0 -13 -7 -20 -20 -20 -16 0 -20 -7 -20 -30 0 -23 4 -30 20
                                            -30 13 0 20 -7 20 -20 0 -16 7 -20 30 -20 23 0 30 4 30 20 0 13 7 20 20 20 16
                                            0 20 7 20 30 0 23 -4 30 -20 30 -13 0 -20 7 -20 20 0 16 -7 20 -30 20 -23 0
                                            -30 -4 -30 -20z m40 -20 c0 -13 7 -20 20 -20 11 0 20 -4 20 -10 0 -5 -9 -10
                                            -20 -10 -13 0 -20 -7 -20 -20 0 -11 -4 -20 -10 -20 -5 0 -10 9 -10 20 0 13 -7
                                            20 -20 20 -11 0 -20 5 -20 10 0 6 9 10 20 10 13 0 20 7 20 20 0 11 5 20 10 20
                                            6 0 10 -9 10 -20z"/>
                                            </g>
                                            </svg></a></li>
                                        </ul>

                                    </td>
                                    <td>{{ $historia->proxima_cita }}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><span><a class="bs-tooltip" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Imprimir" href="{{ route('citas.print', $historia->id)}}"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                            width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000"
                                            preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6">

                                            <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="#000000">
                                            <path d="M132 614 c-15 -11 -22 -25 -22 -50 0 -30 -3 -34 -26 -34 -28 0 -65
                                            -16 -76 -34 -4 -6 -8 -70 -8 -143 0 -130 0 -132 26 -152 15 -12 40 -21 55 -21
                                            l29 0 0 -69 c0 -100 2 -101 210 -101 208 0 210 1 210 101 l0 69 29 0 c15 0 40
                                            9 55 21 26 20 26 22 26 152 0 73 -4 137 -8 143 -11 18 -48 34 -76 34 -23 0
                                            -26 4 -26 34 0 60 -20 66 -210 66 -134 0 -170 -3 -188 -16z m356 -61 l3 -23
                                            -170 0 c-159 0 -171 1 -171 18 0 10 3 22 7 26 4 3 79 5 167 4 158 -3 161 -3
                                            164 -25z m102 -198 l0 -125 -30 0 c-27 0 -30 3 -30 29 0 57 -13 61 -210 61
                                            -197 0 -210 -4 -210 -61 0 -26 -3 -29 -30 -29 l-30 0 0 125 0 125 270 0 270 0
                                            0 -125z m-105 -185 l0 -105 -165 0 -165 0 -3 94 c-1 52 0 101 2 108 4 11 39
                                            13 168 11 l163 -3 0 -105z"/>
                                            <path d="M437 433 c-3 -5 -2 -15 2 -22 12 -18 96 -11 96 9 0 11 -13 16 -47 18
                                            -25 2 -49 -1 -51 -5z"/>
                                            </g>
                                            </svg></a></li>

                                            <li><span data-toggle="modal" data-target="#historiaModal"><a class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="OpenHCModal(historia_{{ $historia->id }}_id, '{{ $historia->id }}', '{{ route('citas.update', $historia->id) }}', '{{ $historia->proxima_cita }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                            <li>
                                                <form method="POST" id="delete_{{ $historia->id }}_form" action="{{ route('citas.destroy', $historia->id) }}" style="display: inline-block">
                                                    @csrf
                                                    <a href="javascript:void(0);" class="bs-tooltip historia_remove confirm"
                                                            form_id="delete_{{ $historia->id }}_form"
                                                            hc_number="@php(printf("%06d", $historia->id))"
                                                            data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
        <script src="{{ asset('assets/js/date-util.js') }}"></script>
        <script src="{{ asset('assets/js/components/ui-accordions.js') }}"></script>
        <script>

            $(function () {
                RegisterHistoriaEvents();

                var f1 = flatpickr(document.getElementById('fecha_nacimiento'), {
                    maxDate: GetTodayDate()
                });

                CalculateAge('#fecha_nacimiento', '#edad');

                $("#email").inputmask(
                    {
                        mask:"*{1,31}[.*{1,31}][.*{1,31}][.*{1,31}]@*{1,31}[.*{2,6}][.*{1,2}]",
                        greedy:!1,onBeforePaste:function(m,a){return(m=m.toLowerCase()).replace("mailto:","")},
                        definitions:{"*":
                            {
                                validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                                cardinality:1,
                                casing:"lower"
                            }
                        }
                    }
                );
            });

            $('.btnSubmit').click(function(e){
                e.preventDefault();
                if(this.form.reportValidity()){
                    $(this).prop('disabled',1);
                    // $(this).css('color', 'black');
                    this.style.setProperty( 'color', 'black', 'important' );
                    $(this).val('Guardando...');
                    this.form.submit();
                }
            });

            c2 = $('#style-2').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                },
                columnDefs:[ {
                    targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }
                }],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Buscar...",
                    "sLengthMenu": "Mostrar :  _MENU_",
                    "sEmptyTable": "No hay datos disponibles en la tabla",
                    "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            multiCheck(c2);

            function RegisterHistoriaEvents() {
                $('.historia_nuevo.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let patient_full_name = $(this).attr('patient_full_name');
                    swal({
                        title: `¿Está seguro(a) de agregar una nueva historia al paciente ${patient_full_name} ?`,
                        type: 'warning',
                        showCancelButton: 1,
                        cancelButtonText: "Cancelar",
                        confirmButtonText: 'Continuar',
                        padding: '2em'
                    }).then(function(result) {
                        if (result.value) {
                            let form = $(`#${form_id}`);
                            form.submit();
                        }
                    });
                });

                $('.historia_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let hc_number = $(this).attr('hc_number');
                    swal({
                        title: `¿Está seguro(a) de eliminar la Historia Clínica ${hc_number} ?`,
                        type: 'warning',
                        showCancelButton: 1,
                        cancelButtonText: "Cancelar",
                        confirmButtonText: 'Eliminar',
                        padding: '2em'
                    }).then(function(result) {
                        if (result.value) {
                            let form = $(`#${form_id}`);
                            form.submit();
                        }
                    });
                });
            }

            function OpenAnamnesisModal(historiaTdId, anamnesisId) {
                let hcid = historiaTdId.innerText;
                $('#anamnesis_hc').html(hcid);
                if (anamnesisId) {
                    $('#anamnesis_modal_id').val(anamnesisId).change();
                }
            }

            function OpenAntecedentesModal(historiaTdId, id) {
                let hcid = historiaTdId.innerText;
                $('#antecedentes_hc').html(hcid);
                if (id) {
                    $('#antecedentes_modal_id').val(id).change();
                }
            }

            function OpenExamenClinicoModal(historiaTdId, id) {
                let hcid = historiaTdId.innerText;
                $('#examen_clinico_hc').html(hcid);
                if (id) {
                    $('#examen_clinico_modal_id').val(id).change();
                }
            }

            function OpenExamenRegionalModal(historiaTdId, id) {
                let hcid = historiaTdId.innerText;
                $('#examen_regional_hc').html(hcid);
                if (id) {
                    $('#examen_regional_modal_id').val(id).change();
                }
            }

            function OpenImpresionDiagnosticaModal(historiaTdId, id) {
                let hcid = historiaTdId.innerText;
                $('#impresion_diagnostica_hc').html(hcid);
                if (id) {
                    $('#impresion_diagnostica_modal_id').val(id).change();
                }
            }

            function OpenTratamientoModal(historiaTdId, id) {
                let hcid = historiaTdId.innerText;
                $('#tratamiento_hc').html(hcid);
                if (id) {
                    $('#tratamiento_modal_id').val(id).change();
                }
            }

            function OpenHCModal(historiaTdNumber, id, route, proximaCita) {
                let hcFormatted = historiaTdNumber.innerText;
                $('#hc_number').html(hcFormatted);
                
                $('#formHC').attr('action', route); 
                $('#hc_modal_id').val(id); 
                $('#proxima_cita').val(proximaCita);
            }
        </script>

        @livewireScripts
    </x-slot>

</x-layouts.admin>
