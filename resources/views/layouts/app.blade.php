<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FilmFavku - Aplikasi Manajemen Film Favorit')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            padding-top: 70px;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .card {
            transition: transform 0.3s;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .footer {
            margin-top: auto;
            padding: 20px 0;
            background-color: #343a40;
            color: white;
        }

        /* Responsive adjustments */
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }

        @media (max-width: 576px) {
            .card-img-top {
                height: 200px;
            }

            .display-4, .display-5 {
                font-size: 1.8rem;
            }

            .btn {
                margin-bottom: 0.25rem;
            }
        }

        @media (max-width: 768px) {
            .card-img-top {
                height: 250px;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }
        }

        /* Grid adjustments for different screen sizes */
        .col-responsive {
            flex: 0 0 auto;
            width: 100%;
        }

        @media (min-width: 576px) {
            .col-responsive {
                width: 50%;
            }
        }

        @media (min-width: 768px) {
            .col-responsive {
                width: 33.333333%;
            }
        }

        @media (min-width: 992px) {
            .col-responsive {
                width: 25%;
            }
        }

        /* Testing panel styles */
        .testing-panel {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .testing-btn {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .testing-btn:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-film"></i> FilmFavku
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Film
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('film.latest') }}">Terbaru</a></li>
                            <li><a class="dropdown-item" href="{{ route('film.search') }}">Pencarian</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('favorites.index') }}">Favorit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4 flex-grow-1">
        @yield('content')
    </main>

    <!-- Testing Panel -->
    <div class="testing-panel">
        <button class="btn btn-success testing-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#testingOffcanvas" aria-controls="testingOffcanvas">
            <i class="fas fa-vial"></i> Test
        </button>
    </div>

    <!-- Testing Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="testingOffcanvas" aria-labelledby="testingOffcanvasLabel">
        <div class="offcanvas-header bg-primary text-white">
            <h5 class="offcanvas-title" id="testingOffcanvasLabel">Panel Testing</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="mb-3">
                <h6>Endpoint Testing</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('api.test.connection') }}" class="btn btn-outline-primary btn-sm" target="_blank">
                        <i class="fas fa-plug"></i> Test API Connection
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-home"></i> Test Home Page
                    </a>
                    <a href="{{ route('film.latest') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-film"></i> Test Latest Films
                    </a>
                    <a href="{{ route('favorites.index') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-star"></i> Test Favorites
                    </a>
                </div>
            </div>

            <div class="mt-4">
                <h6>Responsive Testing</h6>
                <p class="small text-muted">Gunakan developer tools browser untuk menguji tampilan di berbagai ukuran layar.</p>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-secondary btn-sm" onclick="resizeWindow(375, 667)">
                        <i class="fas fa-mobile-alt"></i> Mobile (375px)
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" onclick="resizeWindow(768, 1024)">
                        <i class="fas fa-tablet-alt"></i> Tablet (768px)
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" onclick="resizeWindow(1200, 800)">
                        <i class="fas fa-desktop"></i> Desktop (1200px)
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2026 FilmFavku - Aplikasi Manajemen Film Favorit</p>
            <p>Dibuat dengan ❤️ menggunakan Laravel</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function resizeWindow(width, height) {
            window.resizeTo(width, height);
        }
    </script>

    @yield('scripts')
</body>
</html>