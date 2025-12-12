<?php 
require_once 'includes/header.php'; 

if(isset($_GET['sukses'])) {
    echo '<div class="alert alert-success">'.htmlspecialchars($_GET['sukses']).'</div>';
}
?>

<h2>🧑‍⚖️ Ranking TOPSIS per Decision Maker</h2>
<p>Berikut adalah hasil ranking alternatif berdasarkan nilai preferensi TOPSIS dari masing-masing Decision Maker sebelum dilakukan agregasi menggunakan Metode Borda.</p>

<?php
// Ambil semua decision maker yang telah melakukan penilaian TOPSIS (EXCLUDE admin karena admin hanya mengelola)
$sql_users = mysqli_query($koneksi, "SELECT id, nama_lengkap, role FROM users WHERE role IN ('staf_teknis','staf_sosial','kadinas')");

while ($u = mysqli_fetch_assoc($sql_users)) {
    $id_dm = $u['id'];
    echo "<div class='card mb-3'>
            <div class='card-header bg-secondary text-white'>
                <b>Decision Maker:</b> " . htmlspecialchars($u['nama_lengkap']) . " <small>(" . $u['role'] . ")</small>
            </div>
            <div class='card-body'>";

    $sql_topsis = "
        SELECT a.nama_pemilik AS alternatif, a.alamat, h.nilai_preferensi, h.ranking 
        FROM hasil_topsis AS h
        JOIN alternatif AS a ON h.id_alternatif = a.id
        WHERE h.id_user = $id_dm
        ORDER BY h.ranking ASC
    ";
    $result_topsis = mysqli_query($koneksi, $sql_topsis);

    if (mysqli_num_rows($result_topsis) > 0) {
        echo "<table class='table table-bordered'>
                <thead class='bg-dark text-white'>
                    <tr>
                        <th>Ranking</th>
                        <th>Alternatif</th>
                        <th>Alamat</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($row = mysqli_fetch_assoc($result_topsis)) {
            echo "<tr>
                <td><b>" . $row['ranking'] . "</b></td>
                <td>" . htmlspecialchars($row['alternatif']) . "</td>
                <td>" . htmlspecialchars($row['alamat']) . "</td>
                <td>" . number_format($row['nilai_preferensi'], 6) . "</td>
            </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p class='text-danger'>⚠ Belum ada hasil TOPSIS untuk Decision Maker ini!</p>";
    }

    echo "</div></div>";
}
?>

<hr>

<?php 
// Tombol Jalankan Konsensus Borda HANYA untuk Admin
if ($USER_ROLE == 'admin') {
?>
<div class="alert alert-info mb-4">
    <h5>🔧 Pengaturan Admin</h5>
    <p>Setelah semua Decision Maker (staf teknis, staf sosial, kadinas) selesai melakukan penilaian, tekan tombol di bawah untuk menjalankan proses konsensus Borda:</p>
    <a href="proses_borda.php" class="btn btn-success btn-lg">
        <i class="bi bi-play-circle"></i> Jalankan Konsensus Borda
    </a>
</div>
<?php 
} // akhir dari if
?>

<h3>🏆 Hasil Akhir Konsensus (Metode Borda)</h3>
<p>Ini adalah hasil final keputusan kelompok setelah menggabungkan semua suara (ranking individual) menggunakan Metode Borda.</p>

<div class="card">
    <div class="card-header bg-primary text-white">Ranking Final Prioritas Penerima Bantuan RTLH</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Ranking Final</th>
                    <th>Nama Pemilik (Alternatif)</th>
                    <th>Alamat</th>
                    <th>Total Poin Borda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_borda = "SELECT hb.*, a.nama_pemilik, a.alamat 
                            FROM hasil_borda hb
                            JOIN alternatif a ON hb.id_alternatif = a.id
                            ORDER BY hb.ranking_final ASC, hb.total_poin DESC";
                
                $result_borda = mysqli_query($koneksi, $sql_borda);
                
                if (mysqli_num_rows($result_borda) > 0) {
                    while($row = mysqli_fetch_assoc($result_borda)) {
                        echo "<tr>";
                        echo "<td><h4>" . htmlspecialchars($row['ranking_final']) . "</h4></td>";
                        echo "<td>" . htmlspecialchars($row['nama_pemilik']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                        echo "<td><b>" . htmlspecialchars($row['total_poin']) . "</b></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Belum ada hasil konsensus. Kepala Dinas harus menjalankan 'Proses Borda' terlebih dahulu.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
require_once 'includes/footer.php'; 
?>
