<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Grhatama Pustaka - Home</title>
</head>

<body>
  <!-- nav section start -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <div class="row d-flex align-items-center">
        <div class="col">
          <img src="https://balaiyanpus.jogjaprov.go.id/images/logo.png" alt="" height="75">
        </div>
        <div class="col">
          <div class="row">
            <a class="navbar-brand" href="/">
              <h2>Statistik Pengunjung</h2>
            </a>
          </div>
          <div class="row">
            <a class="navbar-brand" href="/">
              <h5>Grhatama Pustaka Yogyakarta</h5>
            </a>
          </div>
        </div>
        <div class="col">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
      <div class="col-7">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/statistik_perpustakaan/index.php">
                <h4>Home</h4>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/statistik_perpustakaan/input.php">
                <h4>Input Data</h4>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/statistik_perpustakaan/list.php">
                <h4>List Data</h4>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/statistik_perpustakaan/logout.php">
                <h4>Logout</h4>
              </a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <!-- nav section end -->

  <!-- FIRST LAYOUT start-->
  <div class="container-fluid bg-dark text-light">
    <div class="row text-center align-items-center" style="height: 100vh;">
      <!-- Carousel Images Start -->
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active"">
                <img src=" assets/balai1.jpeg" class="d-block w-100" alt="..." style="height: 700px; object-fit:fill;">
          </div>
          <div class="carousel-item">
            <img src="assets/balai2.jpg" class="d-block w-100" alt="..." style="height: 700px; object-fit:fill;">
          </div>
          <div class="carousel-item">
            <img src="assets/balai3.jpg" class="d-block w-100" alt="..." style="height: 700px; object-fit:fill;">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- carousel images end -->
      <div class="row text-center align-items-center mt-4">
        <div class="col-12">
          <h1>Welcome to Grhatama Pustaka!</h1>
        </div>
      </div>

      <!-- Card start -->
      <div class="row mt-2 mb-4">
        <div class="col-sm-4 g-3">
          <div class="card">
            <div class="card-body text-dark">
              <h5 class="card-title text-center">This is Title</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-dark d-block">Go somewhere</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 g-3">
          <div class="card">
            <div class="card-body text-dark">
              <h5 class="card-title text-center">This is Title</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-dark d-block">Go somewhere</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 g-3">
          <div class="card">
            <div class="card-body text-dark">
              <h5 class="card-title text-center">This is Title</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-dark d-block">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Card end -->

    </div>
    <!-- FIRST LAYOUT END -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
</body>

</html>