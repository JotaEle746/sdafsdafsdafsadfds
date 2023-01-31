<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <!-- component -->
        <div class="px-6 pt-2 container item-center">
            @livewire('admin.create-curso')
        </div>
        <x-table>
            @if ($curso->count())
            <div class="py-4 px-4 item-center">
            <table class="w-full table-auto border">
                <thead class="bg-gray-500 border">
                        <th class="cursor-pointer py-3 px-6 text-left" wire:click="order('title')">Titulo</th>
                        <th class="cursor-pointer py-3 px-6 text-center" wire:click="order('content')">Contenido</th>
                        <th class="py-3 px-6 text-center">Duración</th>
                        <th class="cursor-pointer py-3 px-6 text-center" wire:click="order('id')">Estado</th>
                        <th class="py-3 px-6 text-center">Acciónes</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($curso as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    {{$item->nombre}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex-1 items-center justify-center">
                                    {!!$item->temario!!}
                                </div>
                            </td>
                            <td>
                                <div class="py-3 px-6 text-center">{{$item->duracion}}</div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div>
                                    @if($item->estado=="0")
                                    <span class="badge bg-dark p-2">En espera</span>
                                    @elseif($item->estado=="1")
                                    <span class="badge bg-warning p-2">En proceso</span>
                                    @elseif($item->estado=="2")
                                    <span class="badge bg-success p-2">Finalizado</span>
                                    @elseif($item->estado=="3")
                                    <span class="badge bg-secondary p-2">Suspendido</span>
                                    @endif
                                </div>
                                {{-- <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{$item->estado}}</span> --}}
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        {{-- <a href="{{ route('prueba')}}">l</a> --}}
                                        <form method="GET" action="{{route('mostrarponentes')}}">
                                            @csrf
                                            <input type="hidden" name="kis" value="{{$item->id}}">
                                            <button type="submit" class="w-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </form>
                                        {{-- <a class="no-underline " href="{{route('mostrarponentes', $item->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a> --}}
                                    </div>
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                @if ($curso->hasPages())
                <div class="px-6 py-4">
                    {{$curso->links()}}
                </div>
                @endif
            @else   
                <div class="px-4 py-6">No existe datos</div>                
            @endif
            {{-- @if ($posts->hasPages())
            <div class="px-6 py-4">
                {{$posts->links()}}
            </div>
            @endif --}}
        </x-table>
    </div>
    <x-jet-dialog-modal class="pt-6 text-left" wire:model="open_edit">
        <x-slot name='title' class="text-left">
            Crear un nuevo curso
        </x-slot>
        <x-slot name='content'>
            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="">Espere un momento</span>
            </div>
            @if ($image)
                <img class="mb-4 w-full" src="{{$image->temporaryUrl()}}" alt="">
            @else
                <img class="mb-4 w-full" src="{{asset('storage/'. $cursos->certificado)}}" alt="">
            @endif
            <div class="mb-4">
                <x-jet-label value="Titulo del Curso"/>
                <x-jet-input class="w-full" type="text" wire:model.defer="cursos.nombre" placeholder="Ingrese el titulo del curso" />
                <x-jet-input-error for="cursos.nombre" />
            </div>
            <div class="mb-4">
                <div wire:ignore>
                    <x-jet-label value="Temario del Curso"/>
                    <textarea id="editor" class="form-control w-full" cols="10" rows="4" wire:model.defer="cursos.temario"></textarea>
                </div>
                <x-jet-input-error for="cursos.temario" />
            </div>
            <div class="mb-4">
                <div wire:ignore>
                    <x-jet-label value="Descripción del certificado"/>
                    <textarea id="editor" class="form-control w-full" cols="10" rows="4" wire:model.defer="cursos.descripcioncertificado"></textarea>
                </div>
                <x-jet-input-error for="cursos.descripcioncertificado" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-jet-label value="Fecha de inicio del Curso"/>
                    <x-jet-input required class="w-full" type="date" wire:model.defer="cursos.fecha_inicio"/>
                    <x-jet-input-error for="cursos.fecha_inicio" />
                </div>
                <div class="mb-4">
                    <x-jet-label value="Fecha de inicio del Curso"/>
                    <x-jet-input required class="w-full" type="date" wire:model.defer="cursos.fecha_fin"/>
                    <x-jet-input-error for="cursos.fecha_fin" />
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-jet-label value="Capitulo"/>
                    {{-- @livewire('filtrar-capitulo') --}}
                    <div>
                        <select class="custom-select w-full px-3 py-2 bg-gray-50 border border-gray-300" name="estado" id="estado" wire:model="cursos.capitulo_id">
                            <option selected value="0"><p class="text-red-600">--Seleccione--</p></option>
                            @foreach ($capitulos as $item)
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <x-jet-label value="Estado del curso"/>
                    <select class="custom-select" name="estado" id="estado" wire:model="cursos.estado">
                        <option selected value="1">En espera</option>
                        <option value="2">En proceso</option>
                        <option value="3">Finalizado</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-jet-label value="Cantidad de horas"/>
                    <div>
                        <x-jet-input type="number" class="w-full" placeholder="Campo no necesario" wire:model="cursos.horas"/>
                    </div>
                </div>
                <div class="mb-4">
                    <x-jet-label value="Ubicación del cuerpo"/>
                    <select class="custom-select" name="estado" id="estado" wire:model="cursos.encabezado">
                        <option selected value="1">Centro</option>
                        <option value="0">Derecho</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <x-jet-label value="Ubicación de pie de pagina"/>
                    <select class="custom-select" name="estado" id="estado" wire:model="cursos.footer">
                        <option selected value="2">Centro</option>
                        <option value="1">Izquierdo</option>
                        <option value="0">Derecho</option>
                        <option value="3">Sin footer</option>
                    </select>
                </div>
                <div class="mb-4">
                    <x-jet-label value="Fondo del certificado"/>
                    <input type="file" wire:model="image" id="{{$identificador}}">
                    <x-jet-input-error for="image"/>
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <div class="px-2">
                <x-jet-secondary-button wire:click="$set('open_edit', false)">
                    Cancelar
                </x-jet-secondary-button>
            </div>
            <div class="px-2">
                <x-jet-button wire:click="update" {{-- wire:loading.attr="disabled" wire:target="save, image" --}} class="disabled:opacity-25">
                    Guardar
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-modal>
    @push('js')
        <script src="sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('deleteCurso', postId=>{
                Swal.fire({
                title: 'Quieres eliminar el curso?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    Livewire.emitTo('admin.show-cursos', 'delete', postId);
                    Swal.fire(
                        'Eliminado!',
                        'Eliminaste de forma satisfactoria el curso.',
                        'success'
                )
                }
            })
            })
        </script>
    @endpush
</div>