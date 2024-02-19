<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>categoria</th>
            <th>descripcion</th>
            <th>Imagen</th>
            <th>Opciones</th>
        </thead>
        <tbody>
            @foreach ( $productos as $producto )
                <tr>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->categoria}}</td>
                    <td>{{$producto->descripcion}}</td>
                    <td><img src="{{asset('storage/' . $producto->url)}}" alt="img"></td>
                        <td><a href="{{route('producto.show', $producto)}}">ver</a>
                        <a href="{{route('producto.edit', $producto)}}">editar</a>

                        <form action="{{route('producto.destroy', $producto)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>