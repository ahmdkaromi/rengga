<?php
   session_start();

   include "koneksi.php";
   
   $id_transaksi = $_GET['id_transaksi'];

   if(!empty($id_transaksi)){
      $stmt = mysqli_prepare($koneksi, "delete from data_transaksi where id_transaksi=?");
      mysqli_stmt_bind_param($stmt, 'i', $id_transaksi);
      mysqli_stmt_execute($stmt);
      mysqli_close($koneksi);
      header("Location:/rengga/myorder.php");
   }
?>