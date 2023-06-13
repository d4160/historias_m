<x-layouts.admin title="Estabridis - Información General" bodyTitle="Información General">
    <x-slot name="styles">
        <link href="{{ asset('admin/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/css/elements/tooltip.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/css/components/custom-carousel.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/select2/select2.min.css')}}">
        <link href="{{ asset('admin/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('admin/plugins/sweetalerts/promise-polyfill.js') }}"></script>
        <link href="{{ asset('admin/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/drag-and-drop/dragula/dragula.css') }}" rel="stylesheet" type="text/css" />
        <script src="https://kit.fontawesome.com/b3568c5807.js" crossorigin="anonymous"></script>

        @livewireStyles
    </x-slot>

    <form method="POST" action="{{ route('admin.information.update') }}" class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" enctype="multipart/form-data">
        @csrf
        <div class="">
            <div class="statbox widget box box-shadow" id="enterprise_name_group">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Nombre de la empresa <button type="button" class="mr-2 btn btn-outline-info info rounded-circle" data-container="body" data-placement="right" data-html="true" title="Este nombre es usado como título de las páginas"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="4 4 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></button></h4>
                        </div>
                    </div>
                </div>
                <div class="pt-0 widget-content widget-content-area">
                    <input type="text" class="form-control basic" maxlength="100" name="enterprise_name" id="enterprise_name"
                        value="{{ $information ? $information->enterprise_name : '' }}">
                </div>
            </div>

            {{--  @livewire('information.logos', ['logos_string' => $information ? $information->logos : ''])  --}}
            <livewire:information.logos :logosString="$information ? $information->logos : ''" />

            <div class="statbox widget box box-shadow" id="address_group">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Dirección <button type="button" class="mr-2 btn btn-outline-info info rounded-circle" data-container="body" data-placement="right" data-html="true" title="Se muestra en el encabezado de todas las páginas y en la página de contacto"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="4 4 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></button></h4>
                        </div>
                    </div>
                </div>
                <div class="pt-0 widget-content widget-content-area">
                    <input type="text" class="form-control basic" maxlength="191" name="address" id="address"
                        value="{{ $information ? $information->address : '' }}">
                </div>
            </div>

            <div class="statbox widget box box-shadow" id="business_hours_group">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Horarios de Atención <button type="button" class="mr-2 btn btn-outline-info info rounded-circle" data-container="body" data-placement="right" data-html="true" title="Cada horario en líneas separadas. Por ejemplo: Lunes a viernes de 8.00 a.m. - 8.00 p.m..."><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="4 4 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></button></h4>
                        </div>
                    </div>
                </div>
                <div class="pt-0 widget-content widget-content-area">
                    <textarea id="business_hours" name="business_hours" class="form-control textarea" maxlength="350" rows="3" placeholder="">{{ $information ? $information->business_hours : '' }}</textarea>
                </div>
            </div>

            <livewire:information.telephones :telephonesJson="$information ? $information->telephones : ''" />

            <livewire:information.emails :emailsJson="$information ? $information->emails : ''" />

            <livewire:information.social-media :socialMediaJson="$information ? $information->social_media : ''" />

            <input type="submit" class="mb-4 mr-2 btn btn-success btn-block" value="Guardar">
        </div>
    </form>

    <x-slot name="scripts">
        <script src="{{ asset('admin/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>
        <script src="{{ asset('admin/assets/js/elements/tooltip.js') }}"></script>
        <script src="{{ asset('admin/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/select2/custom-select2.js') }}"></script>
        <script src="{{ asset('admin/plugins/blockui/jquery.blockUI.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/drag-and-drop/dragula/dragula.min.js') }}"></script>

        <script>
            function InitializeTooltips() {

                $('.primary').tooltip({
                    template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    title: "Primary"
                });

                $('.success').tooltip({
                    template: '<div class="tooltip tooltip-success" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    title: "Success"
                });

                $('.info').tooltip({
                    template: '<div class="tooltip tooltip-info" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    title: "Info2"
                });

                $('.danger').tooltip({
                    template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    title: "Danger"
                });

                $('.warning').tooltip({
                    template: '<div class="tooltip tooltip-warning" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    title: "Warning"
                });

                $('.secondary').tooltip({
                    template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    title: "Secondary"
                });

                $('.dark').tooltip({
                    template: '<div class="tooltip tooltip-dark" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                    title: "Dark"
                });
            }

            function imageFromValue(option){
                if(option.element){
                    option = `<span class="select2-option-img"><img src="${option.element.value}"><span> ${option.text}`;
                }
                return option;
            }

            function iconFromValue(option){
                if(option.element){
                    option = `<i class="fa fa-lg ${option.element.value}"></i> ${option.text}`;
                }
                return option;
            }
        </script>

        @livewireScripts

        @isset($ok)
            <script>
                $(function(){
                    ShowToast('Guardado correctamente');
                });
            </script>
        @endisset
    </x-slot>
</x-layouts.admin>
