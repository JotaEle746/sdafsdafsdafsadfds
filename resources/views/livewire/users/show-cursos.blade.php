<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl rounded-lg px-4">
            @if ($cursos->count())
            @foreach ($cursos as $item)
            <div class="bg-white overflow-hidden shadow-xl rounded-lg mb-4">
                <div class="">
                    <div class="border bg-gray-400 px-4 py-2">
                        <div>
                            {{$item->nombre}}
                        </div>
                        <div>
                            <x-jet-label>
                                <span>Del </span>{{$item->fecha_inicio}} <span> al </span> {{$item->fecha_fin}}
                            </x-jet-label>
                        </div>
                    </div>
                    <div class="px-4 py-2 grid grid-cols-4">
                        <div class="p-2 col-span-3">
                            {!!$item->temario!!}
                        </div>
                        <div class="p-2 text-right">
                            {{-- @livewire('users.inscripcion-curso', ['curso' => $item], key($item->id)) --}}
                            @if ($item->estado=="1")
                                <x-jet-button class="p-2" wire:click="edit({{$item}})">
                                    Inscribirse
                                </x-jet-button>
                            @endif
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                No existe ningun curso
            @endif
            @if ($cursos->haspages())
                <div class="px-6 py-4">
                    {{$cursos->links()}}
                </div>
            @endif
        </div>
    </div>
    <x-jet-modal wire:model="open_edit">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="w-full">
                <div class="border bg-gray-400 px-4 py-2 text-center">
                    Inscribirse
                    <button type="button" class="float-right text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="$set('open_edit', false)">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="w-full px-8 py-2">
                    <div class="text-center sm:flex">
                        <div class="text-center">
                            Ingrese su número de DNI
                        </div>
                        <div class="text-center relative mx-auto text-gray-600">
                            <input class="border-2 border-gray-300 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none" type="number" name="search" placeholder="Search" wire:model.defer="dni">
                            <x-jet-input-error for="dni"/><br>
                            Digite unicamente 8 digitos
                        </div>
                        <div>
                            <x-jet-button class="border bg-gray-400 px-4 py-2 text-center" wire:click="inscribir({{$curso}})">
                                Inscribir
                            </x-jet-button>
                        </div>
                    </div>
                    <div x-data="{ modelOpen: @entangle('showDropdown') }">
                        <ul x-show="modelOpen" @click.outside="modelOpen = false">
                            <div>
                                <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                        <div x-cloak @click="modelOpen = false" x-show="modelOpen" 
                                            x-transition:enter="transition ease-out duration-300 transform"
                                            x-transition:enter-start="opacity-0" 
                                            x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease-in duration-200 transform"
                                            x-transition:leave-start="opacity-100" 
                                            x-transition:leave-end="opacity-0"
                                            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                                        ></div>
                                        <div x-cloak x-show="modelOpen" 
                                            x-transition:enter="transition ease-out duration-300 transform"
                                            x-transition:enter-start="opacity-0 translate-y-0 sm:translate-y-0 sm:scale-95" 
                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave="transition ease-in duration-200 transform"
                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave-end="opacity-0 translate-y-0 sm:translate-y-0 sm:scale-95"
                                            class="inline-block w-full max-w-xl p-0 my-8 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                                        >
                                        <div class="relative w-full max-w-2xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                                    <div class="flex items-center justify-between space-x-4">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                                                            <span>¡Importante!</span>
                                                        </h3>
                                                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700 float-right">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class=" float-rightw-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-6">
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Se enviará la información del desarrollo del curso al Correo Electronico o al numero telefonico registrado.
                                                    </p>
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Si desea actualizar los datos personales puede hacerlo de a través de la Oficina de Tecnologia y Sistemas del colegio de Ingenieros del Peru CD-Puno.
                                                    </p>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                                    <button @click="modelOpen = false" wire:click="$set('open_edit', false)" type="button" class="text-white bg-gray-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancelar</button>
                                                    <button wire:click="inscribirse({{$curso}})" type="button" class="text-white bg-gray-500 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Inscribirse</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <br><br><br><br>
                                <br><br><br><br>
                                <br><br><br><br>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-jet-modal>
    <x-jet-dialog-modal wire:model="inscribir_persona">
        <x-slot name="title">
            Inscribirse al curso
        </x-slot>
        <x-slot name="content">
            <div class="sm:grid sm:grid-cols-2 w-full gap-6">
                <div>
                    <x-jet-label>
                        Nombres de la persona
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su nombre" wire:model="nombres">
                    <x-jet-input-error for="nombres"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido paterno de la persona
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su Primer apellido" wire:model="paterno">
                    <x-jet-input-error for="paterno"/>
                </div>
                <div>
                    <x-jet-label>
                        Apellido Materno de la persona
                    </x-jet-label>
                    <input class="capitalize w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su Segundo apellido" wire:model="materno">
                    <x-jet-input-error for="materno"/>
                </div>
                <div>
                    <x-jet-label>
                        Número de DNI de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="number" name="search" placeholder="Ingrese su numero de DNI" wire:model="dnii">
                    <x-jet-input-error for="dnii"/>
                </div>
                <div>
                    <x-jet-label>
                        Correo electronico de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="email" name="search" placeholder="Ingrese su Correo electronico" wire:model="email">
                    <x-jet-input-error for="email"/>
                </div>
                <div>
                    <x-jet-label>
                        Dirección de la persona de la persona
                    </x-jet-label>
                    <input onkeyup="javascript:this.value=this.value.toUpperCase();" class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="text" name="search" placeholder="Ingrese su dirección" wire:model="direccion">
                    <x-jet-input-error for="direccion"/>
                </div>
                <div>
                    <x-jet-label>
                        Numero telefonico de la persona
                    </x-jet-label>
                    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="number" name="search" placeholder="Ingrese su numeros telefonico" wire:model="telefono">
                    <x-jet-input-error for="telefono"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="px-2">
                <x-jet-secondary-button wire:click="$set('inscribir_persona', false)">
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
