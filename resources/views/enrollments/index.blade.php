 @extends('layouts.app')

@section('title', 'Daftar Pendaftaran | KursusKu')

@section('content')
<style>
    body {
        background: #07110c !important;
        color: #e8f5ec !important;
    }

    .page-title {
        color: #39ff78;
        font-weight: bold;
    }

    .neon-card {
        background: #0d1b12;
        border: 1px solid rgba(57, 255, 120, 0.25);
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 0 20px rgba(57, 255, 120, 0.05);
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
        box-shadow: 0 0 8px rgba(57, 255, 120, 0.2);
    }

    .form-select option {
        background: #07110c;
        color: white;
    }

    .table {
        color: #e8f5ec;
        vertical-align: middle;
    }

    .table thead th {
        background: #102719;
        color: #39ff78;
        border-color: #285d3b;
        white-space: nowrap;
    }

    .table td {
        background: #0d1b12;
        border-color: #21452e;
    }

    .table tbody tr:hover td {
        background: #142b1b;
        color: white;
    }

    .btn-neon {
        background: #39ff78;
        color: #07110c;
        border: none;
        font-weight: bold;
    }

    .btn-neon:hover {
        background: #20d85b;
        color: #07110c;
    }

    .btn-edit {
        background: #ffc107;
        color: #171717;
        border: none;
        font-weight: bold;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        font-weight: bold;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .status-registered {
        background: #164e63;
        color: #a5f3fc;
    }

    .status-approved {
        background: #14532d;
        color: #86efac;
    }

    .status-rejected {
        background: #7f1d1d;
        color: #fecaca;
    }

    .text-muted-custom {
        color: #a8b8ad;
    }
</style>

<div class="container-fluid py-3">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h2 class="page-title">Daftar Pendaftaran</h2>
            <p class="text-muted-custom mb-0">
                Kelola seluruh data pendaftaran kursus KursusKu.
            </p>
        </div>

        <a href="{{ route('practicum.enrollments.create') }}"
           class="btn btn-neon">
            + Pendaftaran Baru
        </a>
    </div>

    {{-- Pencarian dan Filter --}}
    <div class="neon-card mb-4">
        <form action="{{ route('enrollments.index') }}" method="GET">
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Cari Peserta</label>
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Nama atau email..."
                           value="{{ $search }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Filter Kursus</label>
                    <select name="course_id" class="form-select">
                        <option value="">Semua Kursus</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $courseId == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Filter Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach ($statuses as $item)
                            <option value="{{ $item }}"
                                {{ $status == $item ? 'selected' : '' }}>
                                {{ ucfirst($item) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-neon w-100">
                        Cari
                    </button>
                    <a href="{{ route('enrollments.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>

    {{-- Tabel Pendaftaran --}}
    <div class="neon-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="page-title mb-0">Data Peserta Kursus</h5>
            <span class="text-muted-custom">
                Total: {{ $enrollments->count() }} data
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Nama Kursus</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $enrollment->participant->name ?? '-' }}
                            </td>

                            <td>
                                {{ $enrollment->participant->email ?? '-' }}
                            </td>

                            <td>
                                {{ $enrollment->course->name ?? '-' }}
                            </td>

                            <td>
                                @php
                                    $statusClass = match($enrollment->status) {
                                        'registered' => 'status-registered',
                                        'approved' => 'status-approved',
                                        'rejected' => 'status-rejected',
                                        default => 'status-registered',
                                    };
                                @endphp

                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $enrollment->created_at->format('d-m-Y') }}
                            </td>

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                       class="btn btn-sm btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus pendaftaran ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="mb-0 text-muted-custom">
                                    Belum ada data pendaftaran.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection