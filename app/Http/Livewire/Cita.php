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
        $formatted = substr($fecha_hora, 0, 16);
        $this->titulo = "Editar Cita del '$formatted'";
        $action = route('citas.store', $id, $user->id);
        $this->emit('updateView', $action, $cita, $user);
    }
}
