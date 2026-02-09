<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Panel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f8fafc] text-[#1e293b]">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed inset-y-0 z-50">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-slate-50 flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="size-10 rounded-full object-cover shadow-sm" />
                <div>
                    <h1 class="font-black text-slate-800 text-sm leading-tight">Desa Wisata</h1>
                    <p class="text-[10px] font-bold text-primary tracking-widest uppercase">Admin Panel</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-4 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                    <span class="material-symbols-outlined text-[22px]">dashboard</span>
                    <span class="font-bold text-sm">Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                    <span class="material-symbols-outlined text-[22px]">shopping_bag</span>
                    <span class="font-bold text-sm">Produk Shop</span>
                </a>

                <a href="{{ route('admin.events.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.events.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                    <span class="material-symbols-outlined text-[22px]">calendar_month</span>
                    <span class="font-bold text-sm">Event</span>
                </a>

                <a href="{{ route('admin.articles.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.articles.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                    <span class="material-symbols-outlined text-[22px]">newspaper</span>
                    <span class="font-bold text-sm">Berita</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.orders.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-slate-500 hover:bg-slate-50 hover:text-primary' }}">
                    <span class="material-symbols-outlined text-[22px]">receipt_long</span>
                    <span class="font-bold text-sm">Pesanan</span>
                </a>
            </nav>

            <!-- Bottom Menu -->
            <div class="p-4 border-t border-slate-50 space-y-2">
                <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-500 hover:bg-slate-50 hover:text-primary transition-all">
                    <span class="material-symbols-outlined text-[22px]">language</span>
                    <span class="font-bold text-sm">Lihat Website</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-rose-500 hover:bg-rose-50 transition-all font-bold text-sm">
                        <span class="material-symbols-outlined text-[22px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <header class="mb-10">
                {{ $header ?? '' }}
            </header>

            <div class="animate-reveal">
                {{ $slot }}
            </div>
        </main>
    </div>

    <style>
        :root {
            --primary: #4a0080;
            --primary-light: #6a0dad;
        }
        .bg-primary { background-color: var(--primary); }
        .text-primary { color: var(--primary); }
        .shadow-primary { --tw-shadow-color: var(--primary); }
        .animate-reveal {
            animation: reveal 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes reveal {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
