<div>
    <div class="">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="border bg-gray-400 px-4 py-2 text-center">Inscribirse</div>
            <div class="w-full px-8 py-2">
                <div class="text-center grid grid-cols-6 gap-2 items-center">
                    <div class="col-span-4">
                        <x-jet-label value="Nombre" />
                        <x-jet-input wire:model="nombre" class="w-full border pl-4" type="text" placeholder="Ingrese el nombre"/>
                    </div>
                    <div class="">
                        <x-jet-label value="Seleccione"/>
                        <select class="custom-select" name="estado" id="estado" wire:model="individuo">
                            <option selected value="colegiado">Colegiado</option>
                            <option value="persona">Persona</option>
                        </select>
                    </div>
                    <div>
                        <x-jet-label value="Agregar nuevo" />
                        @livewire('admin.create-new')
                    </div>
                    {{-- <div>
                        <x-jet-label value="Dni"/>
                        <x-jet-input wire:model="dni" class="w-full border pl-4" type="" placeholder="Ingrese su DNI"/>
                    </div>
                    <div>
                        <x-jet-label value="Codigo"/>
                        <x-jet-input wire:model="codigo" class="w-full border pl-4" type="number" placeholder="Ingrese su codigo"/>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div wire:init="loadColegiados">
        @if (count($colegiados))
        <div class="py-2 item-center">
        <table class="w-full table-auto border">
            <thead class="bg-gray-500 border">
                    <th class="cursor-pointer py-3 px-6 text-left" wire:click="order('title')">Nombres</th>
                    <th class="cursor-pointer py-3 px-6 text-center" wire:click="order('content')">DNI</th>
                    @if ($individuo=="colegiado")
                    <th class="py-3 px-6 text-center">Codigo</th>
                    @endif
                    <th class="py-3 px-6 text-center">Acciónes</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($colegiados as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                {{$item->nombres}}
                                {{$item->paterno}}
                                {{$item->materno}}
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex items-center text-center">
                                {{$item->dni}}
                            </div>
                        </td>
                        @if ($individuo=="colegiado")
                        <td class="py-3 px-6 text-center">
                            <div class="flex items-center">
                                {{$item->codigo}}
                            </div>
                        </td>
                        @endif
                        <td class="py-3 px-6">
                            <div class="flex item-center justify-center">
                                {{-- <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a href="{{route('mostrarponentes', $item->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </div> --}}
                                <div class="w-4 mr-2 hover:text-purple-500">
                                    <a wire:click="edit({{$item}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a wire:click="$emit('deleteCurso', {{$item->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a href="">
                                        <svg class="h-4 w-4 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />  <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" /></svg>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            @if ($colegiados->hasPages())
            <div class="px-6 py-4">
                {{$colegiados->links()}}
            </div>
            @endif
        @else   
            <div class="px-4 py-6">No existe datos</div>                
        @endif
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Datos del Colegiado
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 w-full gap-6">
                <div>
                    <x-jet-label>
                        Nombres de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su nombre" wire:model="colegiado.nombres">
                    <x-jet-input-error for="colegiado.nombres"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido paterno de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su Primer apellido" wire:model="colegiado.paterno">
                    <x-jet-input-error for="colegiado.paterno"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido Materno de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su Segundo apellido" wire:model="colegiado.materno">
                    <x-jet-input-error for="colegiado.materno"/>
                </div>
                <div>
                    <x-jet-label>
                        Número de DNI de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="number" name="search" placeholder="Ingrese su numero de DNI" wire:model="colegiado.dni">
                    <x-jet-input-error for="colegiado.dni"/>
                </div>
                <div>
                    <x-jet-label>
                        Correo electronico de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su Correo electronico" wire:model="colegiado.email">
                    <x-jet-input-error for="colegiado.email"/>
                </div>
                <div>
                    <x-jet-label>
                        Dirección de la persona de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su dirección" wire:model="colegiado.direccion">
                    <x-jet-input-error for="colegiado.direccion"/>
                </div>
                <div>
                    <x-jet-label>
                        Numero telefonico de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su numeros telefonico" wire:model="telefono">
                    <x-jet-input-error for="telefono"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="px-2">
                <x-jet-secondary-button wire:click="$set('open_edit', false)">
                    Cancelar
                </x-jet-secondary-button>
            </div>
            <div class="px-2">
                <x-jet-button wire:click="update" {{-- wire:loading.attr="disabled" wire:target="save, image" --}} class="disabled:opacity-25 border bg-gray-400 px-4 py-2 text-center">
                    Inscribir
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>

{{-- <div>
    <x-jet-button class="p-2" wire:click="$set('open', true)">
        Inscribirse
    </x-jet-button>

    <x-jet-modal wire:model="open">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="w-full">
                <div class="border bg-gray-400 px-4 py-2 text-center">Inscribirse</div>
                <div class="w-full px-8 py-2">
                    <div class="text-center grid grid-cols-5 gap-2 items-center">
                        <div class="text-center col-span-2">
                            Ingrese su número de DNI
                        </div>
                        <div class="text-center pt-2 relative mx-auto text-gray-600 col-span-2">
                            <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                            type="search" name="search" placeholder="Search">
                            <button type="submit" class="absolute right-0 top-0 mt-5">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                width="512px" height="512px">
                                <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                            </button>
                        </div>
                        <div class="text-left">
                            <x-jet-button class="px-2">
                                Buscar
                            </x-jet-button>
                        </div>
                        <div></div>
                        <div></div>
                        <div class="col-span-2">Digite unicamente 8 digitos</div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </x-jet-modal>
</div>
 --}}