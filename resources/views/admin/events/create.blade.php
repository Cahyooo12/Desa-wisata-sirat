<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.events.index') }}" class="p-2 bg-white rounded-xl shadow-sm text-slate-400 hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-black text-3xl text-slate-900 tracking-tight">
                {{ __('Tambah Event Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-reveal">
        <div class="p-10 md:p-14">
            <form action="{{ route('admin.events.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Left Column --}}
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Judul Event</label>
                            <input type="text" name="title" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Misal: Festival Bunga Telang">
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Deskripsi Lengkap</label>
                            <textarea name="description" rows="8" required class="w-full px-6 py-4 rounded-[2rem] bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Jelaskan detail event..."></textarea>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Tanggal</label>
                                <input type="date" name="date" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 appearance-none">
                            </div>
                            <div>
                                <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Waktu</label>
                                <input type="time" name="time" required class="w-full h-14 px-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900 appearance-none">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-black text-slate-700 ml-4 mb-2 block uppercase tracking-widest">Lokasi Event</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400">location_on</span>
                                <input type="text" name="location" required class="w-full h-14 pl-14 pr-6 rounded-full bg-slate-50 border-slate-200 focus:border-primary focus:ring-primary transition-all font-bold text-slate-900" placeholder="Lokasi kegiatan...">
                            </div>
                        </div>

                        <div class="p-8 bg-blue-50 rounded-[2rem] border border-blue-100 italic text-blue-700 text-sm">
                            <h4 class="font-black mb-2 uppercase tracking-widest text-[10px]">Tips Pengisian:</h4>
                            Pastikan lokasi sudah jelas bagi pengunjung. Gunakan waktu dalam format 24 jam untuk akurasi data sistem.
                        </div>
                    </div>
                </div>

                <div class="pt-10 border-t border-slate-50 flex items-center justify-end gap-4">
                    <a href="{{ route('admin.events.index') }}" class="px-8 py-4 font-black text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest text-sm">Batal</a>
                    <button type="submit" class="px-12 py-4 bg-primary text-white font-black rounded-full shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 transition-all uppercase tracking-widest">
                        Simpan Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
