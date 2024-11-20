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