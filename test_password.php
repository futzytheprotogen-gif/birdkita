<?php
$input = 'admin123';
$hash = '$2y$10$LZ3SkI6nLECkN/swdfG2LeEYF6S7z/dM5nA/kDQ2yD/RfYcD6e5cO';

if (password_verify($input, $hash)) {
    echo "Password cocok!";
} else {
    echo "Password salah!";
}
?>
