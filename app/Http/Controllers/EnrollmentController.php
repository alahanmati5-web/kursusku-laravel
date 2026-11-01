<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    // ==========================================
    // FITUR PENDAFTARAN LAMA
    // ==========================================

    public function index(): View
    {
        $enrollments = Enrollment::with(['participant', 'course'])
            ->latest()
            ->get();

        return view('enrollments.index', compact('enrollments'));
    }

    public function create(): View
    {
        $participants = Participant::orderBy('name')->get();

        $courses = Course::where('status', 'open')
            ->orderBy('name')
            ->get();

        return view('enrollments.create', compact(
            'participants',
            'courses'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'participant_id' => [
                'required',
                'exists:participants,id'
            ],

            'course_id' => [
                'required',
                'exists:courses,id',
                Rule::unique('enrollments')->where(
                    fn ($query) => $query->where(
                        'participant_id',
                        $request->participant_id
                    )
                ),
            ],
        ]);

        $data['status'] = 'registered';

        Enrollment::create($data);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment berhasil disimpan.');
    }


    // ==========================================
    // FITUR PRAKTIKUM WEEK 9
    // ==========================================

    // Menampilkan formulir pendaftaran praktikum

    public function practicumCreate(): View
    {
        $courses = [
            ['id' => 1, 'name' => 'Web Dasar'],
            ['id' => 2, 'name' => 'PHP Dasar'],
            ['id' => 3, 'name' => 'Laravel Dasar'],
        ];

        return view(
            'enrollments.practicum-create',
            compact('courses')
        );
    }


    // Memproses dan menampilkan preview pendaftaran

    public function practicumPreview(Request $request): View
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],

            'email' => [
                'required',
                'email'
            ],

            'course_id' => [
                'required',
                'integer',
                'in:1,2,3'
            ],
        ]);

        $courses = [
            1 => 'Web Dasar',
            2 => 'PHP Dasar',
            3 => 'Laravel Dasar',
        ];

        $courseName = $courses[$data['course_id']];

        return view(
            'enrollments.preview',
            compact('data', 'courseName')
        );
    }


    // Mengambil informasi kuota kursus melalui Ajax

    public function availability(int $course): JsonResponse
    {
        $availability = [
            1 => [
                'course' => 'Web Dasar',
                'remaining' => 12
            ],

            2 => [
                'course' => 'PHP Dasar',
                'remaining' => 8
            ],

            3 => [
                'course' => 'Laravel Dasar',
                'remaining' => 4
            ],
        ];

        if (!isset($availability[$course])) {
            return response()->json([
                'message' => 'Kursus tidak ditemukan.',
            ], 404);
        }

        return response()->json($availability[$course]);
    }
}
