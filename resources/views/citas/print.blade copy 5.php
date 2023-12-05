<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Imprimir Historia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
    <link href="{{  asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/loader.js') }}"></script>

    {{--
    <!-- BEGIN GLOBAL MANDATORY STYLES --> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    {{--
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" /> --}}
    {{--
    <!-- END GLOBAL MANDATORY STYLES --> --}}

    {{--
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES --> --}}
    <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
        /*.navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }*/
        .layout-px-spacing {
            min-height: calc(100vh - 184px) !important;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <link href="{{ asset('assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

    <style>
        body {
            font-size: 1rem;
        }
    </style>


</head>

<body class="sidebar-noneoverflow">

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div id="content" class="main-content" style="padding-top: 5px;">
            <div class="layout-px-spacing">

                {{--
                <!-- CONTENT AREA --> --}}

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="doc-container" style="overflow: auto;">

                        <div class="invoice-container">
                            <div class="invoice-inbox" style="height: auto;">

                                <div class="invoice-header-section">
                                    <h4 class="inv-number"></h4>
                                    <div class="invoice-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-printer action-print" data-toggle="tooltip" data-placement="top"
                                            data-original-title="Print">
                                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                            <rect x="6" y="14" width="12" height="8"></rect>
                                        </svg>
                                    </div>
                                </div>

                                <div id="" class="">

                                    <div class="invoice-00001">
                                        <div class="content-section animated animatedFadeInUp fadeInUp" style="padding: 0px 70px;">

                                            <div class="row inv--head-section">

                                                <div class="text-right col-sm-12 col-12">
                                                    <div class="company-info">
                                                        <img style="width: auto!important; height: 80px;" alt="logo"
                                                            src="{{ asset('assets/img/logo.png') }}">
                                                    </div>
                                                </div>

                                                <div class="text-center col-sm-12 col-12">
                                                    <h3 class="in-heading">HISTORIA CLÍNICA</h3>
                                                </div>


                                            </div>

                                            <div class="mt-3 row inv--detail-section">

                                                <div class="col-sm-4 align-self-center">
                                                    <p class="inv-to"><span>FECHA</span>: {{ explode(' ', $historia->created_at)[0] }}
                                                    </p>
                                                </div>
                                                <div class="text-center col-sm-4">
                                                    <p class="inv-to"><span>HORA</span>: {{ explode(' ', $historia->created_at)[1] }}
                                                    </p>
                                                </div>
                                                <div class="order-1 col-sm-4 align-self-center text-sm-right order-sm-0">
                                                    <p class="inv-detail-title">NRO. DE H.C. @php(printf("%06d", $historia->id))</p>
                                                </div>
                                            </div>
                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-7 align-self-center">
                                                    <p class="inv-customer-name">DATOS PERSONALES</p>
                                                    <p class="inv-street-addr">DNI: {{ $user->num_document }}</p>
                                                </div>
                                                <div class="order-2 col-sm-5 align-self-center text-sm-right">
                                                </div>
                                            </div>
                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">NOMBRES</p>
                                                    <p class="inv-street-addr">{{ $user->first_names }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-3">
                                                    <p class="inv-customer-name">APELLIDO PATERNO</p>
                                                    <p class="inv-street-addr">{{ $user->last_name1 }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-3">
                                                    <p class="inv-customer-name">APELLIDO MATERNO</p>
                                                    <p class="inv-street-addr">{{ $user->last_name2 }}</p>
                                                </div>
                                                <div class="order-1 col-sm-3 align-self-center text-sm-right order-sm-0">
                                                    <p class="inv-customer-name">FECHA DE NAC.</p>
                                                    <p class="inv-street-addr">{{ $user->fecha_nacimiento ?? '____' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">EDAD</p>
                                                    <p class="inv-street-addr">{{ $user->edad }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-3">
                                                    <p class="inv-customer-name">PROCEDENCIA</p>
                                                    <p class="inv-street-addr">{{ $user->provincia->nombre_prov }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-3">
                                                    <p class="inv-customer-name">ESTADO CIVIL</p>
                                                    <p class="inv-street-addr">{{ $user->estado_civil }}</p>
                                                </div>
                                                <div class="order-1 col-sm-3 align-self-center text-sm-right order-sm-0">
                                                    <p class="inv-customer-name">OCUPACIÓN</p>
                                                    <p class="inv-street-addr">{{ $user->ocupacion ?? '____' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">CELULAR</p>
                                                    <p class="inv-street-addr">{{ $user->celular ?? '____' }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-3">
                                                    <p class="inv-customer-name">REFIERE</p>
                                                    <p class="inv-street-addr">{{ $user->refiere ?? '____' }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-6">
                                                    <p class="inv-customer-name">OTROS</p>
                                                    <p class="inv-street-addr">{{ $user->otros ?? '____' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-12 align-self-center">
                                                    <p class="inv-customer-name">ANAMNESIS</p>
                                                    <p class="inv-street-addr">{{ $historia->anamnesis->anamnesis ?? '___' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-12 align-self-center">
                                                    <p class="inv-customer-name">ANTECEDENTES</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-6 align-self-center">
                                                    <p class="inv-customer-name">FAMILIARES</p>
                                                    <p class="inv-street-addr">{{ $historia->antecedente->familiares ?? '___' }}</p>
                                                </div>
                                                <div class="col-sm-6 align-self-center">
                                                    <p class="inv-customer-name">PERSONALES</p>
                                                    <p class="inv-street-addr">{{ $historia->antecedente->personales ?? '___' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-6 align-self-center">
                                                    <p class="inv-customer-name">HÁBITOS NOCIVOS</p>
                                                    <p class="inv-street-addr">{{ $historia->antecedente->hab_nocivos ?? '___' }}</p>
                                                </div>
                                                <div class="col-sm-6 align-self-center">
                                                    <p class="inv-customer-name">OTROS</p>
                                                    <p class="inv-street-addr">{{ $historia->antecedente->antecedentes ?? '___' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-12 align-self-center">
                                                    <p class="inv-customer-name">EXAMEN CLÍNICO</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">FUNC. VITALES</p>
                                                    <p class="inv-street-addr">FC: {{ $examenClinico->fc ?? '___' }} &emsp;FR: {{
                                                        $examenClinico->fr ?? '___' }}</p>
                                                    <p class="inv-street-addr">T: {{
                                                        ($examenClinico->temperatura ?? '___') . ' ºC' }} &emsp;Sat: {{
                                                        ($examenClinico->sat ?? '___') . ' %'}}</p>
                                                    <p class="inv-street-addr">PA: {{
                                                        ($examenClinico->pa ?? '___') . ' mmHg'}}</p>
                                                </div>
                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">PESO</p>
                                                    <p class="inv-street-addr">{{ ($examenClinico->peso ?? '___') . ' Kg' }}</p>
                                                </div>

                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">TALLA</p>
                                                    <p class="inv-street-addr">{{ ($examenClinico->talla ?? '___') . ' m' }}</p>
                                                </div>

                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">DEPOSICIONES</p>
                                                    <p class="inv-street-addr">{{ $examenClinico->deposiciones ?? '___' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-3 align-self-center">
                                                    <p class="inv-customer-name">ORINA</p>
                                                    <p class="inv-street-addr">{{ $examenClinico->orina ?? '____' }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-3">
                                                    <p class="inv-customer-name">FUR</p>
                                                    <p class="inv-street-addr">{{ $examenClinico->fur ?? '____' }}</p>
                                                </div>
                                                <div class="align-self-center col-sm-6">
                                                    <p class="inv-customer-name">OTROS</p>
                                                    <p class="inv-street-addr">{{ $examenClinico->otros ?? '____' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-12 align-self-center">
                                                    <p class="inv-customer-name">EXAMEN REGIONAL</p>
                                                    <p class="inv-street-addr">{{ $historia->examenRegional->examen_regional ?? '___' }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-12 align-self-center">
                                                    <p class="inv-customer-name">EXÁMENES AUXILIARES</p>
                                                    <p class="inv-street-addr">{!! $examsString !!} {{ $examsString ? '' : '___' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 row inv--detail-section">
                                                <div class="col-sm-12 align-self-center">
                                                    <p class="inv-customer-name">IMPRESIÓN DIAGNÓSTICA</p>
                                                    <p class="inv-street-addr">{{ $historia->impresionDiagnostica->impresion_diagnostica
                                                        ?? '___' }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 mb-4 row inv--detail-section">
                                                <div class="col-sm-12 align-self-center">
                                                    <p class="inv-customer-name">TRATAMIENTO</p>
                                                    <p class="inv-street-addr">{!! $tratsString !!} {{ $tratsString ? '' : '___' }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="inv--thankYou">
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <p class=""></p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{--
                <!-- CONTENT AREA --> --}}

            </div>
        </div>
        {{--
        <!--  END CONTENT AREA  --> --}}

    </div>
    {{--
    <!-- END MAIN CONTAINER --> --}}
</body>

</html>
