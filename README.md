# Backend Gendis Desa Codeigniter 4

## Apa itu backend Gendis Desa?

Backend Gendis Desa adalah sebuah API agar, aplikasi android maupun aplikasi lain bisa berkomunikasi dengan database yang dibuat, Gendis Desa sendiri adalah sebuah aplikasi pelayanan publik untuk pendaftaran orang penyandang disabilitas.

## Fitur

- Mendaftar akun, yang nantinya di verifikasi oleh admin
- Login Aplikasi
- Melihat profile akun
- Mengubah password
- Melihat riwayat pendaftaran orang penyandang disabilitas yang telah didaftarkan akun

## Kebutuhan Server

PHP versi 7.2 atau lebih tinggi, dengan extension yang sudah diinstall atau diaktifkan:

- [intl](http://php.net/manual/en/intl.requirements.php)
- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

Database defaultnya adalah PostgreSql, namun anda juga bisa mengubahnya ke Mysql, untuk lebih jelas silahkan lihat cara instalasinya

## Instalasi

1. Download repositori ini dan taruh di htdocs(Xampp) atau www (Laragon) atau webserver yang lain.
2. Silahkan buka di vscode atau text editor yang lain
3. untuk vs code silahkan klik ctrl+` (\`` diatas key tab).
4. di terminal ketikkan _composer install_ untuk menginstall codeigniter 4 ke projek.
5. rename file env menjadi .env dan ubah sesuai kebutuhan, untuk cara mengubahnya silahkan cari di google
6. setelah disetting silahkan gunakkan perintah _php spark migrate:refresh_ untuk membuat table ke databasenya, dan _php spark db:seed InitSeeder_ untuk memasukkan data awal ke table yang telah dibuat
7. selesai

# Lisensi

Cek link ini untuk melihat lisensi Codeigniter [Lisensi Codeigniter 4](https://github.com/codeigniter4/CodeIgniter4).

# Resources

- [Codeigniter User Guide](https://codeigniter.com/docs)

Laporkan isu keamanan ke [Email kerentanan aplikasi](mailto:herayafpm@gmail.com)
Terima kasih.
