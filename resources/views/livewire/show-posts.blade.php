<div wire:init="loadPosts">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- component -->
        <x-table>
            <div class="py-6 px-4 flex item-center">
                {{-- <input type="text" wire:model="search"> --}}
                <x-jet-input class="flex-1 mr-20" placeholder="Buscar" type="text" wire:model="search"/>
                @livewire('create-post')
            </div>
            {{-- @if ($posts->count()) --}}
            @if (count($posts))
            <table class="w-full table-auto">
                <thead>
                        <th class="cursor-pointer py-3 px-6 text-left" wire:click="order('id')">Id</th>
                        <th class="cursor-pointer py-3 px-6 text-left" wire:click="order('title')">Titulo</th>
                        <th class="cursor-pointer py-3 px-6 text-center" wire:click="order('content')">Contenido</th>
                        <th class="cursor-pointer py-3 px-6 text-center" wire:click="order('id')">Estado</th>
                        <th class="py-3 px-6 text-center">Acciónes</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($posts as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        {{$item->id}}
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    {{$item->title}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex-1 items-center justify-center">
                                    {!!$item->content!!}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Active</span>
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex item-center justify-center">
                                    {{-- <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div> --}}
                                    <div class="w-4 mr-2 hover:text-purple-500">
                                        {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                        <a wire:click="edit({{$item}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a wire:click="$emit('deletePost', {{$item->id}})">
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
                @if ($posts->hasPages())
                <div class="px-6 py-4">
                    {{$posts->links()}}
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

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar el post
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
                <x-jet-secondary-button wire:click="$set('open_edit', false)">
                   Cancelar
                </x-jet-secondary-button>
            </div>
            <div class="px-2">
                <x-jet-button wire:click="update" {{-- wire:loading.attr="disabled" wire:target="save, image" --}} class="disabled:opacity-25">
                    Actualizar
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    @push('js')
        <script src="sweetalert2.all.min.js"></script>
            <script>
                Livewire.on('deletePost', postId=>{
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
                        
                        Livewire.emitTo('show-posts', 'delete', postId);
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
