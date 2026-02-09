<x-app-layout>
    <div class="overflow-x-hidden">
        {{-- Premium Hero Section --}}
        <section class="relative flex min-h-screen w-full flex-col justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/40 z-10"></div>
                <div class="h-full w-full bg-cover bg-center transition-transform duration-[20s] hover:scale-105"
                     style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB3YAFKrvy2NveD9R-ckthaH7S4ezYJEYIH3agIxPqfRVrJxSVFmUXkLp6DIBfWkttYyqOx18ikDYLT89fazPG3Gj4-sFydrkStRTwCitNQUT7b3c4JEiCz1jvJVOUNYmb2CbFYyzC9v4nVLojL1HW3QlrWIMGPq4RcTl9tU2_1je4wh_j5kpVXnnNjDiQFbnq2HovgBCwc_Cx04rIDHbpqD-10xfHXYcQOPyRREQCUkFvvSk68qTFIyl2UhupAWSNoU5Fw1DAJT20')">
                </div>
            </div>

            <div class="relative z-20 flex flex-1 flex-col justify-center px-6 lg:px-40 py-20">
                <div class="flex flex-col max-w-[900px] gap-8 text-center mx-auto items-center animate-reveal">
                    <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/20 backdrop-blur-md border border-white/20 text-white text-xs font-black uppercase tracking-widest">
                        <span class="material-symbols-outlined text-sm">eco</span> Wisata Alam & Edukasi Desa
                    </span>
                    <h1 class="text-white text-6xl md:text-8xl font-black leading-[1.05] tracking-tight text-shadow-md">
                        Pesona Alami <br /> <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-indigo-300">Desa Bunga Telang</span>
                    </h1>
                    <p class="text-gray-100 text-lg md:text-2xl font-medium leading-relaxed max-w-[700px] text-shadow-md opacity-90">
                        Nikmati keindahan Dusun Sirat yang asri, edukasi budidaya telang, dan berbelanja produk olahan herbal langsung dari tangan petani.
                    </p>
                    <div class="flex flex-wrap justify-center gap-5 mt-4">
                        <a href="/shop" class="flex h-16 items-center justify-center rounded-2xl bg-white text-primary text-lg font-black px-10 shadow-2xl hover:scale-105 active:scale-95 transition-all">
                            Mulai Belanja
                        </a>
                        <a href="/story" class="flex h-16 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-md border border-white/30 hover:bg-white/20 text-white text-lg font-black px-10 transition-all">
                            Jelajahi Wisata
                            <span class="material-symbols-outlined ml-3 text-xl">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Activities Grid --}}
        <section class="bg-white py-32 px-6">
            <div class="max-w-[1200px] mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-end gap-10 mb-20">
                    <div class="max-w-2xl space-y-4">
                        <h2 class="text-slate-900 text-4xl md:text-5xl font-black tracking-tight">Jelajahi Aktivitas Desa</h2>
                        <p class="text-[#795e8d] text-lg leading-relaxed">Dari kebun bunga yang rimbun hingga workshop pembuatan teh, Dusun Sirat menawarkan pengalaman otentik yang tak terlupakan.</p>
                    </div>
                    <a href="/story" class="flex items-center gap-2 text-primary font-black uppercase text-sm tracking-widest border-b-2 border-primary pb-1">
                        Lihat Semua Wisata <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Activity 1 --}}
                    <div class="group bg-slate-50 p-10 rounded-3xl hover:bg-white hover:shadow-2xl transition-all duration-500 border border-transparent hover:border-slate-100">
                        <div class="size-16 rounded-2xl bg-purple-100 flex items-center justify-center text-primary mb-8 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">school</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Edukasi Budidaya</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">Belajar cara menanam, merawat, dan memanen bunga telang langsung dari para petani berpengalaman Dusun Sirat.</p>
                        <button class="text-primary font-bold flex items-center gap-2">Selengkapnya <span class="material-symbols-outlined text-base">east</span></button>
                    </div>

                    {{-- Activity 2 --}}
                    <div class="group bg-slate-50 p-10 rounded-3xl hover:bg-white hover:shadow-2xl transition-all duration-500 border border-transparent hover:border-slate-100">
                        <div class="size-16 rounded-2xl bg-green-100 flex items-center justify-center text-secondary mb-8 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">nature_people</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Eko-Wisata Alam</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">Nikmati keasrian pedesaan dan spot foto instagramable di hamparan kebun bunga telang yang berwarna ungu cantik.</p>
                        <button class="text-secondary font-bold flex items-center gap-2">Selengkapnya <span class="material-symbols-outlined text-base">east</span></button>
                    </div>

                    {{-- Activity 3 --}}
                    <div class="group bg-slate-50 p-10 rounded-3xl hover:bg-white hover:shadow-2xl transition-all duration-500 border border-transparent hover:border-slate-100">
                        <div class="size-16 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600 mb-8 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">shopping_bag</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">Pasar UMKM Desa</h3>
                        <p class="text-slate-500 leading-relaxed mb-6">Dapatkan aneka produk olahan seperti teh, sirup, hingga produk kecantikan hasil karya tangan warga lokal.</p>
                        <button class="text-indigo-600 font-bold flex items-center gap-2">Selengkapnya <span class="material-symbols-outlined text-base">east</span></button>
                    </div>
                </div>
            </div>
        </section>

        {{-- Newsletter / CTA Section --}}
        <section class="pb-32 px-6">
            <div class="max-w-[1100px] mx-auto purple-gradient rounded-[3rem] p-12 md:p-24 text-center text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 size-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 translate-x-1/3 translate-y-1/3 size-96 bg-secondary/30 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col items-center gap-8 animate-reveal">
                    <h2 class="text-4xl md:text-5xl font-black leading-tight tracking-tight">Kabar Terbaru Dari Desa</h2>
                    <p class="text-white/80 text-lg md:text-xl max-w-2xl font-medium">Bergabunglah dengan komunitas pecinta Bunga Telang untuk mendapatkan tips kesehatan, promo eksklusif, dan info panen raya.</p>
                    <div class="flex flex-col sm:flex-row gap-4 w-full max-w-lg mt-4">
                        <input
                            type="email"
                            placeholder="Masukkan alamat email"
                            class="flex-1 h-16 rounded-2xl border-none bg-white/10 backdrop-blur-md text-white placeholder-white/50 px-6 focus:ring-2 focus:ring-white/50"
                        />
                        <button class="h-16 px-10 rounded-2xl bg-white text-primary font-black shadow-xl hover:scale-105 active:scale-95 transition-all">
                            Berlangganan
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
