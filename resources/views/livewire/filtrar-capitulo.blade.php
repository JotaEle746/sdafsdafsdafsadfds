<div>
    <select class="custom-select w-full px-3 py-2 bg-gray-50 border border-gray-300 text-center" name="search" id="search" onChange="update()">
        <option selected>--Seleccione--</option>
        @foreach ($capitulos as $item)
        <option value="{{$item->id}}">{{$item->nombre}}</option>
        @endforeach
    </select>
    @push('js')
        <script>
            function update() {
				var select = document.getElementById('search');
				var option = select.options[select.selectedIndex];
				Livewire.emitTo('users.show-cursos', 'search', option.value);
			}
			update();
            /* const dni = document.querySelector('#dni').value;
            Livewire.emitTo('users.show-cursos', 'dni', dni); */
            /* Livewire.on('deleteCurso'{
                dni.oninput = function () {
                var ver = dni.value;
                Livewire.emitTo('users.show-cursos', 'dni', ver);
                };
            }) */
        </script>
    @endpush
</div>
