<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ImpresionDiagnostica extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'onImpresionDiagnosticaChanged' => 'onImpresionDiagnosticaChanged'];

    public function render()
    {
        return view('livewire.impresion-diagnostica');
    }

    public function onImpresionDiagnosticaChanged($id){
        $instance = \App\Models\ImpresionDiagnostica::find($id);
        $this->emit('updateImpresionDiagnosticaView', $instance);
    }
}
