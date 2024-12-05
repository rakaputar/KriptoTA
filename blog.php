<?php
session_start();
include 'koneksi.php';
include 'islogin.php';
include 'kripto.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KK Kartu Kredit</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body class="bodyutama">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <?php
    if (isUserLoggedIn()) {
        $username = $_SESSION['username'];
    }
    
    $id_berita = $_GET['id_berita'];

    $query = mysqli_query($koneksi, "SELECT * FROM komentar WHERE id_beritakomen = $id_berita");

    ?>

    <div class="naviga">
        <nav class="navbar navbar-expand-lg bg-body-dark border sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php" style: align-center>CCC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php ?>
                        <?php
                        if (isUserLoggedIn() || isAdminLoggedin()) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-disabled="true" href="logout.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-x" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4" />
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                    </svg>
                                    Logout</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="loginuser.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4" />
                                    </svg>
                                    Login</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="loginadmin.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                                    </svg>
                                    Login Sebagai Penerbit</a>
                            </li> -->

                        <?php } ?>
                    </ul>
                    <ul class="navbar-item ms-auto my-auto">
                        <li class="nav-item" list-style-type: none;>
                            <span>
                                Kartu Kredit
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <?php
    if (isset($_GET['id_berita']) && !empty($_GET['id_berita'])) {
        $id_berita = $_GET['id_berita'];
        $inner = mysqli_query($koneksi, "SELECT * FROM berita  where id_berita = $id_berita");
        $berita = mysqli_fetch_array($inner);
        $blob = $berita['img'];
        $gambar = 'data:image/webp;base64,' . base64_encode($blob);
        if (empty($berita)) {
            echo '<p class="text-warning">Berita tidak ditemukan </p>';
        } else {
    ?>
            <div>
                <div class="beritadalam">
                    <?php if (isAdminLoggedin()) { ?>
                        <div>
                            <a href="editberita.php?id_berita=<?php echo $berita['id_berita']; ?>"><button class="edithapushome">edit</button></a>
                            <a href="hapusberita.php?id_berita=<?php echo $berita['id_berita']; ?>"><button class="edithapushome">hapus</button></a>
                        </div><?php } ?>
                    <h2><?php echo $berita['judul']; ?></h2>

                    <p class="waktuberita">
                        <?php echo $berita['waktu']; ?>
                    </p>

                    <?php if (!empty($blob)){ ?>
                    <img src="<?php echo $gambar ?> " class="rounded"> 
                    <?php } ?>
                    <p class="isiberita">

                        <?php echo nl2br($berita['isi']); ?>
                    </p>
                </div>


                <div class="komentar">
    <div class="komentardalam">
        <h3>Komentar</h3>
        <hr>
        <div class="bg-light py-2 px-3 rounded">
            <?php
            // Sertakan file kripto.php dan parameter dekripsi
            include 'kripto.php';
            $shift = 3; // Nilai shift untuk Caesar Cipher
            $key = 'kriptoo'; // Kunci untuk XOR Cipher

            // Ambil data komentar dari database
            $idberita = $_GET['id_berita'];
            $query = mysqli_query($koneksi, "SELECT * FROM komentar WHERE id_beritakomen='$idberita'") or die(mysqli_error($koneksi));
            
            while ($komentar = mysqli_fetch_array($query)) {
                // Dekripsi teks komentar
                $decrypted_isi = super_decrypt($komentar['isi'], $shift, $key);
            ?>
                <div class="row ">
                    <div class="col">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </div>

                    <div class="row fw-bold">
                        <a href="<?php $reply = $komentar['username'] ?>" class="link-dark" style="text-decoration:none">
                            @<?php echo $komentar['username']; ?>
                        </a>
                    </div>
                    <div class="row px-4">
                        <?php echo nl2br($decrypted_isi); ?>
                        <hr>
                    </div>
                </div>
            <?php } ?>
        </div><br>
        <br>
        <?php
        if (isUserLoggedIn() || isAdminLoggedin()) {
        ?>
            <form action="komentar.php" method="POST">
                <div class="mb-3">
                    <div class="row-auto ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <div class="col fw-bold">
                            @<?php echo $username; ?>
                        </div>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" cols="60" name="isi"></textarea>
                        <input type="hidden" value="<?php echo $berita['id_berita']; ?>" name="id_berita" />
                        <input type="hidden" value="<?php echo $berita['id_berita']; ?>" name="id_berita" />
                        <input type="hidden" value="<?php echo $berita['id_berita']; ?>" name="id_berita" />
                    </div>        
                </div>
                <div class="submitkomen text-end">
                    <button class="kirimkomen ">Kirim</button>
                </div>
            </form>
        <?php
        } else { ?>

            <div class="mb-3">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" cols="60" name="isi"></textarea>
            </div>
            <div class="submitkomen text-end">
                <button class="kirimkomen " href="loginuser.php">
                    <a href="loginuser.php" class="link-dark" style="text-decoration:none">
                        <?php
                        echo "Login terlebih dahulu.";
                        ?>
                    </a>
                </button>
            </div>
        <?php } ?>
    </div>
</div>

            </div>
    <?php
        }
    }
    ?>
    <script src="script.js"></script>
</body>

</html>