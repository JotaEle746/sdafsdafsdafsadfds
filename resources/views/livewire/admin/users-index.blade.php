<div>
    <div class="card">
        @livewire('admin.create-users')
        <div class="card-header">
            <input wire:model="search" type="text" class="form-control" placeholder="Ingrese el nombre o correo de un usuario">
        </div>
        @if ($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td width="10px"><a href="{{route('admin.users.edit', $item)}}" class="btn btn-primary">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="card-body">
                <strong>No Hay registros</strong>
            </div>
        @endif
        <div class="card-footer">
            {{$users->links()}}
        </div>
    </div>
</div>
