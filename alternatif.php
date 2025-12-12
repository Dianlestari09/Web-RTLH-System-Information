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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_alternatif'])) {
    $nama = $_POST['nama_pemilik'];
    $alamat = $_POST['alamat'];
    
    $sql_insert = "INSERT INTO alternatif (nama_pemilik, alamat) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql_insert);
    mysqli_stmt_bind_param($stmt, "ss", $nama, $alamat);
    
    if(mysqli_stmt_execute($stmt)) {
        $pesan = "<div class='alert alert-success'>Alternatif berhasil ditambahkan.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menambahkan alternatif.</div>";
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA HAPUS (DELETE) ---
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $sql_delete = "DELETE FROM alternatif WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql_delete);
    mysqli_stmt_bind_param($stmt, "i", $id_hapus);
    if(mysqli_stmt_execute($stmt)) {
        $pesan = "<div class='alert alert-success'>Alternatif berhasil dihapus.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menghapus alternatif.</div>";
    }
    mysqli_stmt_close($stmt);
}

// --- LOGIKA UPDATE (EDIT) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_alternatif'])) {
    $id_edit = $_POST['edit_id'];
    $nama = $_POST['edit_nama_pemilik'];
    $alamat = $_POST['edit_alamat'];

    $sql_update = "UPDATE alternatif SET nama_pemilik=?, alamat=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $sql_update);
    mysqli_stmt_bind_param($stmt, "ssi", $nama, $alamat, $id_edit);

    if(mysqli_stmt_execute($stmt)) {
        $pesan = "<div class='alert alert-success'>Data alternatif berhasil diperbarui.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal memperbarui data alternatif.</div>";
    }
    mysqli_stmt_close($stmt);
}

?>

<h3>Kelola Data Alternatif (Rumah)</h3>
<?php echo $pesan; // Tampilkan pesan sukses/error ?>

<div class="card mb-4">
    <div class="card-header">Tambah Alternatif Baru</div>
    <div class="card-body">
        <form action="alternatif.php" method="POST">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control" placeholder="mis: Bapak Budi" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="mis: Jl. Merdeka No. 1" required>
                </div>
                <div class="col-md-2 align-self-end">
                    <button type="submit" name="submit_alternatif" class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Daftar Alternatif Saat Ini</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemilik</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_select = "SELECT * FROM alternatif ORDER BY id ASC";
                $result = mysqli_query($koneksi, $sql_select);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>A" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_pemilik']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                        echo "<td>";
                        
                        //--button--
                        echo "<a href='#' class='btn btn-warning btn-sm'
                                data-bs-toggle='modal' 
                                data-bs-target='#modalEdit$row[id]'>Edit</a> ";

                        echo "<a href='alternatif.php?hapus=" . $row['id'] . "' 
                                class='btn btn-danger btn-sm' 
                                onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>";

                        echo "</td>";
                        echo "</tr>";

                        // Modal Edit Alternatif
                        echo "
                        <div class='modal fade' id='modalEdit$row[id]' tabindex='-1'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>

                            <form method='POST' action='alternatif.php'>
                                <div class='modal-header bg-warning'>
                                <h5 class='modal-title'>Edit Alternatif</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>

                                <div class='modal-body'>
                                    <input type='hidden' name='edit_id' value='$row[id]'>

                                    <div class='mb-3'>
                                        <label class='form-label'>Nama Pemilik</label>
                                        <input type='text' name='edit_nama_pemilik' class='form-control' 
                                            value='".htmlspecialchars($row['nama_pemilik'])."' required>
                                    </div>

                                    <div class='mb-3'>
                                        <label class='form-label'>Alamat</label>
                                        <input type='text' name='edit_alamat' class='form-control' 
                                            value='".htmlspecialchars($row['alamat'])."' required>
                                    </div>
                                </div>

                                <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                <button type='submit' name='update_alternatif' class='btn btn-primary'>Simpan Perubahan</button>
                                </div>

                            </form>

                            </div>
                        </div>
                        </div>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Belum ada data alternatif.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
<?php include 'includes/pet_kucing.php';
?>
