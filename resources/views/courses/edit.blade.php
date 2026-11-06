```blade
@extends('layouts.app')

@section('title', 'Edit Kursus - KursusKu')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <span class="badge rounded-pill mb-2"
                style="background: rgba(57,255,20,0.12); color: #39ff14; border: 1px solid rgba(57,255,20,0.3);">
                KURSUSKU MANAGEMENT
            </span>

            <h2 class="fw-bold mb-2">
                Edit <span style="color: #39ff14;">Kursus</span>
            </h2>

            <p class="text-muted mb-0">
                Perbarui informasi kursus yang sudah tersedia.
            </p>
        </div>

        <a href="{{ route('courses.show', $course) }}"
            class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    {{-- Form Edit --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('courses.update', $course) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Kode Kursus --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Kode Kursus
                        </label>

                        <input
                            type="text"
                            name="code"
                            class="form-control @error('code') is-invalid @enderror"
                            value="{{ old('code', $course->code) }}"
                            required
                        >

                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Kursus --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Nama Kursus
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $course->name) }}"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Deskripsi Kursus
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description', $course->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Biaya --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Biaya Kursus (Rp)
                        </label>

                        <input
                            type="number"
                            name="fee"
                            min="0"
                            class="form-control @error('fee') is-invalid @enderror"
                            value="{{ old('fee', $course->fee) }}"
                            required
                        >

                        @error('fee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kuota --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Kuota Peserta
                        </label>

                        <input
                            type="number"
                            name="quota"
                            min="1"
                            max="500"
                            class="form-control @error('quota') is-invalid @enderror"
                            value="{{ old('quota', $course->quota) }}"
                            required
                        >

                        @error('quota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date', $course->start_date?->format('Y-m-d')) }}"
                            required
                        >

                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Status Kursus
                        </label>

                        <select
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required
                        >
                            <option value="draft"
                                @selected(old('status', $course->status) === 'draft')>
                                Draft
                            </option>

                            <option value="open"
                                @selected(old('status', $course->status) === 'open')>
                                Open
                            </option>

                            <option value="closed"
                                @selected(old('status', $course->status) === 'closed')>
                                Closed
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <hr class="my-4">

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('courses.show', $course) }}"
                        class="btn btn-outline-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-success px-4">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
```