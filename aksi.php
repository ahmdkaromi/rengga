<?php
session_start();
include "koneksi.php";
$user=$_POST['username'];
$pass=$_POST['password'];

   $stmt=mysqli_prepare($koneksi, "select * from login where username=? and password=?");
   mysqli_stmt_bind_param($stmt,'ss',$user,$pass);
   mysqli_stmt_execute($stmt);
   $a=mysqli_stmt_get_result($stmt);
   $b=mysqli_fetch_array($a);
   if($a!=NULL){
        $_SESSION['nama']=$b['username'];
        header("Location:/RENGGA LOLOS REVISI/index-login.php");
   }else{
        header("Location:/RENGGA LOLOS REVISI/login.html");
   }

?>