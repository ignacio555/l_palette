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

        <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
    <h2 class="text-center">Agregar producto</h2>
        <form action="{{ route('producto.store') }}" method="post" class="php-email-form p-3 p-md-4" role="form" enctype="multipart/form-data">
             @csrf
            <div class="row">
                <div class="col-xl-6 form-group">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre de imagen" value="{{old('nombre')}}" required>
                </div>
                <div class="col-xl-6 form-group">
                <input type="text" name="categoria" class="form-control" placeholder="categoria" value="{{old('categoria')}}" required>
                </div>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="imagen">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="descripcion" id="descripcion" required> {{old('descripcion')}}</textarea>
            </div>
            <div class="text-center"><button type="submit">Enviar</button></div>
            <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            </form><!--End Contact Form -->
    </div>
    </section>
</x-mi-layout>