<?php
$password = 'Birdkitaaddmin'; // ganti dengan password yang diinginkan
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password hash: " . $hash;
?>
