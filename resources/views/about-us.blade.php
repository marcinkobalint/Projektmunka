<!doctype html>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rólunk</title>
    <!--Bootstrap href-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--Bootstrap icon href-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="{{ asset('css/about-us.css') }}" rel="stylesheet">
  </head>
  <body>
    <i class="bi bi-mortarboard-fill"></i>
    <h2>Széchenyi Tanár Kereső</h2>
    <div class="txt-field">
      <i class="bi bi-book-half"></i>
      <form action="{{ route('about-us') }}" method="GET">
        <h4>Készítette:</h4>
        <p>
            Fazekas Laura<br>
            Szöllősi Tibor<br>
            Marcinkó Bálint<br>
            Milchram Dániel<br>
            Berecz Péter<br>
        </p><br>
        <a href="{{route('main-screen')}}">Vissza a tanárokhoz</a><br>
      </form>
    </div>
  </body>
</html>