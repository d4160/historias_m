<x-layouts.empty title="Listado de pacientes" bodyTitle="Listado de pacientes">
    <x-slot name="styles">
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link href="{{ asset('assets/css/apps/invoice.css') }}" rel="stylesheet" type="text/css" />
        <!--  END CUSTOM STYLE FILE  -->

        <style>
            body {
                font-size: 1rem;
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

                    <div id="ct" class="">

                        <div class="invoice-00001">
                            <div class="content-section animated animatedFadeInUp fadeInUp" style="padding: 0px 70px;">

                                <div class="row inv--head-section">

                                    <div class="text-right col-sm-12 col-12">
                                        <div class="company-info">
                                            <img style="width: auto!important; height: 80px;" alt="logo" src="{{ asset('assets/img/logo.png') }}">
                                        </div>
                                    </div>

                                    <div class="text-center col-sm-12 col-12">
                                        <h3 class="in-heading">HISTORIA CLÍNICA</h3>
                                    </div>


                                </div>

                                <div class="mt-3 row inv--detail-section">

                                    <div class="col-sm-4 align-self-center">
                                        <p class="inv-to"><span>FECHA</span>: {{ explode(' ', $historia->created_at)[0] }}</p>
                                    </div>
                                    <div class="text-center col-sm-4">
                                        <p class="inv-to"><span>HORA</span>: {{ explode(' ', $historia->created_at)[1] }}</p>
                                    </div>
                                    <div class="order-1 col-sm-4 align-self-center text-sm-right order-sm-0">
                                        <p class="inv-detail-title">NRO. DE H.C. @php(printf("%06d", $historia->id))</p>
                                    </div>

                                    <div class="col-sm-7 align-self-center">
                                        <p class="inv-customer-name">Jesse Cory</p>
                                        <p class="inv-street-addr">405 Mulberry Rd. Mc Grady, NC, 28649</p>
                                        <p class="inv-email-address">redq@company.com</p>
                                    </div>
                                    <div class="order-2 col-sm-5 align-self-center text-sm-right">
                                        <p class="inv-list-number"><span class="inv-title">Invoice Number : </span> <span
                                                class="inv-number">[invoice number]</span></p>
                                        <p class="inv-created-date"><span class="inv-title">Invoice Date : </span> <span
                                                class="inv-date">20 Aug 2020</span></p>
                                        <p class="inv-due-date"><span class="inv-title">Due Date : </span> <span
                                                class="inv-date">26 Aug 2020</span></p>
                                    </div>
                                </div>

                                <div class="row inv--product-table-section">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th scope="col">S.No</th>
                                                        <th scope="col">Items</th>
                                                        <th class="text-right" scope="col">Qty</th>
                                                        <th class="text-right" scope="col">Unit Price</th>
                                                        <th class="text-right" scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Electric Shaver</td>
                                                        <td class="text-right">20</td>
                                                        <td class="text-right">$300</td>
                                                        <td class="text-right">$2800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Earphones</td>
                                                        <td class="text-right">49</td>
                                                        <td class="text-right">$500</td>
                                                        <td class="text-right">$7000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Wireless Router</td>
                                                        <td class="text-right">30</td>
                                                        <td class="text-right">$500</td>
                                                        <td class="text-right">$3500</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 row">
                                    <div class="order-1 col-sm-5 col-12 order-sm-0">
                                        <div class="inv--payment-info">
                                            <div class="row">
                                                <div class="col-sm-12 col-12">
                                                    <h6 class=" inv-title">Payment Info:</h6>
                                                </div>
                                                <div class="col-sm-4 col-12">
                                                    <p class=" inv-subtitle">Bank Name: </p>
                                                </div>
                                                <div class="col-sm-8 col-12">
                                                    <p class="">Bank of America</p>
                                                </div>
                                                <div class="col-sm-4 col-12">
                                                    <p class=" inv-subtitle">Account Number : </p>
                                                </div>
                                                <div class="col-sm-8 col-12">
                                                    <p class="">1234567890</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                        <div class="inv--total-amounts text-sm-right">
                                            <div class="row">
                                                <div class="col-sm-8 col-7">
                                                    <p class="">Sub Total: </p>
                                                </div>
                                                <div class="col-sm-4 col-5">
                                                    <p class="">$13300</p>
                                                </div>
                                                <div class="col-sm-8 col-7">
                                                    <p class="">Tax Amount: </p>
                                                </div>
                                                <div class="col-sm-4 col-5">
                                                    <p class="">$700</p>
                                                </div>
                                                <div class="col-sm-8 col-7">
                                                    <p class=" discount-rate">Discount : <span
                                                            class="discount-percentage">5%</span> </p>
                                                </div>
                                                <div class="col-sm-4 col-5">
                                                    <p class="">$700</p>
                                                </div>
                                                <div class="col-sm-8 col-7 grand-total-title">
                                                    <h4 class="">Grand Total : </h4>
                                                </div>
                                                <div class="col-sm-4 col-5 grand-total-amount">
                                                    <h4 class="">$14000</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <div class="inv--thankYou">
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <p class="">Thank you for doing Business with us.</p>
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
                var setInvoiceNumber = getParentDiv.find('.invoice-inbox .inv-number').text('#2031');
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
