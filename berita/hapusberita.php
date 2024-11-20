<?php
include 'koneksi.php';
$id_berita = $_GET['id_berita'];

$query = mysqli_query($connect, "ALTER TABLE komentar DROP FOREIGN KEY komentar_ibfk_2");
$query3 = mysqli_query($connect, "ALTER TABLE komentar ADD CONSTRAINT komentar_ibfk_2 FOREIGN KEY (id_beritakomen) REFERENCES berita (id_berita) ON DELETE CASCADE ");

if ($query) {

    $query1 = mysqli_query($connect, "DELETE FROM berita WHERE id_berita = $id_berita");

    if ($query1) {

        $query2 = mysqli_query($connect, "DELETE FROM komentar WHERE id_beritakomen = $id_berita");

        if ($query2) {
        
            $query3;
        
            if ($query3) {
                header("location:home.php");
            }
        }
    }
} else {
    echo "Proses Delete Data Gagal";
}
