<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('title', $article->title) }}" required>
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="Berita" {{ $article->category == 'Berita' ? 'selected' : '' }}>Berita</option>
                                <option value="Kegiatan" {{ $article->category == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="Pengumuman" {{ $article->category == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="Wisata" {{ $article->category == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                            </select>
                        </div>

                         <!-- Excerpt -->
                         <div class="mb-4">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" id="excerpt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('excerpt', $article->excerpt) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Ditampilkan di halaman depan.</p>
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                            <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('content', $article->content) }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Gambar Utama (Biarkan kosong jika tidak diganti)</label>
                            @if($article->image)
                                <div class="mb-2">
                                    <img src="{{ $article->image }}" alt="Current Image" class="h-32 w-auto object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" accept="image/*">
                        </div>

                        <!-- Published At -->
                         <div class="mb-4">
                            <label for="published_at" class="block text-sm font-medium text-gray-700">Tanggal Publish</label>
                            <input type="date" name="published_at" id="published_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('published_at', $article->published_at ? date('Y-m-d', strtotime($article->published_at)) : '') }}">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.articles.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="button" onclick="history.back()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-4">
                                Kembali
                            </button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
