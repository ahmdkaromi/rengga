<?php
   session_start();

   include "koneksi.php";
   $id_layanan = $_GET['id_layanan'];

   $query = mysqli_query($koneksi, "select foto_layanan from data_layanan where id_layanan='$id_layanan'");
   $layanan = mysqli_fetch_array($query);

   // hapus
   if(!empty($id_layanan)){
      
      // unlink foto
      $img_folder_path = 'photos/toko_photo/'.$toko['foto_toko'];
      if($layanan['foto_layanan'] != "Frame 23.png"){
         unlink($img_folder_path);
      }

      $stmt = mysqli_prepare($koneksi, "delete from data_layanan where id_layanan=?");
      mysqli_stmt_bind_param($stmt, 'i', $id_layanan);
      mysqli_stmt_execute($stmt);

      mysqli_close($koneksi);
      header("Location:/rengga/edit-toko.php");
    }
?>