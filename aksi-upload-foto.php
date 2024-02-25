<?php
   session_start();
   include "koneksi.php";

   $username = $_SESSION['login'];

   // Foto User
   $stmt = mysqli_prepare($koneksi, "select * from data_user where username=?");
   mysqli_stmt_bind_param($stmt, 's', $username);
   mysqli_stmt_execute($stmt);
   $user = mysqli_fetch_array(mysqli_stmt_get_result($stmt));

   if (isset($_POST['simpan']) && isset($_FILES['foto'])) {

      $img_name = $_FILES['foto']['name'];
      $img_size = $_FILES['foto']['size'];
      $tmp_name = $_FILES['foto']['tmp_name'];
      $error = $_FILES['foto']['error'];
   
      if ($error === 0) {
         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
         $img_ex_lc = strtolower($img_ex);

         $allowed_exs = array("jpg", "jpeg", "png"); 

         if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = 'photos/profile_photo/'.$new_img_name;
            $img_folder_path = 'photos/profile_photo/'.$user['foto'];
            move_uploaded_file($tmp_name, $img_upload_path);
            if($user['foto'] != "kucingsopan.jpeg"){
               unlink($img_folder_path);
            }

            // Insert into Database
            $stmt = mysqli_prepare($koneksi, "update data_user set foto=? where username=?");
            mysqli_stmt_bind_param($stmt, 'ss', $new_img_name, $username);
            mysqli_stmt_execute($stmt);
            mysqli_close($koneksi);
            header("Location:/rengga/profile_user.php");
         }else {
            $em = "You can't upload files of this type";
               header("Location:/rengga/profile_user.php?error=$em");
         }
      }else {
         $em = "unknown error occurred!";
         header("Location:/rengga/profile_user.php?error=$em");
      }
   
   }else {
      header("Location:/rengga/profile_user.php?error=$em");   
   }
?>