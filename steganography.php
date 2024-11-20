<?php


// class Steganography {

//     // Menyembunyikan pesan teks ke dalam gambar
//     public static function hideMessage($imagePath, $message, $outputImagePath) {
//         $image = imagecreatefrompng($imagePath);
//         $message .= "\0"; // Menambahkan terminator null untuk menandai akhir pesan
//         $messageBin = self::toBinary($message);
//         $messageLen = strlen($messageBin);

//         $index = 0;
//         for ($y = 0; $y < imagesy($image); $y++) {
//             for ($x = 0; $x < imagesx($image); $x++) {
//                 if ($index < $messageLen) {
//                     $rgb = imagecolorat($image, $x, $y);
//                     $colors = self::getColors($rgb);

//                     $colors['blue'] = self::replaceLSB($colors['blue'], $messageBin[$index]);

//                     $newColor = imagecolorallocate($image, $colors['red'], $colors['green'], $colors['blue']);
//                     imagesetpixel($image, $x, $y, $newColor);

//                     $index++;
//                 }
//             }
//         }

//         imagepng($image, $outputImagePath);
//         imagedestroy($image);
//     }

//     // Mengekstrak pesan teks dari gambar
//     public static function extractMessage($imagePath) {
//         $image = imagecreatefrompng($imagePath);
//         $messageBin = '';
//         for ($y = 0; $y < imagesy($image); $y++) {
//             for ($x = 0; $x < imagesx($image); $x++) {
//                 $rgb = imagecolorat($image, $x, $y);
//                 $colors = self::getColors($rgb);

//                 $messageBin .= self::getLSB($colors['blue']);
//             }
//         }
        
//         $message = self::fromBinary($messageBin);
//         $nullPos = strpos($message, "\0");
//         if ($nullPos !== false) {
//             $message = substr($message, 0, $nullPos); // Menghapus karakter null dan teks setelahnya
//         }

//         imagedestroy($image);
//         return $message;
//     }

//     private static function toBinary($text) {
//         $binary = '';
//         for ($i = 0; $i < strlen($text); $i++) {
//             $binary .= str_pad(decbin(ord($text[$i])), 8, '0', STR_PAD_LEFT);
//         }
//         return $binary;
//     }

//     private static function fromBinary($binary) {
//         $text = '';
//         for ($i = 0; $i < strlen($binary); $i += 8) {
//             $text .= chr(bindec(substr($binary, $i, 8)));
//         }
//         return $text;
//     }

//     private static function getColors($rgb) {
//         return [
//             'red' => ($rgb >> 16) & 0xFF,
//             'green' => ($rgb >> 8) & 0xFF,
//             'blue' => $rgb & 0xFF
//         ];
//     }

//     private static function getLSB($byte) {
//         return $byte & 1;
//     }

//     private static function replaceLSB($byte, $bit) {
//         return ($byte & 0xFE) | $bit;
//     }
// }

class Steganography {

    // Menyembunyikan gambar ke dalam gambar lain
    public static function hideImage($coverImagePath, $secretImagePath, $outputImagePath) {
        $coverImage = imagecreatefrompng($coverImagePath);
        $secretImage = imagecreatefrompng($secretImagePath);

        $width = imagesx($coverImage);
        $height = imagesy($coverImage);

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $coverPixel = imagecolorat($coverImage, $x, $y);
                $coverColors = self::getColors($coverPixel);

                $secretPixel = imagecolorat($secretImage, $x, $y);
                $secretColors = self::getColors($secretPixel);

                $newColor = self::mergeColors($coverColors, $secretColors);

                imagesetpixel($coverImage, $x, $y, $newColor);
            }
        }

        imagepng($coverImage, $outputImagePath);
        imagedestroy($coverImage);
        imagedestroy($secretImage);
    }

    // Mengekstrak gambar tersembunyi dari gambar
    public static function extractImage($stegoImagePath, $outputImagePath) {
        $stegoImage = imagecreatefrompng($stegoImagePath);

        $width = imagesx($stegoImage);
        $height = imagesy($stegoImage);
        $secretImage = imagecreatetruecolor($width, $height);

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $stegoPixel = imagecolorat($stegoImage, $x, $y);
                $stegoColors = self::getColors($stegoPixel);

                $secretColors = self::extractColors($stegoColors);

                $newColor = imagecolorallocate($secretImage, $secretColors['red'], $secretColors['green'], $secretColors['blue']);
                imagesetpixel($secretImage, $x, $y, $newColor);
            }
        }

        imagepng($secretImage, $outputImagePath);
        imagedestroy($stegoImage);
        imagedestroy($secretImage);
    }

    private static function getColors($rgb) {
        return [
            'red' => ($rgb >> 16) & 0xFF,
            'green' => ($rgb >> 8) & 0xFF,
            'blue' => $rgb & 0xFF
        ];
    }

    private static function mergeColors($coverColors, $secretColors) {
        $red = ($coverColors['red'] & 0xF0) | (($secretColors['red'] & 0xF0) >> 4);
        $green = ($coverColors['green'] & 0xF0) | (($secretColors['green'] & 0xF0) >> 4);
        $blue = ($coverColors['blue'] & 0xF0) | (($secretColors['blue'] & 0xF0) >> 4);

        return imagecolorallocate(imagecreatetruecolor(1, 1), $red, $green, $blue);
    }

    private static function extractColors($stegoColors) {
        $red = ($stegoColors['red'] & 0x0F) << 4;
        $green = ($stegoColors['green'] & 0x0F) << 4;
        $blue = ($stegoColors['blue'] & 0x0F) << 4;

        return ['red' => $red, 'green' => $green, 'blue' => $blue];
    }
}
?>
