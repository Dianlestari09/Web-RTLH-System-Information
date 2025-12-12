<?php 
require_once 'includes/header.php'; 

// --- OTORISASI ---
if ($USER_ROLE != 'admin') {
    echo "<div class='alert alert-danger'>Akses ditolak. Halaman ini hanya untuk Admin.</div>";
    require_once 'includes/footer.php';
    exit;
}

$pesan = "";

// --- LOGIKA SIMPAN (INSERT) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_kriteria'])) {
    $kode = $_POST['kode_kriteria'];
    $nama = $_POST['nama_kriteria'];
    $tipe = $_POST['tipe'];
    
    $sql_insert = "INSERT INTO kriteria (kode_kriteria, nama_kriteria, tipe) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql_insert);
    mysqli_stmt_bind_param($stmt, "sss", $kode, $nama, $tipe);
    
    if(mysqli_stmt_execute($stmt)) {
        $pesan = "<div class='alert alert-success'>Kriteria berhasil ditambahkan.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menambahkan kriteria.</div>";
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA HAPUS (DELETE) ---
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $sql_delete = "DELETE FROM kriteria WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql_delete);
    mysqli_stmt_bind_param($stmt, "i", $id_hapus);
    if(mysqli_stmt_execute($stmt)) {
        $pesan = "<div class='alert alert-success'>Kriteria berhasil dihapus.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menghapus kriteria.</div>";
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA UPDATE (EDIT) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_kriteria'])) {
    $id_edit = $_POST['edit_id'];
    $kode = $_POST['edit_kode_kriteria'];
    $nama = $_POST['edit_nama_kriteria'];
    $tipe = $_POST['edit_tipe'];

    $sql_update = "UPDATE kriteria SET kode_kriteria=?, nama_kriteria=?, tipe=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $sql_update);
    mysqli_stmt_bind_param($stmt, "sssi", $kode, $nama, $tipe, $id_edit);

    if (mysqli_stmt_execute($stmt)) {
        $pesan = "<div class='alert alert-success'>Kriteria berhasil diperbarui.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal memperbarui kriteria.</div>";
    }
    mysqli_stmt_close($stmt);
}

?>

<h3>Kelola Data Kriteria</h3>
<?php echo $pesan; // Tampilkan pesan sukses/error ?>

<div class="card mb-4">
    <div class="card-header">Tambah Kriteria Baru</div>
    <div class="card-body">
        <form action="kriteria.php" method="POST">
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">Kode (C1)</label>
                    <input type="text" name="kode_kriteria" class="form-control" placeholder="C1" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Nama Kriteria</label>
                    <input type="text" name="nama_kriteria" class="form-control" placeholder="mis: Kondisi Atap" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tipe</label>
                    <select name="tipe" class="form-select" required>
                        <option value="benefit">Benefit (Makin tinggi makin baik)</option>
                        <option value="cost">Cost (Makin rendah makin baik)</option>
                    </select>
                </div>
                <div class="col-md-2 align-self-end">
                    <button type="submit" name="submit_kriteria" class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Daftar Kriteria Saat Ini</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_select = "SELECT * FROM kriteria 
               ORDER BY CAST(SUBSTRING(kode_kriteria, 2) AS UNSIGNED) ASC";

                $result = mysqli_query($koneksi, $sql_select);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['kode_kriteria']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_kriteria']) . "</td>";
                        echo "<td>" . htmlspecialchars(ucfirst($row['tipe'])) . "</td>";
                        echo "<td>";

                        //--button--
                        echo "<a href='#' class='btn btn-warning btn-sm' 
                                data-bs-toggle='modal' 
                                data-bs-target='#modalEdit$row[id]'
                                >Edit</a> ";

                        echo "<a href='kriteria.php?hapus=" . $row['id'] . "' 
                                class='btn btn-danger btn-sm' 
                                onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";

                        //--Modal Edit--
                        echo "
                        <div class='modal fade' id='modalEdit$row[id]' tabindex='-1'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>

                            <form method='POST' action='kriteria.php'>
                                <div class='modal-header bg-warning'>
                                <h5 class='modal-title'>Edit Kriteria</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>

                                <div class='modal-body'>
                                    <input type='hidden' name='edit_id' value='$row[id]'>

                                    <div class='mb-3'>
                                        <label class='form-label'>Kode Kriteria</label>
                                        <input type='text' name='edit_kode_kriteria' class='form-control' value='".htmlspecialchars($row['kode_kriteria'])."' required>
                                    </div>

                                    <div class='mb-3'>
                                        <label class='form-label'>Nama Kriteria</label>
                                        <input type='text' name='edit_nama_kriteria' class='form-control' value='".htmlspecialchars($row['nama_kriteria'])."' required>
                                    </div>

                                    <div class='mb-3'>
                                        <label class='form-label'>Tipe</label>
                                        <select name='edit_tipe' class='form-select'>
                                            <option value='benefit' ".($row['tipe']=='benefit'?'selected':'').">Benefit</option>
                                            <option value='cost' ".($row['tipe']=='cost'?'selected':'').">Cost</option>
                                        </select>
                                    </div>

                                </div>

                                <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                <button type='submit' name='update_kriteria' class='btn btn-primary'>Simpan Perubahan</button>
                                </div>

                            </form>

                            </div>
                        </div>
                        </div>
                        ";

                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Belum ada data kriteria.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
require_once 'includes/footer.php'; 
?>