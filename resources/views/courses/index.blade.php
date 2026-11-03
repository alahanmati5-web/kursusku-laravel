
@extends('layouts.app')

@section('title', 'Daftar Kursus - KursusKu')

@section('content')

{{-- Header halaman --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <span class="badge rounded-pill mb-2"
            style="background: rgba(57,255,20,0.12); color: #39ff14; border: 1px solid rgba(57,255,20,0.3);">
            KURSUSKU MANAGEMENT
        </span>

        <h2 class="fw-bold mb-2">
            Daftar <span style="color: #39ff14;">Kursus</span>
        </h2>

        <p class="text-muted mb-0">
            Kelola dan lihat seluruh kursus yang tersedia di KursusKu.
        </p>
    </div>

    <a href="{{ route('courses.create') }}"
        class="btn btn-success px-4 py-2">
        <i class="me-1">＋</i> Tambah Kursus
    </a>
</div>

{{-- Informasi jumlah kursus --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1">Total Kursus</p>
                    <h3 class="fw-bold mb-0" style="color: #39ff14;">
                        {{ $courses->total() }}
                    </h3>
                </div>
                <span style="font-size: 30px;">📚</span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1">Halaman Saat Ini</p>
                    <h3 class="fw-bold mb-0" style="color: #39ff14;">
                        {{ $courses->currentPage() }}
                    </h3>
                </div>
                <span style="font-size: 30px;">📄</span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1">Data Ditampilkan</p>
                    <h3 class="fw-bold mb-0" style="color: #39ff14;">
                        {{ $courses->count() }}
                    </h3>
                </div>
                <span style="font-size: 30px;">📊</span>
            </div>
        </div>
    </div>
</div>

{{-- Pencarian dan filter --}}
<div class="card mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3">
            <span style="color: #39ff14;">⌕</span> Cari Kursus
        </h5>

        <form action="{{ route('courses.index') }}" method="GET"
            class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nama atau Kode Kursus</label>
                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder="Masukkan nama atau kode kursus..."
                    value="{{ $search }}"
                >
            </div>

            <div class="col-md-3">
                <label class="form-label">Status Kursus</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="open" @selected($status === 'open')>
                        Open
                    </option>
                    <option value="draft" @selected($status === 'draft')>
                        Draft
                    </option>
                    <option value="closed" @selected($status === 'closed')>
                        Closed
                    </option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-success flex-grow-1">
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
<div class="card">
    <div class="card-body p-3 p-md-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">
                Data Kursus
            </h5>

            <span class="text-muted small">
                {{ $courses->total() }} data
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Kursus</th>
                        <th>Biaya</th>
                        <th>Kuota</th>
                        <th>Tanggal Mulai</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>
                                {{ $courses->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <span class="fw-bold"
                                    style="color: #39ff14;">
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
                                        style="background: rgba(57,255,20,0.15); color: #39ff14; border: 1px solid #39ff14;">
                                        ● Open
                                    </span>
                                @elseif ($course->status === 'draft')
                                    <span class="badge"
                                        style="background: rgba(255,193,7,0.15); color: #ffc107; border: 1px solid #ffc107;">
                                        ● Draft
                                    </span>
                                @else
                                    <span class="badge"
                                        style="background: rgba(150,150,150,0.15); color: #adb5bd; border: 1px solid #6c757d;">
                                        ● Closed
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div style="font-size: 35px;">📂</div>
                                <p class="fw-bold mt-2 mb-1">
                                    Belum Ada Data Kursus
                                </p>
                                <p class="text-muted mb-0">
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

@endsection
