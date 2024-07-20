@extends('menu')

@section('title', 'Appli RIMBERT')

@section('content')
    <div class="accueil">
        @forelse($statuts as $statut)
            <div class="accueil_statut">
                <div class="accueil_statut_titre" style="color: {{ $statut->couleur }}">{!! $statut->designation !!}</div>
                @if($statut->visible == '1')
                    <div class="accueil_statut_chantiers">
                        @forelse($statut->chantiers as $chantier)
                            <div onclick="window.location='/chantier{{ $chantier->id }}'" class="accueil_statut_chantiers_chantier">
                                <p class="accueil_statut_chantiers_chantier_titre"
                                style="color: {{ $statut->couleur }}">{{ $chantier->lieu->client->societe }} {{ $chantier->lieu->client->nom }} {{ $chantier->lieu->client->prenom }} - {{ $chantier->nom }}</p>
                                <div class="accueil_statut_chantiers_chantier_action">
                                    @php
                                        $date = '';
                                        $typeaction = '';
                                        $designation = '';
                                        $total = 0;
                                    @endphp
                                    @forelse($chantier->actions as $action)
                                        @php
                                            $date = $action->created_at;
                                            $typeaction = $action->typeaction->designation;
                                            $designation = $action->designation;
                                        @endphp
                                    @empty
                                    @endforelse
                                    
                                    @forelse($chantier->chantierdetails as $chantierdetail)
                                        @php
                                            $total = $total + ($chantierdetail->prix / 100 * $chantierdetail->quantite / 100 * (100 - $chantierdetail->remise / 100) / 100);
                                        @endphp
                                    @empty
                                    @endforelse

                                    @if($designation != '')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 16px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM312 376c13.3 0 24-10.7 24-24s-10.7-24-24-24H136c-13.3 0-24 10.7-24 24s10.7 24 24 24H312z"/></svg>
                                        <a class="accueil_statut_chantiers_chantier_action_action">{{ date('d/m', strtotime($date)) }} {{ $typeaction }} : {{ $designation }}</a>
                                    @else
                                        <p></p>
                                    @endif
                                    <a class="accueil_statut_chantiers_chantier_action_tarif">{{ number_format($total * (10000 + $chantier->tva) / 10000, 2, ',', ' ') }}€ TTC</a>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div style="display: flex;
                    flex-direction: row;
                    flex-wrap: nowrap;
                    align-items: center;
                    justify-content: space-evenly;
                    padding: 0 2px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 16px; margin: 0 2px;" title="Ajouter un RDV A PRENDRE POUR DEVIS (Hervé)"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                        <p style="margin: 0;
                        padding: 0;">0€ HT</p>
                    </div>
                @endif
            </div>
        @empty
        @endforelse
    </div>
@endsection