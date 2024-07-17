@extends('menu')

@section('title')
    Chantier {{ $chantier->lieu->client->societe }} {{ $chantier->lieu->client->nom }} {{ $chantier->lieu->client->prenom }} - {{ $chantier->nom }}
@endsection

@section('content')
    <div class="chantier_entete">
        <livewire:chantier-entete :id='$chantier->id' />
    </div>
    <livewire:chantier-detail :id='$chantier->id' />
@endsection