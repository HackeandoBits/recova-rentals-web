import './bootstrap';
import persist from '@alpinejs/persist';

// Solo registramos el plugin y conectamos la persistencia
document.addEventListener('alpine:init', () => {
    // Check if the plugin is already registered to avoid "Cannot redefine property" error
    if (!Alpine.$persist) {
        Alpine.plugin(persist);
    }

    // Pre-check localStorage to ensure valid data format
    try {
        const stored = localStorage.getItem('budget_cart');
        if (stored) {
            const parsed = JSON.parse(stored);
            if (!Array.isArray(parsed)) {
                console.warn('Resetting invalid cart storage');
                localStorage.removeItem('budget_cart');
            } else {
                // Filter out invalid items and deduplicate
                const uniqueItems = [];
                const seenIds = new Set();

                for (const item of parsed) {
                    // Ensure item is an object and has a valid ID
                    if (item && typeof item === 'object' && item.hasOwnProperty('id') && item.id != null) {
                        if (!seenIds.has(item.id)) {
                            seenIds.add(item.id);
                            uniqueItems.push(item);
                        }
                    }
                }

                // If we filtered anything out, update storage
                if (uniqueItems.length !== parsed.length) {
                    console.warn('Cleaned up invalid/duplicate items from cart');
                    localStorage.setItem('budget_cart', JSON.stringify(uniqueItems));
                }
            }
        }
    } catch (e) {
        console.warn('Error parsing cart storage, resetting');
        localStorage.removeItem('budget_cart');
    }

    // Conectamos el array 'items' del store que creamos en el HTML con LocalStorage
    // Esto sobreescribe la propiedad 'items' vacía con la versión persistente
    Alpine.store('cart').items = Alpine.$persist([]).as('budget_cart');
});

// Listener global
window.addEventListener('budget-sent', () => {
    if (window.Alpine) {
        Alpine.store('cart').clear();
    }
});