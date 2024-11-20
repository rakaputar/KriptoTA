<?php
session_start();
include 'koneksi.php';
include 'islogin.php';

?>
<?php
require_once 'steganography.php'; // Pastikan pustaka steganografi tersedia

// Fungsi enkripsi file dengan AES
function encryptFile($filePath, $key) {
    $data = file_get_contents($filePath);
    $cipher = "aes-256-cbc";
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($data, $cipher, $key, $options=0, $iv);
    return base64_encode($iv . $ciphertext);
}

// Fungsi dekripsi file dengan AES
function decryptFile($encryptedData, $key) {
    $cipher = "aes-256-cbc";
    $data = base64_decode($encryptedData);
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = substr($data, 0, $ivlen);
    $ciphertext = substr($data, $ivlen);
    return openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
}

// Fungsi untuk menyembunyikan gambar dalam gambar
//Steganography::hideImage('cover_image.png', 'secret_image.png', 'output_image.png');

// Fungsi untuk mengekstrak gambar dari gambar
//Steganography::extractImage('output_image.png', 'extracted_image.png');

//Fungsi untuk menyembunyikan pesan dalam gambar
function hideMessageInImage($imagePath, $message, $outputPath) {
    $image = imagecreatefrompng($imagePath);
    $steganography = new Steganography();
    $steganography->encode($image, $message, $outputPath);
}


//Fungsi untuk mengekstrak pesan dari gambar
function extractMessageFromImage($imagePath) {
    $image = imagecreatefrompng($imagePath);
    $steganography = new Steganography();
    return $steganography->decode($image);
}

$key = 'your-encryption-key'; // Ganti dengan kunci enkripsi yang aman

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses unggah file
    if (isset($_FILES['file'])) {
        $filePath = $_FILES['file']['tmp_name'];
        $encryptedData = encryptFile($filePath, $key);
        // Simpan data terenkripsi ke file
        file_put_contents('encrypted_file.dat', $encryptedData);
    }

    // Proses unggah gambar
    if (isset($_FILES['image'])) {
        $imagePath = $_FILES['image']['tmp_name'];
        $message = "User Identity Info"; // Ganti dengan informasi yang ingin disisipkan
        hideMessageInImage($imagePath, $message, 'hidden_image.png');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <label for="file">Upload File (for encryption):</label>
        <input type="file" name="file" id="file"><br><br>
        
        <label for="image">Upload Image (for steganography):</label>
        <input type="file" name="image" id="image"><br><br>
        
        <input type="submit" value="Submit">
    </form>

    <hr>

    <h2>Decrypted File Content:</h2>
    <?php
    if (file_exists('encrypted_file.dat')) {
        $encryptedData = file_get_contents('encrypted_file.dat');
        $decryptedData = decryptFile($encryptedData, $key);
        echo "<pre>" . htmlspecialchars($decryptedData) . "</pre>";
    }
    ?>

    <h2>Extracted Message from Image:</h2>
    <?php
    if (file_exists('hidden_image.png')) {
        $extractedMessage = extractMessageFromImage('hidden_image.png');
        echo "<p>" . htmlspecialchars($extractedMessage) . "</p>";
    }
    ?>
</body>
</html>