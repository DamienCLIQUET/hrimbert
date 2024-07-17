<?php

namespace App\Livewire;

use App\Models\Action;
use App\Models\Typeaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChantierOngletActions extends Component {

    public $id;
    public $ajouter = false;
    public $date = '';
    public $typeaction_id = '';
    public $designation = '';
    public $user_id = '1';
 
    protected $rules = [
        'date' => 'required',
        'typeaction_id' => 'required',
        'designation' => 'required',
    ];

    public function messages() {
        return [
            'date.required' => __('A renseigner'),
            'typeaction_id.required' => __('A renseigner'),
            'designation.required' => __('A renseigner'),
        ];
    }

    public function new_action() {
        $this->ajouter = true;
    }

    public function add_action() {
        $this->validate();
        Action::create([
            'chantier_id' => $this->id,
            'designation' => $this->designation,
            'typeaction_id' => $this->typeaction_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
        ]);
        $this->ajouter = false;
    }

    public function close_action() {
        $this->ajouter = false;
    }

    public function render() {
        // return view('livewire.chantier-onglet-actions', [
        //     'actions' => Action::where('chantier_id', $this->id)->with('typeaction')->with('user')->orderBy('created_at', 'desc')->get(),
        //     'chantier_id' => $this->id,
        //     'user_id' => Auth::User()->id, ?????????? Auth
        // ]);
        return view('livewire.chantier-onglet-actions', [
            'actions' => Action::where('chantier_id', $this->id)->with('typeaction')->with('user')->orderBy('created_at', 'desc')->get(),
            'typeactions' => Typeaction::get(),
            'ajouter' => $this->ajouter,
        ]);
    }
}