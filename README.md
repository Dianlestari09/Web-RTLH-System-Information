# Sistem Pendukung Keputusan RTLH (GDSS RTLH)
**Grup Decision Support System untuk Rumah Tidak Layak Huni**

---

## 📋 Deskripsi Project

Sistem Pendukung Keputusan Rumah Tidak Layak Huni (GDSS RTLH) adalah aplikasi web yang dirancang untuk membantu proses evaluasi dan pengambilan keputusan dalam identifikasi rumah-rumah yang tidak layak huni (RTLH). 

Sistem ini menggunakan metode **TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution)** untuk evaluasi individual dan **Borda Count** untuk konsensus grup (Group Decision Support System).

---

## 🌐 Website Hosting

**Akses Aplikasi:** [http://sistem-rtlh.free.nf](http://sistem-rtlh.free.nf)

---

## ✨ Fitur Utama

### 1. **Manajemen Pengguna**
- Sistem login dengan role-based access (Admin, Staf Teknis, Staf Sosial, Kepala Dinas)
- Manajemen user oleh admin

### 2. **Pengelolaan Data Master**
- **Kriteria:** Admin dapat menambah, mengubah, dan menghapus kriteria penilaian
- **Alternatif:** Admin dapat mengelola data rumah/pemilik yang akan dinilai

### 3. **Proses Penilaian (TOPSIS)**
- Setiap Decision Maker dapat melakukan penilaian dengan:
  - Menginput bobot untuk setiap kriteria
  - Menginput nilai untuk setiap alternatif
- Sistem otomatis menghitung ranking TOPSIS

### 4. **Konsensus Grup (Borda Count)**
- Admin dapat menjalankan proses konsensus berdasarkan hasil TOPSIS dari semua Decision Maker
- Sistem menghitung skor Borda dan menghasilkan ranking final

### 5. **Laporan Hasil**
- Visualisasi hasil penilaian individual (TOPSIS)
- Visualisasi hasil konsensus akhir

---

## 🛠️ Alur Kerja Sistem

```
1. ADMIN
   ├─ Mengelola Kriteria (menu "Kelola Kriteria")
   └─ Mengelola Alternatif (menu "Kelola Alternatif")

2. DECISION MAKERS (Semua)
   ├─ Login ke akun masing-masing
   │  ├─ Staf Teknis
   │  ├─ Staf Sosial
   │  └─ Kepala Dinas
   └─ Input penilaian di menu "Penilaian TOPSIS"
      ├─ Tentukan bobot kriteria
      └─ Nilai setiap rumah

3. SISTEM
   ├─ Hitung ranking TOPSIS untuk setiap DM
   └─ Simpan hasil penilaian individual

4. ADMIN (Setelah semua DM selesai)
   └─ Jalankan "Konsensus Borda" di halaman "Hasil Konsensus"

5. SISTEM
   ├─ Hitung skor Borda dari semua hasil TOPSIS
   └─ Simpan hasil akhir

6. DECISION MAKERS (Semua)
   └─ Lihat hasil akhir di menu "Hasil Konsensus"
```

---

## 📁 Struktur File

```
GDDS RTLH/
├── index.php                    # Dashboard utama
├── login.php                    # Halaman login
├── logout.php                   # Proses logout
├── buat_user.php                # Manajemen user (admin)
├── kriteria.php                 # Manajemen kriteria
├── alternatif.php               # Manajemen alternatif
├── input_penilaian.php          # Form penilaian TOPSIS
├── proses_topsis.php            # Proses perhitungan TOPSIS
├── proses_borda.php             # Proses perhitungan Borda
├── hasil_akhir.php              # Tampil hasil akhir
├── proses_login.php             # Validasi login
├── if0_40379204_db_gdss_rtlh.sql # Database (backup SQL)
│
├── config/
│   └── koneksi.php              # Konfigurasi database
│
├── includes/
│   ├── check_auth.php           # Validasi session
│   ├── header.php               # Template header
│   ├── footer.php               # Template footer
│   └── pet_kucing.php           # JavaScript tambahan
│
└── assets/
    ├── css/
    │   └── pet_kucing.css        # Styling CSS
    ├── img/                      # Folder gambar
    └── js/
        └── pet_kucing.js         # Script JavaScript
```

---

## 💻 Teknologi yang Digunakan

| Aspek | Teknologi |
|-------|-----------|
| **Backend** | PHP 7.2+ |
| **Frontend** | HTML5, CSS, JavaScript, Bootstrap |
| **Database** | MySQL/MariaDB |
| **Server** | InfinityFree (Free Hosting) |
| **Metode DSS** | TOPSIS & Borda Count |

---

## 🔧 Instalasi & Setup

### Prasyarat
- PHP 7.2 atau lebih tinggi
- MySQL/MariaDB
- Web Server (Apache/Nginx)

### Langkah Instalasi

1. **Clone/Download Project**
   ```bash
   git clone <repository-url>
   # atau download ZIP
   ```

2. **Setup Database**
   - Buat database baru: `if0_40379204_db_gdss_rtlh`
   - Import file SQL:
     ```
     if0_40379204_db_gdss_rtlh.sql
     ```

3. **Konfigurasi Koneksi Database**
   - Edit file `config/koneksi.php`
   - Sesuaikan kredensial database:
     ```php
     $DB_HOST = "localhost";      // Host database
     $DB_USER = "root";           // Username
     $DB_PASS = "password";       // Password
     $DB_NAME = "db_gdss_rtlh";  // Nama database
     ```

4. **Akses Aplikasi**
   - Buka browser: `http://localhost/GDDS%20RTLH/`
   - Login dengan kredensial default (lihat database)

---

## 👥 Peran Pengguna (Role)

| Role | Akses |
|------|-------|
| **Admin** | Kelola kriteria, alternatif, user, jalankan konsensus |
| **Staf Teknis** | Input penilaian, lihat hasil |
| **Staf Sosial** | Input penilaian, lihat hasil |
| **Kepala Dinas** | Input penilaian, lihat hasil |

---

## 📊 Metode Perhitungan

### TOPSIS (Technique for Order of Preference by Similarity to Ideal Solution)
Metode yang digunakan oleh setiap Decision Maker untuk mengevaluasi alternatif berdasarkan:
- Bobot kriteria
- Nilai setiap alternatif
- Normalisasi dan perhitungan jarak ideal

### Borda Count (Konsensus Grup)
Metode yang digunakan untuk mengagregasi hasil dari semua Decision Maker:
- Setiap DM memberikan ranking
- Skor Borda dihitung berdasarkan posisi ranking
- Hasil akhir adalah ranking berdasarkan skor Borda tertinggi

---

## 🚀 Cara Menggunakan

### Admin
1. Login dengan akun admin
2. Setup data: Kelola Kriteria → Kelola Alternatif
3. Tambah user (Decision Maker)
4. Tunggu semua DM selesai penilaian
5. Jalankan Konsensus Borda

### Decision Maker
1. Login dengan akun masing-masing
2. Masuk menu "Penilaian TOPSIS"
3. Tentukan bobot untuk setiap kriteria
4. Input nilai untuk setiap rumah
5. Submit penilaian

### Melihat Hasil
- Hasil individual: Tersedia setelah submit penilaian
- Hasil akhir: Tersedia setelah admin menjalankan konsensus

---

## 📝 Catatan Penting

- Pastikan semua Decision Maker telah menyelesaikan penilaian sebelum menjalankan konsensus
- Sistem menggunakan session untuk validasi login
- Data sensitif (password) disimpan aman di database
- Backup database secara berkala

---

## 👨‍💻 Pengembang

**Information System Practicum - Semester 5**

---

## 📄 Lisensi

Educational Purpose - Tugas Kuliah

---

## 🔗 Link Penting

- **Website Hosting:** [http://sistem-rtlh.free.nf](http://sistem-rtlh.free.nf)
- **Database:** sql109.infinityfree.com (InfinityFree)

---

## ❓ Troubleshooting

### Masalah: Koneksi Database Gagal
- Cek kredensial database di `config/koneksi.php`
- Pastikan database sudah dibuat
- Pastikan user database memiliki akses yang cukup

### Masalah: Login Tidak Berhasil
- Pastikan database sudah di-import
- Cek apakah ada user di tabel `user`

### Masalah: Session Hilang
- Clear browser cache
- Pastikan cookie diaktifkan di browser
- Cek file `includes/check_auth.php`

---

**Last Updated:** Desember 2025
