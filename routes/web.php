<?php

use App\Models\Action;
use App\Models\Chantier;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Lieu;
use App\Models\Profil;
use App\Models\Statut;
use App\Models\Type;
use App\Models\Typeaction;
use App\Models\Typechantier;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/base_table', function () {
    return 'Vous n\'avez pas les droits pour ça';
    // Profil
        Profil::create([
            'id' => '1',
            'name' => 'Webmaster'
        ]);
    // User
        User::create([
            'id' => '1',
            'name' => 'Damien',
            'profil_id' => '1',
            'email' => 'd.cliquet@gmail.com',
            'password' => 'Test'
        ]);
    // Statut
        Statut::create([
            'id' => '1',
            'designation' => 'RDV A PRENDRE POUR DEVIS (Hervé)',
            'ordre' => '1',
            'couleur' => 'purple'
        ]);
        Statut::create([
            'id' => '2',
            'designation' => 'INFO A COMPLETER',
            'ordre' => '2',
            'couleur' => '#ff8da1'
        ]);
        Statut::create([
            'id' => '3',
            'designation' => 'DEVIS A FAIRE (Hervé)',
            'ordre' => '3',
            'couleur' => 'orange'
        ]);
        Statut::create([
            'id' => '4',
            'designation' => 'DEVIS A ENVOYER (Lise)',
            'ordre' => '4',
            'couleur' => 'green'
        ]);
        Statut::create([
            'id' => '5',
            'designation' => 'DEVIS EN ATTENTE à relancer (Lise)',
            'ordre' => '5',
            'couleur' => 'gray'
        ]);
        Statut::create([
            'id' => '6',
            'designation' => 'EN ATTENTE retour client',
            'ordre' => '6',
            'couleur' => 'yellowgreen'
        ]);
        Statut::create([
            'id' => '7',
            'designation' => 'CHANTIER A PLANIFIER (Hervé)',
            'ordre' => '7',
            'couleur' => 'blue'
        ]);
        Statut::create([
            'id' => '8',
            'designation' => 'CHANTIER PREVU / EN COURS (Hervé)',
            'ordre' => '8',
            'couleur' => '#e92fff'
        ]);
        Statut::create([
            'id' => '9',
            'designation' => 'CHANTIER A FACTURER (Lise)',
            'ordre' => '9',
            'couleur' => 'red'
        ]);
        Statut::create([
            'id' => '10',
            'designation' => 'CHANTIER EN ATTENTE DE PAIEMENT (Lise)',
            'ordre' => '10',
            'couleur' => 'brown'
        ]);
        Statut::create([
            'id' => '11',
            'designation' => 'CHANTIER CLOTURE',
            'ordre' => '11',
            'couleur' => 'black'
        ]);
    // Typeaction
        Typeaction::create([
            'id' => '1',
            'designation' => 'Appel reçu'
        ]);
        Typeaction::create([
            'id' => '2',
            'designation' => 'Appel passé'
        ]);
        Typeaction::create([
            'id' => '3',
            'designation' => 'Email reçu'
        ]);
        Typeaction::create([
            'id' => '4',
            'designation' => 'Email envoyé'
        ]);
        Typeaction::create([
            'id' => '5',
            'designation' => 'SMS reçu'
        ]);
        Typeaction::create([
            'id' => '6',
            'designation' => 'SMS envoyé'
        ]);
        Typeaction::create([
            'id' => '7',
            'designation' => 'RDV fait'
        ]);
        Typeaction::create([
            'id' => '8',
            'designation' => 'Appeler'
        ]);
        Typeaction::create([
            'id' => '9',
            'designation' => 'Envoyer mail'
        ]);
        Typeaction::create([
            'id' => '10',
            'designation' => 'Envoyer SMS'
        ]);
        Typeaction::create([
            'id' => '11',
            'designation' => 'RDV'
        ]);
        Typeaction::create([
            'id' => '12',
            'designation' => 'Autres'
        ]);
    // Typechantier
        Typechantier::create([
            'id' => '1',
            'designation' => 'Normal',
        ]);
        Typechantier::create([
            'id' => '2',
            'designation' => 'Urgence',
        ]);
        Typechantier::create([
            'id' => '3',
            'designation' => 'Contrat',
        ]);
    // Client
        Client::create([
            'id' => '1',
            'nom' => 'CLIQUET',
            'prenom' => 'Damien',
            'email' => 'd.cliquet@gmail.com',
            'tel' => '',
            'gsm' => '0682578631'
        ]);
    // Lieu
        Lieu::create([
            'id' => '1',
            'client_id' => '1',
            'designation' => 'Domicile',
            'adresse' => '17A, Rue des bruyères',
            'codepostal' => '27670',
            'ville' => 'SAINT OUEN DU TILLEUIL'
            ]);
        Lieu::create([
            'id' => '2',
            'client_id' => '1',
            'designation' => 'Melpro',
            'adresse' => '9, Rue condorcet',
            'codepostal' => '76300',
            'ville' => 'SOTTEVILLE LES ROUEN'
        ]);
    // Chantier
        Chantier::create([
            'id' => '1',
            'lieu_id' => '1',
            'nom' => 'Test',
            'statut_id' => '1',
            'commentaire' => 'B',
            'commentaireadmin' => 'Bl',
            'commentairetechnique' => 'Bla',
            'accompt' => '10',
            'tva' => '2000',
            'remise' => '0',
            'typechantier_id' => '1',
            'date' => '2024-07-07'
        ]);
        Chantier::create([
            'id' => '2',
            'lieu_id' => '1',
            'nom' => 'Test2',
            'statut_id' => '2',
            'commentaire' => 'B',
            'commentaireadmin' => 'Bl',
            'commentairetechnique' => 'Bla',
            'accompt' => '0',
            'tva' => '2000',
            'remise' => '0',
            'typechantier_id' => '2',
            'date' => '2024-07-07'
        ]);
        Chantier::create([
            'id' => '3',
            'lieu_id' => '2',
            'nom' => 'Test3',
            'statut_id' => '3',
            'commentaire' => 'B',
            'commentaireadmin' => 'Bl',
            'commentairetechnique' => 'Bla',
            'accompt' => '0',
            'tva' => '1000',
            'remise' => '0',
            'typechantier_id' => '3',
            'date' => '2024-07-07'
        ]);
    // Action
        Action::create([
            'id' => '1',
            'chantier_id' => '2',
            'designation' => 'Test',
            'typeaction_id' => '1',
            'user_id' => '1',
            'date' => '2024-07-01'
        ]);
        Action::create([
            'id' => '2',
            'chantier_id' => '2',
            'designation' => 'Test2',
            'typeaction_id' => '2',
            'user_id' => '1',
            'date' => '2024-07-02'
        ]);
        Action::create([
            'id' => '3',
            'chantier_id' => '2',
            'designation' => 'Test3',
            'typeaction_id' => '3',
            'user_id' => '1',
            'date' => '2024-07-03'
        ]);
        Action::create([
            'id' => '4',
            'chantier_id' => '2',
            'designation' => 'Test4',
            'typeaction_id' => '4',
            'user_id' => '1',
            'date' => '2024-07-04'
        ]);
    // Type
        Type::create([
            'id' => '1',
            'designation' => 'article'
        ]);
        Type::create([
            'id' => '2',
            'designation' => 'titre'
        ]);
        Type::create([
            'id' => '3',
            'designation' => 'compose'
        ]);
});

Route::get('/', function () {
    return view('accueil', [
        'statuts' => Statut::where('id', '>', '0')->with('chantiers', function ($query) {
            $query->with('lieu', function ($query) {
                $query->with('client');
            });
        })->get(),
    ]);
})->name('accueil');

// Détail chantier
Route::get('/chantier{id}', function (string $id) {



    // dd(Categorie::where('id', '1')->with('souscategories', function ($query) {
    //     $query->with('souscategories', function ($query) {
    //         $query->with('souscategories', function ($query) {
    //             $query->with('souscategories', function ($query) {
    //                 $query->with('souscategories', function ($query) {
    //                     $query->with('souscategories', function ($query) {
    //                         $query->with('souscategories', function ($query) {
    //                             $query->with('souscategories', function ($query) {
    //                                 $query->with('souscategories', function ($query) {
    //                                     $query->with('souscategories');
    //                                 });
    //                             });
    //                         });
    //                     });
    //                 });
    //             });
    //         });
    //     });
    // })->first());



    if (Chantier::where('id', $id)->first()) {
        return view('chantier', [
            'chantier' => Chantier::where('id', $id)->with('lieu', function ($query) {
                $query->with('client');
            })->first(),
        ]);
    } else {
        return to_route('accueil');
    }
});