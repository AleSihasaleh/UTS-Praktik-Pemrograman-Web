# Aplikasi Rekap Nilai Mahasiswa

Aplikasi PHP dengan template AdminLTE untuk mengelola nilai mahasiswa. Fitur tabel meliputi foto profil di samping nama, pencarian nama, filter predikat, pengurutan nilai akhir, pagination 5/10/15 data, serta tambah, edit, dan hapus data.

## Kebutuhan

- XAMPP (Apache, PHP, dan MySQL/MariaDB)
- Browser web

## Menjalankan aplikasi

1. Salin folder `phpdb` ke `C:\xampp\htdocs\webpro5e\phpdb` (atau ke folder document root yang sesuai).
2. Jalankan Apache dan MySQL dari XAMPP.
3. Impor `dbnilai.sql` ke MySQL melalui phpMyAdmin (`http://localhost/phpmyadmin`) menggunakan menu **Import**. File SQL membuat database `dbNilai`, tabel, serta data demo.
4. Buka `http://localhost/webpro5e/phpdb/viewdata.php`.

Koneksi database di `connection.php` menggunakan host `localhost`, pengguna `root`, dan password kosong, sesuai konfigurasi XAMPP bawaan. Ubah konfigurasi tersebut jika MySQL lokal Anda memakai kredensial berbeda.

`dbnilai.sql` berisi data demo untuk instalasi baru. Jangan impor langsung ke database `dbNilai` yang sudah berisi data tanpa membuat cadangan terlebih dahulu; jika hanya ingin menambahkan kolom foto pada database aplikasi yang sudah ada, aplikasi akan menyiapkan kolom tersebut saat dibuka.

## Foto profil

Data demo pada SQL merujuk file foto di folder `img`. Sertakan folder tersebut ketika memindahkan atau mengunggah aplikasi. Foto tambahan dapat diunggah melalui `http://localhost/webpro5e/phpdb/form_upload.php`, lalu dipilih saat menambah atau mengedit data mahasiswa.

## Struktur data

- `nilai`: data mahasiswa dan nilai, termasuk `file_path` foto profil.
- `photo`: daftar file foto yang diunggah.
- `nilai_photo`: relasi kompatibilitas antara mahasiswa dan daftar foto.

Saat halaman dan form aplikasi dijalankan, aplikasi juga memastikan tabel/kolom foto tersedia pada database yang sudah ada.

## Repositori GitHub

https://github.com/AleSihasaleh/UTS-Praktik-Pemrograman-Web
