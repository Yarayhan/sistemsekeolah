<?php
$host = "localhost";      // biasanya localhost
$user = "root";           // user default di XAMPP adalah root
$password = "";           // default kosong (kalau belum diubah)
$database = "smks_hangtuah";  // nama database yang sudah dibuat

// buat koneksi
$conn = new mysqli($host, $user, $password, $database);

// cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil!";
?>
