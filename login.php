<?php
// Jika user sudah login, lempar ke index.php
require_once 'config/koneksi.php';
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - GDSS RTLH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="text-center">LOGIN GDSS RTLH</h2>
        <p class="text-center">Sistem Penentuan Rumah Tidak Layak Huni</p>
        
        <?php 
        // Tampilkan pesan error jika ada dari URL
        if(isset($_GET['error'])) {
            echo '<div class="alert alert-danger">'.htmlspecialchars($_GET['error']).'</div>';
        }
        // Tampilkan pesan sukses (misal setelah logout)
        if(isset($_GET['success'])) {
            echo '<div class="alert alert-success">'.htmlspecialchars($_GET['success']).'</div>';
        }
        ?>

        <form action="proses_login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="mt-3 text-center">
            <small>Gunakan akun:<br>
                (kadinas / 12345)<br>
                (teknis / 12345)<br>
                (sosial / 12345)<br>
                (admin / 12345)
            </small>
        </div>
    </div>
</body>
</html>