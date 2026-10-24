
# KursusKu

**Belajar Teknologi, Bangun Masa Depan.**

## Deskripsi
KursusKu merupakan aplikasi web sederhana untuk menampilkan
informasi dan daftar kursus teknologi. Proyek ini dikembangkan
menggunakan Laravel dengan pendekatan Model-View-Controller (MVC).

## Teknologi
- PHP 8.4
- Laravel 13
- HTML
- CSS
- Blade Template

## Struktur MVC
- Route: `routes/web.php`
- Controller: `app/Http/Controllers/HomeController.php`
- View: `resources/views/home.blade.php`
- CSS: `public/css/style.css`
- Gambar: `public/images/`

## Fitur
- Menampilkan halaman utama KursusKu.
- Menampilkan daftar kursus.
- Menggunakan Blade untuk menampilkan data dari Controller.
- Menggunakan CSS untuk mengatur tampilan halaman.

## Cara Menjalankan
1. Buka terminal pada folder proyek.
2. Jalankan server Laravel:

   `php artisan serve`

3. Buka `http://127.0.0.1:8000` pada browser.

## Pengujian
Route utama `/` diarahkan ke `HomeController@index`
dengan nama route `home`.

## Catatan Pengembangan
Proyek ini dikembangkan sebagai bagian dari praktikum
Laravel dan penerapan pola MVC.
## Cara Menjalankan

1. Pastikan PHP, Composer, dan dependency Laravel sudah tersedia.
2. Buka terminal pada folder proyek `kursusku`.
3. Jalankan server Laravel menggunakan PHP 8.4:

   `"C:\laragon\bin\php\php-8.4.27-Win32-vs17-x64\php.exe" artisan serve`

4. Buka browser dan akses `http://127.0.0.1:8000`.

## Pengujian

- Route utama `/` menggunakan nama route `home`.
- Route utama diarahkan ke `HomeController@index`.
- Data kursus dikirim dari Controller ke Blade View.
- URL yang tidak terdaftar, seperti `/abc`, menghasilkan respons 404 Not Found.
