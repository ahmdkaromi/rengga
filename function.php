<?php
    $koneksi= mysqli_connect("localhost","root","","ecom_db");

    function registrasi($data){
        global $koneksi;

        $username = strtolower(stripslashes($data["username"]));
        $hp=$data["hp"];
        $email=$data["email"];
        $password = mysqli_real_escape_string($koneksi, $data["password"]);

        $hasil=mysqli_query($koneksi, "SELECT username from data_user WHERE username = '$username'");
        if(mysqli_fetch_assoc($hasil)){
            echo"<script>
                    alert('username sudah terdaftar!')
            </script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt=mysqli_prepare($koneksi,"insert into data_user set username=?, handphone=?, email=?, password=?");
        mysqli_stmt_bind_param($stmt,'siss',$username,$hp,$email,$password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_affected_rows($koneksi);
    }

?>