<div class="chantier_produit_corps">
    <div class="chantier_produit_corps_produits">
        @php
            $total = 0;
        @endphp
        @forelse($chantierdetails as $chantierdetail)
            @if($chantierdetail->type_id == 1)
                <div class="chantier_produit_corps_produits_produit">
                    <div class="chantier_produit_corps_produits_produit_zonetitre">
                        <div class="chantier_produit_corps_produits_produit_zonetitre_titre">
                            <input type="text" value="{{ $chantierdetail->titre->designation }}">
                        </div>
                        <div class="chantier_produit_corps_produits_produit_zonetitre_pictos">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="chantier_produit_corps_produits_produit_zonetitre_pictos_blanc" title="Cloner la zone"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M384 336l-192 0c-8.8 0-16-7.2-16-16l0-256c0-8.8 7.2-16 16-16l140.1 0L400 115.9 400 320c0 8.8-7.2 16-16 16zM192 384l192 0c35.3 0 64-28.7 64-64l0-204.1c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1L192 0c-35.3 0-64 28.7-64 64l0 256c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l192 0c35.3 0 64-28.7 64-64l0-32-48 0 0 32c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256c0-8.8 7.2-16 16-16l32 0 0-48-32 0z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="chantier_produit_corps_produits_produit_zonetitre_pictos_blanc" title="Ajouter un produit"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C78.3 0 64 14.3 64 32l0 96 64 0 0-96c0-17.7-14.3-32-32-32zM288 0c-17.7 0-32 14.3-32 32l0 96 64 0 0-96c0-17.7-14.3-32-32-32zM32 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l0 32c0 77.4 55 142 128 156.8l0 67.2c0 17.7 14.3 32 32 32s32-14.3 32-32l0-67.2c12.3-2.5 24.1-6.4 35.1-11.5c-2.1-10.8-3.1-21.9-3.1-33.3c0-80.3 53.8-148 127.3-169.2c.5-2.2 .7-4.5 .7-6.8c0-17.7-14.3-32-32-32L32 160zM432 512a144 144 0 1 0 0-288 144 144 0 1 0 0 288zm16-208l0 48 48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-48 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48-48 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l48 0 0-48c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="chantier_produit_corps_produits_produit_zonetitre_pictos_rouge" title="Supprimer le produit"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                        </div>
                    </div>
            @elseif($chantierdetail->type_id == 2)
                    <div class="chantier_produit_corps_produits_produit_finzonetitre">

                    </div>
                </div>
            @elseif($chantierdetail->type_id == 3)
                <div class="chantier_produit_corps_produits_produit_zoneproduit">
                    <div class="chantier_produit_corps_produits_produit_zoneproduit_produit">
                        <input type="button" id="detailprod3789" value="{{ $chantierdetail->article->designation }}" class="chantier_produit_corps_produits_produit_zoneproduit_produit_designation"
                        style="background: linear-gradient(90deg, green {{ $chantierdetail->avancement }}%, #a7a7a7 0%);" onclick="afficher_produit(&quot;3789&quot;)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="chantier_produit_corps_produits_produit_zoneproduit_produit_black" title="Déplacer le produit"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 150.6c12.5-12.5 12.5-32.8 0-45.3l-96-96c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.7 96 32 96C14.3 96 0 110.3 0 128s14.3 32 32 32l306.7 0-41.4 41.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l96-96zm-333.3 352c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 416 416 416c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0 41.4-41.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3l96 96z"/></svg>
                        <input type="text" id="quantiteprod3789" value="{{ number_format($chantierdetail->quantite / 100, '2', ',', ' ') }}" class="chantier_produit_corps_produits_produit_zoneproduit_produit_quantite" onkeypress="return valid_number(event)" onchange="save_produit(3789)" onfocus="this.select();" onclick="this.select();">
                        <p class="chantier_produit_corps_produits_produit_zoneproduit_produit_unite">{{ $chantierdetail->unite }}</p>
                        <div class="chantier_produit_corps_produits_produit_zoneproduit_produit_remise">
                            <input type="text" id="remiseprod3789" value="{{ number_format($chantierdetail->remise / 100, '2', ',', ' ') }}" onkeypress="return valid_number(event)" onchange="save_produit(3789)" onfocus="this.select();" onclick="this.select();"> %
                        </div>
                        <div class="chantier_produit_corps_produits_produit_zoneproduit_produit_tarif">
                            <input type="text" id="tarifprod3789" value="{{ number_format($chantierdetail->prix / 100, '2', ',', ' ') }}" onkeypress="return valid_number(event)" onchange="save_produit(3789)" onfocus="this.select();" onclick="this.select();"> €
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="chantier_produit_corps_produits_produit_zoneproduit_produit_rouge" title="Supprimer le produit"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                    </div>
                    <div class="chantier_produit_corps_produits_produit_zoneproduit_commentaires">
                        <input type="text" id="commentaireprod3789" value="" onchange="save_commentaire(3789, this.value)">
                        @php
                            $total = $total + ($chantierdetail->prix / 100 * $chantierdetail->quantite / 100 * (100 - $chantierdetail->remise / 100) / 100);
                        @endphp
                        <p>{{ number_format($chantierdetail->prix / 100 * $chantierdetail->quantite / 100 * (100 - $chantierdetail->remise / 100) / 100, '2', ',', ' ') }} €</p>
                    </div>
                </div>
            @endif
        @empty
        @endforelse
    </div>
    <div class="chantier_produit_corps_entete">
        <div class="chantier_produit_corps_entete_ajout">
            <div wire:click="new_titre" wire:loading.remove
            title="Ajouter un titre" placeholder="Ajouter un titre">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 30px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32v96V384c0 35.3 28.7 64 64 64H256V384H64V160H256V96H64V32zM288 192c0 17.7 14.3 32 32 32H544c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32H445.3c-8.5 0-16.6-3.4-22.6-9.4L409.4 9.4c-6-6-14.1-9.4-22.6-9.4H320c-17.7 0-32 14.3-32 32V192zm0 288c0 17.7 14.3 32 32 32H544c17.7 0 32-14.3 32-32V352c0-17.7-14.3-32-32-32H445.3c-8.5 0-16.6-3.4-22.6-9.4l-13.3-13.3c-6-6-14.1-9.4-22.6-9.4H320c-17.7 0-32 14.3-32 32V480z"/></svg>
            </div>
            <div wire:click="new_produit" wire:loading.remove
            title="Ajouter un produit" placeholder="Ajouter un produit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 30px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C78.3 0 64 14.3 64 32v96h64V32c0-17.7-14.3-32-32-32zM288 0c-17.7 0-32 14.3-32 32v96h64V32c0-17.7-14.3-32-32-32zM32 160c-17.7 0-32 14.3-32 32s14.3 32 32 32v32c0 77.4 55 142 128 156.8V480c0 17.7 14.3 32 32 32s32-14.3 32-32V412.8c12.3-2.5 24.1-6.4 35.1-11.5c-2.1-10.8-3.1-21.9-3.1-33.3c0-80.3 53.8-148 127.3-169.2c.5-2.2 .7-4.5 .7-6.8c0-17.7-14.3-32-32-32H32zM432 512a144 144 0 1 0 0-288 144 144 0 1 0 0 288zm16-208v48h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V384H368c-8.8 0-16-7.2-16-16s7.2-16 16-16h48V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
            </div>
        </div>
        <p class="chantier_produit_corps_entete_total">TOTAL : {{ number_format($total, 2, ',', ' ') }} € HT</p>
    </div>
    @if($ajoutertitre == true)
        <form wire:submit.prevent="add_titre" class="card_new">
            <div class="card_new_card">
                <div class="card_new_card_entete">
                    <p>Ajouter un titre</p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" wire:click="close_titre" wire:loading.remove><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm175 79c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                </div>
                <div class="card_new_card_corps">
                    <div style="display: flex;
                    flex-direction: column;
                    width: calc(100% - 2px);">
                        <input type="text" wire:model="designation"
                        class="card_new_card_corps_commentaire"
                        title="Titre" placeholder="Titre">
                        @error('designation') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card_new_card_bouton">
                    <button type="submit" wire:loading.remove
                    class="card_new_card_bouton_bouton">Ajouter ce titre</button>
                </div>
            </div>
        </form>
    @endif
    @if($ajouterproduit == true)
        <div class="liste_produits">
            <div class="liste_produits_box">
                <div class="liste_produits_box_titres">
                    <div class="liste_produits_box_titres_precedent" onclick="new_produit(670, 0, 0, &quot;&quot;)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3V256v41.7L459.5 440.6zM256 352V256 128 96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V352z"/></svg>
                    </div>
                    <div class="liste_produits_box_titres_recherche">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                        <input type="text" id="recherche" title="recherche" placeholder="recherche" onkeyup="filtrer(this.value)">
                    </div>
                    <div class="liste_produits_box_titres_fermer" wire:click="close_produit" wire:loading.remove>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm175 79c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                    </div>
                </div>
                <div class="liste_produits_box_corps">



                    <div class="liste_produits_box_corps_N" wire:click="new_produit(670, 0, 389, &quot;&quot;)">
                        <div class="liste_produits_box_corps_N_nom">
                            <p>A Produits indisponibles</p>
                        </div>
                    </div>
                    <div class="liste_produits_box_corps_A" id="liste_produits_1019">
                        <div class="liste_produits_box_corps_A_nom">
                            <p class="liste_produits_box_corps_A_nom_description">contrat</p>
                            <input type="text" id="quantite1019" title="Quantité" placeholder="Qté" class="liste_produits_box_corps_A_nom_quantite" onfocus="this.select();" onclick="this.select();">
                            <p class="liste_produits_box_corps_A_nom_unite">1</p>
                            <input type="number" id="tarif1019" title="Prix de vente" placeholder="€" value="1050" class="liste_produits_box_corps_A_nom_tarif" onfocus="this.select();" onclick="this.select();">
                            <i class="fa-solid fa-right-to-bracket fa-xl" id="add_produit1019" title="Ajouter contrat" onclick="add_produit(670, 0, 1019, &quot;&quot;)" aria-hidden="true"></i><span class="sr-only">Ajouter contrat</span>
                        </div>
                    </div>
                    <div class="liste_produits_box_corps_N" id="liste_produits_new_arborescence">
                        <div class="liste_produits_box_corps_N_newnom">
                            <input type="text" id="arborescence" title="Titre" placeholder="Titre" style="width: 100% !important;">
                            <i class="fa-solid fa-right-to-bracket fa-xl" title="Créer cette nouvelle catégorie" onclick="add_new_arborescence(670, 0, 0, 0)" aria-hidden="true"></i><span class="sr-only">Créer cette nouvelle catégorie</span>
                        </div>
                    </div>
                    <div class="liste_produits_box_corps_A" id="liste_produits_new_produit">
                        <div class="liste_produits_box_corps_A_newnom">
                            <input type="text" id="quantite" title="Quantité" placeholder="Qté" class="liste_produits_box_corps_A_newnom_quantite" onfocus="this.select();" onclick="this.select();">
                            <input type="text" id="unite" title="Unité" placeholder="Unité" class="liste_produits_box_corps_A_newnom_unite">
                            <p> de </p>
                            <input type="text" id="designation" title="Désignation" placeholder="Désignation" class="liste_produits_box_corps_A_newnom_designation">
                            <input type="text" id="tarif" title="Prix de vente" placeholder="€" class="liste_produits_box_corps_A_newnom_unite" onfocus="this.select();" onclick="this.select();">
                            <i class="fa-solid fa-right-to-bracket fa-xl" title="Créer ce nouveau produit" onclick="add_new_produit(&quot;670&quot;, &quot;0&quot;, &quot;0&quot;, &quot;0&quot;)" aria-hidden="true"></i><span class="sr-only">Créer ce nouveau produit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>