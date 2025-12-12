<?php
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=Username dan password wajib diisi");
        exit;
    }

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Verifikasi user dan password
    if ($user && password_verify($password, $user['password'])) {
        // --- Login Berhasil ---
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role']; // PENTING!

        header("Location: index.php");
        exit;
    } else {
        header("Location: login.php?error=Username atau password salah");
        exit;
    }
    mysqli_stmt_close($stmt);
} else {
    header("Location: login.php");
    exit;
}
?>