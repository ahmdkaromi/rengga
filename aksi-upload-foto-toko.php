<?php
   session_start();
   include "koneksi.php";

   $username = $_SESSION['login'];
   
   $stmt = mysqli_prepare($koneksi, "select * from data_toko where username=?");
   mysqli_stmt_bind_param($stmt, 's', $username);
   mysqli_stmt_execute($stmt);
   $toko = mysqli_fetch_array(mysqli_stmt_get_result($stmt));

   if (isset($_FILES['foto_toko'])) {

      $img_name = $_FILES['foto_toko']['name'];
      $img_size = $_FILES['foto_toko']['size'];
      $tmp_name = $_FILES['foto_toko']['tmp_name'];
      $error = $_FILES['foto_toko']['error'];

      if ($error === 0) {
         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
         $img_ex_lc = strtolower($img_ex);

         $allowed_exs = array("jpg", "jpeg", "png"); 

         if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = 'photos/toko_photo/'.$new_img_name;
            $img_folder_path = 'photos/toko_photo/'.$toko['foto_toko'];
            move_uploaded_file($tmp_name, $img_upload_path);
            if($toko['foto_toko'] != "Frame 23.png"){
               unlink($img_folder_path);
            }

            // Insert into Database
            $stmt = mysqli_prepare($koneksi, "update data_toko set foto_toko=? where username=?");
            mysqli_stmt_bind_param($stmt, 'ss', $new_img_name, $username);
            mysqli_stmt_execute($stmt);
            mysqli_close($koneksi);
            header("Location:/rengga/buka-toko.php");
         }else {
            $em = "You can't upload files of this type";
               header("Location:/rengga/buka-toko.php?error=$em");
         }
      }else {
         $em = "unknown error occurred!";
         header("Location:/rengga/buka-toko.php?error=$em");
      }

   }else {
      header("Location:/rengga/buka-toko.php?error=$em");   
   }
?>