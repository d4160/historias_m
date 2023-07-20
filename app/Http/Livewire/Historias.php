<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Historias extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'onHcChanged' => 'onHcChanged'];

    public $historias = [];

    public function render()
    {
        return view('livewire.historias');
    }

    public function onHcChanged($id){
        $dateTimeStrings = array();

        $this->historias = \App\Models\Paciente::find($id)->historias;

        // foreach($this->historias as $his) {
        //     array_push($dateTimeStrings, \Carbon\Carbon::parse($his->created_at)
        //                                 ->timezone(config('app.timezone'))
        //                                 ->toDateTimeString());
        // }

        // $this->emit('updateHistorias', $this->historias, $dateTimeStrings);
    }
}
