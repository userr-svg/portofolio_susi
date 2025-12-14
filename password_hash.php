<?php
// GANTI PASSWORD DI SINI
$password = "123456";

// Generate hash
$hash = password_hash($password, PASSWORD_DEFAULT);

// Tampilkan hasil
echo "Password Asli : " . $password . "<br>";
echo "Password Hash : <br><textarea rows='3' cols='80'>" . $hash . "</textarea>";
?>
