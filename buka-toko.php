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
  if(empty($toko)){
      $toko['foto_toko'] = 'Frame 23.png';
  }else{
      header("Location:/rengga/buka-toko-selesai.php");
  }

  if(isset($_POST['nama_toko'])){
    $nama_toko = $_POST['nama_toko'];
    $email_toko = $_POST['email_toko'];
    $handphone_toko = $_POST['handphone_toko'];
    $kecamatan = $_POST['kecamatan'];
    $kode_pos = $_POST['kode_pos'];
    $detail_alamat = $_POST['detail_alamat'];
    $deskripsi_toko = $_POST['deskripsi_toko'];

    $stmt = mysqli_prepare($koneksi, "insert into data_toko (username, nama_toko, email_toko, handphone_toko, kecamatan, kode_pos, detail_alamat, deskripsi_toko) values (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sssssiss', $username, $nama_toko, $email_toko, $handphone_toko, $kecamatan, $kode_pos, $detail_alamat, $deskripsi_toko);
    mysqli_stmt_execute($stmt);
    mysqli_close($koneksi);
    header("Location:/rengga/buka-toko.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buka Toko Rengga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/cc0302340a.js" crossorigin="anonymous"></script>
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

<!-- Awal Main Content -->
    <section id="konten-buka-toko">
        <div class="container buktok">
            <h5><b>Hello, <?php echo $username ?>!</b> Ayo isi detail lapakmu!</h4><br>
            <div class="isi-konten">
                <section id ="isinya">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="file-field">
                                <div class="z-depth-1-half mb-4">
                                    <center><img src="photos/toko_photo/<?php echo $toko['foto_toko'] ?>" class="img-fluid" alt="example placeholder"></center>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <form action="aksi-upload-foto-toko.php" method="POST" enctype="multipart/form-data" class="row g-3">
                                        <div class="col-auto">
                                            <div class="mb-3">
                                                <label for="formFileSm" class="form-label">Masukkan Foto</label>
                                                <input class="form-control form-control-sm" id="formFileSm" name="foto_toko" type="file">
                                                <button type="submit" class="btn btn-dark btn-sm mt-2"><i class="fas fa-upload"></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-7 offset-md-1">
                            <form action="buka-toko.php" method="POST">
                                <h4><b>Nama Toko</b></h4><br>
                                <input type="text" id="namatoko" placeholder="Nama Toko" name="nama_toko"  class="form-control" autocomplete="off" required><br>
                                <input type="email" id="email" placeholder="E-Mail" name="email_toko"  class="form-control" autocomplete="off" required><br>
                                <input type="tel" id="nomortelepon" placeholder="Nomor Telepon" name="handphone_toko"  class="form-control" autocomplete="off" required><br>   
                                <h4><b>Alamat Toko</b></h4><br>
                                <select class="form-select" name="kecamatan" aria-label="Default select example" required>
                                    <option selected>Kota atau Kecamatan</option>
                                    <option value="bobotsari">Bobotsari</option>
                                    <option value="bojongsari">Bojongsari</option>
                                    <option value="bukateja">Bukateja</option>
                                    <option value="kaligondang">Kaligondang</option>
                                    <option value="kalimanah">Kalimanah</option>
                                    <option value="karanganyar">Karanganyar</option>
                                    <option value="karangjambu">Karangjambu</option>
                                    <option value="karangmoncol">karangmoncol</option>
                                    <option value="karangreja">Karangreja</option>
                                    <option value="kejobong">Kejobong</option>
                                    <option value="kemangkon">Kemangkon</option>
                                    <option value="kertanegara">Kertanegara</option>
                                    <option value="kutasari">Kutasari</option>
                                    <option value="mrebet">Mrebet</option>
                                    <option value="padamara">Padamara</option>
                                    <option value="pengadegan">Pengadegan</option>
                                    <option value="purbalingga">Purbalingga</option>
                                    <option value="rembang">Rembang</option>
                                </select><br>
                                <input type="text" id="kodepos" placeholder="Kode Pos" name="kode_pos"  class="form-control"><br>
                                <textarea id="detailalamat" name="detail_alamat" placeholder="Detail Alamat" class="form-control" rows="5" autocomplete="off" required></textarea> <br>
                                <h4><b>Deskripsi Toko</b></h4><br>
                                <textarea id="deskripsitoko" name="deskripsi_toko" placeholder="Masukkan Deskripsi atau informasi mengenai toko"class="form-control" rows="5" cols="50" autocomplete="off" required></textarea>
                                <br>
                                <section id="tombol">
                                    <center><button type="submit" name="buat_toko" class="btn btn-warning mb-3"><b>Buat Toko</b></button></center>
                                </section>
                            </form>
                        </div>
                    </div>
                </section>
                </form>
            </div>
            </div>
        </div>
    </section>

<!-- Akhir Main Content-->


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