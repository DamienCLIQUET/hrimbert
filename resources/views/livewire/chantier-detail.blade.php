<div class="chantier_detail">
    <div class="chantier_detail_onglets">
        <button wire:click="mon_onglet('details')"
        class="chantier_detail_onglets_onglet {{ $onglet == 'details' ? 'chantier_detail_onglets_onglet_select' : '' }}">Details</button>
        <button wire:click="mon_onglet('produits')"
        class="chantier_detail_onglets_onglet {{ $onglet == 'produits' ? 'chantier_detail_onglets_onglet_select' : '' }}">Produits</button>
        <button wire:click="mon_onglet('actions')"
        class="chantier_detail_onglets_onglet {{ $onglet == 'actions' ? 'chantier_detail_onglets_onglet_select' : '' }}">Actions</button>
        <button wire:click="mon_onglet('pjs')"
        class="chantier_detail_onglets_onglet {{ $onglet == 'pjs' ? 'chantier_detail_onglets_onglet_select' : '' }}">Pièces jointes</button>
        <button wire:click="mon_onglet('photos')"
        class="chantier_detail_onglets_onglet {{ $onglet == 'photos' ? 'chantier_detail_onglets_onglet_select' : '' }}">Photos</button>
        <button wire:click="mon_onglet('plans')"
        class="chantier_detail_onglets_onglet {{ $onglet == 'plans' ? 'chantier_detail_onglets_onglet_select' : '' }}">Plans</button>
    </div>
    @if($onglet == 'details')
        <livewire:chantier-onglet-details :id='$id' />
    @elseif($onglet == 'produits')
        <livewire:chantier-onglet-produits :id='$id' />
    @elseif($onglet == 'actions')
        <livewire:chantier-onglet-actions :id='$id' />
    @elseif($onglet == 'pjs')
        <livewire:chantier-onglet-pjs :id='$id' />
    @elseif($onglet == 'photos')
        <livewire:chantier-onglet-photos :id='$id' />
    @elseif($onglet == 'plans')
        <livewire:chantier-onglet-plans :id='$id' />
    @endif
</div>