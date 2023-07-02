<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExamenClinico extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'onExamenClinicoChanged' => 'onExamenClinicoChanged'];

    public function render()
    {
        return view('livewire.examen-clinico');
    }

    public function onExamenClinicoChanged($id){
        $instance = \App\Models\ExamenClinico::find($id);
        $this->emit('updateExamenClinicoView', $instance);
    }
}
