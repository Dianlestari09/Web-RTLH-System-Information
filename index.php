<?php 
// 1. Panggil header (otomatis cek login & ambil data user)
require_once 'includes/header.php'; 
?>

<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Selamat Datang, <?php echo htmlspecialchars($USER_NAMA); ?>!</h1>
    <p class="col-md-8 fs-4">
      Anda login sebagai <b><?php echo htmlspecialchars($USER_ROLE); ?></b>.
      Silakan gunakan menu navigasi di atas untuk mengelola data atau melakukan penilaian.
    </p>
  </div>
</div>

<h3>Alur Kerja Sistem (GDSS)</h3>
<ol>
    <li><b>(Admin)</b> Mengelola data Kriteria (di menu "Kelola Kriteria") dan Alternatif (di menu "Kelola Alternatif").</li>
    <li><b>(Semua Decision Maker)</b> Login ke akun masing-masing (Staf Teknis, Staf Sosial, Kepala Dinas/Kadinas).</li>
    <li><b>(Semua DM)</b> Masuk ke menu "Penilaian TOPSIS" untuk menginput bobot kriteria dan nilai untuk setiap rumah.</li>
    <li><b>(Sistem)</b> Setelah submit, sistem akan menghitung dan menyimpan ranking TOPSIS (penilaian individual).</li>
    <li><b>(Admin)</b> Setelah semua DM (teknis, sosial, kadinas) selesai menilai, Admin menekan tombol "Jalankan Konsensus Borda" di halaman "Hasil Konsensus".</li>
    <li><b>(Sistem)</b> Menghitung skor Borda dari semua hasil TOPSIS dan menyimpan 1 hasil akhir.</li>
    <li><b>(Semua DM)</b> Dapat melihat hasil akhir di menu "Hasil Konsensus (POIN 5)".</li>
</ol>


<?php 
// 3. Panggil footer
require_once 'includes/footer.php'; 
?>
<?php include 'includes/pet_kucing.php';
?>