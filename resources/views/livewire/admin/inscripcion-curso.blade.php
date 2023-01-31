<div>
    @if (session()->has('message'))
        <div class="px-4 pb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">"Ocurrió un error"</strong>
                <span class="block sm:inline">{{ session('message') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg wire:click="$set('dato', '')" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>
        @endif
    <div class="">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="border bg-gray-400 px-4 py-2 text-center">Inscribirse</div>
            <div class="w-full px-8 py-2">
                <div class="text-center flex items-center">
                    <div class="w-full flex">
                        <div class="w-full"><x-jet-label value="Nombre" />
                        <x-jet-input wire:model="nombre" class="w-full border pl-4" type="text" placeholder="Ingrese el nombre"/></div>
                    </div>
                    <div class="w-1/4 flex px-2">
                        <div class="w-full">
                            <x-jet-label value="Buscar DNI" />
                            <x-jet-input type="text" wire:model="searchid" class="w-full border" placeholder="DNI"/>
                        </div>
                    </div>
                    <div class="w-1/4 px-2">
                        <div class="w-full">
                            <x-jet-label value="Seleccione"/>
                            <select class="custom-select" name="estado" id="estado" wire:model="individuo">
                                <option selected value="colegiado">Colegiado</option>
                                <option value="persona">Persona</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-1/8 flex pl-2">
                        <div class="w-full">
                            <x-jet-label value="Agregar" />
                            @livewire('admin.create-new')
                        </div>
                    </div>
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
                <ul id="paginated-list" data-current-page="1" aria-live="polite">
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
                                @if ($individuo=="colegiado")
                                <div class="w-4 mr-2 hover:text-purple-500">
                                    <a wire:click="edit({{$item}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                </div>
                                @else
                                <div class="w-4 mr-2 hover:text-purple-500">
                                    <a wire:click="editP({{$item}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                </div>
                                @endif
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a wire:click="$emit('deleteColegiado', {{$item->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a wire:click="singin({{$item->id}})">
                                        <svg class="h-4 w-4 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />  <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" /></svg>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </ul>
            </tbody>
        </table>
            {{-- {{$colegiados->links()}} --}}
            @if ($colegiados->hasPages())
            <div class="px-6 py-4">
                {{$colegiados->links()}}
            </div>
            @endif
            {{-- <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px">
                  <li>
                    <button class="pagination-button px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" id="prev-button" aria-label="Previous page" title="Previous page">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    </button>
                  </li>
                  <div class="pagination-button px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white flex" id="pagination-numbers">
                  </div>
                  <li>
                    <button class="pagination-button px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" id="next-button" aria-label="Next page" title="Next page">
                      <svg class="h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    </button>
                  </li>
                </ul>
              </nav> --}}
        @else   
            <div class="px-4 py-6">No existe datos</div>                
        @endif
    </div>
    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            @if ($individuo=="colegiado")
                Datos del Colegiado
            @else
                Datos de la Persona
            @endif
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 w-full gap-6">
                <div>
                    <x-jet-label>
                        Nombres de la persona
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su nombre" wire:model="colegiado.nombres">
                    <x-jet-input-error for="colegiado.nombres"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido paterno de la persona
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su Primer apellido" wire:model="colegiado.paterno">
                    <x-jet-input-error for="colegiado.paterno"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido Materno de la persona
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su Segundo apellido" wire:model="colegiado.materno">
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
                @if ($individuo=="colegiado")
                <div>
                    <x-jet-label>
                        Codigo de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su Correo electronico" wire:model="colegiado.codigo">
                    <x-jet-input-error for="colegiado.codigo"/>
                </div>
                @endif
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
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Ingrese su numeros telefonico" wire:model="colegiado.telefono">
                    <x-jet-input-error for="colegiado.telefono"/>
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

    @push('js')
        <script src="sweetalert2.all.min.js"></script>
            <script>
                Livewire.on('deleteColegiado', postId=>{
                    Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.inscripcion-curso', 'delete', postId);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                    )
                    }
                })
                })
        </script>
    @endpush
</div>
