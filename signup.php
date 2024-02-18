<?php
require 'function.php';
    
    if (isset($_POST["register"])){
        if( registrasi($_POST) > 0){
            echo "<script>
                   alert('user baru berhasil ditambahkan'); 
                  </script>";
            header("Location:/rengga/login.php");
        } else {
            echo mysqli_error($koneksi);
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Rengga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navform">
        <div class="container login">
            <a class="navbar-brand" href="index.html"><img src="css/assets/logo-login.png" alt="logo"></a>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ">
                    <h4>Sign Up</h4>
                    <a class="nav-link" href="pusat-bantuan.html" style="padding-left: 647pt;">Butuh bantuan ?</a>
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
                    <form method="POST" action="">
                        <h4>Sign Up</h4>
                        <div class="mb-3">
                            <label for="Username" class="form-label">Username</label>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" autocomplete="off" required>
                                <label for="floatingInput">Username</label>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Username" class="form-label">No Handphone</label>
                            <div class="form-floating mb-3">
                                <input type="tel" name="hp" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" autocomplete="off" required>
                                <label for="floatingInput">No Handphone</label>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" autocomplete="off" required>
                                <label for="floatingInput">Email</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" autocomplete="off" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="confirm_password"
                                    placeholder="Password" autocomplete="off" required>
                                <label for="floatingPassword">Confirm Password</label>
                                <div id="emailHelp" class="form-text">Kita tidak pernah menyebar data customer kepada
                                    orang
                                    lain.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button 
                                type="submit"
                                name="register"
                                class="btn btn-primary"
                                onclick="cekPassword()"
                                style="background-color:#282544; width: 100%; height: 60px;">
                                SIGN UP
                            </button>
                        </div>

                        <div class="mb-3" style="text-align: center;">
                            <p>Dengan mendaftar, anda setuju dengan <a href=""><b>Syarat, Ketentuan
                                        dan kebijakan dari RENGGA & kebijakan privasi</b></a> </p>
                        </div>

                        <div class="mb-3" style="text-align: center;">
                            <p>Sudah memiliki akun ? <a href="login.php"><b><u>LOG IN </u></b></a></p>
                        </div>
                    </form>
                </div>

                <div class="col-sm-6 text">
                    <img src="CSS/assets/logo-login.png" alt="logo">
                    <h4>R E N G G A <br> RENT OF PURBALINGGA</h4>
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
                            <li><a href="pusat-bantuan.html">Help</a></li>
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
        crossorigin="anonymous">
    </script>
    <script>
    var password = document.getElementById("password") , confirm_password = document.getElementById("confirm_password");

    function cekPassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords dont match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = cekPassword;
    confirm_password.onkeyup = cekPassword;

    </script>
</body>

</html>