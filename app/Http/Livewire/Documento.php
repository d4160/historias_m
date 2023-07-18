<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Documento extends Component
{
    protected $listeners = ['forceRefresh' => '$refresh', 'numDocFocusout' => 'numDocFocusout'];

    public $value;
    public $p_id;
    public $autofocus;

    public function render()
    {
        return view('livewire.documento');
    }

    public function numDocFocusout($value, $id){
        $user = User::where('num_document', '=', $value)->first(); 
        
        if ($user && $user->id != $id)
            $this->emit('numDocAlreadyExists');
    }
}
