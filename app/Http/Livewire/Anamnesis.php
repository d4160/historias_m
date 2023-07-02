<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Anamnesis extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'onAnamnesisChanged' => 'onAnamnesisChanged'];

    public function render()
    {
        return view('livewire.anamnesis');
    }

    public function onAnamnesisChanged($id){
        $anamnesis = \App\Models\Anamnesis::find($id);
        $this->emit('updateAnamnesisView', $anamnesis);
    }
}
