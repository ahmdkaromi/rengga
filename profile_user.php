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

  $query = mysqli_query($koneksi, "select nama_toko from data_toko where username='$username'");
  $toko = mysqli_fetch_array($query);

  if(!empty($_POST['username'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $handphone = $_POST['handphone'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];

    $stmt = mysqli_prepare($koneksi, "update data_user set nama=?, email=?, handphone=?, jenis_kelamin=?, tanggal_lahir=?, alamat=? where username=?");
    mysqli_stmt_bind_param($stmt, 'sssssss', $nama, $email, $handphone, $jenis_kelamin, $tanggal_lahir, $alamat, $username);
    mysqli_stmt_execute($stmt);
    $check = mysqli_fetch_array(mysqli_stmt_get_result($stmt));
    if(!empty($check)){ ?>
<script>
  alert("Data berhasil diupdate!");
</script>
<?php }
    mysqli_close($koneksi);
    header("Location:/rengga/profile_user.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

    <!-- My CSS -->
    <link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" />
    <!-- Font Awesome -->
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

    <section class="container-fluid">
      <!-- Container -->
      <div class="container page">
        <div class="container d-flex">
          <div class="carded_sidebar list-group">
            <div class="d-flex align-items-center justify-content-start list-group-item sidebar_section">
              <img src="photos/profile_photo/<?php echo $hasil['foto']; ?>" alt="user" class="gambar_pengguna" />
              <h6 class="nama_pengguna"><?php echo $username ?></h6>
            </div>
            <div class="list-group-item sidebar_section">
              <div class="row mt-3">
                <div class="col-lg-3 text-end">
                  <i class="fa-solid fa-user"></i>
                </div>
                <div class="col-lg-7">
                  <div>
                    <div class="fw-bold">My Profile</div>
                    <div class="d-flex flex-column sidebar_anchor">
                      <a href="">Edit Profile</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-lg-3 text-end">
                  <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="col-lg-7">
                  <div>
                    <div class="fw-bold">Pengaturan Toko</div>
                    <div class="d-flex flex-column sidebar_anchor">
                      <a href="">Edit Profile Toko</a>
                      <a href="">Tambah Layanan</a>
                      <a href="">Chat</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carded_body flex-grow-1">
            <h1>My Profile</h1>
            <img src="CSS/assets/Line 1.svg" alt="line" width="400" />
            <h4>Edit profile</h4>
            <div class="container">
              <form action="profile_user.php" method="post" id="form_profile" class="d-flex flex-column justify-content-center align-items-center">
                <img class="gambar_edit_profile" src="photos/profile_photo/<?php echo $hasil['foto']; ?>" alt="profile_user" />
                <a href="#" class="mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">edit</a>
                <table class="tabel_edit_profile">
                  <tr class="form-group">
                    <td>
                      <label for="profile-username">Username</label>
                    </td>
                    <td>
                      <input type="text" value="<?php echo $hasil['username']; ?>" class="form-control" name="username" id="profile-username" readonly />
                    </td>
                  </tr>
                  <tr class="form-group">
                    <td>
                      <label for="profile-nama">Nama</label>
                    </td>
                    <td>
                      <input type="text" value="<?php echo $hasil['nama']; ?>" class="form-control" name="nama" id="profile-nama" autocomplete="off"/>
                    </td>
                  </tr>
                  <tr class="form-group">
                    <td>
                      <label for="profile-email">Email</label>
                    </td>
                    <td>
                      <input type="email" value="<?php echo $hasil['email']; ?>" class="form-control" name="email" id="profile-email" readonly />
                    </td>
                  </tr>
                  <tr class="form-group">
                    <td>
                      <label for="profile-number">Nomor Telepon</label>
                    </td>
                    <td>
                      <input type="email" value="<?php echo $hasil['handphone']; ?>" class="form-control" name="handphone" id="profile-email" readonly />
                    </td>
                  </tr>
                  <tr class="form-group">
                    <td>
                      <label for="profile-nama-toko">Nama Toko</label>
                    </td>
                    <td>
                      <input type="text"  value="<?php if(empty($toko['nama_toko'])){echo "";}else{echo $toko['nama_toko'];}  ?>" class="form-control" name="nama_toko" id="profile-nama-toko" readonly >
                    </td>
                  </tr>
                  <tr class="form-group">
                    <td>
                      <label for="profile-email">Jenis Kelamin</label>
                    </td>
                    <td class="d-flex">
                      <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="lakilaki" value="laki-laki"
                        <?php if($hasil['jenis_kelamin'] == "laki-laki")echo "checked"; ?>
                        />
                        <label class="form-check-label" for="lakilaki"> Laki-laki </label>
                      </div>
                      <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan"
                        <?php if($hasil['jenis_kelamin'] == "perempuan")echo "checked"; ?>
                        />
                        <label class="form-check-label" for="perempuan"> Perempuan </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="lainnya" value="lainnya"
                        <?php if($hasil['jenis_kelamin'] == "lainnya")echo "checked"; ?>/>
                        <label class="form-check-label" for="lainnya"> Lainnya </label>
                      </div>
                    </td>
                  </tr>
                  <tr class="form-group">
                    <td>
                      <label for="profile-tanggal-lahir">Tanggal Lahir</label>
                    </td>
                    <td>
                      <input type="date" value="<?php echo $hasil['tanggal_lahir']; ?>" class="form-control" name="tanggal_lahir" id="profile-tanggal-lahir" />
                    </td>
                  </tr>
                  <tr class="form-group">
                    <td>
                      <label for="profile-alamat">Alamat</label>
                    </td>
                    <td>
                      <textarea name="alamat" class="form-control" id="profile-alamat" cols="30" rows="1"><?= $hasil['alamat']; ?></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <button type="submit" class="edit_profile_button">SIMPAN</button>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Tutup Container -->
    </section>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload foto profile baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="aksi-upload-foto.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="file" class="form-control" name="foto">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end modal -->

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
  </body>
</html>
