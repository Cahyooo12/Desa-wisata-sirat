<x-app-layout>
    <div class="pt-24 pb-20 bg-slate-50 min-h-screen font-sans text-slate-800" x-data="{ showEventModal: false, selectedEvent: null }">
        
        <div class="max-w-[1200px] mx-auto px-6">
            
            {{-- Page Header --}}
            <div class="text-center mb-16 animate-fade-in-up">
                <span class="inline-block px-4 py-1 bg-purple-100 text-primary rounded-full text-sm font-bold mb-4">
                    ✨ Kabar & Kegiatan Desa
                </span>
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-slate-900 mb-6">
                    Cerita dari <span class="text-primary">Bunga Telang</span>
                </h1>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                    Ikuti perkembangan terbaru, kisah inspiratif, dan jadwal kegiatan seru di Desa Wisata Bunga Telang.
                </p>
            </div>

            {{-- Featured Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                {{-- Main Content (Articles) --}}
                <div class="lg:col-span-8 space-y-8">
                    @forelse($articles as $article)
                        <div class="group bg-white rounded-3xl p-4 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col md:flex-row gap-6 animate-fade-in-up">
                            <div class="w-full md:w-1/3 aspect-video md:aspect-[4/3] rounded-2xl overflow-hidden relative">
                                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-slate-800">
                                    {{ $article->category }}
                                </div>
                            </div>
                            <div class="flex-1 py-2 flex flex-col justify-center">
                                <div class="flex items-center gap-3 text-xs text-slate-400 mb-3">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_month</span> {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : 'N/A' }}</span>
                                    <span>•</span>
                                    <span>{{ $article->views }} views</span>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                    <a href="{{ route('story.show', $article->id) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="text-slate-500 text-sm mb-4 line-clamp-2">
                                    {{ $article->excerpt }}
                                </p>
                                <a href="{{ route('story.show', $article->id) }}" class="inline-flex items-center gap-2 text-primary text-sm font-bold hover:gap-3 transition-all">
                                    Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-3xl border border-dashed border-slate-200">
                            <p class="text-slate-400">Belum ada artikel.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-4 space-y-8">
                    
                    {{-- Search Widget --}}
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <form action="{{ route('story.index') }}" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Cari artikel..." value="{{ request('search') }}" 
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border-transparent focus:bg-white focus:border-primary rounded-xl transition-all outline-none text-sm">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                        </form>
                    </div>

                    {{-- Categories Widget --}}
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                        <h3 class="font-bold text-lg text-slate-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">category</span> Kategori
                        </h3>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                                <a href="{{ route('story.index', ['category' => $category['name']]) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 group transition-colors">
                                    <span class="text-slate-600 text-sm font-medium group-hover:text-primary">{{ $category['name'] }}</span>
                                    <span class="bg-slate-100 text-slate-400 text-xs font-bold px-2 py-1 rounded group-hover:bg-primary/10 group-hover:text-primary transition-colors">{{ $category['count'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Events Widget --}}
                    <div class="bg-primary p-6 rounded-3xl shadow-lg relative overflow-hidden text-white">
                        <div class="absolute top-0 right-0 size-32 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                        <div class="absolute bottom-0 left-0 size-24 bg-white/10 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2"></div>
                        
                        <h3 class="font-bold text-lg mb-4 flex items-center gap-2 relative z-10">
                            <span class="material-symbols-outlined">event</span> Agenda Desa
                        </h3>

                        <div class="space-y-4 relative z-10">
                            @foreach($events->take(3) as $event)
                                <div class="flex gap-3 items-start group cursor-pointer" @click="showEventModal = true; selectedEvent = {{ $event }}">
                                    <div class="bg-white/10 p-2 rounded-lg text-center shrink-0 min-w-[50px]">
                                        <span class="block text-xl font-bold font-serif leading-none">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                        <span class="block text-[10px] uppercase opacity-80">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm leading-snug mb-1 group-hover:text-purple-200 transition-colors">{{ $event->title }}</h4>
                                        <p class="text-xs opacity-70">{{ $event->time }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button @click="showEventModal = true" class="w-full mt-6 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-xs font-bold transition-colors relative z-10">
                            Lihat Semua Jadwal
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Event Modal (Alpine.js) --}}
        <div x-show="showEventModal" style="display: none;" 
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            x-transition>
            
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden relative" @click.away="showEventModal = false">
                {{-- Modal Header --}}
                <div class="bg-primary px-8 py-6 relative overflow-hidden text-white">
                    <button @click="showEventModal = false" class="absolute top-4 right-4 p-2 hover:bg-white/20 rounded-full transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                    <h2 class="text-2xl font-bold">Jadwal Kegiatan</h2>
                    <p class="opacity-80 text-sm">Desa Wisata Bunga Telang 2026</p>
                </div>

                {{-- Modal Body --}}
                <div class="p-6 max-h-[60vh] overflow-y-auto custom-scrollbar space-y-4">
                    @foreach($events as $event)
                        <div class="flex gap-4 p-4 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                             <div class="shrink-0 w-16 h-16 bg-slate-100 rounded-2xl flex flex-col items-center justify-center text-slate-800">
                                <span class="text-xl font-bold">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                                <span class="text-xs font-bold uppercase text-slate-500">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">{{ $event->title }}</h3>
                                <div class="flex items-center gap-3 text-xs text-slate-500 my-1">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> {{ $event->time }}</span>
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">location_on</span> {{ $event->location }}</span>
                                </div>
                                <p class="text-sm text-slate-600">{{ $event->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
