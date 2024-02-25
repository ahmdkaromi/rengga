<?php
session_start();

if( isset($_SESSION["login"])){
  header("Location:/rengga/index-login.php");
  exit;
}

require 'function.php';

if( isset($_POST["login"])){

  $user=$_POST['username'];
  $pass=$_POST['password'];

   $stmt=mysqli_prepare($koneksi, "select * from data_user where username=?");
   mysqli_stmt_bind_param($stmt,'s', $user);
   mysqli_stmt_execute($stmt);
   $a=mysqli_stmt_get_result($stmt);

  if(mysqli_num_rows($a) === 1){
    $row=mysqli_fetch_assoc($a);
    if(password_verify($pass, $row["password"])){
      $_SESSION["login"] = $row["username"];
      header("Location:/rengga/index-login.php");
      exit;
    }
  }

  $error=true;

}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in RENGGA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/style.css" />
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navform">
      <div class="container login">
        <a class="navbar-brand" href="index.html"><img src="css/assets/logo-login.png" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <h4>Log In</h4>
            <a class="nav-link" href="pusat-bantuan.html" style="padding-left: 660pt">Butuh bantuan ?</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Awal Form -->
    <div class="container-fluid jarak">
      <div class="container form">
        <div class="row">
          <div class="col-sm-6 form1">
            <form method="post" action="">
              <h4>Log in</h4>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="username" id="floatingInput" placeholder="name@example.com" autocomplete="off" />
                  <label for="floatingInput">Username</label>
                  <div id="emailHelp" class="form-text">Kita tidak pernah menyebar data customer kepada orang lain.</div>
                </div>
              </div>
              <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <div class="form-floating">
                  <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" autocomplete="off" />
                  <label for="floatingPassword">Password</label>
                  <div id="passHelp" class="form-text">Isi password Anda dengan benar.</div>
                </div>
              </div>
              <?php if( isset($error)) :?>
                <p style="color:red; font-style: italic;">username / password salah</p>
              <?php endif; ?>
              <div class="mb-3">
                <button type="submit" name="login" class="btn btn-primary" style="background-color: #282544; width: 100%; height: 60px">LOG IN</button>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
              </div>

              <div class="mb-3" style="text-align: center">
                <p>
                  Belum memiliki akun ?
                  <a href="signup.php"
                    ><b><u>SIGN UP</u></b></a
                  >
                </p>
              </div>
            </form>
          </div>

          <div class="col-sm-6 text">
            <img src="CSS/assets/logo-login.png" alt="logo" />
            <h4>
              R E N G G A <br />
              RENT OF PURBALINGGA
            </h4>
            <p>PROVIDING SUPERIOR SERVICES FOR ALL YOUR DAILY NEEDS IN PURBALINGGA, INDONESIA.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Akhir Form -->

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
