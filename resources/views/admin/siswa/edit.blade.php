<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - Admin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body class="py-5 bg-white">

    <div class="container" style="max-width: 900px;">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="fw-bold mb-0" style="font-size: 1.75rem;">Edit Data Siswa</h1>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-black px-4 py-2">Kembali</a>
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
        <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nisn" class="form-label">NISN (10 Digit)</label>
                <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required maxlength="10" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control custom-input" placeholder="Masukkan 10 digit NISN...">
            </div>

            <div class="mb-4">
                <label for="nama" class="form-label">Nama Lengkap Siswa</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required class="form-control custom-input" placeholder="Masukkan nama siswa...">
            </div>

            <div class="mb-4">
                <label for="kelas" class="form-label">Kelas</label>
                <select id="kelas" name="kelas" required class="form-select custom-input">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $item)
                        <option value="{{ $item->nama_kelas }}" {{ old('kelas', $siswa->kelas) == $item->nama_kelas ? 'selected' : '' }}>
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required class="form-select custom-input">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-black px-4 py-2">Batal</a>
                <button type="submit" class="btn btn-outline-black px-4 py-2">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>