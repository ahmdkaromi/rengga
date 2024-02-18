<?php
  session_start();
  if( !isset($_SESSION["login"])){
      header("Location:/rengga/login.php");
      exit;
  }

  include "koneksi.php";
  $username = $_SESSION['login'];
  $id_layanan = $_POST['id_layanan'];
  $jumlah_order = $_POST['jumlah_order'];
  
  $stmt1 = mysqli_prepare($koneksi, "select * from data_user where username=?");
  mysqli_stmt_bind_param($stmt1, 's', $username);
  mysqli_stmt_execute($stmt1);
  $user = mysqli_fetch_array(mysqli_stmt_get_result($stmt1));
  
  $query = mysqli_query($koneksi, "select * from data_layanan where id_layanan='$id_layanan'");
  $layanan = mysqli_fetch_array($query);

  $total_harga = $layanan['harga_layanan'] * $jumlah_order;
  $ongkos_perjalanan = 10000;
  $harga_final = $total_harga + $ongkos_perjalanan;

  if(isset($_POST['id_layanan']) && isset($_POST['pesan'])){
    $id_toko = $layanan['id_toko'];
    $hari_pemesanan = date("Y-m-d");
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $status = "unfinished";

    $stmt = mysqli_prepare($koneksi, "insert into data_transaksi (id_layanan, id_toko, username, jumlah_order, total_harga, alamat_tujuan, hari_pemesanan, metode_pembayaran, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iisiissss', $id_layanan, $id_toko, $username, $jumlah_order, $harga_final, $user['alamat'], $hari_pemesanan, $metode_pembayaran, $status);
    mysqli_stmt_execute($stmt);
    header("Location:/rengga/myorder.php");
  }

  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/style.css?v=<?= time(); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" />
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

    <!-- Awal Order Overview -->
    <div class="container-fluid order">
      <div class="container">
        <div class="orderoverview">
          <div class="row">
            <div class="col-sm-7">
              <h3 style="font-weight: bold">Order Summary</h3>
              <p>Periksa kembali pesanan Anda, dan pastikan alamat dan pembayaran Anda sudah benar.</p>
              <div>
                <h5>Layanan yang dipesan</h5>
                <img src="CSS/assets/garisorder.svg" alt="" class="mb-3" />
                <div class="card mb-3 w-100">
                  <div class="row g-0">
                    <div class="col-md-6 pesanan">
                      <img src="photos/layanan_photo/<?= $layanan['foto_layanan']; ?>" alt="gambarpesanan" />
                    </div>
                    <div class="col-md-6">
                      <div class="card-body">
                        <h5 class="card-title"><?= $layanan['nama_layanan'] ?></h5>
                        <div class="listorder card-text">
                          <p><?= $layanan['deskripsi_layanan'] ?></p>
                        </div>
                        <p class="card-text"><small class="text-muted">Harga Pesanan : Rp<?= $layanan['harga_layanan']; ?></small></p>
                        <p class="card-text"><small class="text-muted">Total Pesanan : x<?= $jumlah_order; ?></small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="alamat-bayar">
                <h5>Atur Pemesanan dan Pembayaran</h5>
                <img src="CSS/assets/garisorder.svg" alt="" class="mb-3" />
                <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">Alamat Tujuan</h5>
                      <small class="text-muted">Ganti Alamat</small>
                    </div>
                    <p class="mb-0">Rumah - <?= $user['nama']; ?> (<?= $user['handphone']; ?>)</p>
                    <small><?= $user['alamat']; ?></small>
                  </a>
                  <!-- <div href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-3">Pilih Hari Pemesanan</h5>
                    </div>
                    <select class="form-select mb-2" aria-label="Default select example">
                      <option selected>Pilih Hari pemesanan</option>
                      <option value="1">Hari ini (22 September 2022)</option>
                      <option value="2">Besok (23 September 2022)</option>
                      <option value="3">Besok Lusa (24 September 2022)</option>
                    </select>
                  </div> -->
                  <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-3">Metode Pembayaran</h5>
                    </div>
                  <form action="order-overview.php" method="POST">
                    <div class="pembayaran">
                      <label class="border border-success p-2 mb-2 rounded-2 w-100">
                        <input type="radio" name="metode_pembayaran" id="bayar" value="cashondelivery" required/>
                        <i class="bi bi-cash-coin m-lg-3"> Cash On Delivery</i>
                      </label>
                    </div>
                    <!-- <div class="pembayaran">
                      <label class="border border-success p-2 mb-2 rounded-2 w-100">
                        <input type="radio" name="bayar" id="dana" />
                        <img src="CSS/assets/dana 1.png" alt="dana" />
                      </label>
                    </div>
                    <div class="pembayaran">
                      <label class="border border-success p-2 mb-2 rounded-2 w-100">
                        <input type="radio" name="bayar" id="gopay" bayar />
                        <img src="CSS/assets/gopay 1.png" alt="dana" />
                      </label>
                    </div>
                    <div class="pembayaran">
                      <label class="border border-success p-2 mb-2 rounded-2 w-100">
                        <input type="radio" name="bayar" id="ovo" bayar />
                        <img src="CSS/assets/ovo 1.png" alt="dana" />
                      </label>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4 offset-md-1">
              <h3 style="font-weight: bold">Detail Pemesanan</h3>
              <p>Selesaikan pesanan Anda, dengan membayar melalu metode pembayaran yang tersedia</p>
              <div class="bayar">
                <h5>Ringkasan Pemesanan</h5>
                <img src="CSS/assets/garisorder.svg" alt="" class="mb-3" />
                <div class="card">
                  <div class="card-body">
                    <div class="row mt-2 mb-2">
                      <div class="col-md-7"><small>Sub Total</small></div>
                      <div class="col-md">Rp<?= $total_harga; ?></div>
                    </div>
                    <div class="row mt-2 mb-2">
                      <div class="col-md-7"><small>Ongkos Perjalanan</small></div>
                      <div class="col-md">Rp10000,00</div>
                    </div>
                    <div class="row mt-2 mb-2">
                      <div class="col-md-7"><small>Total</small></div>
                      <div class="col-md">Rp<?= $harga_final;  ?></div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <input type="number" name="id_layanan" value="<?= $id_layanan; ?>" hidden>
                    <input type="number" name="jumlah_order" value="<?= $jumlah_order; ?>" hidden>
                    <button type="submit" name="pesan" class="btn btn-secondary btn-lg w-100">Pesan</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Order Overview -->

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
  </body>
</html>
