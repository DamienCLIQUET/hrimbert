<?php

namespace App\Livewire;

use App\Models\Chantier;
use App\Models\Statut;
use Livewire\Component;

class ChantierEntete extends Component {

    public string $id;
    public string $statut;
    public string $nom;

    protected $rules = [
        'statut' => 'required',
        'nom' => 'required',
    ];

    public function mount() {
        $this->statut = Chantier::where('id', $this->id)->with('statut')->first()->statut_id;
        $this->nom = Chantier::where('id', $this->id)->first()->nom;
    }

    public function render() {
        $chantier = Chantier::where('id', $this->id)->first();
        $chantier->update([
            'statut_id' => $this->statut,
            'nom' => $this->nom
        ]);
        // ?????????? enregistrer action
        return view('livewire.chantier-entete', [
            'chantier' => Chantier::where('id', $this->id)->with('lieu', function ($query) {
                $query->with('client');
            })->first(),
            'statuts' => Statut::get(),
        ]);
    }
}