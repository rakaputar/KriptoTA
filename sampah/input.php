<?php
    include 'koneksi.php';

    $judul = $_POST['judul'];
    $waktu = $_POST['waktu'];
    $isi = $_POST['isi'];
    $gambar = $_POST['img'];
    

    
    if (!empty($_POST['img'])){
        
        $query = mysqli_query($connect, "INSERT INTO berita  SET img = '$gambar', judul='$judul', waktu='$waktu',isi= '$isi'");

        header("location:home.php");
    }else if (empty($_POST['img'])){
        
        $query2 = mysqli_query($connect, "INSERT INTO berita 
        VALUES('','$judul','$waktu','$isi',NULL)") or die(mysqli_error($connect));
            header("location:home.php");
        }else if ($connect->connect_error) {
            die('Maaf koneksi gagal: ' . $connect->connect_error);
        }
        /*if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            // Tentukan lokasi penyimpanan sementara dan lokasi penyimpanan akhir
            $temp = $_FILES['img']['tmp_name'];
            $final = "C:/xampp/htdocs/tugasakhirraka/img" . $_FILES['img']['name'];
            
            // Pindahkan gambar ke lokasi penyimpanan akhir
            move_uploaded_file($temp, $final);
            
            // Baca konten gambar sebagai blob
            $blob = file_get_contents($final);
            
            // Hapus gambar sementara
            unlink($final);
            
            
            
            
            // Bind parameter blob ke query
            mysqli_stmt_bind_param($query2, "s", $blob);
            
            // Eksekusi query
        }
        mysqli_stmt_execute($query2);*/
            ?>