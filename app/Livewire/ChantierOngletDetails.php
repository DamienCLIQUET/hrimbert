<?php

namespace App\Livewire;

use App\Models\Chantier;
use App\Models\Client;
use App\Models\Lieu;
use Livewire\Component;

class ChantierOngletDetails extends Component {

    public $id;
    public string $adresse;
    public string $codepostal;
    public string $ville;
    public string $tel;
    public string $gsm;
    public string $email;
    public string $accompt;
    public string $tva;
    public string $commentaire;
    public string $commentaireadmin;
    public string $commentairetechnique;

    public function mount() {
        $chantier = Chantier::where('id', $this->id)->first();
        $lieu = Lieu::where('id', Chantier::where('id', $this->id)->with('lieu')->first()->lieu->id)->first();
        $client = Client::where('id', Chantier::where('id', $this->id)->with('lieu', function ($query) {
            $query->with('client');
        })->first()->lieu->client->id)->first();
        if ($lieu->adresse == null) {
            $this->adresse = '';
        } else {
            $this->adresse = $lieu->adresse;
        }
        if ($lieu->codepostal == null) {
            $this->codepostal = '';
        } else {
            $this->codepostal = $lieu->codepostal;
        }
        if ($lieu->ville == null) {
            $this->ville = '';
        } else {
            $this->ville = $lieu->ville;
        }
        if ($client->tel == null) {
            $this->tel = '';
        } else {
            $this->tel = $client->tel;
        }
        if ($client->gsm == null) {
            $this->gsm = '';
        } else {
            $this->gsm = $client->gsm;
        }
        if ($client->email == null) {
            $this->email = '';
        } else {
            $this->email = $client->email;
        }
        if ($chantier->accompt == null) {
            $this->accompt = '0';
        } else {
            $this->accompt = $chantier->accompt;
        }
        if ($chantier->tva == null) {
            $this->tva = '';
        } else {
            $this->tva = $chantier->tva;
        }
        if ($chantier->commentaire == null) {
            $this->commentaire = '';
        } else {
            $this->commentaire = $chantier->commentaire;
        }
        if ($chantier->commentaireadmin == null) {
            $this->commentaireadmin = '';
        } else {
            $this->commentaireadmin = $chantier->commentaireadmin;
        }
        if ($chantier->commentairetechnique == null) {
            $this->commentairetechnique = '';
        } else {
            $this->commentairetechnique = $chantier->commentairetechnique;
        }
    }

    public function render() {
        $lieu = Lieu::where('id', Chantier::where('id', $this->id)->with('lieu')->first()->lieu->id)->first();
        $lieu->update([
            'adresse' => $this->adresse,
            'codepostal' => $this->codepostal,
            'ville' => $this->ville
        ]);
        $client = Client::where('id', Chantier::where('id', $this->id)->with('lieu', function ($query) {
            $query->with('client');
        })->first()->lieu->client->id)->first();
        $client->update([
            'tel' => $this->tel,
            'gsm' => $this->gsm,
            'email' => $this->email
        ]);
        $chantier = Chantier::where('id', $this->id)->first();
        $chantier->update([
            'accompt' => $this->accompt,
            'tva' => $this->tva,
            'commentaire' => $this->commentaire,
            'commentaireadmin' => $this->commentaireadmin,
            'commentairetechnique' => $this->commentairetechnique
        ]);
        return view('livewire.chantier-onglet-details', [
            'chantier' => Chantier::where('id', $this->id)->with('lieu', function ($query) {
                $query->with('client');
            })->first(),
        ]);
    }
}