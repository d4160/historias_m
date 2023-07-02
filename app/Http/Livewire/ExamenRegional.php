<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExamenRegional extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'onExamenRegionalChanged' => 'onExamenRegionalChanged'];

    public function render()
    {
        return view('livewire.examen-regional');
    }

    public function onExamenRegionalChanged($id){
        $instance = \App\Models\ExamenRegional::find($id);
        $this->emit('updateExamenRegionalView', $instance);
    }
}
