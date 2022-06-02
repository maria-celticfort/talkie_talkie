<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Talkie Talkie</title>

  <!--Calls Bootstrap -->
  <link rel="stylesheet" href="/../css/app.css">

  <!--Fonts -->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />

  <!--jquery-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body class="background-color">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container px-5">
      <a class="navbar-brand" href="{{route('index')}}">Talkie Talkie</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          @if (!Session::has('id'))
          <li class="nav-item"><a class="nav-link" href="{{route('user.index')}}">Inicia sesión</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('user.create')}}">Regístrate</a></li>
          @else
          <li class="nav-item"><a class="nav-link" href="{{route('user.show_profile')}}">Ver perfil</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('user.logout')}}">Cierra sesión</a></li>
          @endif
          <li class="nav-item"><a class="nav-link" href="#!">FAQs</a></li>
          <li class="nav-item"><a class="nav-link" href="#!">Sobre nosotros</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header and Body-->
  @yield('content')

  <!-- Footer-->
  <footer class="py-5 bg-black">
    <div class="container">
      <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
        <div class="col">
          <div class="text-center">
            <a class="link-custom text-center" href="https://creativecommons.org/licenses/by-nc-nd/4.0/">Inicio</a>
          </div>
        </div>
        <div class="col">
          <div class="text-center">
            <a class="link-custom text-center" href="https://creativecommons.org/licenses/by-nc-nd/4.0/">Regístrate</a>
          </div>
        </div>
        <div class="col">
          <div class="text-center">
            <a class="link-custom text-center" href="https://creativecommons.org/licenses/by-nc-nd/4.0/">FAQs</a>
          </div>
        </div>
        <div class="col">
          <div class="text-center">
            <a class="link-custom text-center" href="https://creativecommons.org/licenses/by-nc-nd/4.0/">Sobre nosotros</a>
          </div>
        </div>
        <div class="col">
          <div class="text-center">
            <a class="link-custom text-center" href="https://creativecommons.org/licenses/by-nc-nd/4.0/">Creative commons</a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>