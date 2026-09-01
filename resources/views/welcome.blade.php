<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar -->
    <header class="bg-white border-b sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800 tracking-wide">🖼️ Galeri Sekolah</h1>
            <div>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Dashboard Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600 font-medium">Login Admin</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8 flex-grow w-full">
        
        <!-- Filter Kategori -->
        <div class="flex flex-wrap gap-2 justify-center mb-8">
            <a href="{{ route('home') }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition {{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 border hover:bg-gray-50' }}">
                Semua
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('category') == $cat->slug ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 border hover:bg-gray-50' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <!-- Grid Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($galleries as $item)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">
                            {{ $item->category->name ?? 'Umum' }}
                        </span>
                        <h3 class="font-bold text-gray-800 mt-2 text-lg leading-snug">{{ $item->title }}</h3>
                        @if ($item->description)
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-400">
                    Belum ada foto dalam kategori ini.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $galleries->links() }}
        </div>

    </main>

    <footer class="bg-white border-t py-4 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} Galeri Sekolah - Proyek Ujikom
    </footer>

</body>
</html>