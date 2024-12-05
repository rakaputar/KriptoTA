<?php
session_start();
include 'koneksi.php';
include 'islogin.php';
include 'kripto.php'; 

if(empty($_POST['id_berita'])){
    header("location:blog?id_berita");
    exit;
}
if (!isset($_POST['id_berita']) || empty($_POST['id_berita'])){
    header("location:blog?id_berita");
    exit;
}

$idberita = $_POST['id_berita'];
$isikomen = mysqli_real_escape_string($koneksi, $_POST['isi']);

// kunci enkripsi 
$shift = 3; // Example shift value for Caesar Cipher
$key = 'kriptoo'; // Example key for XOR Cipher

// Encrypt the comment text
$encrypted_isi = super_encrypt($isikomen, $shift, $key);

if (isUserLoggedIn()) {
    $username = $_SESSION['username'];    
    $data = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$username'") 
    or die (mysqli_error($koneksi));
    $user = mysqli_fetch_assoc($data);
    $iduser = $user['id'];
    $query = mysqli_query($koneksi, "INSERT INTO komentar VALUES 
    ('', '$iduser',NULL, '$idberita', '$encrypted_isi', '$username')")or die(mysqli_error($koneksi));
}else {
    redirectToLogin();
}

if($query){
    header("location:blog.php?id_berita=$idberita");
}
?>
