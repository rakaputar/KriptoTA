<?php 
    include 'koneksi.php';

    $namapengguna = $_POST['namapengguna'];
    $usernamepengguna = $_POST['usernamepengguna'];
    $passwordpengguna = $_POST['passwordpengguna'];

    $query = mysqli_query($connect, "INSERT INTO user
             VALUES('', '$usernamepengguna', '$passwordpengguna', '$namapengguna')")
             or die(mysqli_error($connect));

    if ($query) {
        header("location:loginuser.php");
    } else {
        echo "Proses Input Data Gagal";
    }
?>