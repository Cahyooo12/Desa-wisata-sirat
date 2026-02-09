<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Desa Wisata Bunga Telang') }}</title>
    <meta name="description" content="Desa Wisata Bunga Telang - Dusun Sirat, Sidomulyo, Bambanglipuro, Bantul. Nikmati keindahan alam, edukasi budidaya telang, dan produk olahan herbal." />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display text-[#151018] antialiased bg-gray-50 selection:bg-primary selection:text-white" x-data="{ scrolled: false, mobileOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
    
    <!-- Navbar -->
    @php
        $isTransparentRoute = request()->is('/', 'shop', 'about');
    @endphp
    
    <nav class="fixed top-0 z-50 w-full transition-all duration-500"
         :class="{ 
            'bg-white/90 backdrop-blur-md py-3 shadow-sm border-b border-slate-100 text-slate-800': scrolled || !{{ $isTransparentRoute ? 'true' : 'false' }},
            'bg-transparent py-6 border-b border-transparent text-white': !scrolled && {{ $isTransparentRoute ? 'true' : 'false' }}
         }">
        <div class="max-w-[1280px] mx-auto px-6 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="size-10 flex items-center justify-center rounded-xl shadow-sm group-hover:scale-110 transition-transform duration-300 overflow-hidden"
                     :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} ? 'bg-white/20 backdrop-blur-md' : 'bg-white'">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-cover" />
                </div>
                <h2 class="hidden md:block text-lg font-bold leading-tight tracking-tight"
                    :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} ? 'text-white' : 'text-[#151018]'">
                    Desa Wisata<br /><span :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} ? 'text-white/80' : 'text-primary'">Bunga Telang</span>
                </h2>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-9">
                @foreach([
                    ['name' => 'Beranda', 'url' => '/'],
                    ['name' => 'Wisata', 'url' => '/story'],
                    ['name' => 'Manfaat', 'url' => '/benefits'],
                    ['name' => 'Tentang', 'url' => '/about'],
                ] as $link)
                    <a href="{{ $link['url'] }}" 
                       class="text-sm font-semibold transition-all duration-300 hover:scale-105 {{ request()->is(ltrim($link['url'], '/')) ? 'scale-105' : '' }}"
                       :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} ? ( '{{ request()->is(ltrim($link['url'], '/')) || (request()->path() == '/' && $link['url'] == '/') ? 'text-white' : 'text-white/80 hover:text-white' }}' ) : ( '{{ request()->is(ltrim($link['url'], '/')) || (request()->path() == '/' && $link['url'] == '/') ? 'text-primary' : 'text-[#795e8d] hover:text-primary' }}' )">
                        {{ $link['name'] }}
                    </a>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center size-10 rounded-full transition-all relative"
                           :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} ? 'bg-white/10 backdrop-blur-md text-white/80 hover:bg-white/20 hover:text-white' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-primary'"
                           title="Dashboard">
                            <span class="material-symbols-outlined text-[20px]">dashboard</span>
                        </a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center justify-center size-10 rounded-full transition-all relative"
                                    :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} ? 'bg-white/10 backdrop-blur-md text-white/80 hover:bg-white/20 hover:text-white' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-primary'"
                                    title="Logout">
                                <span class="material-symbols-outlined text-[20px]">logout</span>
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center size-10 rounded-full transition-all relative"
                       :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} ? 'bg-white/10 backdrop-blur-md text-white/80 hover:bg-white/20 hover:text-white' : 'bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-primary'"
                       title="Login">
                        <span class="material-symbols-outlined text-[20px]">person</span>
                    </a>
                @endauth

                <a href="/shop" class="flex items-center justify-center size-10 rounded-full transition-all relative"
                   :class="!scrolled && {{ $isTransparentRoute ? 'true' : 'false' }} 
                        ? 'bg-white/20 backdrop-blur-md text-white border border-white/30 hover:bg-white/30' 
                        : ( '{{ request()->is('shop') ? 'bg-primary text-white shadow-xl shadow-primary/20' : 'bg-slate-100 text-slate-900 hover:bg-slate-200' }}' )">
                    <span class="material-symbols-outlined text-[22px]">shopping_cart</span>
                    {{-- Cart Badge (Placeholder for now) --}}
                    {{-- @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-black text-white border-2 border-white animate-bounce">
                        {{ $cartCount }}
                    </span>
                    @endif --}}
                </a>

                <button class="lg:hidden flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-[#151018]"
                        @click="mobileOpen = !mobileOpen">
                    <span class="material-symbols-outlined" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="lg:hidden absolute top-full left-0 w-full transition-all duration-500 transform origin-top"
             :class="mobileOpen ? 'scale-y-100 opacity-100' : 'scale-y-0 opacity-0'">
            <div class="mx-6 mt-4 bg-white/95 backdrop-blur-xl shadow-2xl rounded-2xl p-6 border border-slate-100">
                <div class="flex flex-col space-y-3">
                    @foreach([
                        ['name' => 'Beranda', 'url' => '/'],
                        ['name' => 'Wisata', 'url' => '/story'],
                        ['name' => 'Manfaat', 'url' => '/benefits'],
                        ['name' => 'Tentang', 'url' => '/about'],
                    ] as $link)
                        <a href="{{ $link['url'] }}" @click="mobileOpen = false"
                           class="text-sm font-bold p-4 rounded-xl transition-all {{ request()->is(ltrim($link['url'], '/')) || (request()->path() == '/' && $link['url'] == '/') ? 'bg-primary text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            {{ $link['name'] }}
                        </a>
                    @endforeach
                    
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left text-slate-600 hover:bg-slate-50 text-sm font-bold p-4 rounded-xl transition-all">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" @click="mobileOpen = false"
                           class="text-slate-600 hover:bg-slate-50 text-sm font-bold p-4 rounded-xl transition-all">
                            Login
                        </a>
                    @endauth

                    <a href="/shop" @click="mobileOpen = false"
                       class="bg-primary/10 text-primary p-4 rounded-xl text-center font-bold">
                        Belanja Produk
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-t border-[#f3f0f5] py-20 px-6">
        <div class="max-w-[1200px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-16">
            <div class="col-span-1 md:col-span-2 flex flex-col gap-6">
                <div class="flex items-center gap-3 text-primary font-bold text-2xl">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="size-10 rounded-xl object-cover shadow-sm bg-white" />
                    Desa Wisata Bunga Telang
                </div>
                <p class="text-[#795e8d] text-base max-w-sm leading-relaxed">
                    Menghadirkan keindahan alam, kearifan lokal, dan produk olahan bunga telang terbaik untuk Anda. Mari berkunjung dan rasakan ketenangannya di Dusun Sirat.
                </p>
                <div class="flex gap-4">
                     <!-- Social Links (Placeholder) -->
                     <a href="https://www.instagram.com/sitelang_/" target="_blank" class="size-11 rounded-2xl bg-slate-50 flex items-center justify-center text-[#795e8d] hover:bg-gradient-to-tr hover:from-purple-500 hover:via-pink-500 hover:to-orange-500 hover:text-white transition-all shadow-sm group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white transition-colors">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                     </a>
                     {{-- Other socials... --}}
                </div>
            </div>
            
            <div>
                <h4 class="font-bold text-[#151018] mb-6 tracking-tight">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="/about" class="text-[#795e8d] text-sm hover:text-primary transition-colors">Tentang Kami</a></li>
                    <li><a href="/shop" class="text-[#795e8d] text-sm hover:text-primary transition-colors">Produk Desa</a></li>
                    <li><a href="/story" class="text-[#795e8d] text-sm hover:text-primary transition-colors">Wisata & Berita</a></li>
                    <li><a href="/benefits" class="text-[#795e8d] text-sm hover:text-primary transition-colors">Manfaat Kesehatan</a></li>
                </ul>
            </div>

            <div>
                 <h4 class="font-bold text-[#151018] mb-6 tracking-tight">Kontak Lokasi</h4>
                 <div class="space-y-4">
                    <div class="flex items-start gap-3 text-[#795e8d] text-sm">
                        <span class="material-symbols-outlined text-primary text-xl">map</span>
                        <span>Dusun Sirat, Sidomulyo, Kec. Bambanglipuro, Bantul, Yogyakarta</span>
                    </div>
                    <div class="flex items-center gap-3 text-[#795e8d] text-sm">
                        <span class="material-symbols-outlined text-primary text-xl">call</span>
                        <span>+62 852 2931 2990</span>
                    </div>
                 </div>
            </div>
        </div>
        <div class="max-w-[1200px] mx-auto mt-20 pt-10 border-t border-[#f3f0f5] flex flex-col md:flex-row justify-between items-center gap-4 text-[#795e8d] text-xs font-bold uppercase tracking-widest">
            <p>© 2024 Desa Wisata Bunga Telang. Community Pride.</p>
        </div>
    </footer>
</body>
</html>
