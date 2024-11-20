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
    <div class="notif">
      <?php
        if (isset($_GET['pesan'])) {
          if ($_GET['pesan'] == "gagal") {
            echo "Login gagal! username atau password salah!";
          } else if ($_GET['pesan'] == "logout") {
            echo "Anda telah berhasil logout";
          } else if ($_GET['pesan'] == "belum_login") {
            echo "Anda belum login, harus login terlebih dahulu!";
          } else if ($_GET['pesan'] == "belum_logout") {
            echo "Anda belum logout, harus logout terlebih dahulu!";
          }
        } 
        ?>
    </div>
    
    <h1>Login Sebagai Admin</h1>
    
    <br>
    
    <form action="cek_login.php" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="usernameadmin" placeholder="Masukkan Username" style="border: 2px solid black">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="passwordadmin" placeholder="Masukkan password" style="border: 2px solid black">
      </div>
      <br> <br>
      <?php //if ()
      ?>
      <button type="submit" class="tombollogin">Login</button>
    </form>
    
    <br>
    
    <a href="loginuser.php"><p>Login sebagai user?</p></a>
    
    <a class="alink" href="home.php">Back to Home Page</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
  </html>