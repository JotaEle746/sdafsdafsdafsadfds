<div>
    Colegiados:
    {{-- <x-jet-button class="float-right p-2" wire:click="gcertificados">Certificados</x-jet-button> --}}
    <x-jet-button class="float-right p-2" wire:click="exportexcel">Exportar Excel</x-jet-button>
    <hr>
    {{-- {{$codigoscertificados}} --}}
    {{-- @if (!is_null($codigoscertificados))
        @foreach ($codigoscertificados as $item)
            {{$item}}
        @endforeach
    @endif --}}

    <div class="my-2 flex">
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
                    <option selected value="">--Seleccionar--</option>
                    <option value="1">Ponentes</option>
                    <option value="0">Participantes</option>
                </select>
            </div>
        </div>
    </div>
    @if ($colegiados->count())
    <table id="pager" class="table table-striped table-bordered text-start w-100 mb-4">
        <thead>
            <tr class="bg-secondary">
                <th scope="col" class="text-center">DNI</th>
                <th scope="col" class="text-center">Nombres</th>
                <th scope="col" class="text-center">Rol</th>
                <th scope="col" class="text-center">Ponente</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($colegiados as $colegiado)
            <tr>
                <td>{{ $colegiado->dni }}</td>
                <td class="">{{ $colegiado->nombres }} {{$colegiado->paterno}} {{$colegiado->materno}} {{$codigoscertificados}}</td>
                @if($colegiado->rol=="0")
                <td class="text-center"><span class="badge bg-secondary p-2">Participante</span></td>
                @else
                <td class="text-center"><span class="badge bg-success p-2">Ponente</span></td>
                @endif

                <td>
                    <div class="row">
                        <input wire:change="AsignarP({{$colegiado->id}})" type="checkbox" <?php if ($colegiado->rol == "1") { echo 'checked="checked"'; } ?> {{-- value="{{$colegiado->rol}}? : 1 : 0" --}} class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-400 focus:ring-2 dark:bg-gray-300 dark:border-gray-900">
                        <label for="teal-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-700">Asignar Ponente</label>
                    </div>
                </td>
                <td>
                    <div class="col d-flex justify-content-center">
                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a wire:click="$emit('deleteC', {{$colegiado->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a wire:click="singin({{$colegiado->dni}})">
                                <svg class="h-4 w-4 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />  <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" /></svg>
                            </a>
                        </div>
                        {{-- <form action="{{ route('eliminarparticipante',$colegiado->id_matricula)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn bg-transparent border border-danger">Eliminar</button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{$colegiados->links()}} --}}
        @if ($colegiados->hasPages())
        <div class="px-6 py-4">
            {{$colegiados->links()}}
        </div>
        @endif
    @else   
        <div class="px-4 py-6">No existe datos</div>                
    @endif
    Personas:
    <hr>
    @if ($personas->count())
    <table class="table table-striped table-bordered text-start w-100 mb-2">
        <thead>
            <tr class="bg-secondary">
                <th scope="col" class="text-center">DNI</th>
                <th scope="col" class="text-center">Nombres</th>
                <th scope="col" class="text-center">Rol</th>
                <th scope="col" class="text-center">Ponente</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personas as $persona)
            <tr>
                <td>{{ $persona->dni }}</td>
                <td class="">{{ $persona->nombres }} {{$persona->paterno}} {{$persona->materno}}</td>
                @if($persona->rol=="0")
                <td class="text-center"><span class="badge bg-secondary p-2">Participante</span></td>
                @else
                <td class="text-center"><span class="badge bg-success p-2">Ponente</span></td>
                @endif

                <td>
                    <div class="row">
                        <input wire:change="AsignarC({{$persona->id}})" type="checkbox" <?php if ($persona->rol == 1) { echo 'checked="checked"'; } ?> {{-- value="{{$colegiado->rol}}? : 1 : 0" --}} class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-500 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-300 dark:border-gray-600">
                        <label for="teal-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-800">Asignar Ponenete</label>
                    </div>
                </td>
                <td>
                    <div class="col d-flex justify-content-center">
                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a wire:click="$emit('deleteP', {{$persona->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a wire:click="singin({{$persona->dni}})">
                                <svg class="h-4 w-4 text-black"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />  <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" /></svg>
                            </a>
                        </div>
                        {{-- <form action="{{ route('eliminarparticipante',$persona->id_matricula)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn bg-transparent border border-danger">Eliminar</button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        @if ($personas->hasPages())
        <div class="px-6 py-4">
            {{$personas->links()}}
        </div>
        @endif
    @else   
        <div class="px-4 py-6">No existe datos</div>                
    @endif
    @push('js')    
    <script src="sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('deleteC', postId=>{
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
                    
                    Livewire.emitTo('admin.inscritos-curso', 'deleteCo', postId);
                    Swal.fire(
                        'Eliminado!',
                        'Eliminaste de forma satisfactoria el curso.',
                        'success'
                )
                }
            })
            })
        </script>
        <script>
            Livewire.on('deleteP', postId=>{
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
                    Livewire.emitTo('admin.inscritos-curso', 'deletePe', postId);
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