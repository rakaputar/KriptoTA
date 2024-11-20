<?php
//session_start();
function isUserLoggedin()
{
    return isset($_SESSION['username']);
}

function isAdminLoggedin()
{
    return isset($_SESSION['usernameadmin']);
}

function redirectToLogin()
{
    if (isUserLoggedin()) {
        header("location:loginuser.php");
    }
    if (isAdminLoggedin()) {
        header("location:loginadmin.php");
    }
    exit();
}

//tangani tombol komen
if (isset($_POST['username'])) {
    if (isUserLoggedIn()) {
    } else {
        // Jika pengguna belum login, arahkan ke halaman login
        redirectToLogin();
    }
}
if (isset($_POST['usernameadmin'])) {
    if (isAdminLoggedIn()) {
    } else {
        // Jika pengguna belum login, arahkan ke halaman login
        redirectToLogin();
    }
}
