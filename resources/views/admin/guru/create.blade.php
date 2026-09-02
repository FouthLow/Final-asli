<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Tambah Data Guru</h2>
            <a href="{{ route('admin.guru.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali</a>
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

        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Guru</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Masukkan nama lengkap beserta gelar...">
            </div>

            <div>
                <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP (Tepat 12 Angka)</label>
                <input type="text" 
                       id="nip" 
                       name="nip" 
                       value="{{ old('nip') }}" 
                       required
                       maxlength="12" 
                       inputmode="numeric" 
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Contoh: 123456789012">
                <p class="text-xs text-gray-400 mt-1">Harus berisi tepat 12 digit angka.</p>
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan / Mata Pelajaran</label>
                <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Contoh: Guru Matematika / Kepala Sekolah">
            </div>

            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Guru</label>
                <input type="file" id="foto" name="foto" accept="image/*" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 2MB)</p>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.guru.index') }}" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 text-sm font-medium">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition">Simpan Data</button>
            </div>
        </form>
    </div>

</body>
</html>