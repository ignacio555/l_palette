<x-mi-layout>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
@endif

<h1 class="text-center">Crear Categoria</h1>
<section id="contact" class="contact">
<div class="container" data-aos="fade-up">
    <form action="{{route('categoria.store')}}" class="php-email-form p-3 p-md-4" method="post">
        @csrf
        <div class="row">
            <input type="text" name="dato" class="form-control mb-5" placeholder="Categoria" value="{{old('categoria')}}" required>
            <button type="submit">Guardar</button>
        </div>
    </form>
</x-mi-layaout>
</div>
</section>