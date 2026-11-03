 @extends('layouts.app')

@section('title', 'Edit Pendaftaran | KursusKu')

@section('content')
<style>
    body {
        background: #07110c !important;
        color: #e8f5ec !important;
    }

    .edit-wrapper {
        max-width: 750px;
        margin: 35px auto;
    }

    .edit-card {
        background: #0d1b12;
        border: 1px solid rgba(57, 255, 120, 0.3);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 0 25px rgba(57, 255, 120, 0.08);
    }

    .edit-title {
        color: #39ff78;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .form-label {
        color: #c8f5d5;
        font-weight: 600;
    }

    .form-control,
    .form-select {
        background: #07110c;
        color: #e8f5ec;
        border: 1px solid #285d3b;
        border-radius: 8px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #07110c;
        color: #fff;
        border-color: #39ff78;
        box-shadow: 0 0 8px rgba(57, 255, 120, 0.3);
    }

    .form-select option {
        background: #07110c;
        color: white;
    }

    .btn-neon {
        background: #39ff78;
        color: #07110c;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
    }

    .btn-neon:hover {
        background: #20d85b;
        color: #07110c;
    }

    .btn-back {
        color: #39ff78;
        border: 1px solid #39ff78;
        border-radius: 8px;
        padding: 10px 20px;
        text-decoration: none;
    }

    .btn-back:hover {
        background: rgba(57, 255, 120, 0.1);
        color: #39ff78;
    }
</style>

<div class="edit-wrapper">
    <div class="edit-card">
        <h3 class="edit-title">Edit Data Pendaftaran</h3>
        <p class="text-secondary mb-4">
            Perbarui informasi peserta dan status pendaftaran.
        </p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data yang dimasukkan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('enrollments.update', $enrollment->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Peserta</label>
                <select name="participant_id" class="form-select" required>
                    @foreach ($participants as $participant)
                        <option value="{{ $participant->id }}"
                            {{ old('participant_id', $enrollment->participant_id) == $participant->id ? 'selected' : '' }}>
                            {{ $participant->name }} - {{ $participant->email }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Kursus</label>
                <select name="course_id" class="form-select" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}"
                            {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>
                            {{ $course->name }} ({{ $course->code }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Status Pendaftaran</label>
                <select name="status" class="form-select" required>
                    <option value="registered"
                        {{ old('status', $enrollment->status) == 'registered' ? 'selected' : '' }}>
                        Terdaftar
                    </option>
                    <option value="approved"
                        {{ old('status', $enrollment->status) == 'approved' ? 'selected' : '' }}>
                        Disetujui
                    </option>
                    <option value="rejected"
                        {{ old('status', $enrollment->status) == 'rejected' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </select>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn-neon">
                    Simpan Perubahan
                </button>

                <a href="{{ route('enrollments.index') }}" class="btn-back">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection