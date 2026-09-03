<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru - Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body class="py-5 bg-white">

    <div class="container" style="max-width: 900px;">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="fw-bold mb-0" style="font-size: 1.75rem;">Tambah Data Guru</h1>
            <a href="{{ route('admin.guru.index') }}" class="btn btn-black px-4 py-2">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama" class="form-label">Nama Lengkap Guru</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required class="form-control custom-input" placeholder="Masukkan nama lengkap beserta gelar...">
            </div>

            <div class="mb-4">
                <label for="nip" class="form-label">NIP (Tepat 12 Angka)</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required maxlength="12" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control custom-input" placeholder="Contoh: 123456789012">
                <small class="text-muted d-block mt-2">Harus berisi tepat 12 digit angka.</small>
            </div>

            <div class="mb-4">
                <label for="jabatan" class="form-label">Jabatan / Mata Pelajaran</label>
                <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required class="form-control custom-input" placeholder="Contoh: Guru Matematika / Kepala Sekolah">
            </div>

            <!-- Custom File Input -->
            <div class="mb-5">
                <label class="form-label">Foto Guru</label>
                <div class="d-flex align-items-center gap-3 mt-1">
                    <input type="file" id="foto" name="foto" accept="image/*" class="d-none" onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'Tidak ada file'">
                    <label for="foto" class="btn btn-black mb-0 px-4 py-2 cursor-pointer" style="cursor: pointer;">Pilih gambar</label>
                    <span id="file-name" class="text-secondary fw-medium">Tidak ada file</span>
                </div>
                <small class="text-muted d-block mt-2">Format: JPG, PNG, WEBP (Max 2MB)</small>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="{{ route('admin.guru.index') }}" class="btn btn-black px-4 py-2">Batal</a>
                <button type="submit" class="btn btn-outline-black px-4 py-2">Simpan Data</button>
            </div>
        </form>
    </div>

</body>
</html>