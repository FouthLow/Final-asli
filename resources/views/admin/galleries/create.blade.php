<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto - Admin Galeri</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body class="py-5 bg-white">

    <div class="container" style="max-width: 900px;">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="fw-bold mb-0" style="font-size: 1.75rem;">Tambah foto galeri</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-black px-4 py-2">Kembali</a>
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
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul" class="form-label">Judul Foto</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required class="form-control custom-input">
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select id="kategori_id" name="kategori_id" required class="form-select custom-input">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name ?? $cat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control custom-input">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Custom File Input -->
            <div class="mb-5">
                <label class="form-label">Pilih gambar</label>
                <div class="d-flex align-items-center gap-3 mt-1">
                    <input type="file" id="gambar" name="gambar" accept="image/*" required class="d-none" onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'Tidak ada file'">
                    <label for="gambar" class="btn btn-black mb-0 px-4 py-2 cursor-pointer" style="cursor: pointer;">Pilih gambar</label>
                    <span id="file-name" class="text-secondary fw-medium">Tidak ada file</span>
                </div>
                <small class="text-muted d-block mt-2">Format: JPG, PNG, WEBP (Max 2MB)</small>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-black px-4 py-2">Batal</a>
                <button type="submit" class="btn btn-outline-black px-4 py-2">Unggah foto</button>
            </div>
        </form>
    </div>

</body>
</html>