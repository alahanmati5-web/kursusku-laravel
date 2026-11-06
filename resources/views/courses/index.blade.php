
@extends('layouts.app')

@section('title', 'Daftar Kursus - KursusKu')

@section('content')

<style>
    .course-card {
        background: #0d1b12;
        border: 1px solid rgba(57, 255, 120, 0.25);
        border-radius: 14px;
    }

    .course-title {
        color: #39ff78;
    }

    .course-table {
        color: #e8f5ec;
        vertical-align: middle;
    }

    .course-table thead th {
        background: #102719;
        color: #39ff78;
        border-color: #285d3b;
        white-space: nowrap;
    }

    .course-table td {
        background: #0d1b12;
        border-color: #21452e;
    }

    .btn-neon {
        background: #39ff78;
        color: #07110c;
        border: 1px solid #39ff78;
        font-weight: bold;
    }

    .btn-neon:hover {
        background: #20d85b;
        color: #07110c;
    }

    .form-control,
    .form-select {
        background: #07110c;
        color: #e8f5ec;
        border: 1px solid #285d3b;
    }

    .form-control:focus,
    .form-select:focus {
        background: #07110c;
        color: white;
        border-color: #39ff78;
        box-shadow: 0 0 8px rgba(57,255,120,0.2);
    }

    .form-select option {
        background: #07110c;
        color: white;
    }

    .text-muted-custom {
        color: #a8b8ad;
    }
</style>

<div class="container-fluid py-3">

    {{-- Header halaman --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <span class="badge rounded-pill mb-2"
                style="background: rgba(57,255,120,0.12); color: #39ff78; border: 1px solid rgba(57,255,120,0.3);">
                KURSUSKU MANAGEMENT
            </span>

            <h2 class="fw-bold mb-2">
                Daftar <span class="course-title">Kursus</span>
            </h2>

            <p class="text-muted-custom mb-0">
                Kelola dan lihat seluruh kursus yang tersedia di KursusKu.
            </p>
        </div>

        <a href="{{ route('courses.create') }}"
           class="btn btn-neon px-4 py-3">
            ＋ Tambah Kursus
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Informasi jumlah kursus --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="course-card p-3 h-100">
                <p class="text-muted-custom mb-1">Total Kursus</p>
                <h3 class="fw-bold mb-0 course-title">
                    {{ $courses->total() }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="course-card p-3 h-100">
                <p class="text-muted-custom mb-1">Halaman Saat Ini</p>
                <h3 class="fw-bold mb-0 course-title">
                    {{ $courses->currentPage() }}
                </h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="course-card p-3 h-100">
                <p class="text-muted-custom mb-1">Data Ditampilkan</p>
                <h3 class="fw-bold mb-0 course-title">
                    {{ $courses->count() }}
                </h3>
            </div>
        </div>

    </div>

    {{-- Pencarian dan filter --}}
    <div class="course-card mb-4">
        <div class="p-4">

            <h5 class="fw-bold mb-3 course-title">
                Cari Kursus
            </h5>

            <form action="{{ route('courses.index') }}"
                  method="GET"
                  class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Nama atau Kode Kursus</label>
                    <input type="text"
                           name="q"
                           class="form-control"
                           placeholder="Masukkan nama atau kode kursus..."
                           value="{{ $search }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Status Kursus</label>

                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>

                        <option value="open"
                            @selected($status === 'open')>
                            Open
                        </option>

                        <option value="draft"
                            @selected($status === 'draft')>
                            Draft
                        </option>

                        <option value="closed"
                            @selected($status === 'closed')>
                            Closed
                        </option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit"
                            class="btn btn-neon flex-grow-1">
                        Cari
                    </button>

                    <a href="{{ route('courses.index') }}"
                       class="btn btn-outline-success">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Tabel kursus --}}
    <div class="course-card">
        <div class="p-3 p-md-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 course-title">
                    Data Kursus
                </h5>

                <span class="text-muted-custom small">
                    {{ $courses->total() }} data
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle course-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kursus</th>
                            <th>Biaya</th>
                            <th>Kuota</th>
                            <th>Tanggal Mulai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($courses as $course)
                            <tr>

                                <td>
                                    {{ $courses->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <span class="fw-bold course-title">
                                        {{ $course->code }}
                                    </span>
                                </td>

                                <td class="fw-semibold">
                                    {{ $course->name }}
                                </td>

                                <td>
                                    Rp {{ number_format($course->fee, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $course->quota }} peserta
                                </td>

                                <td>
                                    {{ $course->start_date?->format('d-m-Y') ?? '-' }}
                                </td>

                                <td>
                                    @if ($course->status === 'open')
                                        <span class="badge"
                                            style="background:rgba(57,255,120,0.15);color:#39ff78;">
                                            ● Open
                                        </span>
                                    @elseif ($course->status === 'draft')
                                        <span class="badge bg-warning text-dark">
                                            ● Draft
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            ● Closed
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-1">

                                        <a href="{{ route('courses.show', $course) }}"
                                           class="btn btn-sm btn-outline-info">
                                            Detail
                                        </a>

                                        <a href="{{ route('courses.edit', $course) }}"
                                           class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('courses.destroy', $course) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <p class="fw-bold mb-1">
                                        Belum Ada Data Kursus
                                    </p>

                                    <p class="text-muted-custom mb-0">
                                        Silakan tambahkan kursus baru.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $courses->links() }}
            </div>

        </div>
    </div>

</div>

@endsection
