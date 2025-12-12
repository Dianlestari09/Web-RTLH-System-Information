<?php
// Panggil file ini di SETIAP halaman yang butuh login
// Ini akan cek session, jika tidak ada, lempar ke login.php

// Panggil koneksi (yang juga otomatis start session)
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    // Jika belum login, tendang ke halaman login
    header("Location: login.php?error=Anda harus login terlebih dahulu.");
    exit;
}

// Ambil data user dari session untuk digunakan di halaman
$USER_ID = $_SESSION['user_id'];
$USER_ROLE = $_SESSION['role'];
$USER_NAMA = $_SESSION['nama_lengkap'];
?>