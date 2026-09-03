<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Eimei Highschool</title>
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
                        <a href="{{ route('admin.guru.index') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                            <i class="bi bi-person-badge"></i> Guru
                        </a>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                            <i class="bi bi-person"></i> Siswa
                        </a>
                    </div>
                </div>
            </div>

            <!-- Logout -->
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
            
            <div class="mb-4">
                <a href="{{ route('admin.news.index') }}" class="text-decoration-none text-secondary small d-inline-flex align-items-center gap-1 mb-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Galeri
                </a>
                <h1 class="fw-bold text-dark mb-0" style="font-size: 1.75rem;">Edit Kategori</h1>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4" style="max-width: 600px;">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nama" class="form-label fw-semibold text-dark">Nama Kategori</label>
                        <input type="text" class="form-control rounded-3 p-2.5 @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $category->nama ?? $category->name) }}" placeholder="Masukkan nama kategori" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary px-4 rounded-3">Batal</a>
                        <button type="submit" class="btn btn-dark px-4 rounded-3 fw-semibold">Perbarui</button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>