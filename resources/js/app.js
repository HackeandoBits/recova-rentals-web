import './bootstrap';
import persist from '@alpinejs/persist';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { Spanish } from 'flatpickr/dist/l10n/es.js';

window.flatpickr = flatpickr;
window.flatpickrSpanish = Spanish;

document.addEventListener('alpine:init', () => {
    // Register the persist plugin
    if (!Alpine.$persist) {
        Alpine.plugin(persist);
    }

    // Define the cart store with persistence and methods
    Alpine.store('cart', {
        items: Alpine.$persist([]).as('recova_cart_v3'),

        add(item) {
            if (!Array.isArray(this.items)) this.items = [];
            // Use loose equality (==) to handle string/int ID mismatches
            const existing = this.items.find(i => i.id == item.id);
            if (existing) {
                existing.quantity++;
            } else {
                this.items.push({
                    ...item,
                    quantity: 1
                });
            }
        },

        addCombo(itemsArray) {
            if (!Array.isArray(this.items)) this.items = [];
            itemsArray.forEach(newItem => {
                const existing = this.items.find(i => i.id == newItem.id);
                if (existing) {
                    existing.quantity += (newItem.quantity || 1);
                } else {
                    this.items.push({
                        ...newItem,
                        quantity: (newItem.quantity || 1)
                    });
                }
            });
        },

        remove(id) {
            if (!Array.isArray(this.items)) this.items = [];
            this.items = this.items.filter(i => i.id != id);
        },

        updateQuantity(id, quantity) {
            if (!Array.isArray(this.items)) this.items = [];
            const item = this.items.find(i => i.id == id);
            if (item) {
                if (quantity <= 0) {
                    this.remove(id);
                } else {
                    item.quantity = quantity;
                }
            }
        },

        clear() {
            this.items = [];
        },

        get count() {
            // Safety check: ensure items is an array
            if (!Array.isArray(this.items)) return 0;
            return this.items.reduce((acc, item) => acc + item.quantity, 0);
        }
    });
});

// Listener global
window.addEventListener('budget-sent', () => {
    if (window.Alpine) {
        Alpine.store('cart').clear();
    }
});