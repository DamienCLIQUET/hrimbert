<div class="chantier_produit_corps">
    <div class="chantier_produit_corps_ajout">
        <div wire:click="new_titre" wire:loading.remove
        title="Ajouter un titre" placeholder="Ajouter un titre">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 30px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32v96V384c0 35.3 28.7 64 64 64H256V384H64V160H256V96H64V32zM288 192c0 17.7 14.3 32 32 32H544c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32H445.3c-8.5 0-16.6-3.4-22.6-9.4L409.4 9.4c-6-6-14.1-9.4-22.6-9.4H320c-17.7 0-32 14.3-32 32V192zm0 288c0 17.7 14.3 32 32 32H544c17.7 0 32-14.3 32-32V352c0-17.7-14.3-32-32-32H445.3c-8.5 0-16.6-3.4-22.6-9.4l-13.3-13.3c-6-6-14.1-9.4-22.6-9.4H320c-17.7 0-32 14.3-32 32V480z"/></svg>
        </div>
        <div wire:click="new_produit" wire:loading.remove
        title="Ajouter un produit" placeholder="Ajouter un produit">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 30px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C78.3 0 64 14.3 64 32v96h64V32c0-17.7-14.3-32-32-32zM288 0c-17.7 0-32 14.3-32 32v96h64V32c0-17.7-14.3-32-32-32zM32 160c-17.7 0-32 14.3-32 32s14.3 32 32 32v32c0 77.4 55 142 128 156.8V480c0 17.7 14.3 32 32 32s32-14.3 32-32V412.8c12.3-2.5 24.1-6.4 35.1-11.5c-2.1-10.8-3.1-21.9-3.1-33.3c0-80.3 53.8-148 127.3-169.2c.5-2.2 .7-4.5 .7-6.8c0-17.7-14.3-32-32-32H32zM432 512a144 144 0 1 0 0-288 144 144 0 1 0 0 288zm16-208v48h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V384H368c-8.8 0-16-7.2-16-16s7.2-16 16-16h48V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
        </div>
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