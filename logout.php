<?php
    session_start();
    session_destroy();

    header("location:notif.php?pesan=logout")
?>