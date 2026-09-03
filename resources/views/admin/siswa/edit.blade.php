<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Edit Data Siswa</h2>
            <a href="{{ route('admin.siswa.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN (10 Digit)</label>
                <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" required maxlength="10" inputmode="numeric"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Masukkan 10 digit NISN...">
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Siswa</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Masukkan nama siswa...">
            </div>

            <!-- Bagian kelas diubah menjadi select dropdown -->
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select id="kelas" name="kelas" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $item)
                        <option value="{{ $item->nama_kelas }}" {{ old('kelas', $siswa->kelas) == $item->nama_kelas ? 'selected' : '' }}>
                            {{ $item->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.siswa.index') }}" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 text-sm font-medium">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>