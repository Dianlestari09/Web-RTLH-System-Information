<?php
require_once 'config/koneksi.php';

// Data untuk 3 Decision Maker
$users = [
    [
        'username' => 'teknis',
        'password' => '12345', // Password akan di-hash
        'nama_lengkap' => 'Staf Teknis Lapangan',
        'role' => 'staf_teknis'
    ],
    [
        'username' => 'sosial',
        'password' => '12345',
        'nama_lengkap' => 'Staf Sosial Kemasyarakatan',
        'role' => 'staf_sosial'
    ],
    [
        'username' => 'kadinas',
        'password' => '12345',
        'nama_lengkap' => 'Kepala Dinas',
        'role' => 'kepala_dinas'
    ]
];

$sql = "INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $sql);

foreach ($users as $user) {
    // Hash password untuk keamanan
    $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ssss", 
        $user['username'], 
        $hashed_password, 
        $user['nama_lengkap'], 
        $user['role']
    );
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Berhasil membuat user: " . $user['username'] . "<br>";
    } else {
        echo "Gagal membuat user: " . $user['username'] . " (Mungkin sudah ada) <br>";
    }
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);

echo "<hr><a href='login.php'>Kembali ke Login</a>";
?>