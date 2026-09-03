<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gallery->judul }} - Eimei Highschool</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Eksternal (Menyesuaikan dengan styling beranda/galeri) -->
    <link rel="stylesheet" href="{{ asset('css/home-custom.css') }}">
</head>
<body class="bg-white min-vh-100 d-flex flex-column">

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container">
            <a class="navbar-brand d-flex flex-column" href="{{ url('/') }}">
                <span class="fw-bold text-dark lh-1" style="font-size: 1.25rem;">栄明高等学校</span>
                <small class="text-secondary" style="font-size: 0.75rem;">Eimei Highschool</small>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Akademik</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('gallery.index') }}">Galeri</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Utama -->
    <main class="container py-4 flex-grow-1">
        
        <!-- Tombol Kembali ke Halaman Galeri -->
        <div class="mb-4">
            <a href="{{ route('gallery.index') }}" class="btn btn-black-pill px-4 py-2 text-decoration-none">
                Kembali
            </a>
        </div>

        <!-- Detail Layout (Gambar di Kiri, Informasi di Kanan) -->
        <div class="row g-5 align-items-start my-3">
            <!-- Kolom Gambar -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="{{ $gallery->judul }}" class="img-fluid rounded-4 w-100 shadow-sm object-fit-cover" style="height: 450px;">
            </div>

            <!-- Kolom Detail Teks -->
            <div class="col-md-6">
                <!-- Badge Kategori (Gaya Hitam Pill) -->
                <div class="mb-3">
                    <span class="badge bg-black px-3 py-2 rounded-pill fw-normal" style="font-size: 0.8rem;">
                        {{ $gallery->category->nama ?? $gallery->category->name ?? 'Semua foto' }}
                    </span>
                </div>

                <!-- Judul -->
                <h1 class="fw-bold text-dark mb-1" style="font-size: 2.2rem;">{{ $gallery->judul }}</h1>
                <p class="text-secondary small mb-4">Di unggah pada {{ $gallery->created_at->format('d M Y') }}</p>

                <!-- Deskripsi -->
                <div class="text-secondary lh-lg">
                    <p class="mb-0">{{ $gallery->deskripsi ?? 'Deskripsi kegiatan belum ditambahkan.' }}</p>
                </div>
            </div>
        </div>

    </main>

<!-- Footer -->
    <footer class="footer-section pt-5 pb-4 mt-5">
        <div class="container">
            <!-- Tambahkan justify-content-between agar kolom terdorong ke ujung kanan -->
            <div class="row g-4 mb-5 justify-content-between">
                
                <!-- Kolom Kiri (Logo & Deskripsi) -->
                <div class="col-md-5">
                    <h3 class="fw-bold mb-0">栄明高等学校</h3>
                    <p class="text-white-50 small mb-3">Eimei Highschool</p>
                    <p class="text-white-50 small pe-md-5">
                        Membentuk Generasi Berprestasi dalam Akademik dan Olahraga.
                    </p>
                </div>

                <div class="col-6 col-md-3">
                    <h6 class="fw-bold mb-3">Navigasi</h6>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-2"><a href="#tentang-kami" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#galeri" class="text-white-50 text-decoration-none">Kegiatan Sekolah</a></li>
                        <li class="mb-2"><a href="#akademik" class="text-white-50 text-decoration-none">Olahraga</a></li>
                        <li><a href="#galeri" class="text-white-50 text-decoration-none">Berita</a></li>
                    </ul>
                </div>

            </div> <!-- Tag penutup row yang tadi hilang -->

            <hr class="border-secondary my-4">

            <div class="small text-white-50">
                &copy; {{ date('Y') }} Eimei Highschool. Hak Cipta Dilindungi Undang-Undang.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>