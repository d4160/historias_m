<?php

namespace App\Http\Livewire;

use App\Models\Cita as ModelsCita;
use Livewire\Component;

class Cita extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'createCita' => 'createCita', 'editCita' => 'editCita'];

    public $titulo;

    public function render()
    {
        return view('livewire.cita');
    }

    public function createCita(){
        //$this->Cita = null;
        $this->titulo = 'Nueva Cita';
        $action = route('citas.store');
        $this->emit('updateView', $action, null);
    }

    public function editCita($id){
        $cita = ModelsCita::find($id);
        $user = $cita->paciente->user;
        $fecha_hora = $cita->fecha_hora;
        $this->titulo = "Editar Cita del '$fecha_hora'";
        $action = route('citas.store', $id);
        $this->emit('updateView', $action, $cita, $user);
    }
}
