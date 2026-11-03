<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'code' => 'WEB001',
                'name' => 'Web Dasar',
                'description' => 'Belajar dasar-dasar HTML, CSS, dan JavaScript.',
                'fee' => 100000,
                'quota' => 12,
                'start_date' => '2026-12-01',
                'status' => 'open',
            ],
            [
                'code' => 'PHP001',
                'name' => 'PHP Dasar',
                'description' => 'Belajar pemrograman PHP untuk pengembangan web.',
                'fee' => 150000,
                'quota' => 8,
                'start_date' => '2026-12-05',
                'status' => 'open',
            ],
            [
                'code' => 'LAR001',
                'name' => 'Laravel Dasar',
                'description' => 'Belajar framework Laravel untuk membuat aplikasi web.',
                'fee' => 200000,
                'quota' => 4,
                'start_date' => '2026-12-10',
                'status' => 'open',
            ],
            [
                'code' => 'SQL001',
                'name' => 'MySQL Dasar',
                'description' => 'Belajar pengelolaan database menggunakan MySQL.',
                'fee' => 350000,
                'quota' => 30,
                'start_date' => '2026-12-12',
                'status' => 'open',
            ],
            [
                'code' => 'UI001',
                'name' => 'Bootstrap UI',
                'description' => 'Belajar membuat tampilan web responsif dengan Bootstrap.',
                'fee' => 300000,
                'quota' => 25,
                'start_date' => '2026-12-15',
                'status' => 'draft',
            ],
            [
                'code' => 'JS001',
                'name' => 'JavaScript Dasar',
                'description' => 'Belajar dasar pemrograman JavaScript.',
                'fee' => 400000,
                'quota' => 20,
                'start_date' => '2026-12-18',
                'status' => 'open',
            ],
            [
                'code' => 'AJAX001',
                'name' => 'jQuery dan Ajax',
                'description' => 'Belajar interaksi web menggunakan jQuery dan Ajax.',
                'fee' => 450000,
                'quota' => 20,
                'start_date' => '2026-12-20',
                'status' => 'draft',
            ],
            [
                'code' => 'API001',
                'name' => 'REST API Dasar',
                'description' => 'Belajar konsep dan pembuatan REST API.',
                'fee' => 550000,
                'quota' => 18,
                'start_date' => '2026-12-22',
                'status' => 'closed',
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['code' => $course['code']],
                $course
            );
        }
    }
}
