
@extends('layouts.app')

@section('title', 'Tambah Kursus - KursusKu')

@section('content')

{{-- Header --}}
<div class="mb-4">
    <span class="badge rounded-pill mb-2"
        style="background: rgba(57,255,20,0.12); color: #39ff14; border: 1px solid rgba(57,255,20,0.3);">
        KURSUSKU MANAGEMENT
    </span>

    <h2 class="fw-bold mb-2">
        Tambah <span style="color: #39ff14;">Kursus Baru</span>
    </h2>

    <p class="text-muted">
        Lengkapi informasi berikut untuk menambahkan kursus baru ke dalam sistem KursusKu.
    </p>
</div>

{{-- Form --}}
<div class="card">
    <div class="card-body p-4">

        <div class="mb-4">
            <h5 class="fw-bold mb-1">Informasi Kursus</h5>
            <p class="text-muted small mb-0">
                Pastikan seluruh informasi kursus sudah benar.
            </p>
        </div>

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- Kode Kursus --}}
                <div class="col-md-6 mb-4">
                    <label for="code" class="form-label">
                        Kode Kursus
                    </label>

                    <input
                        type="text"
                        name="code"
                        id="code"
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code') }}"
                        placeholder="Contoh: WEB002"
                        maxlength="20"
                        required
                    >

                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama Kursus --}}
                <div class="col-md-6 mb-4">
                    <label for="name" class="form-label">
                        Nama Kursus
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama kursus"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="col-12 mb-4">
                    <label for="description" class="form-label">
                        Deskripsi Kursus
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Jelaskan materi dan tujuan kursus..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Biaya --}}
                <div class="col-md-4 mb-4">
                    <label for="fee" class="form-label">
                        Biaya Kursus (Rp)
                    </label>

                    <input
                        type="number"
                        name="fee"
                        id="fee"
                        class="form-control @error('fee') is-invalid @enderror"
                        value="{{ old('fee', 0) }}"
                        min="0"
                        required
                    >

                    @error('fee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kuota --}}
                <div class="col-md-4 mb-4">
                    <label for="quota" class="form-label">
                        Kuota Peserta
                    </label>

                    <input
                        type="number"
                        name="quota"
                        id="quota"
                        class="form-control @error('quota') is-invalid @enderror"
                        value="{{ old('quota', 1) }}"
                        min="1"
                        max="500"
                        required
                    >

                    @error('quota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div class="col-md-4 mb-4">
                    <label for="start_date" class="form-label">
                        Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        id="start_date"
                        class="form-control @error('start_date') is-invalid @enderror"
                        value="{{ old('start_date') }}"
                        required
                    >

                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6 mb-4">
                    <label for="status" class="form-label">
                        Status Kursus
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required
                    >
                        <option value="">Pilih Status</option>

                        <option value="draft" @selected(old('status') === 'draft')>
                            Draft
                        </option>

                        <option value="open" @selected(old('status', 'open') === 'open')>
                            Open
                        </option>

                        <option value="closed" @selected(old('status') === 'closed')>
                            Closed
                        </option>
                    </select>

                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Tombol --}}
            <hr style="border-color: rgba(57,255,20,0.2);">

            <div class="d-flex flex-wrap gap-2 mt-3">

                <button type="submit" class="btn btn-success px-4 py-2">
                    ✓ Simpan Kursus
                </button>

                <a href="{{ route('courses.index') }}"
                    class="btn btn-outline-success px-4 py-2">
                    Kembali
                </a>

            </div>

        </form>

    </div>
</div>

@endsection
