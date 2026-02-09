document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        items: [],

        async init() {
            await this.fetchCart();
        },

        async fetchCart() {
            try {
                const response = await axios.get('/cart');
                this.items = response.data.items;
            } catch (error) {
                console.error('Failed to fetch cart:', error);
            }
        },

        async add(product, quantity = 1) {
            try {
                // Optimistic UI update could be done here, but strictly relying on server for now to ensure consistency
                await axios.post('/cart/add', {
                    id: product.id,
                    quantity: quantity
                });
                await this.fetchCart();
                // Optional: Show toast notification
            } catch (error) {
                console.error('Failed to add to cart:', error);
                alert('Gagal menambahkan ke keranjang. Silakan coba lagi.');
            }
        },

        async remove(id) {
            try {
                await axios.post('/cart/remove', { id: id });
                await this.fetchCart();
            } catch (error) {
                console.error('Failed to remove item:', error);
            }
        },

        async updateQuantity(id, quantity) {
            if (quantity < 1) {
                return this.remove(id);
            }
            try {
                await axios.post('/cart/update', {
                    id: id,
                    quantity: quantity
                });
                await this.fetchCart();
            } catch (error) {
                console.error('Failed to update quantity:', error);
            }
        },

        async clear() {
            try {
                await axios.post('/cart/clear');
                this.items = [];
            } catch (error) {
                console.error('Failed to clear cart:', error);
            }
        },

        count() {
            return this.items.reduce((sum, item) => sum + item.quantity, 0);
        },

        total() {
            return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        }
    });
});
