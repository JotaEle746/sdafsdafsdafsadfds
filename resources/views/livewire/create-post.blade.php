<div class="ml-4">
    <x-jet-button wire:click="$set('open', true)">
        crear new post
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name='title'>
            Crear un nuevo post
        </x-slot>
        <x-slot name='content'>
            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando!</strong>
                <span class="">Espere un momento</span>
              </div>
{{--             @if ($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}" alt="">
            @endif --}}

            <div class="mb-4">
                <x-jet-label value="Titulo del Post"/>
                <x-jet-input class="w-full" type="text" wire:model.defer="title"/>

                <x-jet-input-error for="title" />
                {{-- @error('title')
                    <span>
                        {{$message}}
                    </span>
                @enderror --}}
            </div>
            <div class="mb-4">
                <div wire:ignore>
                    <x-jet-label value="Contenido del Post"/>
                    <textarea id="editor" class="form-control w-full" cols="30" rows="10" wire:model.defer="content"></textarea>
                </div>
                
                <x-jet-input-error for="content" />
            </div>
            {{-- <div>
                <input type="file" wire:model="image">
                <x-jet-input-error for="image" />
            </div> --}}
        </x-slot>
        <x-slot name='footer'>
            <div class="px-2">
                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-jet-secondary-button>
            </div>
            <div class="px-2">
                <x-jet-button wire:click="save" {{-- wire:loading.attr="disabled" wire:target="save, image" --}} class="disabled:opacity-25">
                    Crear
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-modal>
    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', ()=>{
                        @this.set('content', editor.getData());
                    });
                    Livewire.on('resetCKEditor', ()=>{
                        editor.setData('');
                    })
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>
    @endpush
</div>
