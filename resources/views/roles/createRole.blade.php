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

<h1 class="text-center">Crear Rol</h1>
<section id="contact" class="contact">
<div class="container" data-aos="fade-up">
    <form action="{{route('rol.store')}}" class="php-email-form p-3 p-md-4" method="post">
        @csrf
        <div class="row">
                <div>
                <select class="form-control" name="user_id">
                @foreach ( $users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
                </select>
                </div>
                <button type="submit">Guardar</button>
        </div>
    </form>
</x-mi-layaout>
</div>
</section>