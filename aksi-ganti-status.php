<?php
   session_start();

   include "koneksi.php";
   
   $id_transaksi = $_GET['id_transaksi'];

   if(!empty($id_transaksi)){
      $status = "cancelled";

      $stmt = mysqli_prepare($koneksi, "update data_transaksi set status=? where id_transaksi=?");
      mysqli_stmt_bind_param($stmt, 'si', $status, $id_transaksi);
      mysqli_stmt_execute($stmt);
      mysqli_close($koneksi);
      header("Location:/rengga/myorder.php");
   }
?>