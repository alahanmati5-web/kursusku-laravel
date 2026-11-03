<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::updateOrCreate(
            ['code' => 'WEB001'],
            [
                'name' => 'Web Dasar',
                'description' => 'Belajar dasar-dasar HTML, CSS, dan JavaScript.',
                'fee' => 100000,
                'quota' => 12,
                'start_date' => '2026-12-01',
                'status' => 'open',
            ]
        );

        Course::updateOrCreate(
            ['code' => 'PHP001'],
            [
                'name' => 'PHP Dasar',
                'description' => 'Belajar pemrograman PHP untuk pengembangan web.',
                'fee' => 150000,
                'quota' => 8,
                'start_date' => '2026-12-05',
                'status' => 'open',
            ]
        );

        Course::updateOrCreate(
            ['code' => 'LAR001'],
            [
                'name' => 'Laravel Dasar',
                'description' => 'Belajar framework Laravel untuk membuat aplikasi web.',
                'fee' => 200000,
                'quota' => 4,
                'start_date' => '2026-12-10',
                'status' => 'open',
            ]
        );
    }
}