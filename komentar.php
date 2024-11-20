<?php
    session_start();
    include 'koneksi.php';
    include 'islogin.php';

    if(empty($_POST['id_berita'])){
        header("location:blog?id_berita") ;
        exit;
    }
    if (!isset($_POST['id_berita']) || empty($_POST['id_berita'])){
        header("location:blog?id_berita") ;
        exit;
    }
    
        $idberita = $_POST['id_berita'];
        $isikomen = mysqli_real_escape_string($connect, $_POST['isi']);
    if (isUserLoggedIn()) {
        $username = $_SESSION['username'];    
        $data = mysqli_query($connect,"SELECT * FROM user WHERE username='$username'") 
        or die (mysqli_error($connect));
        $user = mysqli_fetch_assoc($data);
        $iduser = $user['id'];
        $query = mysqli_query($connect, "INSERT INTO komentar VALUES 
        ('', '$iduser',NULL, '$idberita', '$isikomen', '$username')")or die(mysqli_error($connect));
    }else if(isAdminLoggedin()){
        $username = $_SESSION['usernamepenerbit'];
        $data2 = mysqli_query($connect,"SELECT * FROM penerbit WHERE usernamepenerbit='$username'") 
        or die (mysqli_error($connect));
        $user2 = mysqli_fetch_assoc($data2);
        $id = $user2['idpenerbit'];
        $query = mysqli_query($connect, "INSERT INTO komentar VALUES 
        ('', NULL,'$id', '$idberita', '$isikomen', '$username')")or die(mysqli_error($connect));
    
    }else redirectToLogin();

    if($query){
        header("location:blog.php?id_berita=$idberita");
    }


?>