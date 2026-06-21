# Sistem Informasi Akademik (SIAKAD) Sederhana

## a Deskripsi singkat aplikasi
Aplikasi sistem informasi akademik (SIAKAD) sederhana yang dibuat menggunakan Laravel 11. Untuk tampilannya, aplikasi ini menggunakan template AdminLTE supaya lebih rapi dan user-friendly. Fokus utama aplikasi ini adalah untuk mempermudah pengelolaan data kampus seperti dosen, mahasiswa, dan mata kuliah. Selain itu, aplikasi ini juga bisa digunakan mahasiswa untuk mengambil KRS secara online.

## b Penjelasan singkat fungsi dari masing-masing halaman
1. Halaman Login: Fitur login ini dibuat menggunakan Laravel Breeze yang sudah disesuaikan, termasuk penggantian logo agar sesuai dengan tema aplikasi.
2. Halaman Dashboard: Halaman utama yang menampilkan statistik singkat seperti jumlah dosen dan mahasiswa.
3. Halaman Dosen: Halaman buat admin mengelola data dosen (tambah, edit, hapus).
4. Halaman Mahasiswa: Halaman buat admin mengelola data mahasiswa yang terdaftar.
5. Halaman Mata Kuliah: Tempat admin mengatur daftar mata kuliah yang tersedia.
6. Halaman Jadwal: Di sini admin bisa mengatur jadwal kuliah, mulai dari dosen pengajarnya, jam, sampai ruang kelasnya.
7. Halaman Input KRS: Halaman khusus mahasiswa untuk memilih mata kuliah yang mau diambil.
8. Halaman Lihat KRS: Tempat mahasiswa mengecek daftar mata kuliah apa saja yang sudah mereka ambil.

## c Penjelasan fitur
1. Login & Auth (Laravel Breeze): Sistem login yang aman menggunakan Laravel Breeze, lengkap dengan fitur logout dan proteksi halaman.
2. UI AdminLTE: Tampilan dashboard dan tabel yang rapi menggunakan template AdminLTE 3.
3. Login 2 Role: Ada akses untuk Admin dan Mahasiswa dengan fungsi yang berbeda.
4. CRUD Lengkap: Sudah bisa tambah, lihat, ubah, dan hapus data dosen, mahasiswa, dan mata kuliah menggunakan Eloquent ORM.
5. Relasi Database: Semua data saling terhubung, seperti jadwal yang terikat dengan data dosen dan mata kuliah.
6. Validasi Input: Form sudah dilengkapi validasi bawaan Laravel agar data yang dimasukkan tidak asal-asalan atau kosong.
7. Keamanan (Middleware): Membatasi akses halaman agar admin dan mahasiswa hanya bisa membuka menu yang sesuai hak aksesnya.

