<x-mi-layout>
<h1>Crear Categoria</h1>
<form action="{{route('categoria.store')}}" method="post">
    @csrf
    <input type="text" name="dato" placeholder="Categoria" value="{{old('categoria') ?? $categoria->dato}}" required>
    <button type="submit">Guardar</button>
</form>
</x-mi-layaout>