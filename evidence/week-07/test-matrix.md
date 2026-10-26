\# Test Matrix — KursusKu



\## Tujuan

Menguji fungsi utama project Laravel KursusKu pada lingkungan lokal.



\## Matriks Pengujian



| No. | Skenario Pengujian | Hasil yang Diharapkan | Status |

|---|---|---|---|

| 1 | Membuka halaman utama `/` | Halaman KursusKu tampil | Lulus jika terverifikasi |

| 2 | Menjalankan `php artisan route:list` | Route terdaftar ditampilkan | Lulus |

| 3 | Memeriksa route utama | Route `/` mengarah ke `HomeController@index` | Lulus jika sesuai hasil pemeriksaan |

| 4 | Memeriksa daftar kursus | Data kursus ditampilkan pada halaman | Lulus jika terverifikasi |

| 5 | Membuka URL yang tidak terdaftar | Halaman 404 ditampilkan | Lulus jika sesuai hasil pengujian |

| 6 | Memeriksa tampilan mobile | Halaman dapat ditampilkan pada layar kecil | Lulus jika terverifikasi |



\## Catatan

Status setiap pengujian harus disesuaikan dengan hasil yang benar-benar diperoleh. Simpan screenshot sebagai bukti untuk pengujian yang relevan.



