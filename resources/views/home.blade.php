
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $namaWebsite }}</title>

    <link rel="stylesheet"
          href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <div class="container">
            <h2>{{ $namaWebsite }}</h2>
        </div>
    </header>

    <main class="container">

        <section class="hero">
            <div class="hero-content">
                <h1>Belajar Teknologi, Bangun Masa Depan.</h1>

                <p>
                    Tingkatkan kemampuan teknologi dan pemrograman
                    melalui kursus yang mudah dipelajari.
                </p>
            </div>

            <div class="hero-image">
                <img src="{{ asset('images/hero-kursus.png') }}"
                     alt="Ilustrasi kursus teknologi">
            </div>
        </section>

        <h2 class="section-title">Daftar Kursus</h2>

        <section class="course-list">
            @foreach ($kursus as $item)
                <div class="course-card">
                    <h3>{{ $item['nama'] }}</h3>
                    <p>{{ $item['deskripsi'] }}</p>
                </div>
            @endforeach
        </section>

    </main>

    <footer>
        <p>&copy; {{ date('Y') }} {{ $namaWebsite }}</p>
    </footer>

</body>
</html>
