<x-app-layout>
    <div class="bg-[#faf9fc] min-h-screen font-sans" x-data="{ 
        showCartModal: false,
        selectedProduct: null,
        
        formatPrice(price) {
            return 'Rp' + price.toLocaleString('id-ID');
        },

        cartTotal() {
            return $store.cart.total();
        },

        cartCount() {
            return $store.cart.count();
        },

        async checkout() {
            const name = document.getElementById('checkout-name').value;
            const address = document.getElementById('checkout-address').value;
            const note = document.getElementById('checkout-note').value;

            if (!name || !address) {
                alert('Mohon lengkapi nama dan alamat pengiriman.');
                return;
            }

            try {
                const response = await axios.post('/checkout', {
                    name: name,
                    address: address,
                    note: note
                });

                if (response.data.redirect_url) {
                    window.open(response.data.redirect_url, '_blank');
                    this.showCartModal = false;
                    $store.cart.clear(); // This now calls the server clear
                }
            } catch (error) {
                console.error('Checkout failed:', error);
                alert('Terjadi kesalahan saat checkout. Silakan coba lagi.');
            }
        }
    }">
        {{-- Header Banner --}}
        <section class="relative w-full h-[300px] md:h-[350px] flex items-center justify-center overflow-hidden mb-8 md:mb-12 rounded-b-[2.5rem] shadow-sm mx-auto max-w-[1440px]">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-purple-900/80 to-primary/90 mix-blend-multiply z-10"></div>
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1594631252845-29fc458681b3?auto=format&fit=crop&q=80&w=1200')"></div>
            </div>
            <div class="relative z-20 text-center px-6 max-w-4xl mx-auto flex flex-col items-center gap-4 animate-reveal">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white/90 text-[10px] font-bold uppercase tracking-widest hover:bg-white/20 transition-colors cursor-default">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                    Official Community Store
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight leading-tight">
                    Oleh-Oleh Khas <br /><span class="text-purple-200">Dusun Sirat</span>
                </h1>
                <p class="text-purple-100 text-sm md:text-base font-medium max-w-xl leading-relaxed">
                    Produk olahan bunga telang asli, dipetik dan diolah langsung oleh warga desa dengan penuh cinta.
                </p>
            </div>
        </section>

        <div class="max-w-[1280px] mx-auto px-4 md:px-6 pb-24 flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            {{-- Category Navigation --}}
            <aside class="lg:w-64 flex-shrink-0 sticky top-20 z-40 lg:z-0 -mx-4 px-4 lg:mx-0 lg:px-0 bg-[#faf9fc]/95 backdrop-blur-sm lg:bg-transparent lg:backdrop-blur-none py-2 lg:py-0">
                <div class="lg:sticky lg:top-24 space-y-6">
                    <div class="flex lg:flex-col gap-3 overflow-x-auto pb-4 lg:pb-0 hide-scrollbar snap-x">
                        @foreach($categories as $category)
                            <a href="{{ route('shop.index', ['category' => $category['id'] == 'All' ? null : $category['id']]) }}"
                               class="flex-shrink-0 snap-start px-5 py-3 lg:py-4 rounded-xl lg:rounded-2xl font-bold text-sm transition-all flex items-center gap-3 group border {{ $currentCategory == $category['id'] ? 'bg-primary border-primary text-white shadow-md shadow-primary/10' : 'bg-white border-slate-100 text-slate-500 hover:border-primary/30 hover:text-primary hover:shadow-sm hover:bg-slate-50' }}">
                                <span class="material-symbols-outlined text-[20px] {{ $currentCategory == $category['id'] ? 'text-white' : 'text-slate-400 group-hover:text-primary' }}">
                                    {{ $category['icon'] }}
                                </span>
                                <span class="whitespace-nowrap">{{ $category['label'] }}</span>
                            </a>
                        @endforeach
                    </div>

                    {{-- Promo Card --}}
                    <div class="hidden lg:block purple-gradient rounded-3xl p-6 text-white relative overflow-hidden shadow-xl group cursor-pointer hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute -top-10 -right-10 size-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-colors"></div>
                        <span class="material-symbols-outlined text-4xl mb-3 opacity-80">local_offer</span>
                        <h3 class="text-xl font-black mb-2 leading-tight">Paket Hemat Wisata!</h3>
                        <p class="text-white/80 text-xs mb-4 leading-relaxed line-clamp-3">Dapatkan diskon spesial untuk pembelian bundle tiket wisata + produk olahan.</p>
                        <div class="h-1 w-12 bg-white/30 rounded-full group-hover:w-full transition-all duration-500"></div>
                    </div>
                </div>
            </aside>

            {{-- Product Grid --}}
            <div class="flex-1">
                <div class="flex items-center justify-between mb-6 px-1">
                    <h2 class="text-lg font-black text-slate-800 tracking-tight flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">grid_view</span>
                        {{ $currentCategory == 'All' ? 'Semua Produk' : collect($categories)->where('id', $currentCategory)->first()['label'] }}
                    </h2>
                    <span class="text-xs font-bold text-slate-400 bg-white px-3 py-1 rounded-full border border-slate-100 shadow-sm">
                        {{ $products->count() }} Item
                    </span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-[2rem] p-3 md:p-4 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full cursor-pointer"
                             @click="selectedProduct = {{ json_encode($product) }}">
                            
                            {{-- Image Area --}}
                            <div class="relative aspect-[4/3] rounded-[1.5rem] overflow-hidden bg-slate-100 mb-4">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-xs md:text-sm font-black text-slate-900 shadow-sm border border-white/50">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <button @click.stop="$store.cart.add({{ json_encode($product) }})"
                                        class="absolute bottom-3 right-3 size-10 bg-primary text-white rounded-full flex items-center justify-center shadow-lg shadow-primary/30 translate-y-14 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 hover:scale-110 active:scale-90"
                                        title="Tambah ke Keranjang">
                                    <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                                </button>
                            </div>

                            {{-- Content Area --}}
                            <div class="flex flex-col flex-grow px-1">
                                <div class="mb-2">
                                    <span class="text-[9px] font-bold text-primary/80 uppercase tracking-widest bg-primary/5 px-2 py-1 rounded-md inline-block mb-2">
                                        {{ $product->category == 'Drink' ? 'Minuman' : ($product->category == 'Care' ? 'Perawatan' : 'Bibit') }}
                                    </span>
                                    <h3 class="text-base md:text-lg font-black text-slate-800 leading-tight mb-1 line-clamp-2" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </h3>
                                </div>
                                <p class="text-slate-500 text-xs leading-relaxed line-clamp-2 mb-4 flex-grow">
                                    {{ $product->description }}
                                </p>
                                <div class="pt-3 border-t border-slate-50 flex items-center justify-between gap-3 mt-auto">
                                    <div class="flex items-center gap-1.5 text-slate-400" title="Ukuran/Kemasan">
                                        <span class="material-symbols-outlined text-[16px]">inventory_2</span>
                                        <span class="text-[10px] font-bold truncate max-w-[80px]">
                                            {{ Str::words($product->size, 2, '') }}
                                        </span>
                                    </div>
                                    <button @click.stop="$store.cart.add({{ json_encode($product) }})"
                                            class="lg:hidden text-primary text-xs font-black uppercase tracking-wider bg-primary/5 px-3 py-1.5 rounded-lg active:bg-primary active:text-white transition-colors">
                                        + Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Floating Cart Button --}}
        <button @click="showCartModal = true"
                class="fixed bottom-10 right-10 size-20 purple-gradient text-white rounded-3xl shadow-2xl flex items-center justify-center z-50 hover:scale-110 active:scale-95 transition-all duration-300 group">
            <span class="material-symbols-outlined text-3xl group-hover:rotate-12 transition-transform">shopping_bag</span>
            <span x-show="$store.cart.count() > 0"
                  class="absolute -top-3 -right-3 bg-red-500 text-white text-[10px] font-black size-8 rounded-full flex items-center justify-center border-4 border-white shadow-xl animate-bounce"
                  x-text="$store.cart.count()">
            </span>
        </button>

        {{-- Product Detail Modal --}}
        <div x-show="selectedProduct" 
             style="display: none;"
             class="fixed inset-0 z-[70] flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" @click="selectedProduct = null"></div>
            
            <div class="relative w-full max-w-5xl bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row h-[90vh] md:h-auto md:max-h-[90vh]"
                 @click.stop
                 x-data="{ activeTab: 'desc', quantity: 1 }">
                
                <button @click="selectedProduct = null" class="absolute top-6 right-6 z-10 size-10 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white md:text-slate-500 md:bg-white md:shadow-md flex items-center justify-center hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">close</span>
                </button>

                {{-- Left: Image --}}
                <div class="w-full md:w-1/2 bg-slate-50 p-6 flex flex-col gap-4">
                    <div class="relative aspect-square rounded-[2rem] overflow-hidden bg-white shadow-sm flex-1">
                        <img :src="selectedProduct?.image" :alt="selectedProduct?.name" class="w-full h-full object-cover">
                    </div>
                </div>

                {{-- Right: Content --}}
                <div class="flex-1 p-6 md:p-10 flex flex-col overflow-y-auto bg-white">
                    <div class="mb-6">
                        <h2 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight mb-2 tracking-tight" x-text="selectedProduct?.name"></h2>
                        <p class="text-2xl font-black text-primary" x-text="formatPrice(selectedProduct?.price || 0)"></p>
                    </div>

                    <div class="flex border-b border-slate-100 mb-6">
                         <button @click="activeTab = 'desc'" :class="activeTab === 'desc' ? 'border-primary text-primary' : 'border-transparent text-slate-400 hover:text-slate-600'" class="px-0 py-3 mr-6 text-sm font-bold border-b-2 transition-all">Deskripsi</button>
                         <button @click="activeTab = 'ingredients'" x-show="selectedProduct?.ingredients" :class="activeTab === 'ingredients' ? 'border-primary text-primary' : 'border-transparent text-slate-400 hover:text-slate-600'" class="px-0 py-3 mr-6 text-sm font-bold border-b-2 transition-all">Manfaat</button>
                         <button @click="activeTab = 'usage'" x-show="selectedProduct?.usage" :class="activeTab === 'usage' ? 'border-primary text-primary' : 'border-transparent text-slate-400 hover:text-slate-600'" class="px-0 py-3 mr-6 text-sm font-bold border-b-2 transition-all">Penyajian</button>
                    </div>

                    <div class="flex-1 min-h-[100px]">
                        <div x-show="activeTab === 'desc'" class="text-slate-600 leading-relaxed" x-text="selectedProduct?.description"></div>
                        <div x-show="activeTab === 'ingredients'" class="bg-green-50/50 p-4 rounded-xl border border-green-100 text-slate-700 leading-relaxed font-medium" x-text="selectedProduct?.ingredients"></div>
                        <div x-show="activeTab === 'usage'" class="bg-orange-50/50 p-4 rounded-xl border border-orange-100 text-slate-700 leading-relaxed font-medium" x-text="selectedProduct?.usage"></div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 flex gap-4 items-center">
                        <div class="flex items-center gap-3 bg-slate-50 rounded-2xl px-4 py-3 border border-slate-100">
                             <button @click="quantity = Math.max(1, quantity - 1)" class="size-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-slate-500 hover:text-primary transition-colors">-</button>
                             <span class="font-black text-slate-900 w-4 text-center" x-text="quantity"></span>
                             <button @click="quantity = quantity + 1" class="size-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-slate-500 hover:text-primary transition-colors">+</button>
                        </div>
                        <button @click="$store.cart.add(selectedProduct, quantity); selectedProduct = null; quantity = 1;"
                                class="flex-1 py-4 bg-primary text-white rounded-2xl font-black text-base uppercase tracking-widest flex items-center justify-center gap-3 shadow-xl shadow-primary/20 hover:brightness-110 active:scale-95 transition-all">
                            <span class="material-symbols-outlined text-2xl">shopping_bag</span>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cart Modal --}}
        <div x-show="showCartModal"
             style="display: none;"
             class="fixed inset-0 z-[80] flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" @click="showCartModal = false"></div>
            
            <div class="relative w-full max-w-5xl bg-[#f8f7fa] rounded-[2rem] overflow-hidden shadow-2xl flex flex-col max-h-[90vh]" @click.stop>
                 <div class="bg-white px-6 py-4 flex items-center justify-between border-b border-slate-100">
                      <div>
                           <h2 class="text-xl font-black text-slate-900 tracking-tight">Keranjang Belanja Anda</h2>
                           <p class="text-slate-500 text-xs">Periksa kembali pesanan produk lokal Anda sebelum checkout.</p>
                      </div>
                      <button @click="showCartModal = false" class="size-10 rounded-full bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 transition-colors">
                           <span class="material-symbols-outlined">close</span>
                      </button>
                 </div>

                 <div class="flex-1 overflow-y-auto p-6 md:p-8">
                     <div class="flex flex-col lg:flex-row gap-8 items-start">
                         <div class="w-full lg:flex-[3] space-y-4">
                             <template x-if="$store.cart.count() === 0">
                                  <div class="bg-white rounded-3xl p-10 text-center border border-slate-100 shadow-sm">
                                      <div class="size-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                           <span class="material-symbols-outlined text-4xl text-slate-300">shopping_cart_off</span>
                                      </div>
                                      <h3 class="text-lg font-bold text-slate-800 mb-2">Keranjang Kosong</h3>
                                      <button @click="showCartModal = false" class="text-primary font-bold text-sm hover:underline">Mulai Belanja</button>
                                  </div>
                             </template>
                             <template x-for="item in $store.cart.items" :key="item.id">
                                  <div class="bg-white p-4 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-4 md:gap-6">
                                       <div class="size-20 md:size-24 rounded-2xl bg-slate-50 overflow-hidden flex-shrink-0">
                                            <img :src="item.image" :alt="item.name" class="w-full h-full object-cover">
                                       </div>
                                       <div class="flex-1 min-w-0">
                                            <h4 class="font-bold text-slate-900 text-base md:text-lg mb-1 truncate" x-text="item.name"></h4>
                                            <p class="text-slate-900 font-bold text-base md:text-xl" x-text="formatPrice(item.price)"></p>
                                       </div>
                                       <div class="flex items-center gap-3">
                                            <div class="flex items-center bg-slate-50 rounded-xl p-1 border border-slate-200">
                                                 <button @click="$store.cart.updateQuantity(item.id, item.quantity - 1)" class="size-8 rounded-lg flex items-center justify-center hover:bg-white hover:shadow-sm text-slate-600 transition-all font-bold">-</button>
                                                 <span class="w-8 text-center text-sm font-bold text-slate-900" x-text="item.quantity"></span>
                                                 <button @click="$store.cart.updateQuantity(item.id, item.quantity + 1)" class="size-8 rounded-lg flex items-center justify-center hover:bg-white hover:shadow-sm text-slate-900 transition-all font-bold">+</button>
                                            </div>
                                            <button @click="$store.cart.remove(item.id)" class="size-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all">
                                                 <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                       </div>
                                  </div>
                             </template>
                         </div>

                         <div class="w-full lg:flex-[2] bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-lg lg:sticky lg:top-0">
                              <h3 class="text-lg font-bold text-slate-900 mb-1">Detail Pengiriman</h3>
                              <p class="text-slate-500 text-xs mb-6">Lengkapi data untuk estimasi ongkir via WhatsApp.</p>

                              <div class="space-y-5">
                                   <div class="space-y-1">
                                        <label class="text-xs font-bold text-slate-700 ml-1">Nama Lengkap</label>
                                        <input type="text" id="checkout-name" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium" placeholder="Masukkan nama anda">
                                   </div>
                                   <div class="space-y-1">
                                        <label class="text-xs font-bold text-slate-700 ml-1">Alamat Pengiriman</label>
                                        <textarea id="checkout-address" rows="3" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium resize-none" placeholder="Masukkan alamat lengkap..."></textarea>
                                   </div>
                                   <div class="space-y-1">
                                        <label class="text-xs font-bold text-slate-700 ml-1">Catatan (Opsional)</label>
                                        <textarea id="checkout-note" rows="2" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium resize-none" placeholder="Catatan tambahan..."></textarea>
                                   </div>

                                   <div class="py-4 border-t border-slate-50 space-y-2">
                                        <div class="flex justify-between text-sm text-slate-500">
                                             <span>Subtotal (<span x-text="cartCount()"></span> item)</span>
                                             <span class="font-bold text-slate-900" x-text="formatPrice(cartTotal())"></span>
                                        </div>
                                        <div class="flex justify-between text-lg font-black text-primary pt-2 mt-2 border-t border-dashed border-slate-200">
                                             <span>Total</span>
                                             <span x-text="formatPrice(cartTotal())"></span>
                                        </div>
                                   </div>

                                   <button @click="checkout()"
                                           :disabled="$store.cart.count() === 0"
                                           class="w-full py-4 bg-primary hover:bg-[#3a0066] disabled:opacity-50 disabled:cursor-not-allowed text-white rounded-xl font-bold flex items-center justify-center gap-2 shadow-xl shadow-primary/20 active:scale-[0.98] transition-all">
                                        <span class="material-symbols-outlined">chat</span>
                                        Beli via WhatsApp
                                   </button>
                              </div>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>
