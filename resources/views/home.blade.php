
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $namaWebsite }} | Belajar Teknologi</title>

    {{-- Bootstrap dan JavaScript --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS utama KursusKu: dimuat terakhir agar desain neon tetap dominan --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header class="site-header">
        <div class="container topbar">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-icon">K</span>
                <span>
                    <strong>{{ $namaWebsite }}</strong>
                    <small>Laravel MVC</small>
                </span>
            </a>

            <span class="milestone">Milestone 9</span>
        </div>

        {{-- Navbar Bootstrap --}}
        @include('partials.navbar')
    </header>

    <main>

        {{-- HERO SECTION --}}
        <section class="container hero">
            <div class="hero-content">

                <span class="eyebrow">
                    PERTEMUAN 9 · FRAMEWORK LARAVEL
                </span>

                <h1>
                    Belajar terstruktur dengan Route, Controller, dan Blade.
                </h1>

                <p class="hero-description">
                    Landing page KursusKu dipindahkan dari PHP biasa
                    ke pola framework Laravel. Request masuk melalui
                    route, data disiapkan controller, lalu Blade merender HTML.
                </p>

                <div class="hero-actions">

                    <a href="#kursus" class="button button-primary">
                        Program Belajar Unggulan
                    </a>

                    <a href="#alur-mvc" class="button button-secondary">
                        Lihat Alur MVC
                    </a>

                    <a href="{{ route('practicum.enrollments.create') }}"
                       class="button button-primary">
                        Daftar Praktikum
                    </a>

                </div>

                <div class="hero-stats">
                    <div>
                        <strong>Laravel 13</strong>
                        <span>Framework</span>
                    </div>

                    <div>
                        <strong>MVC</strong>
                        <span>Struktur aplikasi</span>
                    </div>

                    <div>
                        <strong>Belajar</strong>
                        <span>Sambil praktik</span>
                    </div>
                </div>

            </div>

            <div class="hero-visual">
                <div class="visual-glow"></div>

                <div class="image-frame">
                    <img
                        src="{{ asset('images/hero-kursus.png') }}"
                        alt="Ilustrasi pembelajaran teknologi KursusKu"
                    >
                </div>

                <div class="floating-tag">
                    ✦ Belajar · Praktik · Berkarya
                </div>
            </div>
        </section>

        {{-- ALUR MVC --}}
        <section class="container mvc-section" id="alur-mvc">

            <div class="section-heading">
                <span class="eyebrow">CARA KERJA APLIKASI</span>

                <h2>Kenali Alur MVC</h2>

                <p>
                    Setiap bagian memiliki tugas agar kode lebih terstruktur.
                </p>
            </div>

            <div class="mvc-list">

                <article class="mvc-card">
                    <span class="step-number">01</span>
                    <h3>Route</h3>
                    <p>
                        Menerima request pengguna melalui alamat halaman.
                    </p>
                </article>

                <article class="mvc-card">
                    <span class="step-number">02</span>
                    <h3>Controller</h3>
                    <p>
                        Menyiapkan nama website dan data kursus.
                    </p>
                </article>

                <article class="mvc-card">
                    <span class="step-number">03</span>
                    <h3>Blade View</h3>
                    <p>
                        Menyajikan data menjadi halaman HTML di browser.
                    </p>
                </article>

            </div>
        </section>

        {{-- KURSUS PILIHAN --}}
        <section class="container courses-section" id="kursus">

            <div class="section-heading">
                <span class="eyebrow">PILIH JALUR BELAJARMU</span>

                <h2>Kursus Pilihan</h2>

                <p>
                    Temukan program yang sesuai dengan minat dan tujuanmu.
                </p>
            </div>

            <div class="course-list">

                @foreach ($kursus as $item)

                    <article class="course-card">

                        <div class="course-icon">✦</div>

                        <h3>{{ $item['nama'] }}</h3>

                        <p>{{ $item['deskripsi'] }}</p>

                        <a href="#kursus" class="course-link">
                            Jelajahi program <span>→</span>
                        </a>

                    </article>

                @endforeach

            </div>
        </section>

        {{-- PENDAFTARAN PRAKTIKUM --}}
        <section class="container"
                 style="padding: 40px 0; text-align: center;">

            <h2>Siap Mengikuti Praktikum?</h2>

            <p>
                Silakan isi formulir pendaftaran dan pilih kursus
                yang ingin diikuti.
            </p>

            <a href="{{ route('practicum.enrollments.create') }}"
               class="button button-primary">
                Daftar Praktikum Sekarang →
            </a>

        </section>

    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container footer-content">

            <a href="{{ route('home') }}" class="footer-brand">
                {{ $namaWebsite }}
            </a>

            <p>Belajar Teknologi, Bangun Masa Depan.</p>

            <small>
                &copy; {{ date('Y') }} {{ $namaWebsite }} · Laravel MVC
            </small>

        </div>
    </footer>

</body>
</html>
