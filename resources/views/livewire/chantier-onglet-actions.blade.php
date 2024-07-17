<div class="chantier_action_corps">
    <div class="chantier_action_corps_ajout">
        <div wire:click="new_action" wire:loading.remove>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 30px;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192zM224 248c13.3 0 24 10.7 24 24v56h56c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v56c0 13.3-10.7 24-24 24s-24-10.7-24-24V376H144c-13.3 0-24-10.7-24-24s10.7-24 24-24h56V272c0-13.3 10.7-24 24-24z"/></svg>
        </div>
    </div>
    <div class="chantier_action_corps_actions">
        @forelse($actions as $action)
            <div class="chantier_action_corps_actions_action">
                <p class="chantier_action_corps_actions_action_date"
                title="Crée le {{ date('d/m/Y h:i:s', strtotime($action->created_at)) }}">{{ date('d/m/Y', strtotime($action->date)) }}</p>
                <p class="chantier_action_corps_actions_action_type">{{ $action->typeaction->designation }}</p>
                <p class="chantier_action_corps_actions_action_commentaire">{{ $action->designation }}</p>
                <p class="chantier_action_corps_actions_action_user">{{$action->user->name }}</p>
            </div>
        @empty
        @endforelse
    </div>
    @if($ajouter == true)
        <form wire:submit.prevent="add_action" class="card_new">
            <div class="card_new_card">
                <div class="card_new_card_entete">
                    <p>Créer une action</p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" wire:click="close_action" wire:loading.remove><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm175 79c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                </div>
                <div class="card_new_card_corps">
                    <div style="display: flex;
                    flex-direction: column;
                    width: calc(100% - 2px);">
                        <input type="date" wire:model="date"
                        class="card_new_card_corps_date">
                        @error('date') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div style="display: flex;
                    flex-direction: column;
                    width: calc(100% - 2px);">
                        <select wire:model="typeaction_id"
                        class="card_new_card_corps_type">
                            <option value="">-- Choisir un type d'action --</option>
                            @forelse($typeactions as $typeaction)
                                <option value="{{ $typeaction->id }}">{{ $typeaction->designation }}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('typeaction_id') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card_new_card_corps">
                    <div style="display: flex;
                    flex-direction: column;
                    width: calc(100% - 2px);">
                        <input type="text" wire:model="designation"
                        class="card_new_card_corps_commentaire"
                        title="Commentaire de l'action" placeholder="Commentaire de l'action">
                        @error('designation') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card_new_card_bouton">
                    <button type="submit" wire:loading.remove
                    class="card_new_card_bouton_bouton">Créer cette action</button>
                </div>
            </div>
        </form>
    @endif
</div>