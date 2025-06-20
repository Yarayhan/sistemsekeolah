<?php
$password_plain = "admin123";
$hash = password_hash($password_plain, PASSWORD_DEFAULT);
echo $hash;
?>