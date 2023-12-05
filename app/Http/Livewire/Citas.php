<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use Livewire\Component;

class Citas extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'filterByOption' => 'filterByOption', 'filterByDate' => 'filterByDate', 'filterByHideAtendido' => 'filterByHideAtendido'];

    public $citas = [];
    public $option = 'created_at';
    public $hideAtendido = true;
    public $date = '';

    public function mount()
    {
        $this->option = session('option', 'created_at');

        $this->date = session('date', '');

        $this->hideAtendido = session('hideAtendido', true);

        $this->setCitas($this->date, $this->option, $this->hideAtendido);
    }

    public function render()
    {
        $this->emit('render');
        return view('livewire.citas');
    }


    public function filterByOption($option)
    {
        $this->option = $option;
        session(['option' => $option]);

        $this->setCitas($this->date, $this->option, $this->hideAtendido);

        //$this->emit('setDataTable');
    }

    public function filterByDate($date)
    {
        $this->date = $date;
        session(['date' => $date]);

        $this->setCitas($this->date, $this->option, $this->hideAtendido);

        //$this->emit('setDataTable');
    }

    public function filterByHideAtendido($hide)
    {
        $this->hideAtendido = $hide;
        session(['hideAtendido' => $hide]);

        $this->setCitas($this->date, $this->option, $this->hideAtendido);

        //$this->emit('setDataTable');
    }

    function setCitas($date, $option, $hideAtendido)
    {
        if ($date) {
            if ($hideAtendido) {
                $this->citas = Cita::whereDate($option,'=', $date)->where('estado_enum', '!=', 'Atendido')->with(['paciente' => fn ($query) => $query->with('user') ])->orderBy($option, 'asc')->get();
            }
            else {
                $this->citas = Cita::whereDate($option,'=', $date)->with(['paciente' => fn ($query) => $query->with('user') ])->orderBy($option, 'asc')->get();
            }
        }
        else {
            if ($hideAtendido) {
                $this->citas = Cita::where('estado_enum', '!=', 'Atendido')->with(['paciente' => fn ($query) => $query->with('user') ])->orderBy($option, 'desc')->get();
            }
            else {
                $this->citas = Cita::with(['paciente' => fn ($query) => $query->with('user') ])->orderBy($option, 'desc')->get();
            }
        }
    }
}
