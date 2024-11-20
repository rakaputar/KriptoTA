<!-- <?php
//     session_start();
//     include 'koneksi.php';

//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $usernameadmin=$_POST['usernameadmin'];
//     $passwordadmin=$_POST['passwordadmin'];

//     $data = mysqli_query($connect,"select * from admin where usernameadmin='$usernameadmin' and passwordadmin='$passwordadmin'") 
//     or die (mysqli_error($connect));
    
//     $cek = mysqli_num_rows($data);
//     if($cek > 0){
//         $_SESSION['usernameadmin'] = $usernameadmin;
//         $_SESSION['role'] = $user['role'];
//         $_SESSION['status'] = "login";
//         header("location:home.php?nama=$usernameadmin");
//     }else{
//         header("location:loginadmin.php?pesan=gagal");
//     }
// }
?>  -->

<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            echo "Login berhasil!";

        } else {
            echo "Password salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }

    //mysqli_close($koneksi);
}
?> <a class="navbar-brand" href="home.php" style: align-center>CCC</a>
