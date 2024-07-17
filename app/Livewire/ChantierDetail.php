<?php

namespace App\Livewire;

use App\Models\Chantier;
use App\Models\Statut;
use Livewire\Component;

class ChantierDetail extends Component {

    public $id;
    public string $onglet = 'produits'; // ?????????? details

    public function mon_onglet($onglet) {
        $this->onglet = $onglet;
    }

    public function render() {
        return view('livewire.chantier-detail', [
            'chantier' => Chantier::where('id', $this->id)->with('lieu', function ($query) {
                $query->with('client');
            })->first(),
            'statuts' => Statut::get(),
            'onglet' => $this->onglet,
        ]);
    }
}