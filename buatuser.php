<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Buat user</title>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body class="bodytambah">

<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password dengan bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "Pendaftaran berhasil!";
        //echo "Login disini";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        echo "Pendaftaran gagal!";
    }

    mysqli_close($koneksi);
}
?>

    <div class="notif">
      <?php
        if (isset($_GET['pesan'])) {
          if ($_GET['pesan'] == "gagal") {
            echo "Login gagal! username atau password salah!";
          } else if ($_GET['pesan'] == "logout") {
            echo "Anda telah berhasil logout";
          } else if ($_GET['pesan'] == "belum_login") {
            echo "Anda belum login, harus login terlebih dahulu!";
          }
        } 
      ?>
    </div>

    <div class="kotak">
      <h1>Buat Akun</h1>

      <br>
    <!-- <form method="POST" action="buatuser.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Register</button>
    </form> -->

      <form action="buatuser.php" method="POST">
        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Masukkan Email" style="border: 2px solid black">
        </div>
        <div class="mb-3">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Masukkan Nama" style="border: 2px solid black">
        </div>
        <div class="mb-3">
          <label for="passwordpengguna">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Masukkan password" style="border: 2px solid black">
        </div>
        <br>
        <button type="submit" class="tombollogin">Daftar</button>
      </form>
      <p>
    <a class="alink" href="loginuser.php">Login Disini</a><br>
    <!-- <a class="alink" href="loginadmin.php">atau login sebagai penerbit</a> -->
</p>
<a class="alink" href="home.php">Back to Home Page</a>
      <br>

    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>

