<div>
    <x-jet-button wire:click="$set('open', true)" class="px-2">
        Agregar
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="py-2 border-b-4">
                <div>
                    <div class="flex-1">
                        Agregar un nuevo:
                    </div>
                    <div class="">
                        <select class="custom-select" name="estado" id="estado" wire:model="individuo">
                            <option selected value="colegiado">Colegiado</option>
                            <option value="persona">Persona</option>
                        </select>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 w-full gap-6">
                <div>
                    <x-jet-label>
                        Nombres
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su nombre" wire:model="nombres">
                    <x-jet-input-error for="nombres"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido paterno
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su Primer apellido" wire:model="paterno">
                    <x-jet-input-error for="paterno"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido Materno
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su Segundo apellido" wire:model="materno">
                    <x-jet-input-error for="materno"/>
                </div>
                <div>
                    <x-jet-label>
                        Número de DNI
                    </x-jet-label>
                    <input class="required w-full border-2 border-gray-300 bg-white h-10 pl-5 pr-16 rounded-lg text-sm focus:outline-none" type="number" name="search" placeholder="Ingrese su numero de DNI" wire:model="dnii">
                    <x-jet-input-error for="dnii"/>
                </div>
                @if ($individuo=="colegiado")
                    <div>
                        <x-jet-label>
                            codigo
                        </x-jet-label>
                        <input class="required w-full border-2 border-gray-300 bg-white h-10 pl-5 pr-16 rounded-lg text-sm focus:outline-none" type="number" name="search" placeholder="Ingrese su Segundo apellido" wire:model="codigo">
                        <x-jet-input-error for="codigo"/>
                    </div>
                    <div>
                        <x-jet-label>
                            capitulo
                        </x-jet-label>
                        <div>
                            <select class="required custom-select w-full px-3 py-2 bg-gray-50 border border-gray-300" name="estado" id="estado" wire:model="capitulo">
                                <option selected value=""><p class="text-red-600">--Seleccione--</p></option>
                                @foreach ($capitulos as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div>
                    <x-jet-label>
                        Correo electronico
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="email" name="search" placeholder="Ingrese su Correo electronico" wire:model="email">
                    <x-jet-input-error for="email"/>
                </div>
                <div>
                    <x-jet-label>
                        Dirección de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su dirección" wire:model="direccion">
                    <x-jet-input-error for="direccion"/>
                </div>
                <div>
                    <x-jet-label>
                        Numero telefonico
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="number" name="search" placeholder="Ingrese su numeros telefonico" wire:model="telefono">
                    <x-jet-input-error for="telefono"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="px-2">
                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-jet-secondary-button>
            </div>
            <div class="px-2">
                <x-jet-button wire:click="save" {{-- wire:loading.attr="disabled" wire:target="save, image" --}} class="disabled:opacity-25 border bg-gray-400 px-4 py-2 text-center">
                    Inscribir
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal> 
</div>
