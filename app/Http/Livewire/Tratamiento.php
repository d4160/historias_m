<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tratamiento extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'onTratamientoChanged' => 'onTratamientoChanged'];

    public function render()
    {
        return view('livewire.tratamiento');
    }

    public function onTratamientoChanged($id){
        $instance = \App\Models\Tratamiento::find($id);
        $this->emit('updateTratamientoView', $instance);
    }
}
