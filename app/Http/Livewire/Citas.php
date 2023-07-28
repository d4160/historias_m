<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use Livewire\Component;

class Citas extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'filterByOption' => 'filterByOption', 'filterByDate' => 'filterByDate'];

    public $citas = [];
    private $option = 'fecha_hora';
    public $date = '';


    public function render()
    {
        $this->emit('render');
        return view('livewire.citas');
    }


    public function filterByOption($option)
    {
        switch($option) {
            case 1:
                $orderBy = 'fecha_hora';
                break;
            case 2:
                $orderBy = 'created_at';
                break;
        }

        $this->option = $orderBy;

        if ($this->date) {
            $this->citas = Cita::with(['paciente' => fn ($query) => $query->with('user') ])->whereDate($orderBy,'=', $this->date)->orderBy($orderBy, 'asc')->get();
        }
        else {
            $this->citas = Cita::with(['paciente' => fn ($query) => $query->with('user') ])->orderBy($orderBy, 'asc')->get();
        }

        //$this->emit('setDataTable');
    }

    public function filterByDate($date)
    {
        $this->date = $date;

        if ($this->date) {
            $this->citas = Cita::whereDate($this->option,'=', $date)->with(['paciente' => fn ($query) => $query->with('user') ])->orderBy($this->option, 'asc')->get();
        }
        else {
            $this->citas = Cita::with(['paciente' => fn ($query) => $query->with('user') ])->orderBy($this->option, 'asc')->get();
        }

        //$this->emit('setDataTable');
    }
}
