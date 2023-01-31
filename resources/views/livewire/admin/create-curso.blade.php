<div>
    <div class="ml-4">
        <div class="text-right">
            <x-jet-button class="text-right px-2" wire:click="$set('open', true)">
                crear new curso
            </x-jet-button>
        </div>
    
        <x-jet-dialog-modal class="pt-6 text-left" wire:model="open">
            <x-slot name='title' class="text-left">
                Crear un nuevo curso
            </x-slot>
            <x-slot name='content'>
                <div wire:loading wire:target="image" class="mb-4 w-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Imagen cargando!</strong>
                    <span class="">Espere un momento</span>
                </div>
                @if ($image)
                        <img class="mb-4 w-full" src="{{$image->temporaryUrl()}}" alt="">
                @endif
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <x-jet-label value="Titulo del Curso"/>
                        <x-jet-input class="w-full" type="text" wire:model.defer="nombre" placeholder="Ingrese el titulo del curso" />
                        <x-jet-input-error for="nombre" />
                    </div>
                    <div class="col-span-2">
                        <div wire:ignore>
                            <x-jet-label value="Temario del Curso"/>
                            <textarea id="editor" class="form-control w-full" cols="20" rows="10" wire:model.defer="temario"></textarea>
                        </div>
                        <x-jet-input-error for="temario" />
                    </div>
                    <div class="col-span-2">
                        <div wire:ignore>
                            <x-jet-label value="Descripción del certificado"/>
                            <textarea id="editor" placeholder="Campo no necesario" class="form-control w-full" cols="20" rows="5" wire:model.defer="descripcion"></textarea>
                        </div>
                        <x-jet-input-error for="temario" />
                    </div>
                    <div class="">
                        <x-jet-label value="Fecha de inicio del Curso"/>
                        <x-jet-input required class="w-full" type="date" wire:model.defer="fecha_inicio"/>
                        <x-jet-input-error for="fecha_inicio" />
                    </div>
                    <div class="">
                        <x-jet-label value="Fecha de inicio del Curso"/>
                        <x-jet-input required class="w-full" type="date" wire:model.defer="fecha_fin"/>
                        <x-jet-input-error for="fecha_fin" />
                    </div>
                    <div class="">
                        <x-jet-label value="Capitulo"/>
                        <select class="custom-select" name="estado" id="estado" wire:model="capitulo">
                            <option selected>--Seleccione--</option>
                            @foreach ($capitulos as $item)
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="capitulo" />
                        
                    </div>
                    <div class="">
                        <x-jet-label value="Estado del curso"/>
                        <select class="custom-select" name="estado" id="estado" wire:model="estado">
                            <option selected>--Seleccione--</option>
                            <option selected value="1">En espera</option>
                            <option value="2">En proceso</option>
                            <option value="3">Finalizado</option>
                        </select>
                        <x-jet-input-error for="estado" />
                    </div>
                    <div class="mb-4">
                        <x-jet-label value="Cantidad de horas"/>
                        <div>
                            <x-jet-input type="number" class="w-full" placeholder="Campo no necesario" wire:model="horas"/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-jet-label value="Ubicaciòn del cuerpo"/>
                        <select class="custom-select" name="estado" id="estado" wire:model="encabezado">
                            <option selected value="">--Seleccione--</option>
                            <option value="1">Centro</option>
                            <option value="0">Derecho</option>
                        </select>
                        <x-jet-input-error for="encabezado" />
                    </div>
                    
                    <div>
                        <x-jet-label value="Ubicaciòn de pie de pàgina"/>
                        <select class="custom-select" name="estado" id="estado" wire:model="footer">
                            <option selected value="">--Seleccione--</option>
                            <option value="2">Centro</option>
                            <option value="1">Izquierdo</option>
                            <option value="0">Derecho</option>
                            <option value="3">Sin footer</option>
                        </select>
                        <x-jet-input-error for="footer" />
                    </div>
                    <div class="mt-4">
                        <input type="file" wire:model="image" id="{{$identificador}}">
                        <x-jet-input-error for="image" />
                    </div>
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
                            @this.set('temario', editor.getData());
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
</div>
