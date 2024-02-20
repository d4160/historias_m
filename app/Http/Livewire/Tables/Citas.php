<?php

namespace App\Http\Livewire\Tables;

use App\Models\Cita;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DatetimeColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Log;

class Citas extends LivewireDatatable
{
    public $exportable = true;

    public function builder()
    {
        return Cita::query()
            ->leftJoin('pacientes', 'pacientes.id', 'citas.paciente_id')
            ->leftJoin('users', 'users.specific_role_id', 'pacientes.id')
            ->where('users.user_role_id', '=', 5);
    }

    public function columns()
    {
        return [
            DatetimeColumn::name('created_at')
                ->label('Fecha registro')
                //->searchable()
                ->filterable()
                ->sortable()
                ->filterView('date')
                ->defaultSort('desc'),

            Column::raw('CONCAT(users.first_names, " ", users.last_name1, " ", COALESCE(users.last_name2, "")) AS Paciente')
                ->searchable()
                ->filterable(),

            Column::name('tipo')
                ->label('Motivo')
                ->searchable()
                ->filterable(),

            Column::name('consultorio')
                ->label('Consultorio')
                ->alignCenter()
                ->filterable(['Consultorio 1', 'Consultorio 2', 'Tópico', 'Rayos X', 'Laboratorio', 'Tomografía'])
                ->minWidth(140),

            DatetimeColumn::name('fecha_hora')
                ->label('Fecha cita')
                //->searchable()
                ->filterable()
                ->filterView('date')
                ->sortable(),

            Column::callback(['medico', 'medico_otro'], function ($medico, $medico_otro) {
                    return $medico == 'Otro' ? $medico_otro : $medico;
                })
                ->label('Médico tratante')
                ->alignCenter()
                ->searchable()
                ->filterOn(['medico', 'medico_otro'])
                ->filterable(['Yamil Cabrera', 'Daysy Mechan', 'Rodolfo Cairo', 'Otro']),

            Column::callback(
                ['estado_enum'],
                function ($estado) {

                    switch ($estado) {
                        case 'Atendido':
                            return '<span class="badge badge-success" style="background-color:#8dbf42;border-color:#8dbf42;">'.$estado.'</span>';
                        case 'No atendido':
                            return '<span class="badge badge-danger" style="background-color: #e7515a;border-color:#e7515a;">'.$estado.'</span>';
                        default:
                            return '<span class="badge badge-warning">'.$estado.'</span>';
                    }
            })
            ->label('Estado')
            ->filterOn(['estado_enum'])
            ->filterable(['Atendido','En espera','No atendido'])
            ->exportCallback(function ($estado) {
                return $estado;
            }),

            Column::name('estado')
                ->label('Observaciones')
                ->searchable()
                ->filterable(),

            Column::callback(['RAW CONCAT(users.first_names, " ", users.last_name1, " ", COALESCE(users.last_name2, ""))', 'id'], 
            function ($paciente_full_name, $cita_id) {	
                //return $id . ' ' . $num;
                return view('tables.cita_actions', ['paciente_full_name' => $paciente_full_name, 'cita_id' => $cita_id]);
            })
            ->label('Acciones')
            ->unsortable()
            ->excludeFromExport(),
        ];
    }

    public function onMounted()
    {

        //$this->removeSelectFilter(6, null, "En espera");
        //$this->removeSelectFilter(6, null, "No atendido");
        $this->doSelectFilter(6, "En espera");
        $this->doSelectFilter(6, "No atendido");

        // foreach($this->columns as $index => $column)
        // {
            
        //     Log::info($index . " - " . $column['label']);
        // }
    }
}