# Sistem Login PHP Native dengan Multi-Faktor dan Fitur Keamanan

Ini adalah proyek sistem login dan autentikasi lengkap yang dibangun menggunakan PHP Native. Proyek ini tidak bergantung pada framework eksternal (seperti Laravel atau CodeIgniter) dan dirancang dengan fokus pada keamanan, praktik terbaik, dan pengalaman pengguna yang modern.

## Fitur Utama

- **Pendaftaran Pengguna:** Form pendaftaran yang aman untuk membuat akun baru.
- **Login Aman:** Proses login yang memverifikasi kredensial pengguna menggunakan password yang di-hash dengan aman (`password_hash`).
- **Autentikasi Dua Faktor (2FA):** Setelah login berhasil, pengguna harus memasukkan token verifikasi 8 digit yang dikirimkan ke email terdaftar mereka.
- **Pembatasan Percobaan Login:** Akun akan secara otomatis memicu alur reset password setelah 3 kali gagal memasukkan password.
- **Reset Password Aman:** Pengguna menerima email dengan link unik yang memiliki waktu kedaluwarsa untuk mereset password mereka.
- **Fitur Lihat/Sembunyikan Password:** Tombol ikon mata pada form untuk memudahkan pengguna memeriksa input password mereka.
- **Halaman Dashboard Terproteksi:** Halaman `dashboard.php` hanya dapat diakses setelah pengguna berhasil melalui semua tahapan autentikasi dan dilindungi menggunakan session.
- **Konfigurasi Path Dinamis:** Proyek ini menggunakan konstanta `BASE_URL` yang dibuat secara dinamis untuk memastikan semua path (URL, aset, dll.) berfungsi dengan benar di lingkungan server mana pun tanpa perlu mengubah kode secara manual.

## Alur Sistem

Sistem ini memiliki beberapa alur utama yang saling berhubungan untuk memastikan keamanan dan kemudahan penggunaan.

1.  **Pendaftaran**

    - Pengguna baru mengisi form pendaftaran (email, username, password, konfirmasi password).
    - Sistem memvalidasi data dan menyimpannya ke database dengan password yang sudah di-hash.

2.  **Login & Verifikasi**

    - Pengguna memasukkan username dan password di halaman login.
    - **Jika Berhasil:**
      1.  Sistem membuat token 2FA acak dan mengirimkannya ke email pengguna.
      2.  Pengguna diarahkan ke halaman "Verifikasi Token".
      3.  Pengguna memasukkan token yang diterima. Jika valid, pengguna diarahkan ke Dashboard.
    - **Jika Gagal:**
      1.  Sistem akan mencatat setiap kegagalan login.
      2.  Setelah **kegagalan ke-3**, sistem akan mengirimkan email berisi link untuk reset password.
      3.  Pengguna akan melihat notifikasi di halaman login bahwa link reset telah dikirim.

3.  **Reset Password**

    - Pengguna mengklik link unik di dalam email notifikasi kegagalan login.
    - Link tersebut akan mengarahkan ke halaman "Reset Password" yang aman.
    - Pengguna memasukkan password baru.
    - Setelah berhasil, password di database diperbarui, dan pengguna dapat mencoba login kembali dengan password baru.

4.  **Logout**
    - Pengguna mengklik tombol logout.
    - Sesi (session) pengguna akan dihancurkan, dan pengguna diarahkan kembali ke halaman login.

## Tech Stack (Teknologi yang Digunakan)

- **Backend:** PHP 8.3+ (Native/Prosedural)
- **Frontend:** HTML5, Bootstrap 5
- **Database:** MySQL (dengan ekstensi MySQLi)
- **Pengiriman Email:** PHPMailer
- **Manajemen Dependensi:** Composer

## Instalasi dan Konfigurasi

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Prasyarat:**

    - Web Server (XAMPP, WAMP, MAMP, atau sejenisnya).
    - PHP (versi 7.4 atau lebih tinggi).
    - Database MySQL.
    - Composer terinstall secara global.
    - Akun Gmail dengan **App Password** untuk pengujian SMTP.

2.  **Langkah Instalasi:**
    1.  Letakkan semua file proyek di dalam direktori `htdocs` (untuk XAMPP) atau direktori root web server Anda.
    2.  Buka terminal atau command prompt di dalam direktori proyek, lalu jalankan perintah `composer install` untuk mengunduh PHPMailer. Ini akan membuat folder `vendor`.
    3.  Buat database baru di phpMyAdmin (misalnya, `db_login_system`).
    4.  Impor struktur tabel `users` menggunakan query SQL yang ada dalam dokumentasi atau file `.sql`.
    5.  Buka file `config.php` dan sesuaikan kredensial database (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
    6.  Buka file `send_email.php` dan konfigurasikan detail SMTP Gmail Anda (`$mail->Username` dan `$mail->Password` dengan App Password).
    7.  Akses proyek melalui browser Anda (misalnya, `http://localhost/nama-folder-proyek`).

## Struktur Folder

```
sistem-login/
├── vendor/                     # Dibuat oleh Composer, berisi PHPMailer
├── config.php                  # Koneksi DB dan konfigurasi utama (BASE_URL)
├── dashboard.php               # Halaman setelah berhasil login
├── index.php                   # Mengarahkan otomatis ke login.php
├── login.php                   # Halaman form login (tahap 1)
├── logout.php                  # Proses untuk keluar
├── process_login.php           # Logika memproses login & percobaan gagal
├── process_register.php        # Logika memproses pendaftaran
├── process_reset_password.php  # Logika memproses form reset password
├── process_verification.php    # Logika memproses token 2FA
├── register.php                # Halaman form pendaftaran
├── reset_password.php          # Halaman form untuk memasukkan password baru
├── send_email.php              # Fungsi untuk mengirim email (2FA & reset)
├── verify_token.php            # Halaman form verifikasi token (tahap 2)
└── composer.json               # File konfigurasi Composer
```
