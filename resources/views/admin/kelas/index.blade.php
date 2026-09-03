<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas - Eimei Highschool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body class="d-flex">

    <!-- Sidebar (Sama dengan halaman Siswa, tambahkan menu Kelas) -->
    <aside class="sidebar p-4 d-flex flex-column justify-content-between flex-shrink-0">
        <div>
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-secondary" style="width: 42px; height: 42px;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">{{ auth()->user()->name ?? 'Admin' }}</h6>
                    <small class="text-secondary" style="font-size: 0.75rem;">Role : Super Admin</small>
                </div>
            </div>
            
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </div>

            <div class="mb-4">
                <div class="text-dark fw-bold mb-3" style="font-size: 1.05rem;">Konten</div>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-person-badge"></i> Guru
                    </a>
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-people-fill"></i> Siswa
                    </a>
                </div>
            </div>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sidebar-outline w-100 text-start py-2 px-3 fw-semibold d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-grow-1 p-4 p-md-5">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
            <div>
                <h1 class="fw-bold text-dark mb-0" style="font-size: 1.75rem;">Kelola Data Kelas</h1>
                <p class="text-secondary small mb-0">Eimei Highschool</p>
            </div>
            <div>
                <button type="button" class="btn btn-sidebar-active py-2 px-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahKelas">
                    Tambah Kelas
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                Data gagal disimpan, nama kelas mungkin sudah ada.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="bg-white rounded-3 border shadow-sm overflow-hidden" style="max-width: 700px;">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light border-bottom">
                    <tr>
                        <th class="px-4 py-3 fw-bold" style="width: 10%;">No</th>
                        <th class="py-3 fw-bold" style="width: 60%;">Nama Kelas</th>
                        <th class="py-3 text-end px-4 fw-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelasList as $index => $k)
                        <tr>
                            <td class="px-4 text-secondary">{{ $kelasList->firstItem() + $index }}</td>
                            <td class="fw-bold text-dark">{{ $k->nama_kelas }}</td>
                            <td class="text-end px-4">
                                <div class="d-inline-flex gap-2">
                                    <button class="btn btn-sm btn-outline-dark px-3 py-1 d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalEditKelas{{ $k->id }}" style="border-radius: 6px;">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1" style="border-radius: 6px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Kelas -->
                        <div class="modal fade" id="modalEditKelas{{ $k->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header border-bottom-0 pb-0">
                                        <h5 class="modal-title fw-bold">Edit Kelas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.kelas.update', $k->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body py-4 text-start">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold text-dark">Nama Kelas</label>
                                                <input type="text" class="form-control border-dark" name="nama_kelas" value="{{ $k->nama_kelas }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 pt-0">
                                            <button type="button" class="btn btn-sidebar-outline px-4" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-sidebar-active px-4">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">Belum ada data kelas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($kelasList->hasPages())
            <div class="mt-4">{{ $kelasList->links('pagination::bootstrap-5') }}</div>
        @endif

        <!-- Modal Tambah Kelas -->
        <div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold">Tambah Kelas Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.kelas.store') }}" method="POST">
                        @csrf
                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Nama Kelas</label>
                                <input type="text" class="form-control border-dark" name="nama_kelas" placeholder="Contoh: XII - RPL 1" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>