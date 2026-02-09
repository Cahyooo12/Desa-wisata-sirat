<x-app-layout>
    <div class="pt-32 pb-20 bg-[#FAFAFA] min-h-screen font-sans text-slate-800">
        <div class="max-w-[1200px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- Main Content (Left) --}}
            <div class="lg:col-span-8">
                {{-- Header --}}
                <div class="mb-8">
                    <h1 class="text-4xl md:text-5xl font-serif font-bold text-slate-900 leading-[1.15] mb-6">
                        {{ $article->title }}
                    </h1>

                    <div class="flex items-center justify-between border-y border-slate-200 py-4">
                        <div class="flex items-center gap-3">
                            <div class="size-10 rounded-full bg-slate-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author) }}&background=random" alt="{{ $article->author }}" />
                            </div>
                            <div class="text-xs">
                                <p class="font-bold text-slate-900">{{ $article->author }} <span class="text-green-500 text-[10px] align-middle material-symbols-outlined">verified</span></p>
                                <p class="text-slate-500">{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : 'N/A' }} • {{ $article->views }} Views</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="size-8 flex items-center justify-center text-slate-400 hover:text-slate-900 transition-colors"><span class="material-symbols-outlined text-lg">bookmark</span></button>
                            <button class="size-8 flex items-center justify-center text-slate-400 hover:text-slate-900 transition-colors"><span class="material-symbols-outlined text-lg">share</span></button>
                        </div>
                    </div>
                </div>

                {{-- Featured Image --}}
                @if($article->image)
                <div class="rounded-2xl overflow-hidden mb-10 shadow-sm">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-auto object-cover" />
                    <p class="text-xs text-slate-400 mt-2 text-center italic">Dokumentasi: Desa Wisata Bunga Telang</p>
                </div>
                @endif

                {{-- Article Body --}}
                <div class="prose prose-lg prose-slate max-w-none prose-headings:font-serif prose-headings:font-bold prose-p:leading-loose prose-a:text-primary">
                    <p class="lead text-xl text-slate-600 font-serif italic mb-8">
                        {{ $article->excerpt }}
                    </p>

                    @if($article->content)
                        <div class="space-y-6">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                    @else
                        <div class="p-6 bg-slate-50 border border-slate-100 rounded-xl text-center">
                            <p class="mb-4">Artikel ini memuat konten dari sumber eksternal.</p>
                            @if($article->url)
                                <a href="{{ $article->url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-2 rounded-full font-bold text-sm hover:brightness-110 transition-all">
                                    Baca Selengkapnya <span class="material-symbols-outlined text-sm">open_in_new</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Tags / Footer --}}
                <div class="mt-12 flex gap-2 flex-wrap">
                    @if($article->category)
                        <a href="{{ route('story.index', ['category' => $article->category]) }}" class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold hover:bg-slate-200 cursor-pointer">#{{ $article->category }}</a>
                    @endif
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold hover:bg-slate-200 cursor-pointer">#DesaWisata</span>
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold hover:bg-slate-200 cursor-pointer">#BungaTelang</span>
                </div>
            </div>

            {{-- Sidebar (Right) --}}
            <div class="lg:col-span-4 space-y-10">

                {{-- Categories --}}
                <div>
                    <h3 class="font-serif font-bold text-xl mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">category</span> Kategori Populer
                    </h3>
                    <div class="space-y-2">
                        @foreach($categories as $cat)
                            <a href="{{ route('story.index', ['category' => $cat['name']]) }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-white hover:shadow-sm transition-all cursor-pointer group">
                                <span class="text-sm font-medium text-slate-600 group-hover:text-primary transition-colors">{{ $cat['name'] }}</span>
                                <span class="text-xs font-bold bg-slate-100 px-2 py-1 rounded text-slate-400 group-hover:bg-primary/10 group-hover:text-primary transition-colors">{{ $cat['count'] }} Articles</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Recent News --}}
                <div>
                    <h3 class="font-serif font-bold text-xl mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">newspaper</span> Berita Terbaru
                    </h3>
                    <div class="space-y-6">
                        @foreach($recentArticles as $recent)
                            <a href="{{ route('story.show', $recent->id) }}" class="flex gap-4 group">
                                <div class="size-20 shrink-0 rounded-xl overflow-hidden bg-slate-100">
                                    <img src="{{ $recent->image }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h4 class="font-bold text-slate-800 text-sm leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                        {{ $recent->title }}
                                    </h4>
                                    <span class="text-xs text-slate-400">{{ $recent->published_at ? \Carbon\Carbon::parse($recent->published_at)->format('d M Y') : '' }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('story.index') }}" class="w-full block py-3 text-center border border-slate-200 rounded-xl text-sm font-bold text-primary hover:bg-primary hover:text-white transition-all">
                            Lihat Semua Berita
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
