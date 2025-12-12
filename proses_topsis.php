<?php
// Panggil file auth (koneksi, session, $USER_ID)
require_once 'includes/check_auth.php';

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_penilaian'])) {

    try {
        // Mulai "Transaksi"
        mysqli_begin_transaction($koneksi);

        // 1. Ambil data POST
        $bobot_post = $_POST['bobot']; // Array [id_kriteria] => nilai_bobot
        $nilai_post = $_POST['nilai']; // Array [id_alternatif][id_kriteria] => nilai

        // 2. Hapus data bobot & penilaian LAMA untuk user ini (agar bisa update)
        $sql_del_bobot = "DELETE FROM bobot_dm WHERE id_user = ?";
        $stmt_del_bobot = mysqli_prepare($koneksi, $sql_del_bobot);
        mysqli_stmt_bind_param($stmt_del_bobot, "i", $USER_ID);
        mysqli_stmt_execute($stmt_del_bobot);
        mysqli_stmt_close($stmt_del_bobot);

        $sql_del_nilai = "DELETE FROM penilaian WHERE id_user = ?";
        $stmt_del_nilai = mysqli_prepare($koneksi, $sql_del_nilai);
        mysqli_stmt_bind_param($stmt_del_nilai, "i", $USER_ID);
        mysqli_stmt_execute($stmt_del_nilai);
        mysqli_stmt_close($stmt_del_nilai);
        
        // 3. Hapus data hasil TOPSIS LAMA untuk user ini
        $sql_del_topsis = "DELETE FROM hasil_topsis WHERE id_user = ?";
        $stmt_del_topsis = mysqli_prepare($koneksi, $sql_del_topsis);
        mysqli_stmt_bind_param($stmt_del_topsis, "i", $USER_ID);
        mysqli_stmt_execute($stmt_del_topsis);
        mysqli_stmt_close($stmt_del_topsis);

        // 4. Simpan data bobot BARU
        $sql_ins_bobot = "INSERT INTO bobot_dm (id_user, id_kriteria, nilai_bobot) VALUES (?, ?, ?)";
        $stmt_ins_bobot = mysqli_prepare($koneksi, $sql_ins_bobot);
        foreach ($bobot_post as $id_kriteria => $nilai_bobot) {
            mysqli_stmt_bind_param($stmt_ins_bobot, "iid", $USER_ID, $id_kriteria, $nilai_bobot);
            mysqli_stmt_execute($stmt_ins_bobot);
        }
        mysqli_stmt_close($stmt_ins_bobot);

        // 5. Simpan data penilaian BARU
        $sql_ins_nilai = "INSERT INTO penilaian (id_user, id_alternatif, id_kriteria, nilai) VALUES (?, ?, ?, ?)";
        $stmt_ins_nilai = mysqli_prepare($koneksi, $sql_ins_nilai);
        foreach ($nilai_post as $id_alternatif => $kriteria_arr) {
            foreach ($kriteria_arr as $id_kriteria => $nilai) {
                mysqli_stmt_bind_param($stmt_ins_nilai, "iiii", $USER_ID, $id_alternatif, $id_kriteria, $nilai);
                mysqli_stmt_execute($stmt_ins_nilai);
            }
        }
        mysqli_stmt_close($stmt_ins_nilai);
        
        // --- MULAI PERHITUNGAN TOPSIS ---
        
        // Ambil data yang baru disimpan
        $matriks_x = []; // Matriks X (nilai)
        foreach ($nilai_post as $id_a => $kriteria_arr) {
            foreach ($kriteria_arr as $id_k => $nilai) {
                $matriks_x[$id_a][$id_k] = $nilai;
            }
        }
        
        $bobot_w = []; // Bobot W (sudah normalisasi)
        $total_bobot = array_sum($bobot_post);
        foreach($bobot_post as $id_k => $bobot) {
            $bobot_w[$id_k] = $bobot / $total_bobot;
        }
        
        // Ambil tipe kriteria (cost/benefit)
        $kriteria_tipe = [];
        $k_result = mysqli_query($koneksi, "SELECT id, tipe FROM kriteria");
        while($k_row = mysqli_fetch_assoc($k_result)) {
            $kriteria_tipe[$k_row['id']] = $k_row['tipe'];
        }

        // Tahap 1: Menghitung Pembagi (sqrt(sum(x_ij^2)))
        $pembagi = [];
        foreach ($matriks_x as $id_a => $kriteria_arr) {
            foreach ($kriteria_arr as $id_k => $nilai) {
                if (!isset($pembagi[$id_k])) $pembagi[$id_k] = 0;
                $pembagi[$id_k] += pow($nilai, 2);
            }
        }
        foreach ($pembagi as $id_k => $total) {
            $pembagi[$id_k] = sqrt($total);
        }

        // Tahap 2: Matriks Ternormalisasi (R)
        $matriks_r = [];
        foreach ($matriks_x as $id_a => $kriteria_arr) {
            foreach ($kriteria_arr as $id_k => $nilai) {
                $matriks_r[$id_a][$id_k] = $nilai / $pembagi[$id_k];
            }
        }

        // Tahap 3: Matriks Ternormalisasi Terbobot (Y)
        $matriks_y = [];
        foreach ($matriks_r as $id_a => $kriteria_arr) {
            foreach ($kriteria_arr as $id_k => $nilai_r) {
                $matriks_y[$id_a][$id_k] = $nilai_r * $bobot_w[$id_k];
            }
        }

        // Tahap 4: Menentukan Solusi Ideal Positif (A+) dan Negatif (A-)
        $solusi_a_plus = [];
        $solusi_a_minus = [];
        foreach ($bobot_w as $id_k => $bobot) { // Loop per kriteria
            $kolom_y = array_column($matriks_y, $id_k);
            if ($kriteria_tipe[$id_k] == 'benefit') {
                $solusi_a_plus[$id_k] = max($kolom_y);
                $solusi_a_minus[$id_k] = min($kolom_y);
            } else { // 'cost'
                $solusi_a_plus[$id_k] = min($kolom_y);
                $solusi_a_minus[$id_k] = max($kolom_y);
            }
        }

        // Tahap 5: Menghitung Jarak (D+ dan D-)
        $jarak_d_plus = [];
        $jarak_d_minus = [];
        foreach ($matriks_y as $id_a => $kriteria_arr) {
            $jarak_d_plus[$id_a] = 0;
            $jarak_d_minus[$id_a] = 0;
            foreach ($kriteria_arr as $id_k => $nilai_y) {
                $jarak_d_plus[$id_a] += pow($nilai_y - $solusi_a_plus[$id_k], 2);
                $jarak_d_minus[$id_a] += pow($nilai_y - $solusi_a_minus[$id_k], 2);
            }
            $jarak_d_plus[$id_a] = sqrt($jarak_d_plus[$id_a]);
            $jarak_d_minus[$id_a] = sqrt($jarak_d_minus[$id_a]);
        }

        // Tahap 6: Menghitung Nilai Preferensi (V)
        $nilai_v = [];
        foreach ($jarak_d_plus as $id_a => $d_plus) {
            $d_minus = $jarak_d_minus[$id_a];
            $nilai_v[$id_a] = $d_minus / ($d_minus + $d_plus);
        }

        // Tahap 7: Merangking dan Menyimpan Hasil
        arsort($nilai_v); // Urutkan dari terbesar (V) ke terkecil

        $sql_ins_topsis = "INSERT INTO hasil_topsis (id_user, id_alternatif, nilai_preferensi, ranking) VALUES (?, ?, ?, ?)";
        $stmt_ins_topsis = mysqli_prepare($koneksi, $sql_ins_topsis);
        
        $ranking = 1;
        foreach ($nilai_v as $id_a => $v) {
            mysqli_stmt_bind_param($stmt_ins_topsis, "iidi", $USER_ID, $id_a, $v, $ranking);
            mysqli_stmt_execute($stmt_ins_topsis);
            $ranking++;
        }
        mysqli_stmt_close($stmt_ins_topsis);

        // --- SELESAI PERHITUNGAN TOPSIS ---

        // Jika semua berhasil, commit transaksi
        mysqli_commit($koneksi);
        
        header("Location: input_penilaian.php?sukses=Perhitungan TOPSIS individual Anda berhasil disimpan.");
        exit;

    } catch (Exception $e) {
        // Jika ada error, rollback semua
        mysqli_rollback($koneksi);
        header("Location: input_penilaian.php?error=" . urlencode($e->getMessage()));
        exit;
    }

} else {
    // Jika diakses langsung
    header("Location: input_penilaian.php");
    exit;
}
?>