<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Validasi input kosong
if (empty($username) || empty($password) || empty($role)) {
    echo "<script>alert('Semua kolom harus diisi!'); window.history.back();</script>";
    exit;
}

// Cari user di database
$stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($hash_password, $db_role);
    $stmt->fetch();

    if (password_verify($password, $hash_password) && $role === $db_role) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        if ($role === 'admin') {
            header("Location: admin.html");
            exit;
        } elseif ($role === 'guru') {
            header("Location: guru.html");
            exit;
        } elseif ($role === 'siswa') {
            echo "<script>alert('Login sebagai siswa berhasil (halaman siswa belum dibuat).'); window.location.href='index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Username, password, atau role salah!'); window.history.back();</script>";
        exit;
    }
} else {
    echo "<script>alert('Username tidak ditemukan!'); window.history.back();</script>";
    exit;
}
?>

