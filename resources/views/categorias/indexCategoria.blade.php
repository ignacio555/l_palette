<x-mi-layout>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <table>
        <thead>
            <th>Categoria</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria )
                <tr>
                    <td>{{$categoria->dato}}</td>
                    <td>
                        <a href="{{route('categoria.edit', $categoria)}}">Editar</a>
                        <form method="POST" action="{{route('categoria.destroy', $categoria)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-mi-layaout>