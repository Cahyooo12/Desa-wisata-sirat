<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Tambah Berita Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-10 md:p-14">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Left Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Judul Berita</label>
                            <input type="text" name="title" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Judul berita...">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Kategori</label>
                            <select name="category" class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900">
                                <option value="News">News</option>
                                <option value="Event">Event</option>
                                <option value="Tips">Tips</option>
                                <option value="Story">Story</option>
                            </select>
                        </div>

                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
