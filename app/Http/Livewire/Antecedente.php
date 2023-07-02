<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Antecedente extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'onAntecedentesChanged' => 'onAntecedentesChanged'];

    public function render()
    {
        return view('livewire.antecedente');
    }

    public function onAntecedentesChanged($id){
        $antecedente = \App\Models\Antecedente::find($id);
        $this->emit('updateAntecedentesView', $antecedente);
    }
}
