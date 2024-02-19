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

    <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nombre" id="nombre" placeholder="nombre de imagen" value="{{old('nombre')}}" required>
        <input type="text" name="categoria" placeholder="categoria" value="{{old('categoria')}}" required>
        <textarea name="descripcion" id="descripcion" required> {{old('descripcion')}}</textarea>
        <input type="file" name="imagen" required>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>