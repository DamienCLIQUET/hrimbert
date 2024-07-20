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

Route::get('/test', function () {
    dd();
});

Route::get('/', function () {
    return view('accueil', [
        'statuts' => Statut::where('id', '>', '0')->with('chantiers', function ($query) {
            $query->with('actions', function ($query) {
                $query->with('typeaction');
            })->with('lieu', function ($query) {
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