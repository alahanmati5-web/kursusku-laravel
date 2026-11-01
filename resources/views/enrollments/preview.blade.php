```blade
@extends('layouts.app')

@section('title', 'Preview Pendaftaran | KursusKu')

@section('content')

<style>
    body {
        background: #07110c !important;
        color: #e8f5ec !important;
    }

    .preview-wrapper {
        max-width: 800px;
        margin: 45px auto;
    }

    .preview-card {
        background: linear-gradient(145deg, #102019, #09140e);
        border: 1px solid rgba(57, 255, 123, 0.35);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 0 25px rgba(57, 255, 123, 0.10);
    }

    .preview-header {
        padding: 28px;
        background: rgba(57, 255, 123, 0.07);
        border-bottom: 1px solid rgba(57, 255, 123, 0.2);
    }

    .preview-header h3 {
        color: #39ff7b;
        font-weight: 700;
        text-shadow: 0 0 12px rgba(57, 255, 123, 0.3);
    }

    .preview-header p {
        color: #a8c5b1;
        margin-bottom: 0;
    }

    .preview-body {
        padding: 30px;
    }

    .preview-table {
        color: #e8f5ec !important;
        border-color: #28583a !important;
        margin-top: 22px;
    }

    .preview-table th {
        width: 35%;
        background: rgba(57, 255, 123, 0.06);
        color: #39ff7b;
    }

    .preview-table td,
    .preview-table th {
        background-color: transparent !important;
        border-color: #28583a !important;
        padding: 16px;
    }

    .preview-note {
        background: rgba(57, 255, 123, 0.07);
        color: #b9e9c7;
        border: 1px solid rgba(57, 255, 123, 0.3);
        border-radius: 10px;
        padding: 15px;
        margin-top: 22px;
    }

    .btn-neon {
        background: #39ff7b;
        color: #07110c;
        border: 1px solid #39ff7b;
        border-radius: 10px;
        padding: 11px 22px;
        font-weight: 700;
        text-decoration: none;
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

    @media (max-width: 576px) {
        .preview-body {
            padding: 18px;
        }

        .preview-header {
            padding: 22px;
        }

        .preview-table th {
            width: 40%;
        }

        .preview-actions {
            flex-direction: column;
            gap: 12px;
        }

        .preview-actions a {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="preview-wrapper">

    <div class="preview-card">

        <div class="preview-header">
            <span class="badge rounded-pill text-bg-success mb-3">
                KURSUSKU · KONFIRMASI
            </span>

            <h3>Preview Pendaftaran Praktikum</h3>

            <p>Periksa kembali informasi yang sudah kamu masukkan.</p>
        </div>

        <div class="preview-body">

            <h5 style="color: #39ff7b;">
                ✦ Informasi Pendaftaran
            </h5>

            <table class="table table-bordered preview-table">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $data['name'] }}</td>
                </tr>

                <tr>
                    <th>Alamat Email</th>
                    <td>{{ $data['email'] }}</td>
                </tr>

                <tr>
                    <th>Kursus</th>
                    <td>{{ $courseName }}</td>
                </tr>
            </table>

            <div class="preview-note">
                <strong>Informasi:</strong><br>
                Ini merupakan preview data pendaftaran.
                Belum ada data yang disimpan ke database.
            </div>

            <hr style="border-color: #28583a; margin: 28px 0;">

            <div class="d-flex justify-content-between align-items-center preview-actions">

                <a href="{{ route('practicum.enrollments.create') }}"
                    class="btn-outline-neon">
                    ← Kembali ke Formulir
                </a>

                <a href="{{ route('home') }}" class="btn-neon">
                    Kembali ke Beranda
                </a>

            </div>

        </div>
    </div>

    <p class="text-center mt-4" style="color: #789382;">
        Belajar Teknologi, Bangun Masa Depan.
    </p>

</div>

@endsection
```