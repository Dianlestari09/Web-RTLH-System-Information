<?php
require_once 'includes/check_auth.php'; // Cek login & role

// --- OTORISASI ---
if ($USER_ROLE != 'admin') {
    header("Location: index.php?error=Akses ditolak. Hanya admin yang dapat menjalankan proses Borda");
    exit;
}

// Cek jumlah DM yang sudah menilai (harus 3)
$sql_cek_dm = "SELECT COUNT(DISTINCT id_user) as jumlah_dm FROM hasil_topsis";
$result_cek = mysqli_query($koneksi, $sql_cek_dm);
$row_cek = mysqli_fetch_assoc($result_cek);
$jumlah_dm_selesai = $row_cek['jumlah_dm'];

// Cek jumlah user di sistem
$sql_total_dm = "SELECT COUNT(id) as total_dm FROM users";
$result_total_dm = mysqli_query($koneksi, $sql_total_dm);
$row_total_dm = mysqli_fetch_assoc($result_total_dm);
$total_dm_sistem = $row_total_dm['total_dm']; // Harusnya 3

if ($jumlah_dm_selesai < $total_dm_sistem) {
    header("Location: index.php?error=" . urlencode("Proses Borda Gagal. Baru $jumlah_dm_selesai dari $total_dm_sistem DM yang menyelesaikan penilaian TOPSIS."));
    exit;
}

// --- LANJUT JIKA SEMUA DM SUDAH MENILAI ---

try {
    mysqli_begin_transaction($koneksi);

    // 1. Ambil jumlah total alternatif (N)
    $sql_n = "SELECT COUNT(id) as N FROM alternatif";
    $result_n = mysqli_query($koneksi, $sql_n);
    $row_n = mysqli_fetch_assoc($result_n);
    $N = $row_n['N']; // Misal N = 5

    // 2. Ambil semua hasil ranking TOPSIS dari semua DM
    $sql_topsis = "SELECT id_alternatif, ranking FROM hasil_topsis";
    $result_topsis = mysqli_query($koneksi, $sql_topsis);
    
    $skor_borda = []; // Array untuk menampung total poin Borda

    // 3. Hitung Poin Borda
    // Rumus Poin Borda = N - ranking + 1
    // Peringkat 1 dapat N poin, Peringkat 2 dapat N-1 poin, ...
    while ($row = mysqli_fetch_assoc($result_topsis)) {
        $id_a = $row['id_alternatif'];
        $ranking = $row['ranking'];
        
        $poin = $N - $ranking + 1;
        
        if (!isset($skor_borda[$id_a])) {
            $skor_borda[$id_a] = 0;
        }
        $skor_borda[$id_a] += $poin;
    }

    // 4. Hapus hasil Borda lama (TRUNCATE)
    mysqli_query($koneksi, "TRUNCATE TABLE hasil_borda");

    // 5. Simpan hasil Borda baru
    $sql_ins_borda = "INSERT INTO hasil_borda (id_alternatif, total_poin, ranking_final) VALUES (?, ?, 0)"; // Ranking 0 dulu
    $stmt_ins_borda = mysqli_prepare($koneksi, $sql_ins_borda);
    foreach ($skor_borda as $id_a => $total_poin) {
        mysqli_stmt_bind_param($stmt_ins_borda, "ii", $id_a, $total_poin);
        mysqli_stmt_execute($stmt_ins_borda);
    }
    mysqli_stmt_close($stmt_ins_borda);
    
    // 6. Update Ranking Final berdasarkan total_poin
    $sql_select_rank = "SELECT id FROM hasil_borda ORDER BY total_poin DESC, id_alternatif ASC";
    $result_rank = mysqli_query($koneksi, $sql_select_rank);
    
    $ranking_final = 1;
    $sql_update_rank = "UPDATE hasil_borda SET ranking_final = ? WHERE id = ?";
    $stmt_update_rank = mysqli_prepare($koneksi, $sql_update_rank);
    
    while ($row_rank = mysqli_fetch_assoc($result_rank)) {
        $id_borda = $row_rank['id'];
        mysqli_stmt_bind_param($stmt_update_rank, "ii", $ranking_final, $id_borda);
        mysqli_stmt_execute($stmt_update_rank);
        $ranking_final++;
    }
    mysqli_stmt_close($stmt_update_rank);

    // 7. Commit Transaksi
    mysqli_commit($koneksi);

    header("Location: hasil_akhir.php?sukses=Konsensus Borda berhasil dijalankan.");
    exit;

} catch (Exception $e) {
    mysqli_rollback($koneksi);
    header("Location: index.php?error=" . urlencode("Terjadi error saat proses Borda: " . $e->getMessage()));
    exit;
}
?>