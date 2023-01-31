<div class="pt-4">
  <h4>Cursos: {{ $curso->nombre }} </h4>
  <hr>
  <div x-data="{ activeTab: 'details' }">
      <ul class="flex flex-wrap gap-2">
        <li>
          <a x-on:click.prevent="activeTab = 'specs'" :class="{ 'button-active bg-gray-100 border': activeTab === 'specs' }" href="#specs" class="button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
            INSCRITOS
          </a>
        </li>
        <li>
          <a x-on:click.prevent="activeTab = 'reviews'" :class="{ 'button-active bg-gray-100 border': activeTab === 'reviews' }" href="#reviews" class="button bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
            MATRICULAR
          </a>
        </li>
      </ul>
    
      <div class="content">
        <div x-cloak x-show="activeTab === 'details'">
          {{-- ---------------------------------------- --}}
          <div class="card-body">
              Colegiados:
              <hr>
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
                            <td class="">{{ $colegiado->nombres }} {{$colegiado->paterno}} {{$colegiado->materno}}</td>
                            @if($colegiado->rol=="0")
                            <td class="text-center"><span class="badge bg-secondary p-2">Participante</span></td>
                            @else
                            <td class="text-center"><span class="badge bg-success p-2">Ponente</span></td>
                            @endif

                            <td>
                                <div class="row">
                                    <input wire:change="AsignarP({{$colegiado->id}})" type="checkbox" <?php if ($colegiado->rol == 1) { echo 'checked="checked"'; } ?> {{-- value="{{$colegiado->rol}}? : 1 : 0" --}} class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-400 focus:ring-2 dark:bg-gray-300 dark:border-gray-900">
                                    <label for="teal-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-700">Asignar Ponente</label>
                                    {{-- @if($colegiado->rol=="0")
                                    <div class="col d-flex justify-content-center">
                                        <form method="POST" action="{{ route('asignarponente',$curso->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="condicion" value="{{ $colegiado->rol }}">
                                            <input type="hidden" name="id_matricula" value="{{ $colegiado->id_matricula }}">
                                            <button class="btn bg-transparent border border-success">Asignar</button>
                                        </form>
                                    </div>
                                    @else
                                    <div class="col d-flex justify-content-center">
                                        <form method="POST" action="{{ route('asignarponente',$curso->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="condicion" value="{{ $colegiado->rol }}">
                                            <input type="hidden" name="id_matricula" value="{{ $colegiado->id_matricula }}">
                                            <button class="btn bg-transparent border border-success">Desasignar</button>
                                        </form>
                                    </div>
                                    @endif --}}
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
                                        <a wire:click="singin({{$colegiado->id}})">
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
                                    {{-- @if($persona->rol=="0")
                                    <div class="col d-flex justify-content-center">
                                        <form method="POST" action="{{ route('asignarponente',$curso->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="condicion" value="{{ $persona->rol }}">
                                            <input type="hidden" name="id_matricula" value="{{ $persona->id_matricula }}">
                                            <button class="btn bg-transparent border border-success">Asignar</button>
                                        </form>
                                    </div>
                                    @else
                                    <div class="col d-flex justify-content-center">
                                        <form method="POST" action="{{ route('asignarponente',$curso->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="condicion" value="{{ $persona->rol }}">
                                            <input type="hidden" name="id_matricula" value="{{ $persona->id_matricula }}">
                                            <button class="btn bg-transparent border border-success">Desasignar</button>
                                        </form>
                                    </div>
                                    @endif --}}
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
                                        <a wire:click="singin({{$persona->id}})">
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
                <div class="px-6 py-4">
                    <div class="flex">
                        <div id="pageNavPosition" class="pager-nav border rounded-md bg-gray-300 px-2"></div>
                      </div>
                </div>
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
          </div>
          {{-- ---------------------------------------- --}}
        </div>
        <div x-cloak x-show="activeTab === 'specs'">
          {{-- ---------------------------------------- --}}
          <div class="card-body">
              @livewire('admin.inscritos-curso', [$curso])
          </div>
          {{-- ---------------------------------------- --}}
        </div>
        <div x-cloak x-show="activeTab === 'reviews'">
          {{-- ---------------------------------------- --}}
          <div class="card-body">
              @livewire('admin.inscripcion-curso', [$curso])
          </div>
          {{-- ---------------------------------------- --}}
        </div>
      </div>
    </div>
</div>
</div>
</div>
<script>
  function Pager(tableName, itemsPerPage) {
      'use strict';
  
      this.tableName = tableName;
      this.itemsPerPage = itemsPerPage;
      this.currentPage = 1;
      this.pages = 0;
      this.inited = false;
  
      this.showRecords = function (from, to) {
          let rows = document.getElementById(tableName).rows;
          for (let i = 1; i < rows.length; i++) {
              if (i < from || i > to) {
                  rows[i].style.display = 'none';
              } else {
                  rows[i].style.display = '';
              }
          }
      };
  
      this.showPage = function (pageNumber) {
          if (!this.inited) {
              // Not initialized
              return;
          }
  
          let oldPageAnchor = document.getElementById('pg' + this.currentPage);
          oldPageAnchor.className = 'pg-normal';
          oldPageAnchor.className = 'px-2';
  
          this.currentPage = pageNumber;
          let newPageAnchor = document.getElementById('pg' + this.currentPage);
          newPageAnchor.className = 'pg-selected';
          newPageAnchor.className = 'bg-gray-500 px-2';
  
          let from = (pageNumber - 1) * itemsPerPage + 1;
          let to = from + itemsPerPage - 1;
          this.showRecords(from, to);
  
          let pgNext = document.querySelector('.pg-next'),
              pgPrev = document.querySelector('.pg-prev');
  
          if (this.currentPage == this.pages) {
              pgNext.style.display = 'none';
          } else {
              pgNext.style.display = '';
          }
  
          if (this.currentPage === 1) {
              pgPrev.style.display = 'none';
          } else {
              pgPrev.style.display = '';
          }
      };
  
      this.prev = function () {
          if (this.currentPage > 1) {
              this.showPage(this.currentPage - 1);
          }
      };
  
      this.next = function () {
          if (this.currentPage < this.pages) {
              this.showPage(this.currentPage + 1);
          }
      };
  
      this.init = function () {
          let rows = document.getElementById(tableName).rows;
          let records = (rows.length - 1);
  
          this.pages = Math.ceil(records / itemsPerPage);
          this.inited = true;
      };
  
      this.showPageNav = function (pagerName, positionId) {
          if (!this.inited) {
              // Not initialized
              return;
          }
  
          let element = document.getElementById(positionId),
              pagerHtml = '<span onclick="' + pagerName + '.prev();" class="bg-gray-300 px-2 boder">&#171;</span>';
  
          for (let page = 1; page <= this.pages; page++) {
              pagerHtml += '<span id="pg' + page + '" class="bg-gray-300 px-2 boder" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span>';
          }
  
          pagerHtml += '<span onclick="' + pagerName + '.next();" class="bg-gray-300 px-2 boder">&#187;</span>';
  
          element.innerHTML = pagerHtml;
      };
  }
  
  
  
  //
  let pager = new Pager('pager', 3);
  
  pager.init();
  pager.showPageNav('pager', 'pageNavPosition');
  pager.showPage(1);
    </script>