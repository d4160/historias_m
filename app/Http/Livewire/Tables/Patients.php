<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\DatetimeColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Patients extends LivewireDatatable
{
    public function builder()
    {
        return User::query()
            ->leftJoin('pacientes', 'pacientes.id', 'users.specific_role_id')
            //->leftJoin('historias', 'historias.paciente_id', 'users.specific_role_id')
            //->groupBy('users.id')
            ->where('user_role_id', '=', 5)
            ->whereHas('paciente', function ($q) {
                $q->where('tipo', 1);
            });
            //->withCount('historias')
            //->orderBy('updated_at', 'desc');
    }

    public function columns()
    {
        return [

            Column::name('num_document')
                ->label('Nº Documento')
                ->searchable()
                ->filterable(),

            Column::name('first_names')
                ->label('Nombres')
                ->searchable()
                ->filterable(),

            Column::raw('CONCAT(users.last_name1, " ", COALESCE(users.last_name2, "")) AS Apellidos')
                ->searchable()
                ->filterable(),

            Column::callback(['RAW (
                SELECT
                count(*)
                FROM
                historias
                WHERE
                users.specific_role_id = historias.paciente_id
            )', 'paciente.id', '
                RAW CONCAT(users.first_names, " ", users.last_name1, " ", COALESCE(users.last_name2, ""))
            '], function ($historias_count, $paciente_id, $paciente_full_name) {
                //return $id . ' ' . $num;
                return view('tables.historias_count', ['historias_count' => $historias_count, 'paciente_id' => $paciente_id, 'paciente_full_name' => $paciente_full_name]);
            })
            ->label('Nº Atenciones'),

            DatetimeColumn::name('created_at')
                ->label('Fecha y hora de registro')
                //->searchable()
                ->filterable()
                ->sortable(),
            //->defaultSort('desc'),

            DatetimeColumn::name('updated_at')
                ->defaultSort('desc')
                ->hide(),

            DatetimeColumn::name('paciente.proxima_cita')
                ->label('Proxima cita')
                //->filterable()
                ->sortable(),
            //->defaultSort('desc'),

            Column::callback(
                ['paciente.estado', 'RAW (
                    SELECT
                    count(*)
                    FROM
                    historias
                    WHERE
                    users.specific_role_id = historias.paciente_id
                )'],
                function ($estado, $historias_count) {
                    if ($historias_count == 0) {
                        return '';
                    }

                    switch ($estado) {
                        case 'Atendido':
                            return '<span class="badge badge-danger" style="background-color:#8dbf42;border-color:#8dbf42;">'.$estado.'</span>';
                        case 'Pendiente':
                            return '<span class="badge badge-danger" style="background-color: #e7515a;border-color:#e7515a;">'.$estado.'</span>';
                        default:
                            return '<span class="badge badge-warning">'.$estado.'</span>';
                    }
            })
            ->label('Estado'),
            //->filterable(),

            Column::callback(['RAW (
                SELECT
                count(*)
                FROM
                historias
                WHERE
                users.specific_role_id = historias.paciente_id
            )', 'paciente.id', 
            'RAW CONCAT(users.first_names, " ", users.last_name1, " ", COALESCE(users.last_name2, ""))
            ', 'paciente.proxima_cita'
            , 'paciente.estado'], function ($historias_count, $paciente_id, $paciente_full_name, $paciente_proxima_cita, $paciente_estado) {	
                //return $id . ' ' . $num;
                return view('tables.paciente_actions', ['historias_count' => $historias_count, 'paciente_id' => $paciente_id, 'paciente_full_name' => $paciente_full_name, 'paciente_proxima_cita' => $paciente_proxima_cita, 'paciente_estado' => $paciente_estado]);
            })
            ->label('Acciones')
            ->unsortable(),
        ];
    }
}