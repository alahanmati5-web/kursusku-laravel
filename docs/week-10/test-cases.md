# Test Cases Week 10 – KursusKu

## Tujuan Pengujian
Pengujian dilakukan untuk memastikan fitur tambah dan tampil data kursus berjalan dengan baik serta validasi input berfungsi sesuai ketentuan.

## Hasil Pengujian

| No. | Skenario Pengujian | Hasil yang Diharapkan | Status |
|---|---|---|---|
| 1 | Menambahkan kursus dengan data valid | Data berhasil disimpan dan tampil pada daftar kursus | Berhasil |
| 2 | Mengisi kode kursus yang sudah digunakan | Sistem menolak kode duplikat | Berhasil |
| 3 | Mengisi biaya kursus dengan nilai negatif | Sistem menolak nilai biaya negatif | Berhasil |
| 4 | Mengisi kuota dengan nilai 0 | Sistem menolak kuota yang tidak valid | Berhasil |
| 5 | Mengisi status dengan nilai selain draft, open, dan closed | Sistem menolak status yang tidak sesuai | Berhasil |
| 6 | Mengosongkan kode kursus | Sistem menolak input kode kosong | Belum diuji |
| 7 | Mengosongkan nama kursus | Sistem menolak input nama kosong | Belum diuji |
| 8 | Memuat ulang halaman daftar kursus | Data yang sudah disimpan tetap tampil | Berhasil |

## Kesimpulan
Berdasarkan pengujian yang telah dilakukan, fitur tambah dan tampil data kursus pada aplikasi KursusKu berjalan dengan baik. Data kursus berhasil disimpan ke database dan validasi input telah berfungsi pada skenario yang diuji.# Test Cases Week 10 
