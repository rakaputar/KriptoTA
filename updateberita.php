<?php
    include 'koneksi.php';

    $id_berita = $_POST['id_berita'];
    $judul = $_POST['judul'];
    $waktu = $_POST['waktu'];
    $isi = $_POST['isi'];
    if (!empty($_POST['img'])){
        $query = mysqli_query($connect, "UPDATE berita SET judul = '$judul', waktu = '$waktu', isi = '$isi', img ='$img' WHERE id_berita = '$id_berita' ") 
                or die(mysqli_error($connect));

    }else {
    $query = mysqli_query($connect, "UPDATE berita SET judul = '$judul', waktu = '$waktu', isi = '$isi' WHERE id_berita = '$id_berita' ") 
            or die(mysqli_error($connect));
    }
    
    if ($query){
        header("location:home.php");

    } else if ($connect->connect_error) {
        die('Maaf koneksi gagal: ' . $connect->connect_error);
    }
?>