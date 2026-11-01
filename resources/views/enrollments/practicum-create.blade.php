```blade
@extends('layouts.app')

@section('title', 'Pendaftaran Praktikum | KursusKu')

@section('content')

<style>
    body {
        background: #07110c !important;
        color: #e8f5ec !important;
    }

    .enroll-wrapper {
        max-width: 850px;
        margin: 45px auto;
    }

    .enroll-card {
        background: linear-gradient(145deg, #102019, #09140e);
        border: 1px solid rgba(57, 255, 123, 0.35);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 0 25px rgba(57, 255, 123, 0.10);
    }

    .enroll-header {
        padding: 28px;
        background: rgba(57, 255, 123, 0.07);
        border-bottom: 1px solid rgba(57, 255, 123, 0.2);
    }

    .enroll-header h3 {
        color: #39ff7b;
        font-weight: 700;
        margin-bottom: 8px;
        text-shadow: 0 0 12px rgba(57, 255, 123, 0.3);
    }

    .enroll-header p {
        color: #a8c5b1;
        margin-bottom: 0;
    }

    .enroll-body {
        padding: 30px;
    }

    .form-label {
        color: #c9f5d4;
        font-weight: 600;
    }

    .form-control,
    .form-select {
        background-color: #0a1910 !important;
        border: 1px solid #28583a !important;
        color: #ffffff !important;
        border-radius: 10px;
        padding: 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #39ff7b !important;
        box-shadow: 0 0 12px rgba(57, 255, 123, 0.2) !important;
    }

    .form-control::placeholder {
        color: #789382;
    }

    .form-select option {
        background: #0a1910;
        color: white;
    }

    .btn-neon {
        background: #39ff7b;
        color: #07110c;
        border: 1px solid #39ff7b;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-neon:hover {
        background: transparent;
        color: #39ff7b;
        box-shadow: 0 0 18px rgba(57, 255, 123, 0.4);
    }

    .btn-outline-neon {
        color: #39ff7b;
        border: 1px solid #39ff7b;
        border-radius: 10px;
        padding: 11px 22px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-outline-neon:hover {
        background: #39ff7b;
        color: #07110c;
    }

    .enroll-info {
        color: #a8c5b1;
        font-size: 14px;
    }

    #availability-info {
        border-radius: 10px;
    }

    @media (max-width: 576px) {
        .enroll-body {
            padding: 20px;
        }

        .enroll-header {
            padding: 22px;
        }

        .enroll-actions {
            flex-direction: column;
            gap: 12px;
        }

        .enroll-actions a,
        .enroll-actions button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="enroll-wrapper">

    <div class="enroll-card">

        <div class="enroll-header">
            <span class="badge rounded-pill text-bg-success mb-3">
                KURSUSKU · PENDAFTARAN
            </span>

            <h3>Formulir Pendaftaran Praktikum</h3>

            <p>
                Lengkapi data diri dan pilih program praktikum
                yang ingin kamu ikuti.
            </p>
        </div>

        <div class="enroll-body">

            <form method="POST"
                action="{{ route('practicum.enrollments.preview') }}">

                @csrf

                <div class="mb-4">
                    <label class="form-label">Nama Lengkap</label>

                    <input type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Alamat Email</label>

                    <input type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required>

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Kursus Praktikum</label>

                    <select name="course_id"
                        id="course_id"
                        class="form-select @error('course_id') is-invalid @enderror"
                        required>

                        <option value="">-- Pilih Kursus --</option>

                        @foreach ($courses as $course)
                            <option value="{{ $course['id'] }}"
                                {{ old('course_id') == $course['id'] ? 'selected' : '' }}>
                                {{ $course['name'] }}
                            </option>
                        @endforeach

                    </select>

                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div id="availability-info"
                    class="alert alert-dark border border-success d-none mt-3"
                    role="status">
                </div>

                <hr style="border-color: #28583a; margin: 28px 0;">

                <div class="d-flex justify-content-between align-items-center enroll-actions">

                    <a href="{{ route('home') }}"
                        class="btn-outline-neon">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn-neon">
                        Lihat Preview Pendaftaran →
                    </button>

                </div>

            </form>

        </div>
    </div>

    <p class="text-center enroll-info mt-4">
        Belajar Teknologi, Bangun Masa Depan.
    </p>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const courseSelect = document.getElementById('course_id');
        const info = document.getElementById('availability-info');

        courseSelect.addEventListener('change', async function () {

            const courseId = this.value;

            if (!courseId) {
                info.classList.add('d-none');
                info.textContent = '';
                return;
            }

            info.className = 'alert alert-dark border border-success mt-3';
            info.style.color = '#39ff7b';
            info.textContent = 'Sedang memeriksa kuota...';

            const url = "{{ route('courses.availability', ['course' => '__ID__']) }}"
                .replace('__ID__', courseId);

            try {
                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error('Gagal mengambil data kuota.');
                }

                const result = await response.json();

                info.textContent =
                    '✓ Kursus: ' + result.course +
                    ' | Sisa kuota: ' + result.remaining;

            } catch (error) {

                info.style.color = '#ff7777';
                info.textContent = 'Gagal mengambil informasi kuota.';

                console.error(error);
            }

        });

    });
</script>
@endpush
```