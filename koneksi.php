<?php
    $hostname   = "localhost"; 
    $username   = "root";      
    $password   = "";          
    $database   = "tugasakhir";
    $koneksi = new mysqli($hostname,$username,$password, $database);

    if ($koneksi->connect_error){
        die('Maaf koneksi gagal: '. $koneksi->connect_error);
    }
?>