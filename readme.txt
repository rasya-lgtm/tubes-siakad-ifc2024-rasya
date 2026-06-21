# [tubes-siakad-kelas-npm-nama]

> **Link Hosting:** [Isi Link Hosting Lu di Sini - Contoh: https://siakad-rasya.up.railway.app]

## Deskripsi Singkat
Aplikasi SIAKAD ini adalah sistem informasi akademik berbasis web yang dibangun menggunakan **Laravel 11**. Aplikasi ini dirancang untuk mensimulasikan proses pengelolaan data akademik mulai dari data master (Dosen, Mahasiswa, Matakuliah) hingga proses pengisian KRS oleh mahasiswa.

## Akun Testing
Gunakan akun berikut untuk menguji aplikasi:
- **Admin:** `admin@gmail.com` | Password: `admin`
- **Mahasiswa:** `mahasiswa@gmail.com` | Password: `mahasiswa`

## Fitur Utama
- Authentication & Authorization: Login multi-role (Admin & Mahasiswa) menggunakan Middleware.
- Manajemen Data (CRUD):** Kelola data Dosen, Mahasiswa, Matakuliah, dan Jadwal (Khusus Admin).
- Manajemen KRS:** Mahasiswa dapat mengambil dan menghapus (drop) mata kuliah.
- **Dashboard Statistik:** Ringkasan jumlah data pada halaman utama.
- **Validasi Form:** Implementasi Laravel Validation di setiap input.

## Penjelasan Fungsi Halaman
Berikut adalah penjelasan singkat mengenai fungsi dari masing-masing halaman:

1. **Halaman Login:** Pintu masuk utama sistem. User diarahkan ke dashboard sesuai role masing-masing.
2. **Dashboard:** Menampilkan statistik ringkas (total mahasiswa, dosen, matakuliah) untuk memberikan gambaran cepat isi sistem.
3. **Data Dosen (Admin):** Halaman untuk mengelola (Tambah, Edit, Hapus, Lihat) data dosen pengajar.
4. **Data Mahasiswa (Admin):** Halaman untuk mengelola data mahasiswa yang terdaftar di sistem.
5. **Data Mata Kuliah (Admin):** Halaman manajemen daftar mata kuliah yang tersedia.
6. **Data Jadwal (Admin):** Halaman untuk mengatur jadwal perkuliahan, menentukan dosen pengajar, ruang kelas, dan jam kuliah.
7. **Input KRS (Mahasiswa):** Halaman khusus mahasiswa untuk memilih mata kuliah yang ingin diambil pada semester berjalan.
8. **Lihat KRS:** Menampilkan daftar mata kuliah yang telah diambil oleh mahasiswa beserta detailnya.

## Teknologi yang Digunakan
- **Framework:** Laravel 11
- **Template:** AdminLTE 3 (Bootstrap 4)
- **Database:** MySQL
- **ORM:** Eloquent ORM
- **Tools:** Composer, NPM, Vite
