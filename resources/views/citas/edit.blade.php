<x-layouts.admin title="Reumainnova - Nueva Cita" bodyTitle="Datos básicos de la cita">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    </x-slot>

    @include('medicamentos.create')
    @include('medicamentos.edit')
    @include('examen_auxiliares.lab_create')
    @include('examen_auxiliares.lab_edit')
    @include('examen_auxiliares.img_create')
    @include('examen_auxiliares.img_edit')
    @include('examen_auxiliares.otros_create')
    @include('examen_auxiliares.otros_edit')
    @include('examen_auxiliares.proc_create')
    @include('examen_auxiliares.proc_edit')
    @include('examen_auxiliares.inter_create')
    @include('examen_auxiliares.inter_edit')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('historias.update', $cita->id) }}">
                        @csrf

                        <label style="font-weight: bold; color: black; font-size: 17px;">PACIENTE</label>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="getFullNameAttribute">Nombre completo</label>
                                <input id="getFullNameAttribute" name="getFullNameAttribute" type="text" class="form-control" placeholder="" value="{{ $patient->getFullNameAttribute() }}" readonly>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="num_document">DNI o CE</label>
                                <input id="num_document" name="num_document" type="text" class="form-control" placeholder="" value="{{ $patient->num_document }}" readonly>
                            </div>
                            <div class="col">
                                <label for="edad">Edad</label>
                                <input id="edad" name="edad" type="text" class="form-control" placeholder="" value="{{ $patient->edad }}" readonly>
                            </div>
                        </div>

                        <label style="font-weight: bold; color: black; font-size: 17px;">CITA</label>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="numero">Número</label>
                                <input id="numero" name="numero" type="text" class="form-control" placeholder="001349" value="@php(printf("%06d", $cita->id))" readonly>
                            </div>
                            <div class="col">
                                <label for="sede">Sede</label>
                                <input id="sede" name="sede" placeholder="" class="form-control" type="text" value="{{ $cita->sede }}">
                            </div>
                            <div class="col">
                                <label for="fecha_hora">Fecha y Hora</label>
                                <input id="fecha_hora" name="fecha_hora" value="{{ $cita->fecha_hora }}" class="form-control" type="text" placeholder="" readonly="readonly" autofocus>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>ENFERMEDAD ACTUAL</h3>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('enfermedad_actuales.save', $cita->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="seg_tip_informante">Según tipo de informante</label>
                                {{ Form::select('seg_tip_informante', ['Directa' => 'Directa', 'Indirecta' => 'Indirecta', 'Mixta' => 'Mixta'], $enf_actual ? $enf_actual->seg_tip_informante : old('seg_tip_informante'), ['id' => 'seg_tip_informante', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="tie_enfermedad">Tiempo de enfermedad (meses)</label>
                                <input id="tie_enfermedad" name="tie_enfermedad" type="number"
                                min="1" max="999"  class="form-control" placeholder="" value="{{ $enf_actual ? $enf_actual->tie_enfermedad : old('tie_enfermedad') }}">
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="for_inicio">Forma de inicio</label>
                                <textarea id="for_inicio" name="for_inicio" type="text" class="form-control" placeholder="">{{ $enf_actual ? $enf_actual->for_inicio : old('for_inicio') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="sig_sin_principales">Signos y síntomas principales</label>
                                <textarea id="sig_sin_principales" name="sig_sin_principales" type="text" class="form-control" placeholder="">{{ $enf_actual ? $enf_actual->sig_sin_principales : old('sig_sin_principales') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="rel_cronologico">Relato cronológico</label>
                                <textarea id="rel_cronologico" name="rel_cronologico" type="text" class="form-control" placeholder="">{{ $enf_actual ? $enf_actual->rel_cronologico : old('rel_cronologico') }}</textarea>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>FUNCIONES BIOLÓGICAS</h3>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('funciones.save_fun_bio', $cita->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="fun_bio_apetito">Apetito</label>
                                {{ Form::select('fun_bio_apetito', ['N' => 'Normal', 'D' => 'Disminuído', 'A' => 'Aumentado'], $funcion ? $funcion->fun_bio_apetito : old('fun_bio_apetito'), ['id' => 'fun_bio_apetito', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="fun_bio_sed">Sed</label>
                                {{ Form::select('fun_bio_sed', ['N' => 'Normal', 'D' => 'Disminuído', 'A' => 'Aumentado'], $funcion ? $funcion->fun_bio_sed : old('fun_bio_sed'), ['id' => 'fun_bio_sed', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="fun_bio_sueno">Sueño</label>
                                {{ Form::select('fun_bio_sueno', ['N' => 'Normal', 'D' => 'Disminuído', 'A' => 'Aumentado'], $funcion ? $funcion->fun_bio_sueno : old('fun_bio_sueno'), ['id' => 'fun_bio_sueno', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="fun_bio_orina">Orina</label>
                                {{ Form::select('fun_bio_orina', ['N' => 'Normal', 'D' => 'Disminuído', 'A' => 'Aumentado'], $funcion ? $funcion->fun_bio_orina : old('fun_bio_orina'), ['id' => 'fun_bio_orina', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="fun_bio_deposiciones">Deposiciones</label>
                                {{ Form::select('fun_bio_deposiciones', ['N' => 'Normal', 'D' => 'Disminuído', 'A' => 'Aumentado'], $funcion ? $funcion->fun_bio_deposiciones : old('fun_bio_deposiciones'), ['id' => 'fun_bio_deposiciones', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>FUNCIONES VITALES</h3>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('funciones.save_fun_vit', $cita->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="fun_vit_pa">P.A. (MMHG)</label>
                                <input id="fun_vit_pa" name="fun_vit_pa" type="text" class="form-control" placeholder="" value="{{ $funcion ? $funcion->fun_vit_pa : old('fun_vit_pa') }}">
                            </div>
                            <div class="col">
                                <label for="fun_vit_fr">FR (X)</label>
                                <input id="fun_vit_fr" name="fun_vit_fr" type="number" min="0" step="0.01" class="form-control" placeholder="" value="{{ $funcion ? $funcion->fun_vit_fr : old('fun_vit_fr') }}">
                            </div>
                            <div class="col">
                                <label for="fun_vit_fc">FC (X)</label>
                                <input id="fun_vit_fc" name="fun_vit_fc" type="number" min="0" step="0.01" class="form-control" placeholder="" value="{{ $funcion ? $funcion->fun_vit_fc : old('fun_vit_fc') }}">
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="fun_vit_t">T (Cº)</label>
                                <input id="fun_vit_t" name="fun_vit_t" type="number" min="0" step="0.01" class="form-control" placeholder="" value="{{ $funcion ? $funcion->fun_vit_t : old('fun_vit_t') }}">
                            </div>
                            <div class="col">
                                <label for="fun_vit_peso">Peso (Kg)</label>
                                <input id="fun_vit_peso" name="fun_vit_peso" type="number" min="0" step="0.01" class="form-control" placeholder="" value="{{ $funcion ? $funcion->fun_vit_peso : old('fun_vit_peso') }}">
                            </div>
                            <div class="col">
                                <label for="fun_vit_talla">Talla (cm)</label>
                                <input id="fun_vit_talla" name="fun_vit_talla" type="number" min="0" step="0.01" class="form-control" placeholder="" value="{{ $funcion ? $funcion->fun_vit_talla : old('fun_vit_talla') }}">
                            </div>
                            <div class="col">
                                <label for="fun_vit_imc">IMC (Peso/Talla)</label>
                                <input id="fun_vit_imc" name="fun_vit_imc" type="number" min="0" step="0.01" class="form-control" placeholder="" value="{{ $funcion ? $funcion->fun_vit_imc : old('fun_vit_imc') }}" readonly>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>EXAMEN FÍSICO</h3>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('examenes.save', $cita->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="exa_fis_est_general">Estado general</label>
                                <input id="exa_fis_est_general" name="exa_fis_est_general" type="text" class="form-control" placeholder="" value="{{ $examen ? $examen->exa_fis_est_general : old('exa_fis_est_general') }}" required>
                            </div>
                            <div class="col">
                                <label for="exa_fis_est_conciencia">Estado de conciencia</label>
                                {{ Form::select('exa_fis_est_conciencia', ['Hipervigilante' => 'Hipervigilante', 'Ensoñación' => 'Ensoñación', 'Sueño' => 'Sueño', 'Sueño profundo' => 'Sueño profundo', 'Coma' => 'Coma'], $examen ? $examen->exa_fis_est_conciencia : old('exa_fis_est_conciencia'), ['id' => 'exa_fis_est_conciencia', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="exa_fis_dirigido">Examen físico dirigido</label>
                                <textarea id="exa_fis_dirigido" name="exa_fis_dirigido" type="text" class="form-control" placeholder="">{{ $examen ? $examen->exa_fis_dirigido : old('exa_fis_dirigido') }}</textarea>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>DIAGNÓSTICO PRESUNTIVO</h3>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('diagnosticos.save_p', $cita->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col-md-3">
                                <label for="dia_pre_cei101">CIE 10</label>
                                <input id="dia_pre_cei101" name="dia_pre_cei101" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_pre_cei101 : old('dia_pre_cei101') }}">
                            </div>
                            <div class="col-md-9">
                                <label for="dia_pre_p1">(P/ )</label>
                                <input id="dia_pre_p1" name="dia_pre_p1" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_pre_p1 : old('dia_pre_p1') }}">
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col-md-3">
                                <label for="dia_pre_cei102">CIE 10</label>
                                <input id="dia_pre_cei102" name="dia_pre_cei102" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_pre_cei102 : old('dia_pre_cei102') }}">
                            </div>
                            <div class="col-md-9">
                                <label for="dia_pre_p2">(P/ )</label>
                                <input id="dia_pre_p2" name="dia_pre_p2" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_pre_p2 : old('dia_pre_p2') }}">
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col-md-3">
                                <label for="dia_pre_cei103">CIE 10</label>
                                <input id="dia_pre_cei103" name="dia_pre_cei103" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_pre_cei103 : old('dia_pre_cei103') }}">
                            </div>
                            <div class="col-md-9">
                                <label for="dia_pre_p3">(P/ )</label>
                                <input id="dia_pre_p3" name="dia_pre_p3" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_pre_p3 : old('dia_pre_p3') }}">
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>EXÁMENES AUXILIARES / INTERCONSULTAS Y OTROS</h3>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <div class="m-3 mt-4 mb-4">

                        <div class="mb-4 row">
                            <div class="mb-4 table-responsive">

                                <label class="ml-3" style="font-weight: bold; color: black; font-size: 17px; margin-bottom: 31px;">Laboratorios:</label>

                                <button type="button" data-toggle="modal" data-target="#labModal"
                                class="ml-3 btn btn-success" style="margin-bottom: 10px;" onclick="$('#lab_modal_cita_id').val({{ $cita->id }})">Nuevo laboratorio</button>

                                <table id="lab_table" class="table style-3 table-hover">
                                    {{--  table-hover  --}}
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nº</th>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Fecha de subida</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cita->laboratorios as $lab)
                                        <tr>
                                            {{--  class="checkbox-column"  --}}
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $lab->titulo }}</td>
                                            <td class="text-center">{{ substr($lab->descripcion, 0, 50).'...' }}</td>
                                            <td class="text-center">{{ $lab->url ? $lab->updated_at : 'Todavia no subido' }}</td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    @if($lab->url)
                                                    <li><a href="{{ Storage::url($lab->url) }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>
                                                    @endif

                                                    <li><span data-toggle="modal" data-target="#labEditModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="$('#lab_titulo').text('{{ addslashes($lab->titulo) }}'); $('#lab_edit_titulo').val('{{ old('lab_edit_titulo', addslashes($lab->titulo)) }}'); $('#lab_edit_descripcion').val(`{{ old('lab_edit_descripcion', addslashes($lab->descripcion)) }}`); $('#lab_edit_form').prop('action', '{{ route('examen_auxiliares.update', $lab->id) }}'); $('#lab_edit_file_url').text('{{ addslashes(substr($lab->url, 8)) }}'); $('#lab_edit_file_download').attr('href', '{{ Storage::url(addslashes($lab->url)) }}');if('{{ addslashes($lab->url) }}' == ''){ $('#lab_replace_file').hide();$('#lab_put_file').show(); }else{ $('#lab_replace_file').show();$('#lab_put_file').hide(); } "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                                    <li><form id="delete_lab_{{ $lab->id }}_form" method="POST" action="{{ route('examen_auxiliares.destroy', $lab->id) }}" style="display: inline-block">
                                                        @csrf
                                                        <a href="javascript:void(0);" class="bs-tooltip lab_remove confirm"
                                                                                form_id="delete_lab_{{ $lab->id }}_form"
                                                                                exam_aux_title="{{ addslashes($lab->titulo) }}"
                                                                                data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                        </a>
                                                    </form></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="mb-4 table-responsive">

                                <label class="ml-3" style="font-weight: bold; color: black; font-size: 17px; margin-bottom: 31px;">Imágenes:</label>

                                <button type="button" data-toggle="modal" data-target="#imgModal"
                                class="ml-3 btn btn-success" style="margin-bottom: 10px;" onclick="$('#img_modal_cita_id').val({{ $cita->id }})">Nueva Imágen</button>

                                <table id="img_table" class="table style-3 table-hover">
                                    {{--  table-hover  --}}
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nº</th>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Fecha de subida</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cita->imagenes as $eAux)
                                        <tr>
                                            {{--  class="checkbox-column"  --}}
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $eAux->titulo }}</td>
                                            <td class="text-center">{{ substr($eAux->descripcion, 0, 50).'...' }}</td>
                                            <td class="text-center">{{ $eAux->url ? $eAux->updated_at : 'Todavia no subido' }}</td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    @if($eAux->url)
                                                    <li><a href="{{ Storage::url($eAux->url) }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>
                                                    @endif

                                                    <li><span data-toggle="modal" data-target="#imgEditModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="$('#img_titulo').text('{{ addslashes($eAux->titulo) }}'); $('#img_edit_titulo').val('{{ old('img_edit_titulo', addslashes($eAux->titulo)) }}'); $('#img_edit_descripcion').val(`{{ old('img_edit_descripcion', addslashes($eAux->descripcion)) }}`); $('#img_edit_form').prop('action', '{{ route('examen_auxiliares.update', $eAux->id) }}'); $('#img_edit_file_url').text('{{ addslashes(substr($eAux->url, 8)) }}'); $('#img_edit_file_download').attr('href', '{{ Storage::url(addslashes($eAux->url)) }}');if('{{ addslashes($eAux->url) }}' == ''){ $('#img_replace_file').hide();$('#img_put_file').show(); }else{ $('#img_replace_file').show();$('#img_put_file').hide(); } "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                                    <li><form id="delete_img_{{ $eAux->id }}_form" method="POST" action="{{ route('examen_auxiliares.destroy', $eAux->id) }}" style="display: inline-block">
                                                        @csrf
                                                        <a href="javascript:void(0);" class="bs-tooltip img_remove confirm"
                                                                                form_id="delete_img_{{ $eAux->id }}_form"
                                                                                exam_aux_title="{{ addslashes($eAux->titulo) }}"
                                                                                data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                        </a>
                                                    </form></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="mb-4 table-responsive">

                                <label class="ml-3" style="font-weight: bold; color: black; font-size: 17px; margin-bottom: 31px;">Otros:</label>

                                <button type="button" data-toggle="modal" data-target="#otrosModal"
                                class="ml-3 btn btn-success" style="margin-bottom: 10px;" onclick="$('#otros_modal_cita_id').val({{ $cita->id }})">Nuevo Examen Auxiliar (otro)</button>

                                <table id="otros_table" class="table style-3 table-hover">
                                    {{--  table-hover  --}}
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nº</th>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Fecha de subida</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cita->otros as $eAux)
                                        <tr>
                                            {{--  class="checkbox-column"  --}}
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $eAux->titulo }}</td>
                                            <td class="text-center">{{ substr($eAux->descripcion, 0, 50).'...' }}</td>
                                            <td class="text-center">{{ $eAux->url ? $eAux->updated_at : 'Todavia no subido' }}</td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    @if($eAux->url)
                                                    <li><a href="{{ Storage::url($eAux->url) }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>
                                                    @endif

                                                    <li><span data-toggle="modal" data-target="#otrosEditModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="$('#otros_titulo').text('{{ addslashes($eAux->titulo) }}'); $('#otros_edit_titulo').val('{{ old('otros_edit_titulo', addslashes($eAux->titulo)) }}'); $('#otros_edit_descripcion').val(`{{ old('otros_edit_descripcion', addslashes($eAux->descripcion)) }}`); $('#otros_edit_form').prop('action', '{{ route('examen_auxiliares.update', $eAux->id) }}'); $('#otros_edit_file_url').text('{{ addslashes(substr($eAux->url, 8)) }}'); $('#otros_edit_file_download').attr('href', '{{ Storage::url(addslashes($eAux->url)) }}');if('{{ addslashes($eAux->url) }}' == ''){ $('#otros_replace_file').hide();$('#otros_put_file').show(); }else{ $('#otros_replace_file').show();$('#otros_put_file').hide(); } "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                                    <li><form id="delete_otros_{{ $eAux->id }}_form" method="POST" action="{{ route('examen_auxiliares.destroy', $eAux->id) }}" style="display: inline-block">
                                                        @csrf
                                                        <a href="javascript:void(0);" class="bs-tooltip otros_remove confirm"
                                                                                form_id="delete_otros_{{ $eAux->id }}_form"
                                                                                exam_aux_title="{{ addslashes($eAux->titulo) }}"
                                                                                data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                        </a>
                                                    </form></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="mb-4 table-responsive">

                                <label class="ml-3" style="font-weight: bold; color: black; font-size: 17px; margin-bottom: 31px;">Procedimientos:</label>

                                <button type="button" data-toggle="modal" data-target="#procModal"
                                class="ml-3 btn btn-success" style="margin-bottom: 10px;" onclick="$('#proc_modal_cita_id').val({{ $cita->id }})">Nuevo procedimiento</button>

                                <table id="proc_table" class="table style-3 table-hover">
                                    {{--  table-hover  --}}
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nº</th>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Fecha de subida</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cita->procedimientos as $eAux)
                                        <tr>
                                            {{--  class="checkbox-column"  --}}
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $eAux->titulo }}</td>
                                            <td class="text-center">{{ substr($eAux->descripcion, 0, 50).'...' }}</td>
                                            <td class="text-center">{{ $eAux->url ? $eAux->updated_at : 'Todavia no subido' }}</td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    @if($eAux->url)
                                                    <li><a href="{{ Storage::url($eAux->url) }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>
                                                    @endif

                                                    <li><span data-toggle="modal" data-target="#procEditModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="$('#proc_titulo').text('{{ addslashes($eAux->titulo) }}'); $('#proc_edit_titulo').val('{{ old('proc_edit_titulo', addslashes($eAux->titulo)) }}'); $('#proc_edit_descripcion').val(`{{ old('proc_edit_descripcion', addslashes($eAux->descripcion)) }}`); $('#proc_edit_form').prop('action', '{{ route('examen_auxiliares.update', $eAux->id) }}'); $('#proc_edit_file_url').text('{{ addslashes(substr($eAux->url, 8)) }}'); $('#proc_edit_file_download').attr('href', '{{ Storage::url(addslashes($eAux->url)) }}');if('{{ addslashes($eAux->url) }}' == ''){ $('#proc_replace_file').hide();$('#proc_put_file').show(); }else{ $('#proc_replace_file').show();$('#proc_put_file').hide(); } "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                                    <li><form id="delete_proc_{{ $eAux->id }}_form" method="POST" action="{{ route('examen_auxiliares.destroy', $eAux->id) }}" style="display: inline-block">
                                                        @csrf
                                                        <a href="javascript:void(0);" class="bs-tooltip proc_remove confirm"
                                                                                form_id="delete_proc_{{ $eAux->id }}_form"
                                                                                exam_aux_title="{{ addslashes($eAux->titulo) }}"
                                                                                data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                        </a>
                                                    </form></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="mb-4 table-responsive">

                                <label class="ml-3" style="font-weight: bold; color: black; font-size: 17px; margin-bottom: 31px;">Interconsultas:</label>

                                <button type="button" data-toggle="modal" data-target="#interModal"
                                class="ml-3 btn btn-success" style="margin-bottom: 10px;" onclick="$('#inter_modal_cita_id').val({{ $cita->id }})">Nueva interconsulta</button>

                                <table id="inter_table" class="table style-3 table-hover">
                                    {{--  table-hover  --}}
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nº</th>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Fecha de subida</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cita->interconsultas as $eAux)
                                        <tr>
                                            {{--  class="checkbox-column"  --}}
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $eAux->titulo }}</td>
                                            <td class="text-center">{{ substr($eAux->descripcion, 0, 50).'...' }}</td>
                                            <td class="text-center">{{ $eAux->url ? $eAux->updated_at : 'Todavia no subido' }}</td>
                                            <td class="text-center">
                                                <ul class="table-controls">
                                                    @if($eAux->url)
                                                    <li><a href="{{ Storage::url($eAux->url) }}" target="_blank" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Descargar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></a></li>
                                                    @endif

                                                    <li><span data-toggle="modal" data-target="#interEditModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" onclick="$('#inter_titulo').text('{{ addslashes($eAux->titulo) }}'); $('#inter_edit_titulo').val('{{ old('inter_edit_titulo', addslashes($eAux->titulo)) }}'); $('#inter_edit_descripcion').val(`{{ old('inter_edit_descripcion', addslashes($eAux->descripcion)) }}`); $('#inter_edit_form').prop('action', '{{ route('examen_auxiliares.update', $eAux->id) }}'); $('#inter_edit_file_url').text('{{ addslashes(substr($eAux->url, 8)) }}'); $('#inter_edit_file_download').attr('href', '{{ Storage::url(addslashes($eAux->url)) }}');if('{{ addslashes($eAux->url) }}' == ''){ $('#inter_replace_file').hide();$('#inter_put_file').show(); }else{ $('#inter_replace_file').show();$('#inter_put_file').hide(); } "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                                    <li><form id="delete_inter_{{ $eAux->id }}_form" method="POST" action="{{ route('examen_auxiliares.destroy', $eAux->id) }}" style="display: inline-block">
                                                        @csrf
                                                        <a href="javascript:void(0);" class="bs-tooltip inter_remove confirm"
                                                                                form_id="delete_inter_{{ $eAux->id }}_form"
                                                                                exam_aux_title="{{ addslashes($eAux->titulo) }}"
                                                                                data-container="body" data-html="true" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-trash br-6"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                        </a>
                                                    </form></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{--  <div class="mb-4 row">
                            <div class="col">
                                <label for="exa_aux_imagenes">Interconsulta</label>
                                <input id="exa_aux_imagenes" name="exa_aux_imagenes" type="text" class="form-control" placeholder="" value="{{ '' }}" required>
                            </div>
                        </div>  --}}

                        {{--  <input type="submit" class="btn btn-primary btn_submit" value="Guardar">  --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>DIAGNÓSTICO DEFINITIVO</h3>
        </div>
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('diagnosticos.save_d', $cita->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col-md-3">
                                <label for="dia_def_cie10">CIE 10</label>
                                <input id="dia_def_cie10" name="dia_def_cie10" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_def_cie10 : old('dia_def_cie10') }}">
                            </div>
                            <div class="col-md-9">
                                <label for="dia_def_d">( /D)</label>
                                <input id="dia_def_d" name="dia_def_d" type="text" class="form-control" placeholder="" value="{{ $diagnostico ? $diagnostico->dia_def_d : old('dia_def_d') }}">
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="page-header">
        <div class="page-title">
            <h3>TRATAMIENTO</h3>
        </div>
        @if($tratamiento)
        <button type="button" data-toggle="modal" data-target="#createModal"
                class="ml-3 btn btn-success" onclick="$('#create_modal_user_id').val({{ $patient->id }})">Nuevo medicamento</button>
        @endif
    </div>

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    @if($tratamiento)
                    <div class="mb-4 table-responsive">

                        <label style="font-weight: bold; color: black; font-size: 17px;">Medicamentos:</label>

                        <table id="style-2" class="table style-3 table-hover">
                            {{--  table-hover  --}}
                            <thead>
                                <tr>
                                    <th class="text-center">Nº</th>
                                    <th class="text-center">Medicamento</th>
                                    <th class="text-center">Concentración</th>
                                    <th class="text-center">DOSIS</th>
                                    <th class="text-center">Frecuencia</th>
                                    <th class="text-center">Vía</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tratamiento->detalles as $detalle)
                                <tr>
                                    {{--  class="checkbox-column"  --}}
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $detalle->medicamento }}</td>
                                    <td class="text-center">{{ $detalle->concentracion }}</td>
                                    <td class="text-center">{{ $detalle->dosis }}</td>
                                    <td class="text-center">{{ $detalle->frecuencia }}</td>
                                    <td class="text-center">{{ $detalle->via }}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            {{--  Storage::url($detalle->url)  --}}

                                            <li><span data-toggle="modal" data-target="#editModal"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"
                                                onclick="$('#medicamento_title').text('{{ $detalle->medicamento }}'); $('#edit_medicamento').val('{{ $detalle->medicamento }}'); $('#edit_concentracion').val('{{ $detalle->concentracion }}'); $('#edit_dosis').val('{{ $detalle->dosis }}'); $('#edit_frecuencia').val('{{ $detalle->frecuencia }}'); $('#edit_via').val('{{ $detalle->via }}'); $('#edit_form').prop('action', '{{ route('medicamentos.update', ['id' => $detalle->id, 'cita_id' => $cita->id]) }}'); $('#edit_id').val('{{ $detalle->id  }}');"
                                                ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="p-1 mb-1 feather feather-edit-2 br-6"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                            <li>
                                                <form id="delete_{{ $detalle->id }}_form" method="POST" action="{{ route('medicamentos.destroy', $detalle->id) }}" style="display: inline-block">
                                                    @csrf
                                                    <a href="javascript:void(0);" class="bs-tooltip result_remove confirm"
                                                                            form_id="delete_{{ $detalle->id }}_form"
                                                                            result_title="{{ $detalle->medicamento }}"
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
                    @endif

                    <div class="widget-header">

                    @if(count($errors) > 0)
                        <div>{{ $errors }}</div>
                    @endif

                    <label style="font-weight: bold; color: black; font-size: 17px;">Datos del tratamiento:</label>

                    <form class="m-3 mt-4 mb-4" method="POST" action="{{ route('tratamientos.save', $cita->id) }}">
                        @csrf

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="tra_med_hig_dieteticas">Medidas higiénico dietéticas</label>
                                <textarea id="tra_med_hig_dieteticas" name="tra_med_hig_dieteticas" type="text" class="form-control" placeholder="">{{ $tratamiento ? $tratamiento->tra_med_hig_dieteticas : old('tra_med_hig_dieteticas') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="tra_med_preventivos">Medidas preventivas</label>
                                <textarea id="tra_med_preventivos" name="tra_med_preventivos" type="text" class="form-control" placeholder="">{{ $tratamiento ? $tratamiento->tra_med_preventivos : old('tra_med_preventivos') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="tra_trans_lugar">Transferencia (lugar)</label>
                                {{ Form::select('tra_trans_lugar', ['Ginecología y
Obstetricia', 'Pediatría', 'Cardiología', 'Nutrición', 'Odontología', 'Gastroenterología', 'Medicina
Familiar', 'Anestesiología', 'Cirugía de cabeza, cuello y maxilofacial', 'Cirugía general y
Aparato digestivo', 'Cirugía Plástica', 'Dermatología', 'Endocrinología', 'Geriatría',
'Hematología', 'Medicina Física y rehabilitación', 'Medicina General', 'Medicina Intensiva',
'Medicina Interna', 'Neumología', 'Neurocirugía', 'Neurología', 'Oftalmología', 'Oncología',
'Otorrinolaringología', 'Psicología', 'Psiquiatría', 'Radiología', 'Reumatología', 'Traumatología', 'Ortopedia', 'Urología'], $tratamiento ? $tratamiento->tra_trans_lugar : old('tra_trans_lugar'), ['id' => 'tra_trans_lugar', 'class' => 'form-control', 'required' => 'required']) }}
                            </div>
                            <div class="col">
                                <label for="tra_trans_hora">Transferencia (hora)</label>
                                <input id="tra_trans_hora" name="tra_trans_hora" type="text" class="form-control" placeholder="" value="{{ $tratamiento ? $tratamiento->tra_trans_hora : old('tra_trans_hora') }}" readonly>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="tra_des_med_dias">Descanso médico (Nº de días)</label>
                                <input id="tra_des_med_dias" name="tra_des_med_dias" type="number" min="0" class="form-control" placeholder="" value="{{ $tratamiento ? $tratamiento->tra_des_med_dias : old('tra_des_med_dias') }}">
                            </div>
                            <div class="col">
                                <label for="tra_des_med_periodo">Descanso médico (periodo)</label>
                                <input id="tra_des_med_periodo" name="tra_des_med_periodo" type="text" class="form-control" placeholder="" value="{{ $tratamiento ? $tratamiento->tra_des_med_periodo : old('tra_des_med_periodo') }}" readonly>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col">
                                <label for="tra_fec_pro_cita">Fecha de próxima cita</label>
                                <input id="tra_fec_pro_cita" name="tra_fec_pro_cita" type="text" class="form-control" placeholder="" value="{{ $tratamiento ? $tratamiento->tra_fec_pro_cita : old('tra_fec_pro_cita') }}" readonly>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn_submit" value="Guardar">
                    </form>
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
        <script>

            $(() => {
                var f2 = flatpickr(document.getElementById('fecha_hora'), {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });

                var f3 = flatpickr(document.getElementById('tra_trans_hora'), {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i"
                });

                var f4 = flatpickr(document.getElementById('tra_fec_pro_cita'));

                $('#fun_vit_pa').inputmask("9{1,3}/9{1,3}");
            });

            $(function () {
                RegisterDeleteResultEvents();
            });

            $('.btn_submit').click(function(e){
                e.preventDefault();
                if(this.form.reportValidity()){
                    $(this).prop('disabled',true);
                    // $(this).css('color', 'black');
                    this.style.setProperty( 'color', 'black', 'important' );
                    $(this).val('Guardando...');
                    this.form.submit();
                }
            });

            $('.btn_submit2').click(function(e){
                e.preventDefault();
                if(this.form.reportValidity()){
                    $(this).prop('disabled',true);
                    // $(this).css('color', 'black');
                    //this.style.setProperty( 'color', 'black', 'important' );
                    $(this).val('Guardando...');
                    this.form.submit();
                }
            });

            $('#style-2').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    /*e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'*/
                },
                columnDefs:[ {
                    /*targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }*/
                }],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            $('#lab_table').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    /*e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'*/
                },
                columnDefs:[ {
                    /*targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }*/
                }],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            $('#img_table').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    /*e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'*/
                },
                columnDefs:[ {
                    /*targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }*/
                }],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            $('#otros_table').DataTable({
                headerCallback:function(e, a, t, n, s) {
                },
                columnDefs:[ {
                }],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            $('#proc_table').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    /*e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'*/
                },
                columnDefs:[ {
                    /*targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }*/
                }],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            $('#inter_table').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    /*e.getElementsByTagName("th")[0].innerHTML='<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'*/
                },
                columnDefs:[ {
                    /*targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="m-auto new-control new-checkbox checkbox-outline-primary">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }*/
                }],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            // multiCheck(c2);

            function RegisterDeleteResultEvents() {
                $('.result_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let result_title = $(this).attr('result_title');
                    swal({
                        title: `¿Está seguro de eliminar el medicamento '${result_title}' ?`,
                        type: 'warning',
                        showCancelButton: true,
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

                $('.lab_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let title = $(this).attr('exam_aux_title');
                    swal({
                        title: `¿Está seguro de eliminar el laboratorio '${title}' ?`,
                        type: 'warning',
                        showCancelButton: true,
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

                $('.img_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let title = $(this).attr('exam_aux_title');
                    swal({
                        title: `¿Está seguro de eliminar la imágen '${title}' ?`,
                        type: 'warning',
                        showCancelButton: true,
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

                $('.otros_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let title = $(this).attr('exam_aux_title');
                    swal({
                        title: `¿Está seguro de eliminar el examen auxiliar '${title}' ?`,
                        type: 'warning',
                        showCancelButton: true,
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

                $('.proc_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let title = $(this).attr('exam_aux_title');
                    swal({
                        title: `¿Está seguro de eliminar el procedimiento '${title}' ?`,
                        type: 'warning',
                        showCancelButton: true,
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

                $('.inter_remove.confirm').on('click', function () {
                    let form_id = $(this).attr('form_id');
                    let title = $(this).attr('exam_aux_title');
                    swal({
                        title: `¿Está seguro de eliminar la interconsulta '${title}' ?`,
                        type: 'warning',
                        showCancelButton: true,
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

            $('#tra_des_med_dias').change(() => {
                CalculateTratPeriodo();
            });

            $('#tra_des_med_dias').keyup(() => {
                CalculateTratPeriodo();
            });

            function CalculateTratPeriodo() {
                // console.log($('#fecha_hora').val());
                let fecha_hora = $('#fecha_hora').val();
                if (fecha_hora){
                    let citaDT = new Date(fecha_hora);
                    let fromDate = GetDate(citaDT);
                    let toDate = GetDate(citaDT, parseInt($('#tra_des_med_dias').val()));

                    $('#tra_des_med_periodo').val(`del ${fromDate} al ${toDate}`);
                }
            }

            $('#fun_vit_peso,#fun_vit_talla').change(() => {
                CalculateIMC();
            });

            $('#fun_vit_peso,#fun_vit_talla').keyup(() => {
                CalculateIMC();
            });

            function CalculateIMC(){
                let peso = $('#fun_vit_peso').val();
                let talla = $('#fun_vit_talla').val();

                if (peso && talla) {
                    $('#fun_vit_imc').val(parseFloat(parseFloat(peso)/parseFloat(talla)).toFixed(2));
                }
            }
        </script>
    </x-slot>

</x-layouts.admin>
