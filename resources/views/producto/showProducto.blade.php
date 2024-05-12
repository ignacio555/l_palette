<x-mi-layout>

    <div id="hero" class="breadcrumbs m-5">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center p-5">
          <div class="container">
            <div class="row justify-content-between gy-5">
              <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
              <h2 data-aos="fade-up">Informacion del producto</h2>
                        <p data-aos="fade-up"><br>Nombre:{{$producto->nombre}}</p>
                        <p data-aos="fade-up">Precio:{{$producto->precio}}</p>
                        <p data-aos="fade-up">Categoria:{{$producto->categorias->first()->dato}}</p>
                        <p data-aos="fade-up">Descripcion:{{$producto->descripcion}}</p>
                        <p data-aos="fade-up">Fecha de creacion:{{$producto->created_at}}</p>
              </div>
              <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
                <img src="{{asset('storage/' . $producto->url)}}" class="img-fluid img_show" alt="imagen" data-aos="zoom-out" data-aos-delay="300">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->
</x-mi-layout>