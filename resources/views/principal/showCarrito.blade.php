<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>L_palette</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

   <!-- Favicons -->
            
    <!--<link href="{{asset('build/assets/assets_palette/img/apple-touch-icon.png')}}" rel="apple-touch-icon">-->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('build/assets/assets_palette/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/assets_palette/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/assets_palette/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/assets_palette/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('build/assets/assets_palette/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('build/assets/assets_palette/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Jan 30 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="book-a-table" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{route('principal')}}" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>L_palette</h1>
      </a>

      <nav id="navbar" class="navbar cabeza">
        <ul>
        <li class="dropdown"><a href="#"><span>Mas</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              @foreach ( $nav_categoria as $nav )
                @if($nav->productos()->exists())
                  <li><a href="{{route('seleccion.Categoria', $nav)}}">{{ucfirst($nav->dato)}}</a></li>
                @endif
              @endforeach
            </ul>
          </li>
         @foreach ($categorias as $categoria)
            @if($categoria->productos()->exists())
              <li><a href="{{route('seleccion.Categoria', $categoria)}}">{{ucfirst($categoria->dato)}}</a></li>
            @endif
            @if ($loop->first)
                <li><a href="#varios">Varios</a></li>
            @endif
          @endforeach
          <li><a href="#contact">Contactame</a></li>
        </ul>
      </nav><!-- .navbar -->

      @if (auth()->check())
         <div class="dropdown">
              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{auth()->user()->name}}
              </button>
              <!-- Menú desplegable -->
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{route('show_carrito')}}">Carrito</a>
                  @auth
                      <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                        @can('rol', auth()->user())
                          <a class="dropdown-item" href="{{route('producto.index')}}">Gestionar</a>
                        @endcan
                  @endauth
                </div>
          </div>
        </div>
      @else
          <a class="btn-book-a-table" href="{{route('login')}}">Iniciar sesión</a>
      @endif
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div id="hero" class="breadcrumbs">
      <div class="container">
        <h2 data-aos="fade-up" class="text-center"><strong>Carrito</strong></h2>
        @foreach ($productoCarrito as $producto)
            <div class="d-flex justify-content-between align-items-center p-5 ">
                <div class="container">
                <div class="row justify-content-normal gy-5">
                        <hr class="border border-dark">
                        <div class="col-lg-5 order-2 order-lg-2 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                            <!--<h2 data-aos="fade-up">Productos en la categoria {{$categoria->dato}}</h2>-->               
                            <p data-aos="fade-up"><strong>{{$producto->nombre}}</strong></p>        
                            <p data-aos="fade-up">{{$producto->descripcion}}</p>
                            <p data-aos="fade-up"><strong>Cantidad:</strong>{{$producto->pivot->cantidad}}</p>
                            <div class="flex-row mt-4 parrafo_img">
                            <form  action="{{route('eliminar_carrito', $producto)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger "value="Eliminar">
                            </form>
                              <a href="{{route('editar_producto', $producto)}}">Modificar</a>
                            </div>
                        </div>
                        <div class="col-lg-5 order-1 order-lg-1 text-end">
                        <!--<img src="{{asset('storage/' . $producto->url)}}" class="img-fluid img_show" alt="imagen" data-aos="zoom-out" data-aos-delay="300">-->
                        <img src="{{$producto->url}}" class="img-fluid img_show w-60 h-60" alt="imagen" data-aos="zoom-out" data-aos-delay="300">
                        </div>
                </div>
                </div>
            </div>
        @endforeach
                <hr class="border border-dark">

      </div>
    </div><!-- End Breadcrumbs -->


  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{asset('build/assets/assets_palette/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('build/assets/assets_palette/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('build/assets/assets_palette/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('build/assets/assets_palette/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('build/assets/assets_palette/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <!--<script src="{{asset('build/assets/assets_palette/vendor/php-email-form/validate.js')}}"></script>-->

    <!-- Template Main JS File -->
    <script src="{{asset('build/assets/assets_palette/js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>