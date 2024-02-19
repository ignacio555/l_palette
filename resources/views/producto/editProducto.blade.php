<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('producto.update', $producto) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="text" name="nombre" id="nombre" placeholder="nombre de imagen" value="{{old('nombre') ?? $producto->nombre}}" required>
        <input type="text" name="categoria" placeholder="categoria" value="{{old('categoria') ?? $producto->categoria}}" required>
        <textarea name="descripcion" id="descripcion" required> {{old('descripcion') ?? $producto->descripcion}}</textarea>
        <input type="file" name="imagen">
        <label for="imagen">Si no desea cambiar la imagen no agrege nada:</label>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>