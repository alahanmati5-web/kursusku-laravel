```blade
@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Detail Kursus</h2>
            <p class="text-muted mb-0">
                Informasi lengkap mengenai kursus yang dipilih.
            </p>
        </div>

        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Detail Kursus --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <span class="badge bg-success mb-2">
                        {{ $course->code }}
                    </span>

                    <h3 class="fw-bold mb-1">
                        {{ $course->name }}
                    </h3>

                    <p class="text-muted mb-0">
                        {{ $course->description ?: 'Tidak ada deskripsi kursus.' }}
                    </p>
                </div>

                @php
                    $statusClass = match ($course->status) {
                        'open' => 'success',
                        'closed' => 'danger',
                        'draft' => 'secondary',
                        default => 'secondary',
                    };
                @endphp

                <span class="badge bg-{{ $statusClass }}">
                    {{ ucfirst($course->status) }}
                </span>
            </div>

            <hr>

            <div class="row g-4">
                <div class="col-md-6">
                    <small class="text-muted">Biaya Kursus</small>
                    <h5 class="fw-bold mt-1">
                        Rp {{ number_format($course->fee, 0, ',', '.') }}
                    </h5>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Kuota Peserta</small>
                    <h5 class="fw-bold mt-1">
                        {{ $course->quota }} orang
                    </h5>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Tanggal Mulai</small>
                    <h5 class="fw-bold mt-1">
                        {{ $course->start_date
                            ? $course->start_date->format('d-m-Y')
                            : '-' }}
                    </h5>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Jumlah Pendaftar</small>
                    <h5 class="fw-bold mt-1">
                        {{ $course->enrollments_count ?? 0 }} orang
                    </h5>
                </div>
            </div>

            <hr>

            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('courses.edit', $course) }}"
                   class="btn btn-warning">
                    Edit Kursus
                </a>

                <a href="{{ route('courses.index') }}"
                   class="btn btn-outline-secondary">
                    Kembali ke Daftar
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
```