<div class="card">
    <div class="px-4 py-2">
        @livewire('create-catitulos')
    </div>
    {{-- <div class="card-header">
        <input wire:model="search" type="text" class="form-control" placeholder="Ingrese el nombre o correo de un usuario">
    </div> --}}
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Capitulo</th>
                    <th>Responsable</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($capitulos as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->decano}}</td>
                        <td width="10px">{{-- <a href="{{route('admin.users.edit', $item)}}" class="btn btn-primary">Editar</a> --}}
                            <div class="flex">
                                <div class="px-2">
                                    <a wire:click="editcapitulo({{$item}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>                                      
                                    </a>
                                </div>
                                <div>
                                    <a wire:click="$emit('deletecapi', {{$item->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>                                  
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-jet-dialog-modal wire:model="edit">
        <x-slot name="title">
            <div class="text-center">EDITAR CAPITULO</div>
        </x-slot>
        <x-slot name="content">
            <div class="py-2">
                <x-jet-label value="CAPITULO"/>
                <x-jet-input type="text" class="w-full" wire:model="capitulo.nombre"/>
                <x-jet-input-error for="capitulo.nombre" />
            </div>
            <div class="py-2">
                <x-jet-label value="RESPONSABLE"/>
                <x-jet-input type="text" class="w-full" wire:model="capitulo.decano"/>
                <x-jet-input-error for="capitulo.decano" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex">
                <div class="px-2">
                    <x-jet-danger-button wire:click="$set('edit', false)">
                        Cancelar
                    </x-jet-danger-button>
                </div>
                <div>
                    <x-jet-button class="px-2" wire:click="save">
                        Guardar
                    </x-get-button>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    @push('js')
    <script src="sweetalert2.all.min.js"></script>
    <script>
        Livewire.on('deletecapi', postId=>{
            Swal.fire({
            title: 'Quieres eliminar el capitulo?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                Livewire.emitTo('admin.capitulos-show', 'delete', postId);
                Swal.fire(
                    'Eliminado!',
                    'Eliminaste de forma satisfactoria el capitulo.',
                    'success'
            )
            }
        })
        })
    @endpush
</div>