<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Page</title>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body class="bodytambah">
    <div class="kotak">

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

    <h1>Login</h1>

    <br>
    <!-- <form method="POST" action="cek_login.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
    </form> -->

    <form action="cek_login.php" method="POST">
      <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Masukkan Username">
      </div>
      <div class="mb-3" class="formlogin">
        <label for="passwordpengguna">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Masukkan password">
      </div>

      <br>

      <button type="submit" class="tombollogin">Login</button>
    </form> 

    <br>
<p>
    <a class="alink" href="buatuser.php">Belum punya akun?</a><br>
    <!-- <a class="alink" href="loginadmin.php">atau login sebagai penerbit</a> -->
</p>
<a class="alink" href="home.php">Back to Home Page</a>
      </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>