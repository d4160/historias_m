<x-layouts.empty title="Imprimir Kardex" bodyTitle="Imprimir Kardex">
    <x-slot name="styles">
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link href="{{ asset('assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
        <!--  END CUSTOM STYLE FILE  -->

        <style>
            @page
            {
                size: auto; /* auto is the initial value */

                /* this affects the margin in the printer settings */
                margin: 20mm 0mm 20mm 0mm;
            }

            @page:first {
                margin: 0mm 0mm 0mm 0mm;
            }

            body
            {
                font-size: 1rem;
                /* this affects the margin on the content before sending to printer */
                margin: 0px;
            }
        </style>
    </x-slot>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="doc-container" style="overflow: auto;">

            <div class="invoice-container">
                <div class="invoice-inbox" style="height: auto;">

                    <div class="invoice-header-section">
                        <h4 class="inv-number"></h4>
                        <div class="invoice-action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-printer action-print"
                                data-toggle="tooltip" data-placement="bottom" data-original-title="Imprimir">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                </path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                        </div>
                    </div>

                    <div id="ct" class="">

                        <div class="invoice-00001">
                            <div class="content-section animated animatedFadeInUp fadeInUp" style="padding: 0 70px;">

                                <div class="mb-4 row inv--head-section">

                                    <div class="text-left col-sm-12 col-12">
                                        <div class="company-info">
                                            <img style="width: auto!important; height: 80px;" alt="logo"
                                                src="{{ asset('assets/img/logo.png') }}">
                                        </div>
                                    </div>

                                    <div class="text-center col-sm-12 col-12">
                                        <h3 class="in-heading font-weight-bold">KARDEX</h3>
                                    </div>


                                </div>

                                @php
                                    $hcNum = sprintf("%06d", $historia->id);
                                @endphp

                                <div class="pt-2 row inv--detail-section" style="">
                                    <div class="col-sm-12 align-self-center">
                                        <p class="inv-customer-name"><span class="font-weight-bold">PACIENTE:</span> {{ $user->full_name }} <span class="font-weight-bold">&ensp;DNI:</span> {{ $user->num_document }} <span class="font-weight-bold">&ensp;PROCEDENCIA:</span> {{ $user->provincia->nombre_prov }} <span class="font-weight-bold">&ensp;NRO. H.C.:</span> {{ $hcNum }}</p>
                                        <p class="inv-customer-name"><span class="font-weight-bold">EDAD:</span> {{ $user->edad }} <span class="font-weight-bold">&ensp;DIAGNOSTICO:</span> {{ $historia->impresionDiagnostica->impresion_diagnostica ?? '_______' }} <span class="font-weight-bold">&ensp;FECHA DE H.C.:</span> {{ $historia->created_at }}</p>
                                    </div>
                                </div>

                                <div class="my-4 row inv--product-table-section">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th scope="col" class="text-center">Nº</th>
                                                        <th scope="col" class="text-center">Fecha</th>
                                                        <th scope="col" class="text-center">Medicamento</th>
                                                        <th scope="col" class="text-center">Dosis</th>
                                                        <th scope="col" class="text-center">Vía</th>
                                                        <th scope="col" class="text-center">Frecuencia</th>
                                                        <th scope="col" class="text-center">Día 1</th>
                                                        <th scope="col" class="text-center">Día 2</th>
                                                        <th scope="col" class="text-center">Día 3</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kardex->detalles as $det)
                                                    <tr>
                                                        {{-- class="checkbox-column" --}}
                                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                                        <td class="text-center">{{ $det->fecha }}</td>
                                                        <td class="text-center">{{ $det->medicamento }}</td>
                                                        <td class="text-center">{{ $det->dosis }}</td>
                                                        <td class="text-center">{{ $det->via }}</td>
                                                        <td class="text-center">{{ $det->frecuencia }}</td>
                                                        <td class="text-center">{{ $det->dia1 }}</td>
                                                        <td class="text-center">{{ $det->dia2 }}</td>
                                                        <td class="text-center">{{ $det->dia3 }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-2 row inv--detail-section" style="border: ridge;">
                                    <div class="col-sm-4 align-self-center">
                                        <p class="inv-customer-name font-weight-bold">EXÁMENES DE LABORATORIO</p>
                                        <p class="inv-street-addr">{{ $kardex->exam_lab ?? '____' }}</p>
                                    </div>
                                    <div class="align-self-center col-sm-4">
                                        <p class="inv-customer-name font-weight-bold">EXÁMENES DE IMAGEN</p>
                                        <p class="inv-street-addr">{{ $kardex->exam_imagen ?? '____' }}</p>
                                    </div>
                                    <div class="align-self-center col-sm-4">
                                        <p class="inv-customer-name font-weight-bold">REEVALUACIÓN</p>
                                        <p class="inv-street-addr">{{ $kardex->reevaluacion ?? '____' }}</p>
                                    </div>
                                </div>

                                <div class="pt-2 mb-5 row inv--detail-section" style="border: ridge; border-top: none;">
                                    <div class="col-sm-12 align-self-center">
                                        <p class="inv-customer-name font-weight-bold">OBSERVACIONES</p>
                                        <p class="inv-street-addr">{{ $kardex->observaciones ?? '___' }}</p>
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

    <x-slot name="scripts">
        <script src="{{ asset('assets/js/apps/invoice.js') }}"></script>

        <script>
            $(function () {
                console.log('hello');
                var $el = $('.invoice-00001').show();

                var getParentDiv = $('.doc-container');

                var $el = $('.invoice-00001').show();
                $('#ct > div').not($el).hide();
                var setInvoiceNumber = getParentDiv.find('.invoice-inbox .inv-number').text('#{{ $hcNum }}');
                var showInvHeaderSection = getParentDiv.find('.invoice-inbox .invoice-header-section').css('display', 'flex');
                var showInvContentSection = getParentDiv.find('.invoice-inbox #ct').css('display', 'block');
                var showInvContentSection = getParentDiv.find('.invoice-inbox').css('height', 'auto');
                var hideInvEmptyContent = getParentDiv.find('.invoice-inbox .inv-not-selected').css('display', 'none');
                var hideInvEmptyContent = getParentDiv.find('.invoice-container .inv--thankYou').css('display', 'block');
                if ($('.tab-title').hasClass('open-inv-sidebar')) {
                    $('.tab-title').removeClass('open-inv-sidebar');
                }

                var myDiv = document.getElementsByClassName('invoice-inbox')[0];
                myDiv.scrollTop = 0;
            });
        </script>
    </x-slot>

    </x-layouts.admin>
