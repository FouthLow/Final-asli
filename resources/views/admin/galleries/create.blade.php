<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto - Admin Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Tambah Foto Galeri</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali</a>
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

        <!-- 1. PASTIKAN ADA enctype="multipart/form-data" -->
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Foto</label>
                <!-- 2. PASTIKAN name="judul" -->
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Masukkan judul foto...">
            </div>

            <div>
                <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <!-- 3. PASTIKAN name="kategori_id" -->
                <select id="kategori_id" name="kategori_id" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('kategori_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name ?? $cat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                <!-- 4. PASTIKAN name="deskripsi" -->
                <textarea id="deskripsi" name="deskripsi" rows="3" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                          placeholder="Penjelasan singkat foto...">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Pilih File Gambar</label>
                <!-- 5. PASTIKAN name="gambar" -->
                <input type="file" id="gambar" name="gambar" accept="image/*" required 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 2MB)</p>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 text-sm font-medium">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition">Simpan & Upload</button>
            </div>
        </form>
    </div>

</body>
</html>