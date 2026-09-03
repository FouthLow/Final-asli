<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Eimei Highschool</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar p-4 d-flex flex-column justify-content-between flex-shrink-0">
            <div>
                <!-- Profil Admin -->
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-secondary" style="width: 42px; height: 42px;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">{{ auth()->user()->name ?? 'Admin 1' }}</h6>
                        <small class="text-secondary" style="font-size: 0.75rem;">Role : Super Admin</small>
                    </div>
                </div>

                <!-- Main Menu -->
                <div class="mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </div>

                <!-- Group Konten -->
                <div class="mb-4">
                    <div class="text-dark fw-bold mb-3" style="font-size: 1.05rem;">Konten</div>
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-sidebar-active w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                            <i class="bi bi-newspaper"></i> Berita
                        </a>
                        <a href=" {{ route('admin.guru.index') }} " class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                            <i class="bi bi-person-badge"></i> Guru
                        </a>
                        <a href=" {{ route('admin.siswa.index') }} " class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                            <i class="bi bi-person"></i> Siswa
                        </a>
                    </div>
                </div>
            </div>

            <!-- Group Lainnya / Logout -->
            <div>
                <div class="text-dark fw-bold mb-3" style="font-size: 1.05rem;">Lainnya</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow-1 p-4 p-md-5">
            
            <!-- Header Judul & Tombol Tambah Berita -->
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 class="fw-bold text-dark mb-0" style="font-size: 1.75rem;">
                        栄明高等学校 <span class="fw-normal ms-2" style="font-size: 1.5rem;">Panel admin</span>
                    </h1>
                    <p class="text-secondary small mb-0">Eimei Highschool</p>
                </div>
                <a href="{{ route('admin.news.create') }}" class="btn btn-dark rounded-3 px-4 py-2 fw-semibold">
                    Tambah berita
                </a>
            </div>

            <!-- Alert Notifikasi -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Kategori (Pill Buttons Custom) -->
            @if (isset($categories) && count($categories) > 0)
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('admin.news.index') }}" 
                    class="btn btn-pill {{ !request('kategori') ? 'btn-pill-active' : 'btn-pill-outline' }}">
                        Semua foto
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('admin.news.index', ['kategori' => $cat->slug]) }}" 
                        class="btn btn-pill {{ request('kategori') == $cat->slug ? 'btn-pill-active' : 'btn-pill-outline' }}">
                            {{ $cat->nama ?? $cat->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Grid Cards -->
            <div class="row g-4">
                @forelse ($galleries as $item)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card admin-gallery-card h-100">
                            <!-- Image container with category overlay -->
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="admin-gallery-img" alt="{{ $item->judul }}">
                                <span class="badge-kategori-overlay position-absolute top-0 end-0 m-2">
                                    {{ $item->category->nama ?? $item->category->name ?? 'Kategori' }}
                                </span>
                            </div>
                            
                            <!-- Card Body -->
                            <div class="card-body p-3 d-flex flex-column justify-content-between">
                                <h6 class="fw-bold text-dark mb-3">{{ $item->judul }}</h6>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    <a href="{{ route('galleries.edit', $item->id) }}" class="btn btn-dark btn-sm flex-grow-1 d-flex align-items-center justify-content-center gap-1 py-1">
                                        <i class="bi bi-pencil-square" style="font-size: 0.8rem;"></i> Ubah
                                    </a>
                                    
                                    <form action="{{ route('galleries.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-2 py-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        Belum ada item galeri yang diunggah.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if (method_exists($galleries, 'hasPages') && $galleries->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $galleries->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>