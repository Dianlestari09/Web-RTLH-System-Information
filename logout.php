<?php
require_once 'config/koneksi.php'; // untuk start session

session_unset();
session_destroy();

header("Location: login.php?success=Anda telah berhasil logout.");
exit;
?>