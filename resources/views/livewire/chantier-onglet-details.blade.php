<div class="chantier_detail_corps">
    <div class="chantier_detail_corps_client">
        <div class="chantier_detail_corps_client_zone">
            <a href="https://www.google.com/maps/dir//{{ $chantier->lieu->adresse }}{{ $chantier->lieu->ville }}" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 25px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M408 120c0 54.6-73.1 151.9-105.2 192c-7.7 9.6-22 9.6-29.6 0C241.1 271.9 168 174.6 168 120C168 53.7 221.7 0 288 0s120 53.7 120 120zm8 80.4c3.5-6.9 6.7-13.8 9.6-20.6c.5-1.2 1-2.5 1.5-3.7l116-46.4C558.9 123.4 576 135 576 152V422.8c0 9.8-6 18.6-15.1 22.3L416 503V200.4zM137.6 138.3c2.4 14.1 7.2 28.3 12.8 41.5c2.9 6.8 6.1 13.7 9.6 20.6V451.8L32.9 502.7C17.1 509 0 497.4 0 480.4V209.6c0-9.8 6-18.6 15.1-22.3l122.6-49zM327.8 332c13.9-17.4 35.7-45.7 56.2-77V504.3L192 449.4V255c20.5 31.3 42.3 59.6 56.2 77c20.5 25.6 59.1 25.6 79.6 0zM288 152a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
            </a>
            <input type="text" wire:model.live.debounce.1s="adresse"
            title="Adresse du client" placeholder="Adresse du client"
            style="width: 100%;">
            <input type="text" wire:model.live.debounce.1s="codepostal"
            title="Code postal du client" placeholder="Code postal du client"
            size="5">
            <input type="text" wire:model.live.debounce.1s="ville"
            title="Ville du client" placeholder="Ville du client"
            style="width: 75%;">
        </div>
    <div class="chantier_detail_corps_client_zonecentre">
        <a href="tel:06 50 36 21 42 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 25px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
        </a>
        <input type="phone" wire:model.live.debounce.1s="tel"
        title="Téléphone fixe du client" placeholder="Téléphone fixe du client"
        size="10">
        <a href="tel:">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 25px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64H80V384H304V64z"/></svg>
        </a>
        <input type="phone" wire:model.live.debounce.1s="gsm"
        title="Téléphone portable du client" placeholder="Téléphone portable du client"
        size="10">
    </div>
    <div class="chantier_detail_corps_client_zone">
        <a href="mailto:benjamin.delmach@gmai.com">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 25px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 64C150 64 64 150 64 256s86 192 192 192c17.7 0 32 14.3 32 32s-14.3 32-32 32C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256v32c0 53-43 96-96 96c-29.3 0-55.6-13.2-73.2-33.9C320 371.1 289.5 384 256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128c27.9 0 53.7 8.9 74.7 24.1c5.7-5 13.1-8.1 21.3-8.1c17.7 0 32 14.3 32 32v80 32c0 17.7 14.3 32 32 32s32-14.3 32-32V256c0-106-86-192-192-192zm64 192a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg>
        </a>
        <input type="email" wire:model.live.debounce.1s="email"
        title="Adresse email du client" placeholder="Adresse email du client"
        style="width: 100%;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" style="height: 25px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M247.7 8C103.6 8 0 124.8 0 256c0 136.3 111.7 248 247.7 248C377.9 504 496 403.1 496 256 496 117 388.4 8 247.7 8zm.6 450.7c-112 0-203.6-92.5-203.6-202.7 0-23.2 3.7-45.2 10.9-66l65.7 29.1h-4.7v29.5h23.3c0 6.2-.4 3.2-.4 19.5h-22.8v29.5h27c11.4 67 67.2 101.3 124.6 101.3 26.6 0 50.6-7.9 64.8-15.8l-10-46.1c-8.7 4.6-28.2 10.8-47.3 10.8-28.2 0-58.1-10.9-67.3-50.2h90.3l128.3 56.8c-1.5 2.1-56.2 104.3-178.8 104.3zm-16.7-190.6l-.5-.4 .9 .4h-.4zm77.2-19.5h3.7v-29.5h-70.3l-28.6-12.6c2.5-5.5 5.4-10.5 8.8-14.3 12.9-15.8 31.1-22.4 51.1-22.4 18.3 0 35.3 5.4 46.1 10l11.6-47.3c-15-6.6-37-12.4-62.3-12.4-39 0-72.2 15.8-95.9 42.3-5.3 6.1-9.8 12.9-13.9 20.1l-81.6-36.1c64.6-96.8 157.7-93.6 170.7-93.6 113 0 203 90.2 203 203.4 0 18.7-2.1 36.3-6.3 52.9l-136.1-60.5z"/></svg>
        <input type="number" wire:model.live.debounce.1s="accompt"
        title="Déjà encaissé" placeholder="€"
        style="width: 100px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="height: 25px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M374.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-320 320c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l320-320zM128 128A64 64 0 1 0 0 128a64 64 0 1 0 128 0zM384 384a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z"/></svg>
        <select wire:model.live.debounce.1s="tva"
        title="Taux de TVA du chantier">
            <option value="20">20 %</option>
            <option value="10" selected="">10 %</option>
            <option value="5.5">5,5 %</option>
            <option value="0">0 %</option>
        </select>
    </div>
</div>
<div class="chantier_detail_corps_commentaire">
    <textarea wire:model.live.debounce.1s="commentaire" rows="6"
    title="Commentaires" placeholder="Commentaires"></textarea>
    <textarea wire:model.live.debounce.1s="commentaireadmin" rows="6"
    title="Commentaires administratifs" placeholder="Commentaires administratifs"></textarea>
    <textarea wire:model.live.debounce.1s="commentairetechnique" rows="6"
    title="Commentaires techniques" placeholder="Commentaires techniques"></textarea>
</div>
</div>