<x-mi-layout>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <table class="contenedor_tabla text-center">
        <thead>
            <tr class="tabla_titulos">
                <th>Categoria</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria )
                <tr class="informacion">
                    <td>{{$categoria->dato}}</td>
                    <td>
                        <div class="row">
                            <a href="{{route('categoria.edit', $categoria)}}">Editar</a>
                            <a href="{{route('categoria.show', $categoria)}}">ver</a>
                        </div>
                        <form method="POST" action="{{route('categoria.destroy', $categoria)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-mi-layaout>