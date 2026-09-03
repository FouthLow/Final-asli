<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Siswa - Eimei Highschool</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body class="d-flex">

    <!-- Sidebar -->
    <aside class="sidebar p-4 d-flex flex-column justify-content-between flex-shrink-0">
        <div>
            <!-- Profil Admin -->
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-secondary" style="width: 42px; height: 42px;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">{{ auth()->user()->name ?? 'Admin' }}</h6>
                    <small class="text-secondary" style="font-size: 0.75rem;">Role : Super Admin</small>
                </div>
            </div>

            <!-- Menu Dashboard -->
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </div>

            <!-- Menu Konten -->
            <div class="mb-4">
                <div class="text-dark fw-bold mb-3" style="font-size: 1.05rem;">Konten</div>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-person-badge"></i> Guru
                    </a>
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-sidebar-active w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-people-fill"></i> Siswa
                    </a>
                </div>
            </div>
        </div>

        <!-- Tombol Keluar -->
        <div>
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
        <!-- Header Page & Actions -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
            <div>
                <h1 class="fw-bold text-dark mb-0" style="font-size: 1.75rem;">
                    栄明高等学校 <span class="fw-normal ms-2" style="font-size: 1.5rem;">Kelola Data Siswa</span>
                </h1>
                <p class="text-secondary small mb-0">Eimei Highschool</p>
            </div>

            <!-- Search Bar & Buttons -->
            <div class="d-flex align-items-center gap-2">
                <!-- Input Telursuri (Fungsi GET ke index) -->
                <form action="{{ route('admin.siswa.index') }}" method="GET" class="position-relative" style="width: 250px;">
                    <input type="text" name="search" class="form-control rounded-pill pe-5 ps-3 py-2 border-dark" placeholder="Telursuri" value="{{ request('search') }}" style="font-size: 0.875rem;">
                    <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y border-0 pe-3 bg-transparent">
                        <i class="bi bi-search text-dark"></i>
                    </button>
                </form>

                <!-- Tombol Kelola Kelas (Mengarah ke halaman index kelas) -->
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-sidebar-active py-2 px-3 fw-semibold">
                    Kelola Kelas
                </a>

                <!-- Tombol Tambah Siswa -->
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-sidebar-active py-2 px-3 fw-semibold">
                    Tambah Siswa
                </a>
            </div>
        </div>

        <!-- Alert Notification -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card & Tabel Siswa -->
        <div class="bg-white rounded-3 border shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th class="px-4 py-3 fw-bold">No</th>
                            <th class="py-3 fw-bold">NISN</th>
                            <th class="py-3 fw-bold">Nama Lengkap</th>
                            <th class="py-3 fw-bold">Kelas</th>
                            <th class="py-3 fw-bold">Jenis Kelamin</th>
                            <th class="py-3 text-end px-4 fw-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $index => $siswa)
                            <tr>
                                <td class="px-4 text-secondary">{{ $siswas->firstItem() + $index }}</td>
                                <td class="fw-bold text-dark">{{ $siswa->nisn }}</td>
                                <td class="text-dark">{{ $siswa->nama }}</td>
                                <td>
                                    <!-- Badge kelas menggunakan style border tipis -->
                                    <span class="badge bg-white text-dark border font-monospace px-2 py-1 fw-semibold" style="font-size: 0.75rem;">
                                        {{ $siswa->kelas }}
                                    </span>
                                </td>
                                <td class="text-dark">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="text-end px-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-sm btn-outline-dark px-3 py-1 d-inline-flex align-items-center gap-1" style="border-radius: 6px;">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Hapus data siswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1" style="border-radius: 6px;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($siswas->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $siswas->links('pagination::bootstrap-5') }}
            </div>
        @endif

        <!-- Modal Tambah Kelas -->
        <div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-labelledby="modalTambahKelasLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold" id="modalTambahKelasLabel">Tambah Kelas Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Pastikan route 'admin.kelas.store' sudah terdaftar di web.php -->
                    <form action="{{ route('admin.kelas.store') }}" method="POST">
                        @csrf
                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label fw-semibold text-dark">Nama Kelas</label>
                                <input type="text" class="form-control border-dark" id="nama_kelas" name="nama_kelas" placeholder="Contoh: XII - RPL 1" required>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 pt-0">
                            <button type="button" class="btn btn-sidebar-outline px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sidebar-active px-4">Simpan Kelas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>