<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan - Eimei Highschool</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Eksternal Galeri -->
    <link rel="stylesheet" href="{{ asset('css/gallery-custom.css') }}">
</head>
<body class="bg-white min-vh-100 d-flex flex-column">

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg bg-white py-3 sticky-top border-bottom">
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
                    <li class="nav-item"><a class="nav-link" href="{{ url('/#beranda') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/#tentang-kami') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/#akademik') }}">Akademik</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('gallery.index') }}">Galeri</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Utama -->
    <main class="container py-4 flex-grow-1">
        
        <!-- Judul Halaman Centered -->
        <div class="text-center my-4">
            <h2 class="fw-bold text-dark mb-1" style="font-size: 2rem;">Galeri kegiatan</h2>
            <h1 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">栄明高等学校</h1>
            <p class="text-secondary small mt-1">Eimei Highschool</p>
        </div>

        <!-- Filter Kategori Tombol Oval -->
        <div class="d-flex justify-content-center flex-wrap gap-3 my-5">
            <a href="{{ route('gallery.index') }}" 
               class="btn btn-pill {{ !request('kategori') ? 'btn-pill-active' : 'btn-pill-outline' }} text-decoration-none">
                Semua foto
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('gallery.index', ['kategori' => $cat->slug]) }}" 
                   class="btn btn-pill {{ request('kategori') == $cat->slug ? 'btn-pill-active' : 'btn-pill-outline' }} text-decoration-none">
                    {{ $cat->nama ?? $cat->name }}
                </a>
            @endforeach
        </div>

        <!-- Grid Cards Galeri (3 Kolom Per Baris) -->
        <div class="row g-4 mb-5">
            @forelse ($galleries as $item)
                <div class="col-md-4">
                    <!-- Bungkus card dengan tag <a> agar bisa diklik -->
                    <a href="{{ route('gallery.show', $item->id) }}" class="text-decoration-none">
                        <div class="card border-0 gallery-card overflow-hidden shadow-sm h-100">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top gallery-card-img" alt="{{ $item->judul }}">
                                <span class="badge badge-category position-absolute top-0 end-0 m-3">
                                    {{ $item->category->nama ?? $item->category->name ?? 'Kategori' }}
                                </span>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="card-title fw-bold text-dark mb-0">{{ $item->judul }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fw-semibold">Belum ada dokumentasi untuk kategori ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($galleries->hasPages())
            <div class="d-flex justify-content-center mb-5">
                {{ $galleries->links() }}
            </div>
        @endif

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
                        <li class="mb-2"><a href="{{ url('/#tentang-kami') }}" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#galeri" class="text-white-50 text-decoration-none">Kegiatan Sekolah</a></li>
                        <li class="mb-2"><a href="{{ url('/#akademik') }}" class="text-white-50 text-decoration-none">Olahraga</a></li>
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