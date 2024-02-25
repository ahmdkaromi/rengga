<?php
    session_start();
    if( !isset($_SESSION["login"])){
        header("Location:/rengga/login.php");
        exit;
    }

    include "koneksi.php";
    $username = $_SESSION['login'];
    $id_layanan = $_GET['id_layanan'];

    $stmt1 = mysqli_prepare($koneksi, "select * from data_user where username=?");
    mysqli_stmt_bind_param($stmt1, 's', $username);
    mysqli_stmt_execute($stmt1);
    $user = mysqli_fetch_array(mysqli_stmt_get_result($stmt1));

    $stmt2 = mysqli_prepare($koneksi, "select id_toko from data_toko where username=?");
    mysqli_stmt_bind_param($stmt2, 's', $username);
    mysqli_stmt_execute($stmt2);
    $toko = mysqli_fetch_array(mysqli_stmt_get_result($stmt2));

    $stmt3 = mysqli_prepare($koneksi, "select * from data_layanan where id_layanan=?");
    mysqli_stmt_bind_param($stmt3, 'i', $id_layanan);
    mysqli_stmt_execute($stmt3);
    $layanan = mysqli_fetch_array(mysqli_stmt_get_result($stmt3));

    if(isset($_POST['nama_layanan'])){
      $id_toko = $toko['id_toko'];
      $nama_layanan = $_POST['nama_layanan'];
      $jenis_layanan = $_POST['jenis_layanan'];
      $harga_layanan = $_POST['harga_layanan'];
      $deskripsi_layanan = $_POST['deskripsi_layanan'];

      $stmt = mysqli_prepare($koneksi, "update data_layanan set nama_layanan=?, jenis_layanan=?, harga_layanan=?, deskripsi_layanan=? where id_layanan=?");
      mysqli_stmt_bind_param($stmt, 'ssisi', $nama_layanan, $jenis_layanan, $harga_layanan, $deskripsi_layanan, $id_layanan);
      mysqli_stmt_execute($stmt);

      if (isset($_FILES['foto_layanan'])) {

        $img_name = $_FILES['foto_layanan']['name'];
        $img_size = $_FILES['foto_layanan']['size'];
        $tmp_name = $_FILES['foto_layanan']['tmp_name'];
        $error = $_FILES['foto_layanan']['error'];
  
        if ($error === 0) {
           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
           $img_ex_lc = strtolower($img_ex);
           $allowed_exs = array("jpg", "jpeg", "png"); 
  
           if (in_array($img_ex_lc, $allowed_exs)) {
              $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
              $img_upload_path = 'photos/layanan_photo/'.$new_img_name;
              $img_folder_path = 'photos/layanan_photo/'.$layanan['foto_layanan'];
              move_uploaded_file($tmp_name, $img_upload_path);
              if($layanan['foto_layanan'] != "Frame 23.png"){
                unlink($img_folder_path);
             }
  
              // Insert into Database
              $stmt = mysqli_prepare($koneksi, "update data_layanan set foto_layanan=? where id_layanan=?");
              mysqli_stmt_bind_param($stmt, 'si', $new_img_name, $id_layanan);
              mysqli_stmt_execute($stmt);
              mysqli_close($koneksi);
           }else {
              $em = "You can't upload files of this type";
                 header("Location:/rengga/edit-toko.php?error=$em");
           }
        }else {
           $em = "unknown error occurred!";
           header("Location:/rengga/edit-toko.php?error=$em");
        }
     }
      header("Location:/rengga/edit-data-penyedia-jasa.php?id_layanan=".$id_layanan);
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
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" />
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
    <!--awal main content-->
    <div class="maincontent">
      <div class="kecil">
        <span
          ><b
            >Hello,
            <?= $username; ?>!</b
          ></span
        >
        <span style="color: grey"> Ayo Isi Detail Layananmu!</span>
      </div>
      <br />
      <div class="container form-input-data-penyedia-jasa">
        <section id="foto">
          <h5><b>Deskripsi Gambar</b></h5>
          <br />
          <div class="row">
            <div class="col-md-6">
              <div class="file-field">
                <div class="z-depth-1-half mb-4">
                  <center><img src="photos/layanan_photo/<?= $layanan['foto_layanan'] ?>" class="img-fluid gambar_toko" alt="example placeholder" /></center>
                </div>
                <div class="d-flex justify-content-center">
                  <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                    <div class="col-auto">
                      <label for="inputFoto" class="visually-hidden">Foto</label>
                      <input type="file" class="form-control" name="foto_layanan" id="inputFoto" placeholder="Foto" />
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 d-flex align-items-center">
              <p>Format gambar .jpg .jpeg .png dan ukuran minimum 300 x 300px (Untuk gambar optimal gunakan ukuran minimum 700 x 700 px).</p>
            </div>
          </div>
        </section>
        <br />
        <section class="Informasi-Layanan">
          <h5><b>Informasi Layanan</b></h5>
          <br />
          <div class="row">
              <div class="col-md-4">
                <p>Nama Layanan</p>
                <br />
                <p>Jenis Layanan</p>
                <br />
                <p>Harga</p>
              </div>
              <div class="col-md-7 offset-md-1">
                <input type="text" id="namalayanan" placeholder="Masukkan Nama Layanan" name="nama_layanan" maxlength="30" class="form-control" value="<?= $layanan['nama_layanan']; ?>"/>
                <br />
                <select class="form-select" name="jenis_layanan" aria-label="Default select example">
                  <option selected>Pilih Jenis Layanan</option>
                  <option value="cleaningservice" <?php if($layanan['jenis_layanan'] == 'cleaningservice') echo 'selected'; ?>>Cleaning Service</option>
                  <option value="barbershop" <?php if($layanan['jenis_layanan'] == 'barbershop') echo 'selected'; ?>>Barbershop</option>
                  <option value="shoecleaning" <?php if($layanan['jenis_layanan'] == 'shoecleaning') echo 'selected'; ?>>Shoe Cleaning</option>
                  <option value="massage" <?php if($layanan['jenis_layanan'] == 'massage') echo 'selected'; ?>>Massage</option>
                  <option value="technician" <?php if($layanan['jenis_layanan'] == 'technician') echo 'selected'; ?>>Technician</option>
                  <option value="lesprivate" <?php if($layanan['jenis_layanan'] == 'lesprivate') echo 'selected'; ?>>Les Private</option>
                  <option value="jokitugas" <?php if($layanan['jenis_layanan'] == 'jokitugas') echo 'selected'; ?>>Joki Tugas</option>
                  <option value="makeup" <?php if($layanan['jenis_layanan'] == 'makeup') echo 'selected'; ?>>Make Up Artist</option>
                  <option value="band" <?php if($layanan['jenis_layanan'] == 'band') echo 'selected'; ?>>Band</option>
                  <option value="mc" <?php if($layanan['jenis_layanan'] == 'mc') echo 'selected'; ?>>Master of Ceremony</option>
                </select>
                <br />
                <input type="number" min="0.00" id="harga" placeholder="Rp. 0" name="harga_layanan" class="form-control" value="<?= $layanan['harga_layanan']; ?>"/><br />
              </div>
          </div>
        </section>
        <section id="DeskripsiLayanan">
          <h5><b>Deskripsi Layanan</b></h5>
          <br />
          <textarea class="form-control" rows="5" cols="40" name="deskripsi_layanan" placeholder="Masukkan Deskripsi atau Informasi Mengenai Layanan"><?= $layanan['deskripsi_layanan']; ?></textarea>
          <br />
        </section>
        <!-- <section id="spesifikasitambahan">
          <h5><b>Spesifikasi Tambahan</b></h5>
          <br />
          <div class="row">
            <div class="col-md-4">
              <button type="submit" id="contohButton"><b>-</b></button>
              <input type="text" id="contohInput" />
            </div>
            <div class="col-md-4">
              <button type="submit" id="contohButton">-</button>
              <input type="text" id="contohInput" />
            </div>
            <div class="col-md-4">
              <button type="submit" id="contohButton">-</button>
              <input type="text" id="contohInput" />
            </div>
            <br />
            <div class="col-md-4">
              <form class="form-control" id="contohForm">
                <button type="submit" id="contohButton"><b>-</b></button>
                <input type="text" id="contohInput" />
              </form>
            </div>
            <div class="col-md-4">
              <form class="form-control" id="contohForm">
                <button type="submit" id="contohButton">-</button>
                <input type="text" id="contohInput" />
              </form>
            </div>
            <div class="col-md-4">
              <form class="form-control" id="contohForm">
                <button type="submit" id="contohButton">-</button>
                <input type="text" id="contohInput" />
              </form>
            </div>
          </div>
        </section> -->
        <br />
        <center>
          <button type="submit" class="btn btn-primary btn-sm" style="background-color: #ffd803; color: black"><b>Submit</b></button>
          <a href="<?= "hapus-data-penyedia-jasa.php?id_layanan=".$id_layanan; ?>" name="hapus_layanan" onclick="return confirm('Anda yakin ingin menghapus layanan ini?')" class="btn btn-danger btn-sm">Hapus</a>
        </center>
       </form>
      </div>
    </div>

    <!--akhir main content-->
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
