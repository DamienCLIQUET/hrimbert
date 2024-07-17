<div>
    <select wire:model.live.debounce.250ms="statut" class="chantier_entete_select">
        @forelse($statuts as $statut)
            <option value="{{ $statut->id }}" style="color: {{ $statut->couleur }};">{{ $statut->designation }}</option>
        @empty
        @endforelse
    </select>
    <input type="text" readonly="readonly" value="{{ $chantier->lieu->client->societe }} {{ $chantier->lieu->client->nom }} {{ $chantier->lieu->client->prenom }}"
    title="Nom du client" placeholder="Nom du client" class="chantier_entete_input">
    <input type="text" wire:model.live.debounce.250ms="nom"
    value="{{ $nom }}"
    title="Nature du chantier" placeholder="Nature du chantier" class="chantier_entete_input">
</div>