<?php
    session_start();
    include 'koneksi.php';

    $usernamepengguna=$_POST['usernamepengguna'];
    $passwordpengguna=$_POST['passwordpengguna'];

    $data = mysqli_query($connect,"SELECT * FROM user WHERE usernamepengguna='$usernamepengguna' and passwordpengguna='$passwordpengguna'") 
    or die (mysqli_error($connect));
    
    $cek = mysqli_num_rows($data);
    if($cek > 0){
        $_SESSION['usernamepengguna'] = $usernamepengguna;
        $_SESSION['status']   = "login";
        header("location:home.php?nama=$usernamepengguna");
    }else{
        header("location:loginadmin.php?pesan=gagal");
    }
?>
