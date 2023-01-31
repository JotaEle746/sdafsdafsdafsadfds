<div>
    {{-- <div>
        <a wire:click="$set('create', true)" class="rounded cursor-pointer bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r float-right mr-4 m-2">Crear capitulo</a>
    </div> --}}
    {{$message}}
    <x-jet-button wire:click="$set('create', true)" class="px-2 float-right">
        create
    </x-jet-button>
    <x-jet-dialog-modal wire:model="create">
        <x-slot name="title">
            <div class="text-center">CREAR UN NUEVO CAPITULO</div>
        </x-slot>
        <x-slot name="content">
            <div class="py-2">
                <x-jet-label value="CAPITULO"/>
                <x-jet-input type="text" class="w-full" placeholder="Ingrese el nombre del capitulo" wire:model="nombre"/>
                <x-jet-input-error for="nombre"/>
            </div>
            <div class="py-2">
                <x-jet-label value="RESPONSABLE"/>
                <x-jet-input type="text" class="w-full" placeholder="Ingrese el nombre del responsable" wire:model="decano"/>
                <x-jet-input-error for="decano"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex">
                <div class="px-2">
                    <x-jet-danger-button wire:click="$set('create', false)">
                        Cancelar
                    </x-jet-danger-button>
                </div>
                <div>
                    <x-jet-button class="px-2" wire:click="save">
                        Guardar
                    </x-jet-button>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
