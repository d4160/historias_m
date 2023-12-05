<div class="table-responsive">
    <input type="hidden" id="historias_modal_id" name="historias_modal_id">
    <table class="table table-bordered table-hover table-condensed mb-4">
        <thead>
            <tr>
                <th>Nro. de H.C.</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody id="historias_tbody">
            @foreach ($historias as $his)
            <tr>
                <td>@php(printf("%06d", $his->id))</td>
                <td>{{ $his->created_at }}</td>
                <td>
                    @switch($his->estado)
                        @case('Atendido')
                            <span class="badge badge-danger" style="background-color:#8dbf42;border-color:#8dbf42;"> {{ $his->estado }} </span>
                            @break

                        @case('Pendiente')
                            <span class="badge badge-danger" style="background-color: #e7515a;"> {{ $his->estado }} </span>
                            @break

                        @default
                            <span class="badge badge-warning"> {{ $his->estado }} </span>
                    @endswitch
                </td>
                <td class="text-center">
                    <ul class="table-controls">
                        <li><a target="_blank" href="{{ route('patients.edit', $his->paciente->id) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-primary"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>

                        <li><span><a class="bs-tooltip" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Imprimir" href="{{ route('historias.print', $his->id)}}"><svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 64.000000 64.000000"
                        preserveAspectRatio="xMidYMid meet" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-primary">

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
                        </svg></a></span></li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>

    $('#historias_modal_id').change(() => {

        Livewire.emit('onHcChanged', $('#historias_modal_id').val());
    });

    // Livewire.on('updateHistorias', (data, dates) => {
    //     console.log(data);

    //     // $('#historias_tbody').empty();
    //     // let i = 0;
    //     // for (his of data) {
    //     //     $('#historias_tbody').append(
    //     //         `<tr>
    //     //             <td>${his.id}</td>
    //     //             <td>${dates[i]}</td>
    //     //             <td>${his.estado}</td>
    //     //             <td class="text-center">
    //     //                 <ul class="table-controls">
    //     //                     <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></a></li>
    //     //                     <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
    //     //                 </ul>
    //     //             </td>
    //     //         </tr>`
    //     //     );
    //     //     i++;
    //     // }
    // });

</script>
@endpush
