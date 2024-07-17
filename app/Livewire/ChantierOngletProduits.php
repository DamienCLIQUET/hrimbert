<?php

namespace App\Livewire;

use App\Models\Chantierdetail;
use App\Models\Article;
use Livewire\Component;

class ChantierOngletProduits extends Component {

    public $id;
    public $ajoutertitre = false;
    public $ajouterproduit = false;
    public $designation = '';
 
    protected $rules = [
        'designation' => 'required',
    ];

    public function messages() {
        return [
            'designation.required' => __('A renseigner'),
        ];
    }

    public function new_titre() {
        $this->ajoutertitre = true;
    }

    public function add_titre() {
        $this->validate();
        $titre = Article::create([
            'designation' => $this->designation,
        ]);
        $ordre = Chantierdetail::where('chantier_id', $this->id)->max('ordre');
        if ($ordre == null) {
            $ordre = 1;
        } else {
            $ordre++;
        }
        Chantierdetail::create([
            'chantier_id' => $this->id,
            'detail' => $titre->id,
            'type_id' => '2',
            'ordre' => $ordre
        ]);
        $this->designation = '';
        $this->ajoutertitre = false;
    }

    public function close_titre() {
        $this->ajoutertitre = false;
    }

    public function new_produit() {
        $this->ajouterproduit = true;
    }

    public function add_produit() {
        dd('add_produit');
        $this->validate();
        Action::create([
            'chantier_id' => $this->id,
            'designation' => $this->designation,
            'typeaction_id' => $this->typeaction_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
        ]);
        $this->designation = '';
        $this->ajouterproduit = false;
    }

    public function close_produit() {
        $this->ajouterproduit = false;
    }
    
    public function render() {
        return view('livewire.chantier-onglet-produits');
    }
}