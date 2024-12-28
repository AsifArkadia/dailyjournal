<?php
include "koneksi.php"; 
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Javascript</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        color: #000000;
        transition: background-color 0.3s, color 0.3s;
    }

    .dark-mode {
        background-color: #121212;
        color: #ffffff;
    }

    .button {
        padding: 10px 20px;
        margin: 10px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }

    .light-button {
        background-color: #f1f1f1;
        color: #333;
    }
    
    .dark-button {
        background-color: #333;
        color: #f1f1f1;
    }
</style>

    <!-- nav begin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
          <a class="navbar-brand" href="#">Ticketing Online</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">

              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#article">Article</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#gallery">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#schedule">Schedule</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#aboutme">About Me</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php" target="_blank">Login</a>
              </li>
              
              <!-- mode terang -->
              <button class="button light-button" onclick="setLightMode()"><i class="bi bi-sun-fill"></i></i></button>
    
              <!-- mode gelap -->
              <button class="button dark-button" onclick="setDarkMode()"><i class="bi bi-moon-fill"></i></button>
            </ul>
          </div>
        </div>
      </nav>
    <!-- nav end -->
    <!-- hero begin -->
    <section id="hero" class="text-center p-5 bg-secondary text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="img/bannerr.jpg" class="img-fluid" width="300">
          <div>
            <h1 class="fw-bold display-4">Pembelian Tiket Bus Malam Secara Online</h1>
            <h4 class="lead display-6">Temukan kemudahan dalam memesan tiket bus malam dengan platform kami. Dengan berbagai pilihan rute, jadwal fleksibel, dan harga terjangkau, perjalanan Anda menjadi lebih praktis dan nyaman. Kami berkomitmen untuk menghadirkan pengalaman pemesanan yang aman dan cepat, langsung dari genggaman Anda. #TiketBusMalam #JelajahTanpaBatas #PerjalananNyaman</h4>
            <h6>
              <span id="tanggal"></span>
              <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <!-- hero end -->
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
    <!-- gallery begin -->
    <section id="gallery" class="text-center p-5 bg-secondary">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Gallery</h1>
            <div id="carouselExample" class="carousel slide">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="img/DoubleDeck.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="img/Single.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="img/Slepeer.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="img/Medium.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="img/Elf.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
        </div>
    </section>
    <!-- gallery end -->
    <!-- schedule begin -->
    <section id="schedule" class="text-center p-5">
      <div class="container">
          <h1 class="fw-bold display-4 pb-3">Schedule</h1>
          <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <div class="col">
              <div class="card h-100">
                <div class="card-header">
                  Senin
                </div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Basis Data <br>10.20-12.00 | D.3.M</li>
                  <li class="list-group-item">Sistem Operasi <br>12.30-15.00 | H.4.9</li>
                </ul>
              </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-header">
                  Selasa
                </div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Pemrograman Berbasis Web <br>10.20-12.00 | D.2.J</li>
                  <li class="list-group-item">Sistem Infromasi <br>12.30-15.00 | H.5.13</li>
                  <li class="list-group-item">Pendidikan Kewarganegaraan <br>18.30-20.10 | H.5.13</li>
                </ul>
              </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-header">
                  Rabu
                </div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Probabilitas Dan Statistik <br>07.00-09.30 | H.4.9</li>
                  <li class="list-group-item">Logika Informatika <br>12.30-15.00 | H.4.10</li>
                </ul>
              </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-header">
                  Kamis
                </div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Basis Data <br>08.40-10.20 | H.4.6</li>
                  <li class="list-group-item">Rekayasa Perangkat Lunak <br>12.30-15.00 | H.5.4</li>
                </ul>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-header">
                  Jumat
                </div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Free</li>
                </ul>
              </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="card-header">
                  Sabtu
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Free</li>
                  </ul>
                </div>
                </div>
            </div>
          </div>
      </div>
  </section>
  <!-- schedule end -->
   <!-- aboutme begin -->
   <section id="aboutme" class="text-center p-5 bg-secondary">
    <div class="container">
      <div class="d-sm-flex col-sm-reverse align-items-center">
        <div class="p-3">
          <img src="img/saya.jpeg" class="rounded-circle border shadow" width="300">
        </div> 
        <div class="p-md-5 text-sm-start">
          <h3 class="lead">A11.2023.15038</h3>
          <h1 class="fw-bold">Asif Maulida Arkadia</h1>
          Program Studi Teknik Informatika<br />
          <a href="https://dinus.ac.id/" class="fw-bold text-decoration-none text-dark"
            >Universitas Dian Nuswantoro</a>
        </div>
      </div>
    </div>
  </section>
  <!-- aboutme end -->
    <!-- footer begin -->
    <footer id="footer" class="text-center p-5">
      <div>
        <a href="https://www.instagram.com/arkalcoaa._1836?igsh=MWdpYW9ueWp3OXRjZA=="><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
        <a href="https://www.facebook.com/profile.php?id=100009594558888&mibextid=ZbWKwL"><i class="bi bi-facebook h2 p-2 text-dark"></i></a>
        <a href="https://wa.me/+6281391043725"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
      </div>
      <div>
        Asif Maulida Arkadia &copy; 2024
      </div>
    </footer>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
      window.setTimeout("tampilWaktu()", 1000);

      function tampilWaktu() {
        var waktu = new Date();
        var bulan = waktu.getMonth() + 1;

        setTimeout("tampilWaktu()", 1000);
        document.getElementById("tanggal").innerHTML =
        waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
        document.getElementById("jam").innerHTML =
        waktu.getHours() + ":" +
        waktu.getMinutes() + ":" +
        waktu.getSeconds();
      }
    </script>
    <script>
      function setLightMode() {
          document.body.classList.remove("dark-mode");
      }
      function setDarkMode() {
          document.body.classList.add("dark-mode");
      }
  </script>
</body>
</html>