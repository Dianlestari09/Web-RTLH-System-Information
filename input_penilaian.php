<?php 
require_once 'includes/header.php'; 

// Ambil semua kriteria dan alternatif
$kriteria_result = mysqli_query(
    $koneksi,
    "SELECT * FROM kriteria ORDER BY CAST(SUBSTRING(kode_kriteria, 2) AS UNSIGNED) ASC"
);
$alternatif_result = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY id ASC");

// Simpan ke array agar mudah di-loop
$kriteria_list = [];
while ($row = mysqli_fetch_assoc($kriteria_result)) {
    $kriteria_list[$row['id']] = $row;
}

$alternatif_list = [];
while ($row = mysqli_fetch_assoc($alternatif_result)) {
    $alternatif_list[$row['id']] = $row;
}

// Ambil data bobot & penilaian SEBELUMNYA dari user ini (jika ada)
$bobot_user = [];
$sql_bobot = "SELECT id_kriteria, nilai_bobot FROM bobot_dm WHERE id_user = ?";
$stmt_bobot = mysqli_prepare($koneksi, $sql_bobot);
mysqli_stmt_bind_param($stmt_bobot, "i", $USER_ID);
mysqli_stmt_execute($stmt_bobot);
$result_bobot = mysqli_stmt_get_result($stmt_bobot);
while($row = mysqli_fetch_assoc($result_bobot)) {
    $bobot_user[$row['id_kriteria']] = $row['nilai_bobot'];
}
mysqli_stmt_close($stmt_bobot);

$penilaian_user = [];
$sql_nilai = "SELECT id_alternatif, id_kriteria, nilai FROM penilaian WHERE id_user = ?";
$stmt_nilai = mysqli_prepare($koneksi, $sql_nilai);
mysqli_stmt_bind_param($stmt_nilai, "i", $USER_ID);
mysqli_stmt_execute($stmt_nilai);
$result_nilai = mysqli_stmt_get_result($stmt_nilai);
while($row = mysqli_fetch_assoc($result_nilai)) {
    $penilaian_user[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
}
mysqli_stmt_close($stmt_nilai);

// Tampilkan pesan
if(isset($_GET['sukses'])) {
    echo '<div class="alert alert-success">'.htmlspecialchars($_GET['sukses']).'</div>';
}
if(isset($_GET['error'])) {
    echo '<div class="alert alert-danger">'.htmlspecialchars($_GET['error']).'</div>';
}
?>

<h3>Form Penilaian Individual (Metode TOPSIS)</h3>
<p>Halo <b><?php echo htmlspecialchars($USER_NAMA); ?></b>, silakan masukkan preferensi bobot dan nilai Anda.</p>

<form action="proses_topsis.php" method="POST">
    
    <div class="card mb-4">
        <div class="card-header">1. Input Bobot Kriteria (Versi Anda)</div>
        <div class="card-body">
            <div class="row g-3">
                <?php foreach ($kriteria_list as $id_k => $k): ?>
                    <div class="col-md-3">
                        <label class="form-label"><?php echo htmlspecialchars($k['nama_kriteria']); ?> (<?php echo htmlspecialchars($k['kode_kriteria']); ?>)</label>
                        <input type="number" name="bobot[<?php echo $id_k; ?>]" class="form-control" 
                               value="<?php echo isset($bobot_user[$id_k]) ? htmlspecialchars($bobot_user[$id_k]) : ''; ?>" 
                               placeholder="Bobot (1-5)" min="1" max="5" required>
                    </div>
                <?php endforeach; ?>
            </div>
            <small class="form-text text-muted">Isi bobot (misal 1-5) sesuai tingkat kepentingan menurut Anda.</small>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">2. Input Matriks Penilaian (Skala 1-5)</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Alternatif (Rumah)</th>
                            <?php foreach ($kriteria_list as $k): ?>
                                <th><?php echo htmlspecialchars($k['nama_kriteria']); ?> (<?php echo htmlspecialchars(ucfirst($k['tipe'])); ?>)</th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alternatif_list as $id_a => $a): ?>
                            <tr>
                                <td class="text-start"><?php echo htmlspecialchars($a['nama_pemilik']); ?></td>
                                <?php foreach ($kriteria_list as $id_k => $k): ?>
                                    <td>
                                        <input type="number" name="nilai[<?php echo $id_a; ?>][<?php echo $id_k; ?>]" 
                                               class="form-control" 
                                               value="<?php echo isset($penilaian_user[$id_a][$id_k]) ? htmlspecialchars($penilaian_user[$id_a][$id_k]) : ''; ?>"
                                               placeholder="1-5" min="1" max="5" required>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($alternatif_list) || empty($kriteria_list)): ?>
                            <tr>
                                <td colspan="<?php echo count($kriteria_list) + 1; ?>" class="text-center text-danger">
                                    Data Kriteria atau Alternatif masih kosong. Harap hubungi Kepala Dinas.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <small class="form-text text-muted">Isi nilai 1 (Sangat Buruk) s/d 5 (Sangat Baik) untuk setiap kriteria.</small>
        </div>
    </div>

    <?php if (!empty($alternatif_list) && !empty($kriteria_list)): ?>
    <button type="submit" name="submit_penilaian" class="btn btn-primary btn-lg w-100">Simpan dan Hitung TOPSIS (Individual)</button>
    <?php endif; ?>
</form>

<?php 
require_once 'includes/footer.php'; 
?>