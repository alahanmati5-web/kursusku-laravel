<?php


namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $namaWebsite = 'KursusKu';

        $kursus = [
            [
                'nama' => 'Pemrograman Web',
                'deskripsi' => 'Belajar membuat website menggunakan HTML, CSS, dan PHP.',
            ],
            [
                'nama' => 'Pemrograman Laravel',
                'deskripsi' => 'Belajar membangun aplikasi web dengan framework Laravel.',
            ],
            [
                'nama' => 'Basis Data',
                'deskripsi' => 'Belajar mengelola data menggunakan database.',
            ],
        ];

        return view('home', compact('namaWebsite', 'kursus'));
    }
}
