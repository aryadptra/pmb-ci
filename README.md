
# Aplikasi Pendaftaran Mahasiswa Baru

Aplikasi Pendaftaran Mahasiswa Baru - Bang Ambo University

## Authors

- [@Arya Dwi Putra](https://github.com/aryadptra)


## Features

- Admin (panitia)
- Member(peserta)

Admin (panitia) dapat:

- Melakukan login
-  Mengelola informasi pendaftaran
- Mengelola data fakultas
- Mengelola data prodi
- Mengelola data pendaftaran 

Member (peserta) dapat:

- Mengunjungi halaman utama website 
- Membuat akun pendaftaran Melakukan login 
- Melakukan pendaftran: 
    - Tahap satu (Mengisi Biodata)
    - Tahap dua (Pilih Fakultas Dan Prodi) 
    - Tahap tiga (Upload Berkas Pendaftaran) 
    - Tahap empat (Resume Pendaftaran) 
    - Mencetak kartu pendaftaran 

Email dan password (default) login Aplikasi :

| Email  | Password | Role |
| ------------- | ------------- | ------------- |
| admin-pmb@ba-university.ac.id  | admin123  | Admin (panitia)  |
| lelahmishquen@gmail.com  | member123  | Member (peserta)  |
| penikmatsenja@gmail.com  | member123  | Member (peserta)  |
| otewekaya@gmail.com | member123  | Member (peserta)  |

## Installation

- Clone repository ini

```bash
  git clone https://github.com/aryadptra/pmb-ci.git
```
    
- Buat database baru dengan nama pmb_ci di phpMyAdmin atau sejenisnya.

- Import database yang berada di direktori pmb_ci/database/app-pmbdb.sql

- Atur konfigurasi pada file .env sesuai dengan pengaturan yang digunakan

- Jalankan skrip pada terminal
```bash
  php spark serve
```
