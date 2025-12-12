<?php
// --- Koneksi Database ---
$DB_HOST = "sql109.infinityfree.com";
$DB_USER = "if0_40379204";
$DB_PASS = "DianLestari9";
$DB_NAME = "if0_40379204_db_gdss_rtlh";

$koneksi = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// --- Mulai Session ---
// Selalu mulai session di file koneksi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>