<?php
// File header ini akan dipanggil oleh halaman yang sudah login,
// jadi kita panggil 'check_auth.php'
require_once 'check_auth.php';

// Variabel $USER_ID, $USER_ROLE, $USER_NAMA sudah tersedia
// dari 'check_auth.php'
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDSS Penentuan RTLH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav .nav-link.active {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">GDSS RTLH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Dashboard</a>
        </li>
        
        <?php 
        // --- OTORISASI ---
        // Menu Kelola Kriteria dan Alternatif HANYA untuk 'admin'
        if ($USER_ROLE == 'admin') {
        ?>
            <li class="nav-item">
              <a class="nav-link" href="kriteria.php">Kelola Kriteria</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="alternatif.php">Kelola Alternatif</a>
            </li>
        <?php 
        } // akhir dari if
        ?>
        
        <?php 
        // Menu Penilaian TOPSIS HANYA untuk DM (Staf Teknis, Staf Sosial, Kadinas) - EXCLUDE Admin
        if ($USER_ROLE != 'admin') {
        ?>
            <li class="nav-item">
              <a class="nav-link" href="input_penilaian.php">Penilaian TOPSIS</a>
            </li>
        <?php 
        } // akhir dari if
        ?>

        <li class="nav-item">
          <a class="nav-link" href="hasil_akhir.php">Hasil Konsensus (POIN 5)</a>
        </li>
      </ul>
      
      <ul class="navbar-nav">
         <li class="nav-item">
            <span class="navbar-text text-white me-3">
              Halo, <?php echo htmlspecialchars($USER_NAMA); ?> (<?php echo htmlspecialchars($USER_ROLE); ?>)
            </span>
         </li>
         <li class="nav-item">
            <a class="btn btn-danger" href="logout.php">Logout</a>
         </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">