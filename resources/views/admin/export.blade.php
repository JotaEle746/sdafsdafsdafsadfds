<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>A.Paterno</th>
        <th>A.Materno</th>
        <th>Telefono</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($use as $user)
        <tr>
            <td>{{ $user->nombres }}</td>
            <td>{{ $user->paterno }}</td>
            <td>{{ $user->materno }}</td>
            <td>{{ $user->telefono }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    @endforeach
    @foreach($person as $user)
        <tr>
            <td>{{ $user->nombres }}</td>
            <td>{{ $user->paterno }}</td>
            <td>{{ $user->materno }}</td>
            <td>{{ $user->telefono }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>