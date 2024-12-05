<?php
// Fungsi Caesar Cipher
if (!function_exists('caesar_encrypt')) {
    function caesar_encrypt($text, $shift) {
        $result = "";
        $length = strlen($text);
        for ($i = 0; $i < $length; $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $offset = ctype_upper($char) ? 65 : 97;
                $result .= chr((ord($char) + $shift - $offset) % 26 + $offset);
            } else {
                $result .= $char;
            }
        }
        return $result;
    }
}

// Fungsi XOR Cipher
if (!function_exists('xor_encrypt')) {
    function xor_encrypt($text, $key) {
        $result = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $result .= $text[$i] ^ $key[$i % strlen($key)];
        }
        return $result;
    }
}

// Fungsi kombinasi Caesar + XOR (Super Enkripsi)
if (!function_exists('super_encrypt')) {
    function super_encrypt($text, $shift, $key) {
        $caesar_text = caesar_encrypt($text, $shift);
        return xor_encrypt($caesar_text, $key);
    }
}

// Fungsi Dekripsi kombinasi Caesar + XOR
if (!function_exists('super_decrypt')) {
    function super_decrypt($text, $shift, $key) {
        $xor_text = xor_encrypt($text, $key);
        return caesar_encrypt($xor_text, 26 - $shift); // Dekripsi Caesar
    }
}
?>


<?php 
// function encryptFile($filePath, $key) {
//     $data = file_get_contents($filePath);
//     $cipher = "aes-256-cbc";
//     $ivlen = openssl_cipher_iv_length($cipher);
//     $iv = openssl_random_pseudo_bytes($ivlen);
//     $ciphertext = openssl_encrypt($data, $cipher, $key, $options=0, $iv);
//     return base64_encode($iv . $ciphertext);
// }

// function saveEncryptedFile($encryptedData, $outputPath) {
//     file_put_contents($outputPath, $encryptedData);
// }

// function decryptFile($encryptedData, $key) {
//     $cipher = "aes-256-cbc";
//     $data = base64_decode($encryptedData);
//     $ivlen = openssl_cipher_iv_length($cipher);
//     $iv = substr($data, 0, $ivlen);
//     $ciphertext = substr($data, $ivlen);
//     return openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
// }

// function saveDecryptedFile($decryptedData, $outputPath) {
//     file_put_contents($outputPath, $decryptedData);
// }
?>