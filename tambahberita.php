<?php
session_start();
if (empty($_SESSION['usernamepenerbit'])) {
    header("location:loginadmin.php?pesan=belum_login");
}

include 'koneksi.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NNN News</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bodytambah">
    <div class="kotak">
        <h1>Unggah Berita</h1>

        <br>

        <form action="input.php" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Judul</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="judul" style="border: 2px solid black">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Waktu</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="DD M(huruf) YYYY, [time] WIB/WIT/WITA" name="waktu" style="border: 2px solid black">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Isi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="isi" style="border: 2px solid black"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="formFile" placeholder="format jpeg/webp" name="img">
            </div> 
            <br>
            <button type="submit" class="tombollogin">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>