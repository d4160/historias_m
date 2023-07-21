<?php

namespace App\Http\Livewire;

use App\Models\KardexDetalle;
use Livewire\Component;

class Kardex extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'createMedicamento' => 'createMedicamento', 'editMedicamento' => 'editMedicamento'];

    public $titulo;
    //public $medicamento;

    public function render()
    {
        return view('livewire.kardex');
    }

    public function createMedicamento($id){
        //$this->medicamento = null;
        $this->titulo = 'Nuevo Medicamento';
        $action = route('kardex.detalle_store', $id);
        $this->emit('updateKardexView', $action, null);
    }

    public function editMedicamento($id){
        $medicamento = KardexDetalle::find($id);
        $med = $medicamento->medicamento;
        $this->titulo = "Editar Medicamento '$med'";
        $action = route('kardex.detalle_update', $id);
        $this->emit('updateKardexView', $action, $medicamento);
    }
}
