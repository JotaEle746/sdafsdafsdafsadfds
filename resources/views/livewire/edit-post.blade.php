<div>
    <a wire:click="$set('open', true)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
        </svg>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el post {{$post->title}}
        </x-slot>

        <x-slot name="content">
            <div>
                <x-jet-label value="Titulo del Post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full"/>
            </div>

            <div>
                <x-jet-label value="Contenido del Post" />
                <textarea wire:model="post.content" rows="6" class="form-control w-full"></textarea>
            </div>
        </x-slot>

        <x-slot name='footer'>
            <div class="px-2">
                <x-jet-secondary-button wire:click="$set('open', false)">
                   Cancelar
                </x-jet-secondary-button>
            </div>
            <div class="px-2">
                <x-jet-button wire:click="save" {{-- wire:loading.attr="disabled" wire:target="save, image" --}} class="disabled:opacity-25">
                    Actualizar
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
