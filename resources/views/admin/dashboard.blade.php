<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Galeri Sekolah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin Dashboard Galeri</a>
            <div class="d-flex align-items-center gap-3">
                <span class="navbar-text text-white">
                    Halo, <strong>{{ auth()->user()->name }}</strong>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        
        <!-- Flash Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Statistik Ringkas -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted fw-semibold">Total Foto Galeri</h6>
                        <h2 class="card-title fw-bold text-primary mb-0">{{ $totalGalleries }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted fw-semibold">Total Kategori</h6>
                        <h2 class="card-title fw-bold text-success mb-0">{{ $totalCategories }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Tabel Data Galeri -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-bold mb-0">Daftar Foto Galeri</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm fw-semibold">
                        <i class="bi bi-tags me-1"></i> Kelola Kategori
                    </a>
                    <a href="{{ route('galleries.create') }}" class="btn btn-primary btn-sm fw-semibold">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Foto
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase text-secondary small">
                        <tr>
                            <th scope="col" class="ps-4">Gambar</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Kategori</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galleries as $item)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="rounded object-fit-cover" width="64" height="48">
                                </td>
                                <td class="fw-semibold text-dark">{{ $item->judul }}</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
                                        {{ $item->category->nama ?? $item->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('galleries.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('galleries.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">Belum ada foto yang diunggah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($galleries->hasPages())
                <div class="card-footer bg-white py-3">
                    {{ $galleries->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>