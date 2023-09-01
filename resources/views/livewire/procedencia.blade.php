<div>
    <span style="font-weight: bold; color: #030303; font-size: 17px;">Procedencia</span>

    <div class="mb-4 mt-2 row">
        <div class="col">
            <label for="procedencia_dep">Departamento</label>
            <select id="procedencia_dep" name="procedencia_dep" class="form-control">
                @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->codigo_dep }}" {{ $departamento->codigo_dep === $seldep ? 'selected' : '' }}>{{ $departamento->nombre_dep }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="procedencia_prov">Provincia</label>
            <select id="procedencia_prov" name="procedencia_prov" class="form-control">
                @foreach ($provincias as $provincia)
                <option value="{{ $provincia->codigo_prov }}" {{ $provincia->codigo_prov === $selprov ? 'selected' : '' }}>{{ $provincia->nombre_prov }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="procedencia_dis">Distrito</label>
            <select id="procedencia_dis" name="procedencia_dis" class="form-control">
                @foreach ($distritos as $distrito)
                <option value="{{ $distrito->codigo_dis }}" {{ $distrito->codigo_dis === $seldis ? 'selected' : '' }}>{{ $distrito->nombre_dis }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-4">
            <label for="direccion">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="form-control" placeholder="" value="{{ $patient ? $patient->direccion : old('direccion') }}">
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#procedencia_dep').change(() => {
        console.log('dep changed');
        $('#procedencia_prov').empty();
        $('#procedencia_prov').append('<option>CARGANDO...</option>');
        $('#procedencia_dis').empty();
        $('#procedencia_dis').append('<option>CARGANDO...</option>');
        Livewire.emit('updateDep', $('#procedencia_dep').val());
    });

    $('#procedencia_prov').change(() => {
        $('#procedencia_dis').empty();
        $('#procedencia_dis').append('<option>CARGANDO...</option>');
        Livewire.emit('updateProv', $('#procedencia_prov').val());
    });

    Livewire.on('updateProvincias', (data) => {
        $('#procedencia_prov').empty();
        for (prov of data) {
            $('#procedencia_prov').append(`<option value="${prov.codigo_prov}">${prov.nombre_prov}</option>`);
        }

        Livewire.emit('updateProv', $('#procedencia_prov').val());
    });

    Livewire.on('updateDistritos', (data) => {
        $('#procedencia_dis').empty();
        for (dis of data) {
            $('#procedencia_dis').append(`<option value="${dis.codigo_dis}">${dis.nombre_dis}</option>`);
        }
    });

</script>
@endpush

