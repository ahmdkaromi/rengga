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

  if(!empty($_GET['id_layanan'])){
    $id_layanan = $_GET['id_layanan'];
  }

  $stmt2 = mysqli_prepare($koneksi, "select * from data_layanan where id_layanan=?");
  mysqli_stmt_bind_param($stmt2, 'i', $id_layanan);
  mysqli_stmt_execute($stmt2);
  $layanan = mysqli_fetch_array(mysqli_stmt_get_result($stmt2));

  $id_toko = $layanan['id_toko'];
  $query = mysqli_query($koneksi, "select * from data_toko where id_toko='$id_toko'");
  $toko = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>R E N G G A</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/style.css?v=<?= time(); ?>" />
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
              <a class="nav-link a" aria-current="page" href="index-login.php">Home</a>
              <a class="nav-link a active" href="layanan-login.php">Layanan Jasa</a>
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

    <section class="container-fluid">
      <!-- Container -->
      <div class="container page">
        <div class="carded">
          <div class="row">
            <div class="col-lg-5">
              <div id="carousel_jasa" class="carousel slide carousel-fade" data-bs-ride="true">
                <div class="carousel-controls">
                  <ol class="carousel-indicators">
                    <li data-bs-target="#carousel_jasa" data-bs-slide-to="0" class="indicatorBtn active" aria-current="true" aria-label="Slide 1"></li>
                    <li data-bs-target="#carousel_jasa" data-bs-slide-to="1" class="indicatorBtn" aria-label="Slide 2"></li>
                    <li data-bs-target="#carousel_jasa" data-bs-slide-to="2" class="indicatorBtn" aria-label="Slide 3"></li>
                  </ol>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="photos/layanan_photo/<?= $layanan['foto_layanan']; ?>" class="d-block w-100" alt="..." />
                  </div>
                  <div class="carousel-item">
                    <img src="photos/layanan_photo/<?= $layanan['foto_layanan'] ?>" class="d-block w-100" alt="..." />
                  </div>
                  <div class="carousel-item">
                    <img src="photos/layanan_photo/<?= $layanan['foto_layanan'] ?>" class="d-block w-100" alt="..." />
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_jasa" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel_jasa" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <div class="col-lg-7">
              <!-- top -->
              <section id="detail_top" class="container">
                <h4 class="harga">Rp<?= $layanan['harga_layanan']; ?></h4>
                <div class="d-flex small">
                  <div class="star_rating">
                    <span id="rating">3.9</span>
                    <span id="rating-star">
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                      <i class="fa-solid fa-star-half"></i>
                    </span>
                  </div>
                  <div>| <span id="penilaian">30 </span>Penilaian&nbsp;</div>
                  <div>| <span id="terpakai">69 </span>Terpakai</div>
                </div>
              </section>
              <!-- end top -->
              <!-- Product Details -->
              <section class="product_details container">
                <h1><?= $layanan['nama_layanan'] ?></h1>
                <h6>Deskripsi Layanan</h6>
                <p>
                  <?= $layanan['deskripsi_layanan']; ?>
                </p>
                  <!-- Kuantitas -->
                <form action="order-overview.php" method="POST">  
                <section class="d-flex align-items-center">
                  <div>Kuantitas</div>
                  <div class="kuantitas_input_container d-flex">
                    <input type="number" name="id_layanan" value="<?= $id_layanan ?>" hidden>
                    <button class="qty_btn d-flex justify-content-center align-items-center" id="decrement" type="button">-</button>
                    <input id="kuantitas" class="input_kuantitas" name="jumlah_order" type="number" min="0" value="1" />
                    <button class="qty_btn d-flex justify-content-center align-items-center" id="increment" type="button">+</button>
                  </div>
                  <div>Orang</div>
                </section>
                <!-- End of Kuantitas -->
              </section>
              <!-- End of Product Details -->
              
              <!-- buttons -->
              <section class="btn_container">
                <button type="submit" class="order_button">ORDER NOW</button>
                <a class="chat_button" href="#">CHAT</a>
              </section>
              </form>
              <!-- end of buttons -->
            </div>
          </div>
          <div class="row">
            <hr class="line" />
            <div class="col-lg-5">
              <h3 class="subjudul">&nbsp;Informasi Penyedia Jasa</h3>
            </div>
            <div class="col-lg-7 d-flex">
              <img class="gambar_penyediajasa" src="photos/toko_photo/<?= $toko['foto_toko']; ?>" alt="user" />
              <div>
                <h5><?= $toko['nama_toko']; ?></h5>
                <p><?= $toko['detail_alamat']; ?>, Kec. <?= $toko['kecamatan']; ?>, Kabupaten Purbalingga, Jawa Tengah <?= $toko['kode_pos']; ?></p>
              </div>
            </div>
          </div>
          <div class="row">
            <hr class="line" />
            <div class="col-lg-5">
              <h3 class="subjudul">&nbsp;Review Jasa</h3>
            </div>
            <div class="col-lg-7 d-flex">
              <div class="row">
                <div class="col-lg-auto d-flex flex-column flex">
                  <span class="rating_score">3.9<span class="rating_score_divider">/5</span></span>
                  <span class="rating_score_star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half"></i>
                  </span>
                  <div>30 Penilaian</div>
                </div>
                <div class="col-lg-auto d-flex align-items-center">
                  <div class="rating_lists">
                    <div class="rating_list">5<i class="fa-solid fa-star"></i></div>
                    <div class="rating_list">4<i class="fa-solid fa-star"></i></div>
                    <div class="rating_list">3<i class="fa-solid fa-star"></i></div>
                    <div class="rating_list">2<i class="fa-solid fa-star"></i></div>
                    <div class="rating_list">1<i class="fa-solid fa-star"></i></div>
                  </div>
                  <div>
                    <div class="rating_sum">20</div>
                    <div class="rating_sum">20</div>
                    <div class="rating_sum">20</div>
                    <div class="rating_sum">20</div>
                    <div class="rating_sum">20</div>
                  </div>
                </div>
                <hr class="lineSmall" />
                <div class="daftar_review">
                  <h4>Daftar Review</h4>
                  <div class="filter_star">
                    <button type="button" id="filter_semua" class="filter_button actived">Semua</button>
                    <button type="button" id="filter_1" class="filter_button">1<i class="fa-solid fa-star rev_star"></i></button>
                    <button type="button" id="filter_2" class="filter_button">2<i class="fa-solid fa-star rev_star"></i></button>
                    <button type="button" id="filter_3" class="filter_button">3<i class="fa-solid fa-star rev_star"></i></button>
                    <button type="button" id="filter_4" class="filter_button">4<i class="fa-solid fa-star rev_star"></i></button>
                    <button type="button" id="filter_5" class="filter_button">5<i class="fa-solid fa-star rev_star"></i></button>
                  </div>
                  <div class="bubble">
                    <div class="card_review">
                      <div class="bubble_star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <h5>Pelayanan cukup memuaskan!</h5>
                      <div class="bubble_review d-flex">
                        <img src="photos/profile_photo/kucingsopan.jpeg" alt="" />
                        <div class="bubble_review_text">
                          <strong>Mas Ahmad Karomi</strong>
                          <p>Not bad laaaa</p>
                          <small class="text-muted">09 Desember 2002</small>
                        </div>
                      </div>
                    </div>
                    <div class="card_review">
                      <div class="bubble_star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <h5>Pelayanan cukup memuaskan!</h5>
                      <div class="bubble_review d-flex">
                        <img src="photos/profile_photo/kucingsopan.jpeg" alt="" />
                        <div class="bubble_review_text">
                          <strong>Mas Ahmad Karomi</strong>
                          <p>Hidden gems purbalingga nih gaes!</p>
                          <small class="text-muted">09 Desember 2002</small>
                        </div>
                      </div>
                    </div>
                    <div class="card_review">
                      <div class="bubble_star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <h5>Pelayanan cukup memuaskan!</h5>
                      <div class="bubble_review d-flex">
                        <img src="photos/profile_photo/kucingsopan.jpeg" alt="" />
                        <div class="bubble_review_text">
                          <strong>Mas Ahmad Karomi</strong>
                          <p>Worth it</p>
                          <small class="text-muted">09 Desember 2002</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- Tutup Container -->
    </section>

    <!-- Awal Footer -->
    <footer>
      <div class="container-fluid footer">
        <div class="container footer1">
          <div class="row footer2">
            <div class="col-sm-6">
              <img src="CSS/assets/footer-logo.png" alt="logo" />
              <p>
                Sebagai pelayanan jasa online terbagus dan terpercaya, Rengga menawarkan berbagai pilihan jasa yang berkualitas dengan tersedianya oleh lebih dari 100.000 mitra usaha, mulai dari layanan jasa primer, jasa sekunder, jasa
                untuk kebutuhan sehari-hari hingga layasan jasa untuk keperluan gaya hidup.
              </p>
              <img src="CSS/assets/line3.svg  " alt="line" />
            </div>
            <div class="col-sm-2">
              <h4>LAYANAN</h4>
              <ul>
                <li><a href="#">Cleaning Service</a></li>
                <li><a href="#">Barber Shop</a></li>
                <li><a href="#">Shoe Cleaning</a></li>
                <li><a href="#">Massage</a></li>
                <li><a href="#">Joki Tugas</a></li>
                <li><a href="#">Others</a></li>
              </ul>
            </div>
            <div class="col-sm-2">
              <h4>INFO</h4>
              <ul>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Career</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="#">Help</a></li>
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
                <li>
                  <a href="#"><img src="CSS/assets/fb.svg" alt="fb" /></a>
                </li>
                <li>
                  <a href="#"><img src="CSS/assets/instagram.svg" alt="fb" /></a>
                </li>
                <li>
                  <a href="#"><img src="CSS/assets/twitter.svg" alt="fb" /></a>
                </li>
                <li>
                  <a href="#"><img src="CSS/assets/google.svg" alt="fb" /></a>
                </li>
              </ul>
              <p>Rengga 2022. Hak Cipta Dilindungi</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="js/input_kuantitas.js"></script>
  </body>
</html>
