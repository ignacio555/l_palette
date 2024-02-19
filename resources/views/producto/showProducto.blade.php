<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista del producto</title>
</head>
<h1>Informacion del producto</h1>
<body>
    <img src="{{asset('storage/' . $producto->url)}}" alt="imagen">
    <ul>
        <td>Nombre:{{$producto->nombre}}</td>
        <td>Categoria:{{$producto->categoria}}</td>
        <td>Descripcion:{{$producto->descripcion}}</td>
        <td>Fecha de creacion:{{$producto->created_at}}</td>
    </ul>
</body>
</html>