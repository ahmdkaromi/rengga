<?php
    session_start();
    if( !isset($_SESSION["login"])){
        header("Location:/rengga/login.php");
        exit;
    }

    include "koneksi.php";
    $username = $_SESSION['login'];
  
    $stmt = mysqli_prepare($koneksi, "select * from data_user where username=?");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_fetch_array(mysqli_stmt_get_result($stmt));
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="index-login.php"><img src="css/assets/logo.png" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link a active" aria-current="page" href="index-login.php">Home</a>
            <a class="nav-link a" href="layanan-login.php">Layanan Jasa</a>
            <a class="nav-link a" href="pusat-bantuan-login.html">Bantuan</a>
            <form class="nav-link d-flex input-group" role="search">
              <span class="input-group-text" id="basic-addon1"
                ><button type="submit" style="border: none"><i class="bi bi-search"></i></button
              ></span>
              <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" />
            </form>
            <span class="nav-link login"><?php echo $_SESSION["login"]; ?></span>
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="navbar_photo" src="photos/profile_photo/<?php echo $hasil['foto']; ?>" alt="profile" />
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="profile_user.php">Setting</a></li>
                <li><a class="dropdown-item" href="myorder.php">Pesanan Saya</a></li>
                <li><a class="dropdown-item" href="buka-toko.php">Buka Toko</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="logout.php">Log out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Hero -->
    <section class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row herosection">
                <div class="col">
                    <h1 class="display-4">Find All of Your Needs Right Here.</h1>
                    <p class="lead">We knows all your wants, We knows all your needs, You can have anything, everything
                        you need
                        is right here.</p>
                    <a href="layanan-login.php"><button type="submit" class="btn btn-primary btn-lg">Order
                            Now</button></a>
                </div>

                <div class="col">
                    <img src="CSS/assets/hero.png" alt="hero">
                </div>
            </div>

        </div>
    </section>
    <!-- Akhir Hero -->

    <section class="container-fluid">
        <!-- Container -->
        <div class="container menu">
            <!-- Awal Menu -->
            <div class="judul">
                <h4>Apa yang bisa kami lakukan untuk Anda ?</h4>
                <img src="CSS/assets/Line 1.svg" alt="line">
            </div>
            <div class="submenu">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/clean.svg" alt="cleaning" class="card-title">
                                <p class="card-text">Cleaning Service</p>
                                <a href="detail-cleaning-service.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/barber.svg" alt="barber" class="card-title">
                                <p class="card-text">Barber Shop</p>
                                <a href="detail-barbershop.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/shoe.svg" alt="shoe" class="card-title">
                                <p class="card-text">Shoe Cleaning</p>
                                <a href="detail-shoecleaning.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/massage.svg" alt="massage" class="card-title">
                                <p class="card-text">Massage</p>
                                <a href="detail-massage.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/technic.svg" alt="technic" class="card-title">
                                <p class="card-text">Technician</p>
                                <a href="detail-technician.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/tutor.svg" alt="tutor" class="card-title">
                                <p class="card-text">Les Private</p>
                                <a href="detail-lesprivate.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/tugas.svg" alt="tugas" class="card-title">
                                <p class="card-text">Joki Tugas</p>
                                <a href="detail-jokitugas.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/makeup.svg" alt="massage" class="card-title">
                                <p class="card-text">Make Up Artist</p>
                                <a href="detail-mua.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/band.svg" alt="dress" class="card-title">
                                <p class="card-text">Band</p>
                                <a href="detail-band.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box">
                            <div class="card-body">
                                <img src="CSS/assets/mc.svg" alt="MC" class="card-title">
                                <p class="card-text">Master Of Ceremony </p>
                                <a href="detail-mc.php" class="btn btn-primary" id="buttonPesanLayanan">Pesan Layanan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card box order">
                            <div class="card-body">
                                <img src="CSS/assets/order.svg" alt="order" class="card-title">
                                <p class="card-text">My Orders</p>
                                <a href="myorder.html" class="btn btn-primary" id="buttonLihatPesanan">Lihat Pesanan</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Akhir Menu -->
        </div>
        <!-- Tutup Container -->
    </section>

    <!-- Awal Footer -->
    <footer>
        <div class="container-fluid footer">
            <div class="container footer1">
                <div class="row footer2">
                    <div class="col-sm-6">
                        <img src="CSS/assets/footer-logo.png" alt="logo">
                        <p>Sebagai pelayanan jasa online terbagus dan terpercaya, Rengga menawarkan berbagai pilihan
                            jasa yang
                            berkualitas dengan tersedianya oleh lebih dari 100.000 mitra usaha, mulai dari layanan jasa
                            primer, jasa
                            sekunder, jasa untuk kebutuhan sehari-hari hingga layasan jasa untuk keperluan gaya hidup.
                        </p>
                        <img src="CSS/assets/line3.svg  " alt="line">

                    </div>
                    <div class="col-sm-2">
                        <h4>LAYANAN</h4>
                        <ul>
                            <li><a href="detail-cleaning-service.php">Cleaning Service</a></li>
                            <li><a href="detail-barbershop.php">Barber Shop</a></li>
                            <li><a href="detail-shoecleaning.php">Shoe Cleaning</a></li>
                            <li><a href="detail-massage.php">Massage</a></li>
                            <li><a href="detail-jokitugas.php">Joki Tugas</a></li>
                            <li><a href="layanan-login.php">Others</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-2">
                        <h4>INFO</h4>
                        <ul>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Career</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="pusat-bantuan-login.html">Help</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-2">
                        <h4>CONTACT</h4>
                        <ul>
                            <li>Feel free to contact us by either email or phone.</li>
                            <li><a href="#">+62 899 321-980</a></li>
                            <li><a href="#">renggakaromi@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row footer3">
                    <div class="col-sm-6">
                        <h5>Ikuti Kami</h5>
                        <ul>
                            <li><a href="#"><img src="CSS/assets/fb.svg" alt="fb"></a></li>
                            <li><a href="#"><img src="CSS/assets/instagram.svg" alt="fb"></a></li>
                            <li><a href="#"><img src="CSS/assets/twitter.svg" alt="fb"></a></li>
                            <li><a href="#"><img src="CSS/assets/google.svg" alt="fb"></a></li>
                        </ul>
                        <p>Rengga 2022. Hak Cipta Dilindungi
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <a href="#">
                            <h4>PRIVACY POLICY</h4>
                        </a>

                    </div>
                    <div class="col-sm-3">
                        <a href="#">
                            <h4>TERMS AND CONDITION</h4>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <!-- Akhir Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>