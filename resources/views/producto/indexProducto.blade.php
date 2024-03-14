<x-mi-layout>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <table class="contenedor_tabla text-center">
            <thead>
                <tr class="tabla_titulos">
                    <th>Nombre</th>
                    <th>categoria</th>
                    <th>descripcion</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $productos as $producto )
                    <tr class="informacion">
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->categoria}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td><img src="{{asset('storage/' . $producto->url)}}" class="img_index"alt="img"></td>
                        <td>
                            <div class="row">
                                <a class="boton_index btn btn-light mb-1" href="{{route('producto.show', $producto)}}">ver</a>
                                <a class="boton_index btn btn-light mb-1 " href="{{route('producto.edit', $producto)}}">editar</a>
                            </div>
                            <form  action="{{route('producto.destroy', $producto)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger "value="Eliminar">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</x-mi-layout>