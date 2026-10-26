
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaWebsite }} | Belajar Teknologi</title>
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

            <span class="milestone">Milestone 7</span>
        </div>

        <nav class="navbar">
            <div class="container nav-content">
                <div class="nav-links">
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="#alur-mvc">Alur MVC</a>
                    <a href="#kursus">Kursus Pilihan</a>
                </div>

                <a href="#kursus" class="nav-button">Lihat Program</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="container hero">
            <div class="hero-content">
                <span class="eyebrow">PERTEMUAN 7 · FRAMEWORK LARAVEL</span>

                <h1>Belajar terstruktur dengan Route, Controller, dan Blade.</h1>

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
                <div class="floating-tag">✦ Belajar · Praktik · Berkarya</div>
            </div>
        </section>

        <section class="container mvc-section" id="alur-mvc">
            <div class="section-heading">
                <span class="eyebrow">CARA KERJA APLIKASI</span>
                <h2>Kenali Alur MVC</h2>
                <p>Setiap bagian memiliki tugas agar kode lebih terstruktur.</p>
            </div>

            <div class="mvc-list">
                <article class="mvc-card">
                    <span class="step-number">01</span>
                    <h3>Route</h3>
                    <p>Menerima request pengguna melalui alamat halaman.</p>
                </article>

                <article class="mvc-card">
                    <span class="step-number">02</span>
                    <h3>Controller</h3>
                    <p>Menyiapkan nama website dan data kursus.</p>
                </article>

                <article class="mvc-card">
                    <span class="step-number">03</span>
                    <h3>Blade View</h3>
                    <p>Menyajikan data menjadi halaman HTML di browser.</p>
                </article>
            </div>
        </section>

        <section class="container courses-section" id="kursus">
            <div class="section-heading">
                <span class="eyebrow">PILIH JALUR BELAJARMU</span>
                <h2>Kursus Pilihan</h2>
                <p>Temukan program yang sesuai dengan minat dan tujuanmu.</p>
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
    </main>

    <footer>
        <div class="container footer-content">
            <a href="{{ route('home') }}" class="footer-brand">
                {{ $namaWebsite }}
            </a>
            <p>Belajar Teknologi, Bangun Masa Depan.</p>
            <small>&copy; {{ date('Y') }} {{ $namaWebsite }} · Laravel MVC</small>
        </div>
    </footer>

</body>
</html>
