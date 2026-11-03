
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            KursusKu
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarKursusKu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarKursusKu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('practicum.enrollments.create') }}">
                        Pendaftaran Praktikum
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('enrollments.index') }}">
                        Daftar Pendaftaran
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>
