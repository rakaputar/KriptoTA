<?php
    include 'koneksi.php';

    $id_berita = $_GET['id_berita'];
    $query = mysqli_query($connect, "SELECT * from berita where id_berita=$id_berita");
    $data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunting Berita</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body class="bodytambah">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class="kotak">
        <h1>Sunting Berita</h1>
        <br>
        <form action="updateberita.php" method="POST">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"></label>
                <input type="hidden" class="form-control" id="exampleFormControlInput1" placeholder="" name="id_berita" style="border: 2px solid black" value="<?php echo $data['id_berita']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Judul</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="judul" style="border: 2px solid black" value="<?php echo $data['judul']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Waktu</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="waktu" style="border: 2px solid black" value="<?php echo $data['waktu']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Isi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="isi" style="border: 2px solid black">
                    <?php echo $data['isi']; ?>
                </textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="formFile" placeholder="format jpeg/webp" name="img">
            </div>
            <br>
            <button type="submit" class="tombollogin">Submit</button>
        </form>
    <br><br>
    <a class="alink" href="home.php">Back to Home Page</a>
    </div>

    <script src="script.js"></script>
</body>

</html>