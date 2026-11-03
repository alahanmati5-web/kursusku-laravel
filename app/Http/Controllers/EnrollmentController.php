<?php


namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    // Menampilkan daftar pendaftaran dengan pencarian dan filter
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $courseId = $request->input('course_id');
        $status = $request->input('status');

        $enrollments = Enrollment::with(['participant', 'course'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('participant', function ($participantQuery) use ($search) {
                    $participantQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->when($courseId, function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->get();

        $courses = Course::orderBy('name')->get();

        $statuses = Enrollment::select('status')
            ->distinct()
            ->pluck('status');

        return view('enrollments.index', compact(
            'enrollments',
            'search',
            'courseId',
            'status',
            'courses',
            'statuses'
        ));
    }

    // Menampilkan formulir pendaftaran lama
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

    // Menyimpan pendaftaran lama
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'participant_id' => ['required', 'exists:participants,id'],
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
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }

    // Menampilkan halaman edit pendaftaran
    public function edit(Enrollment $enrollment): View
    {
        $enrollment->load(['participant', 'course']);

        $participants = Participant::orderBy('name')->get();

        $courses = Course::orderBy('name')->get();

        return view('enrollments.edit', compact(
            'enrollment',
            'participants',
            'courses'
        ));
    }

    // Memperbarui data pendaftaran
    public function update(
        Request $request,
        Enrollment $enrollment
    ): RedirectResponse {

        $data = $request->validate([
            'participant_id' => ['required', 'exists:participants,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'status' => ['required', Rule::in([
                'registered',
                'approved',
                'rejected'
            ])],
        ]);

        // Mencegah pendaftaran ganda
        $duplicate = Enrollment::where(
            'participant_id',
            $data['participant_id']
        )
            ->where('course_id', $data['course_id'])
            ->where('id', '!=', $enrollment->id)
            ->exists();

        if ($duplicate) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_id' => 'Peserta sudah terdaftar pada kursus tersebut.'
                ]);
        }

        DB::transaction(function () use ($data, $enrollment) {

            $course = Course::whereKey($data['course_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($course->id != $enrollment->course_id) {
                $totalEnrollments = Enrollment::where(
                    'course_id',
                    $course->id
                )->count();

                if (
                    $course->status !== 'open' ||
                    $totalEnrollments >= $course->quota
                ) {
                    throw ValidationException::withMessages([
                        'course_id' => 'Kursus tidak tersedia atau kuotanya penuh.'
                    ]);
                }
            }

            $enrollment->update($data);
        });

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    // Menghapus data pendaftaran
    public function destroy(Enrollment $enrollment): RedirectResponse
    {
        $enrollment->delete();

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    // Menampilkan formulir praktikum
    public function practicumCreate(): View
    {
        $courses = Course::where('status', 'open')
            ->orderBy('name')
            ->get();

        return view('enrollments.practicum-create', compact('courses'));
    }

    // Menampilkan preview pendaftaran
    public function practicumPreview(Request $request): View
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $course = Course::findOrFail($data['course_id']);

        $courseName = $course->name;

        return view('enrollments.preview', compact(
            'data',
            'courseName'
        ));
    }

    // Menyimpan pendaftaran praktikum
    public function practicumStore(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('practicum.enrollments.create')
                ->withInput()
                ->withErrors($validator);
        }

        $data = $validator->validated();

        try {
            DB::transaction(function () use ($data) {

                $course = Course::whereKey($data['course_id'])
                    ->lockForUpdate()
                    ->first();

                if (!$course || $course->status !== 'open') {
                    throw ValidationException::withMessages([
                        'course_id' => 'Kursus tidak tersedia.',
                    ]);
                }

                // Periksa pendaftaran ganda
                $alreadyRegistered = Enrollment::where(
                    'course_id',
                    $course->id
                )->whereHas('participant', function ($query) use ($data) {
                    $query->where('email', $data['email']);
                })->exists();

                if ($alreadyRegistered) {
                    throw ValidationException::withMessages([
                        'email' => 'Email ini sudah terdaftar pada kursus tersebut.',
                    ]);
                }

                // Periksa kuota kursus
                $totalEnrollments = Enrollment::where(
                    'course_id',
                    $course->id
                )->count();

                if ($totalEnrollments >= $course->quota) {
                    throw ValidationException::withMessages([
                        'course_id' => 'Maaf, kuota kursus sudah penuh.',
                    ]);
                }

                // Simpan atau gunakan data peserta
                $participant = Participant::firstOrCreate(
                    ['email' => $data['email']],
                    ['name' => $data['name']]
                );

                Enrollment::create([
                    'participant_id' => $participant->id,
                    'course_id' => $course->id,
                    'status' => 'registered',
                ]);
            });

        } catch (ValidationException $e) {
            return redirect()
                ->route('practicum.enrollments.create')
                ->withInput($data)
                ->withErrors($e->errors());
        }

        return redirect()
            ->route('practicum.enrollments.create')
            ->with('success', 'Pendaftaran praktikum berhasil disimpan!');
    }

    // Mengecek kuota kursus melalui AJAX
    public function availability(int $course): JsonResponse
    {
        $courseData = Course::withCount('enrollments')
            ->where('status', 'open')
            ->find($course);

        if (!$courseData) {
            return response()->json([
                'message' => 'Kursus tidak ditemukan.',
            ], 404);
        }

        $remaining = max(
            0,
            $courseData->quota - $courseData->enrollments_count
        );

        return response()->json([
            'course' => $courseData->name,
            'remaining' => $remaining,
        ]);
    }
}
