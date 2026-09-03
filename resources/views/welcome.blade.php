<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eimei Highschool - Beranda</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Eksternal -->
    <link rel="stylesheet" href="{{ asset('css/home-custom.css') }}">
</head>
<body class="bg-white">

    <!-- Header / Navbar Sticky -->
    <nav class="navbar navbar-expand-lg bg-white py-3 sticky-top border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex flex-column" href="#beranda">
                <span class="fw-bold text-dark lh-1" style="font-size: 1.25rem;">栄明高等学校</span>
                <small class="text-secondary" style="font-size: 0.75rem;">Eimei Highschool</small>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link active" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang-kami">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#akademik">Akademik</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-3">
        
        <!-- Hero Section Banner -->
        <section id="beranda" class="hero-section d-flex align-items-center px-4 px-md-5 text-white">
            <div style="max-width: 500px;">
                <h1 class="fw-bold mb-3 display-6">Temukan Potensi Akademik dan Olahragamu.</h1>
                <p class="small text-light mb-0" style="opacity: 0.9;">
                    Eimei Highschool menyediakan lingkungan akademis dan pengembangan bakat olahraga berkualitas tinggi untuk mencetak generasi berprestasi hingga tingkat nasional.
                </p>
            </div>
        </section>

        <!-- About Showcase Section (Tentang Kami) -->
        <section id="tentang-kami" class="section-margin">
            <div class="row align-items-center g-4">
                <div class="col-md-5">
                    <img src="{{ asset('storage/images/Pic2.png') }}" alt="Badminton Player" class="img-fluid rounded-4 img-cover shadow-sm" style="height: 480px;">
                </div>
                <div class="col-md-7 ps-md-4">
                    <h2 class="fw-bold text-dark mb-3">Buka Segala Kemungkinan Bersama Kami.</h2>
                    <p class="text-secondary small mb-4">
                        Membuka potensi terbaik setiap siswa melalui lingkungan belajar yang suportif dan penuh tantangan. Kami hadir demi mencetak sumber daya akademis unggul dan pembawa prestasi melalui pembinaan berorientasi kompetisi, mandiri, berkarakter, dan meraih impian.
                    </p>
                    <a href="#akademik-desc" class="btn btn-black-pill">
                        Pelajari Lebih Lanjut <i class="bi bi-arrow-up-right ms-1"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Grid 4 Foto Cabang Olahraga -->
        <section id="akademik" class="section-margin1">
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <img src="{{ asset('storage/images/sport2.jpg') }}" class="img-fluid rounded-4 img-cover" style="height: 360px;" alt="Sports 1">
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ asset('storage/images/sport4.jpg') }}" class="img-fluid rounded-4 img-cover" style="height: 360px;" alt="Sports 2">
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ asset('storage/images/sport6.jpg') }}" class="img-fluid rounded-4 img-cover" style="height: 360px;" alt="Sports 3">
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ asset('storage/images/sport8.jpg') }}" class="img-fluid rounded-4 img-cover" style="height: 360px;" alt="Sports 4">
                </div>
            </div>
        </section>

        <!-- Program Siswa Section (Akademik) -->
        <section id="akademik-desc" class="section-margin2">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <h2 class="fw-bold text-dark mb-4">Program siswa<br>yang dapat Anda ikuti.</h2>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark mb-1">Keunggulan Akademik</h6>
                        <p class="text-secondary small mb-0">Kurikulum yang dirancang untuk memastikan siswa mampu bersaing masuk perguruan tinggi dan masa depan.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold text-dark mb-1">Program Atletik Nasional</h6>
                        <p class="text-secondary small mb-0">Fasilitas dan pelatih modern berstandar tinggi untuk cabang bulutangkis, voli, basket, hingga senam artistik.</p>
                    </div>

                    <div>
                        <h6 class="fw-bold text-dark mb-1">Komunitas yang Suportif</h6>
                        <p class="text-secondary small mb-0">Pertumbuhan karakter dan mental positif di mana latihan penuh kebersamaan mempererat hubungan antar siswa.</p>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/images/sport5.jpg') }}" class="img-fluid rounded-4 img-cover shadow-sm" style="max-height: 400px;" alt="Program Volley">
                </div>
            </div>
        </section>

        <!-- Section Galeri Kegiatan Terbaru -->
        <section id="galeri" class="py-4 mb-4">
            <h3 class="fw-bold text-dark mb-4">Galeri kegiatan</h3>

            <!-- Dynamic Gallery Cards (Terbaru) -->
            <div class="row g-4">
                @forelse ($galleries->take(3) as $item)
                    <div class="col-md-4">
                        <a href="{{ route('gallery.show', $item->id) }}" class="text-decoration-none">
                            <div class="card border-0 rounded-4 overflow-hidden shadow-sm gallery-card h-100 bg-light">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top img-cover" style="height: 200px;" alt="{{ $item->judul }}">
                                    <span class="badge bg-black position-absolute top-0 end-0 m-3 px-3 py-1 rounded-pill fw-normal" style="font-size: 0.75rem;">
                                        {{ $item->category->nama ?? $item->category->name ?? '-' }}
                                    </span>
                                </div>
                                <div class="card-body p-3">
                                    <h6 class="card-title fw-bold text-dark mb-1">{{ $item->judul }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        Belum ada foto galeri terbaru.
                    </div>
                @endforelse
            </div>

            <!-- Button Arahkan ke Halaman Full Galeri -->
            <div class="text-center mt-5">
                <a href="{{ route('gallery.index') }}" class="btn btn-black-pill px-4">
                    Lihat Lebih Lanjut <i class="bi bi-arrow-up-right ms-1"></i>
                </a>
            </div>
        </section>

    </div>

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