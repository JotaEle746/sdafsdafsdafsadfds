<x-guest-layout>
    <div class="container md:flex mx-auto px-5 sm:px-0 w-full py-6 item-center">
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    {{-- @livewire('show-posts',['title'=>'Este esun un titulo']) --}}
                    {{-- @livewire('show-cursos') --}}
                    <div class="w-full">
                        <div class="border bg-gray-400 px-4 py-2 text-center">VALIDAR CERTIFICADO</div>
                        <div class="w-full px-8 py-2">
                            <div class="p-2">
                                <x-jet-input type="text" class="w-full px-3 py-2 bg-gray-50 border border-gray-300" placeholder="Ingrese el codigo" id="codigo"/>
                            </div>
                            <div class="p-2 text-center w-full">
                                <x-jet-button class="w-full p-2" onclick="add();">
                                    Buscar
                                </x-jet-button>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-xl rounded-lg mt-4">
                    <div>
                        <div class="border bg-gray-400 px-4 py-2 text-center">MENU PRINCIPAL</div>
                        <div>
                            <div id="myID" class="text-gray-900 rounded-b-lg bg-white">
                                <button type="" id="estado" value="0" class="btn bg-gray-300 relative items-center py-2 w-full text-sm font-medium border-b hover:bg-gray-300 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                    Todos
                                </button>
                                <button type="" id="estado" value="1" class="btn relative items-center py-2 w-full text-sm border-b font-medium hover:bg-gray-300 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:text-white">
                                    En espera
                                </button>
                                <button type="" id="estado" value="2" class="btn relative items-center py-2 w-full text-sm font-medium border-b hover:bg-gray-300 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 {{-- dark:border-gray-600 --}} dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                    En proceso
                                </button>
                                <button type="" id="estado" value="3" class="btn relative items-center py-2 w-full text-sm font-medium rounded-b-lg hover:bg-gray-300 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                    Finalizado
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-xl rounded-lg mt-4">
                    <div class="w-full">
                        <div class="border bg-gray-400 px-4 py-2 text-center">FILTRAR POR CAPITULO</div>
                    </div>
                    <div>
                        @livewire('filtrar-capitulo')
                    </div>
                </div>
            </div>
        </div>
        
        <div class="py-8 flex-1">
            @livewire('users.show-cursos')
        </div>
    </div>
    @push('js')
        <script>
            var header = document.getElementById("myID");
            var btns = header.getElementsByClassName("btn");
            for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("bg-gray-300");
                current[0].className = current[0].className.replace(" bg-gray-300", "");
                this.className += " bg-gray-300";
            });
            }
        </script>
        <script>
            const estado = document.querySelectorAll("#estado");
            const cuandoSeHaceClick = function (evento) {
                var ver = this.value;
                Livewire.emitTo('users.show-cursos', 'estado', ver);
            }
            estado.forEach(boton => {
                boton.addEventListener("click", cuandoSeHaceClick);
            });
        </script>
        <script>
            var codigo = document.getElementById("codigo");
            function add()
            {
                var ver = codigo.value;
                Livewire.emitTo('users.show-cursos', 'codigo', ver);
            }
            /* function add()
            {
                codigo.oninput = function () {
                    var ver = codigo.value;
                    Livewire.emitTo('users.show-cursos', 'dni', ver);
                    alert('funca');
                }
            } */
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
</x-guest-layout>