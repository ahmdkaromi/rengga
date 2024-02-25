<?php
   session_start();

   include "koneksi.php";

   $username = $_SESSION['login'];
   $id_layanan = $_GET['id_layanan'];

   $stmt = mysqli_prepare($koneksi, "select * from data_user where username=?");
   mysqli_stmt_bind_param($stmt, 's', $username);
   mysqli_stmt_execute($stmt);
   $user = mysqli_fetch_array(mysqli_stmt_get_result($stmt));

   $query = mysqli_query($koneksi, "select * from data_layanan where id_layanan='$id_layanan'");
   $layanan = mysqli_fetch_array($query);

   if(!empty($id_layanan)){
      $jumlah_order = $_POST['jumlah_order'];
      $total_harga = $layanan['harga_layanan'] * $jumlah_order;
      $alamat_tujuan = $user['alamat'];
      // $hari_pemesanan = 
   }
?>