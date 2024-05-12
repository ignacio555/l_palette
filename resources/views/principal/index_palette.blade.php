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
          <!--<a class=" dropdown btn-book-a-table" href="{{route('show_carrito')}}">Carrito</a>
          @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-book-a-table border-0" type="submit">Logout</button>
            </form>
            @can('rol', auth()->user())
              <a class="btn-book-a-table" href="{{route('producto.index')}}">Gestionar</a>
            @endcan
          @endauth-->
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

        <div class="d-flex justify-content-between align-items-center">
          <div class="container">
            <div class="row justify-content-between gy-5">
              <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                <h2 data-aos="fade-up">Calidad<br>Diseño Exclusivo y Personalizado</h2>
                <p data-aos="fade-up" data-aos-delay="100"> <br> Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
              </div>
              <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
                <img src="{{asset('build/assets/assets_palette/img_L_palette/L_palette.jpg')}}" class="img-fluid zoom" alt="" data-aos="zoom-out" data-aos-delay="300">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

  @foreach ($categorias as $categoria)
    @if ($categoria->productos()->exists())
      <section class="sample-page">
        <div class="container" data-aos="fade-up">
          <section id="{{$categoria->dato}}" class="about">
              <div class="section-header">
                <h2 class="titulo">{{$categoria->dato}}</h2>
                <p>{{$categoria->dato}}</p>
              </div>
              <div class="display_flex">
                @foreach ($categoria->productos()->take(3)->get() as $producto)
                  
                    <a href="{{route('seleccion.Producto',$producto)}}">
                    <div class="contendor_img">
                      <img class="img_l zoom" src="{{asset('storage/' . $producto->url)}}" alt="collar_1">
                      <!--<img class="img_l zoom" src="{{$producto->url}}" alt="collar_1">-->
                      <p class="parrafo_img"><strong>{{$producto->nombre}}</strong></p>
                      <p>${{$producto->precio}}</p>
                    </div>
                    </a> 
                @endforeach
              </div>
    @endif 
        </section>

      @if($loop->first)
              <!-- ======= Events Section ======= -->
        <section id="varios" class="events">
          <div class="container-fluid" data-aos="fade-up">

            <div class="section-header">
              <h2>Variedad</h2>
              <p>Variedad de joyeria </p>
            </div>

            <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">

                <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img_L_palette/varios_1.jpg)">
                  <h3>Collar de cadena</h3>
                  <div class="price align-self-start">$99</div>
                  <p class="description">
                    Quo corporis voluptas ea ad. Consectetur inventore sapiente ipsum voluptas eos omnis facere. Enim facilis veritatis id est rem repudiandae nulla expedita quas.
                  </p>
                </div><!-- End Event item -->

                <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img_L_palette/varios_2.jpg)">
                  <h3>Collar de letras</h3>
                  <div class="price align-self-start">$289</div>
                  <p class="description">
                    In delectus sint qui et enim. Et ab repudiandae inventore quaerat doloribus. Facere nemo vero est ut dolores ea assumenda et. Delectus saepe accusamus aspernatur.
                  </p>
                </div><!-- End Event item -->

                <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(assets/img_L_palette/varios_3.jpg)">
                  <h3>Pulsera de osos</h3>
                  <div class="price align-self-start">$499</div>
                  <p class="description">
                    Laborum aperiam atque omnis minus omnis est qui assumenda quos. Quis id sit quibusdam. Esse quisquam ducimus officia ipsum ut quibusdam maxime. Non enim perspiciatis.
                  </p>
                </div><!-- End Event item -->

              </div>
              <div class="swiper-pagination"></div>
            </div>

          </div>
        </section><!-- End Events Section -->
      @endif
  @endforeach

  </main><!-- End #main -->

  <section>
    <div  id="contact" class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Contact</h2>
        <p>Nuestro local</p>
      </div>

      <div class="mb-3">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7467.430445139846!2d-103.3129914!3d20.6404614!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b24b7ad44099%3A0xc9b8aa9671c18f2a!2sCalle%20Independencia%20248%2C%20Centro%2C%2045500%20San%20Pedro%20Tlaquepaque%2C%20Jal.!5e0!3m2!1ses-419!2smx!4v1707016237557!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Google Maps -->
    </div>
  </section>

  <!-- ======= Footer ======= -->
  <footer class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022 - US<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Reservations</h4>
            <p>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat: 11AM</strong> - 23PM<br>
              Sunday: Closed
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Yummy</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('build/assets/assets_palette/js/main.js')}}"></script>

</body>

</html>