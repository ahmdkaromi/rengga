<?php
  session_start();
  if( !isset($_SESSION["login"])){
      header("Location:/rengga/login.php");
      exit;
  }

  include "koneksi.php";
  $username = $_SESSION['login'];

  $stmt1 = mysqli_prepare($koneksi, "select * from data_user where username=?");
  mysqli_stmt_bind_param($stmt1, 's', $username);
  mysqli_stmt_execute($stmt1);
  $user = mysqli_fetch_array(mysqli_stmt_get_result($stmt1));

  $stmt2 = mysqli_prepare($koneksi, "select * from data_toko where username=?");
  mysqli_stmt_bind_param($stmt2, 's', $username);
  mysqli_stmt_execute($stmt2);
  $toko = mysqli_fetch_array(mysqli_stmt_get_result($stmt2));
//   if(empty($toko)){
//       $toko['foto_toko'] = 'Frame 23.png';
//   }

//   $stmt3 = mysqli_prepare($koneksi, "select * from data_layanan where id_toko=?");
//   mysqli_stmt_bind_param($stmt3, 'i', $toko['id_toko']);
//   mysqli_stmt_execute($stmt3);
//   $layanan = mysqli_fetch_array(mysqli_stmt_get_result($stmt3));
//   if(empty($layanan)){
//       $layanan['foto_layanan'] = 'Frame 23.png';
//   }
//    $id_toko = $toko['id_toko'];
   $query = mysqli_query($koneksi, "select * from data_layanan where jenis_layanan='jokitugas'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Band</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/style.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
        <a class="navbar-brand" href="index-login.html"><img src="css/assets/logo.png" alt="logo" /></a>
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
                <img class="navbar_photo" src="photos/profile_photo/<?php echo $user['foto']; ?>" alt="profile" />
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


    <!-- Detail Layanan -->
    <div class="container-fluid detail">
        <div class="container detail-layanan">
            <div class="judul">
                <h4>Layanan Jasa > > <b>Joki Tugas</b></h4>
                <img src="CSS/assets/Line 1.svg" alt="line">
            </div>
            <div class="layanan">
                <?php foreach($query as $layanan) { ?>
                    <a href="<?= "detail_layanan.php?id_layanan=".$layanan['id_layanan']; ?>" class="text-decoration-none text-reset">
                        <div class="card mb-4" style="max-width: 800px;">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <img src="photos/layanan_photo/<?php echo $layanan['foto_layanan'] ?>" class="img-fluid rounded-start gambar_layanan" alt="mc1" style="width:400px; height:230px">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title"><label for=""><?= $layanan['nama_layanan'] ?></label></h5>
                                        <p class="card-text"><small class="text-muted"><i class="bi bi-geo-alt-fill"> 2
                                                    km</i> | <i class="bi bi-star-fill"> </i> <i
                                                    class="bi bi-star-fill"></i>
                                                </i> <i class="bi bi-star-fill"> </i> <i class="bi bi-star-fill"> </i>
                                            </small></p>
                                        <p class="card-text"><?= $layanan['deskripsi_layanan'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>    
                <?php } ?>
            </div>
        </div>
    </div>


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
                            <li><a href="detail-cleaning-service.html">Cleaning Service</a></li>
                            <li><a href="detail-barbershop.html">Barber Shop</a></li>
                            <li><a href="detail-shoecleaning.html">Shoe Cleaning</a></li>
                            <li><a href="detail-massage.html">Massage</a></li>
                            <li><a href="detail-jokitugas.html">Joki Tugas</a></li>
                            <li><a href="layanan-login.html">Others</a></li>
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