<?php

namespace App\Http\Livewire;

use App\Models\Departamento;
use App\Models\Provincia;
use Livewire\Component;

class Procedencia extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'updateDep' => 'updatedDep', 'updateProv' => 'updatedProv'];

    public $departamentos;
    public $provincias = [];
    public $distritos = [];

    public $patient;
    public $seldep;
    public $selprov;
    public $seldis;

    public function mount(){
        if ($this->patient) {
            $this->seldep = $this->patient->procedencia_dep;
            $this->selprov = $this->patient->procedencia_prov;
            $this->seldis = $this->patient->procedencia_dis;
        }
    }

    public function render()
    {
        $this->departamentos = Departamento::all();
        $dep = $this->patient && $this->seldep ? Departamento::find($this->seldep) : Departamento::first();

        $this->provincias = $dep->provincias;
        $prov = $this->patient && $this->selprov ? Provincia::find($this->selprov) : Provincia::where('codigo_dep', $dep->codigo_dep)->first();

        $this->distritos = $prov->distritos;

        return view('livewire.procedencia');
    }

    public function updatedDep($value){
        $this->provincias = Departamento::find($value)->provincias;

        $this->emit('updateProvincias', $this->provincias);
    }

    public function updatedProv($value){
        $this->distritos = Provincia::find($value)->distritos;

        $this->emit('updateDistritos', $this->distritos);
    }


}